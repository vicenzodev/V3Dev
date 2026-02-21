<?php

	require_once('../Config/config.php');

	header('Content-Type: application/json');

	if(isset($_GET['id'])){
		if($_GET['id'] != ''){
			$id = (int)$_GET['id'];
			$dados = Modelo::getModeloById($id);

			if($dados){
				echo json_encode($dados);
			}else{
				echo json_encode(['erro' => 'Modelo não encontrado']);
			}
		}else{
			echo json_encode(['erro' => 'ID não identificado']);
		}
	}else{
		echo json_encode(['erro' => 'ID não identificado']);
	}
?>