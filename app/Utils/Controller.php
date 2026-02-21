<?php
	
	class Controller{
		public static function isLogged(){
			return isset($_COOKIE['login']) ? true : false;
		}

		public static function alert($type, $msg) {
		    // Sanitiza a mensagem para evitar que aspas quebrem o JS
		    $cleanMsg = addslashes($msg); 
		    
		    // Mapeia os tipos se necessário, ou passa direto
		    // No seu JS definimos: 'sucesso', 'erro', 'alerta'
		    
		    echo "<script>
		        document.addEventListener('DOMContentLoaded', function() {
		            if(typeof showToast === 'function') {
		                showToast('$type', '$cleanMsg');
		            } else {
		                console.error('Função showToast não encontrada.');
		                // Fallback para alert nativo se o JS falhar
		                alert('$cleanMsg'); 
		            }
		        });
		    </script>";
		}

		public static function uploadArquivo($arquivo){
	        $nome_original = $arquivo['name'];
	        $tipo_mime = $arquivo['type'];
	        $tamanho = $arquivo['size']; // em bytes
	        $temp_path = $arquivo['tmp_name'];
	        $erro = $arquivo['error']; // 0 para sucesso, outros valores para erros [1]

	        // Verifica se não houve erro no upload
	        if ($erro === UPLOAD_ERR_OK) {
	            // Define o diretório de destino final
	            $diretorio_destino = 'uploads/';

	            // Cria um nome de arquivo único para evitar sobrescrever arquivos
	            $nome_final = uniqid() . '_' . basename($nome_original);
	            $final_path = $diretorio_destino . $nome_final;

	            // Move o arquivo temporário para o diretório de destino permanente
	            if (move_uploaded_file($temp_path, $final_path)) {
	                return $nome_final;
	            } else {
	                throw new Exception("Erro ao mover o arquivo enviado.");
	            }
	        } else {
	            throw new Exception("Ocorreu um erro durante o upload. Código do erro: " . $erro);
	        }
	    }
	}

?>