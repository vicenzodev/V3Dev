<?php
header('Content-Type: application/json');
require_once '../Config/config.php';

$ip = IP_IMPRESSORA;
$impressora = new Impressora($ip);
$mensagem = "";

// Definição das ações possíveis
// Cada chave é o nome da ação vindo do POST
// O valor é uma função anônima que executa a lógica
$acoes = [
    'fan_on' => function($imp, $temp) {
        $imp->enviarComando("set", ["fan" => 1]);
        return "Ventoinha Ligada!";
    },
    'fan_off' => function($imp, $temp) {
        $imp->enviarComando("set", ["fan" => 0]);
        return "Ventoinha Parada!";
    },
    'home' => function($imp, $temp) {
        // Exemplo de comando múltiplo encapsulado
        $imp->enviarComando("set", ["autohome" => "X Y"]); 
        $imp->enviarComando("set", ["autohome" => "Z"]);
        return "Indo para home";
    },
    'bicoTemp' => function($imp, $temp) {
        $imp->enviarComando("set", ['nozzleTempControl' => (int)$temp]);
        return "Aquecendo bico para {$temp}°C";
    },
    'mesaTemp' => function($imp, $temp) {
        // Correção da estrutura baseada no seu comentário
        $payload = ["num" => 0, "val" => (int)$temp];
        $imp->enviarComando("set", ['bedTempControl' => $payload]);
        return "Aquecendo mesa para {$temp}°C";
    }
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipo = $_POST['acao'] ?? null;
    $temp = $_POST['temp'] ?? null;

    // Verifica se a ação existe no array e executa
    if ($tipo && isset($acoes[$tipo])) {
        // Chama a função correspondente passando a impressora e a temperatura
        $mensagem = $acoes[$tipo]($impressora, $temp);
    } else {
        $mensagem = "Ação desconhecida.";
    }
    
    // Retorna feedback se necessário (opcional)
    echo json_encode(['status' => 'success', 'mensagem' => $mensagem]);

} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $dados = $impressora->getData();
    echo json_encode($dados ?: ['status' => 'error', 'message' => 'Erro ao obter dados']);
}
?>