<?php
class Impressora {
    private $ip;
    private $port;

    public function __construct($ip, $port = 9999) {
        $this->ip = $ip;
        $this->port = $port;
    }

    // --- LER DADOS (Mantivemos igual, pois funciona) ---
    public function getData() {
        $socket = $this->conectar();
        if (!$socket) return ['error' => "Offline"];

        // Ignora Headers
        while($line = fgets($socket)) if(trim($line) == "") break;

        stream_set_timeout($socket, 2);
        $buffer = "";
        $startTime = time();
        $jsonData = null;

        while ((time() - $startTime) < 3) {
            $chunk = fread($socket, 2048);
            if (!$chunk) { usleep(100000); continue; }
            $buffer .= $chunk;

            $start = strpos($buffer, '{');
            $end = strrpos($buffer, '}');

            if ($start !== false && $end !== false && $end > $start) {
                $candidate = substr($buffer, $start, ($end - $start) + 1);
                $decoded = json_decode($candidate, true);
                if ($decoded !== null) {
                    $jsonData = $decoded;
                    break;
                }
            }
        }
        fclose($socket);
        return $jsonData ?? ['error' => 'Timeout leitura'];
    }

    // --- ENVIAR COMANDOS (ATUALIZADO PARA O FORMATO QUE VOCÊ ACHOU) ---
    public function enviarComando($metodo, $params) {
        $socket = $this->conectar();
        if (!$socket) return "Erro de Conexão";

        // Ignora Headers
        while($line = fgets($socket)) if(trim($line) == "") break;

        // Monta o JSON exatamente como você viu no navegador
        $payload = json_encode([
            "method" => $metodo,   // Ex: "set"
            "params" => $params,   // Ex: {"fan": 1}
            "id" => rand(1, 9999)  // Identificador único da requisição
        ]);

        // Cria o frame binário e envia
        $frame = $this->criarFrameWebSocket($payload);
        fwrite($socket, $frame);
        
        fclose($socket);
        return "Enviado: $payload";
    }

    // --- AUXILIARES ---
    private function conectar() {
        $socket = @fsockopen($this->ip, $this->port, $errno, $errstr, 2);
        if (!$socket) return false;
        
        // Handshake Simples
        $key = base64_encode(uniqid() . uniqid());
        $header = "GET / HTTP/1.1\r\nHost: {$this->ip}:{$this->port}\r\nUpgrade: websocket\r\nConnection: Upgrade\r\nSec-WebSocket-Key: $key\r\nSec-WebSocket-Version: 13\r\n\r\n";
        fwrite($socket, $header);
        return $socket;
    }

    private function criarFrameWebSocket($text) {
        $length = strlen($text);
        if($length <= 125) $header = pack('CC', 0x81, $length + 128);
        elseif($length < 65536) $header = pack('CCn', 0x81, 126 + 128, $length);
        else $header = pack('CCJ', 0x81, 127 + 128, $length);

        $mask = []; 
        for ($i = 0; $i < 4; $i++) $mask[] = rand(0, 255);
        $frame = $header . pack('C*', ...$mask);
        for ($i = 0; $i < $length; $i++) $frame .= chr(ord($text[$i]) ^ $mask[$i % 4]);
        return $frame;
    }
}

?>