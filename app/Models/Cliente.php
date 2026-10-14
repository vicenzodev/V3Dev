<?php
	include('../Controllers/MySql.php');

	class Cliente{
		public function getAllClientes(){
			$sql = MySql::conect()->prepare("SELECT * FROM `usuarios`");
			$sql->execute();
			return $sql->fetchAll(PDO::FETCH_ASSOC);
		}

		public function getClientesById($id){
			$sql = MySql::conect()->prepare("SELECT * FROM `usuarios` WHERE id = ?");
			$sql->execute(array($id));
			return $sql->fetch(PDO::FETCH_ASSOC);
		}

		public function getClientesFields($fields){
			$sql = MySql::conect()->prepare("SELECT ".$fields." FROM `usuarios`");
			$sql->execute();
			return $sql->fetchAll(PDO::FETCH_ASSOC);
		}

		public function setCliente($usuario,$email,$senha){
			$sql = MySql::conect()->prepare(
				"SELECT id FROM `usuarios` WHERE usuario = ? OR email = ? LIMIT 1"
			);
			$sql->execute(array($usuario, $email));

			if ($sql->fetch(PDO::FETCH_ASSOC)) {
				throw new Exception("Usuário ou e-mail já cadastrado", 1);
			}

			$senhaHash = password_hash($senha, PASSWORD_DEFAULT);
			$data = date('Y-m-d H:i:s');

			$sql = MySql::conect()->prepare(
				"INSERT INTO `usuarios` VALUES (null,?,?,?,?)"
			);

			return $sql->execute(array($usuario,$email,$senhaHash,$data));
		}
	}
?>