<?php
	include('../Controllers/MySql.php');

	class Cliente{
		public function getAllClientes(){
			$sql = MySql::conect()->prepare("SELECT * FROM `usuarios`");
			$sql = $sql->execute();
			return $sql->fetch(PDO::FETCH_ASSOC);
		}

		public function getClientesById($id){
			$sql = MySql::conect()->prepare("SELECT * FROM `usuarios` WHERE id = ?");
			$sql->execute(array($id));
			return $sql->fetch(PDO::FETCH_ASSOC);
		}

		public function getClientesFields($fields){
			$sql = MySql::conect()->prepare("SELECT ".$fields." FROM `usuarios`");
			$sql->execute(array());
			return $sql->fetch(PDO::FETCH_ASSOC);
		}

		public function setCliente($usuario,$email,$senha){
			$senha = password_hash($senha, PASSWORD_DEFAULT);
			$data = date('Y-m-d H:i:s');
			$fields = 'usuario,email';
			$verify = getClientesFieldsById($fields);

			foreach ($verify as $key => $value) {
				if($value['usuario'] == $usuario || $value['email'] == $email){
					throw new Exception("Usuário ou e-mail já cadastrado", 1);
				}
			}
			$sql = MySql::conect()->prepare("INSERT INTO `usuarios` VALUES (null,?,?,?,?)");
			$sql = $sql->execute(array($usuario,$email,$senha,$data));
			return $sql;
		}
	}
?>