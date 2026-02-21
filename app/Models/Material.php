<?php

	class Material{
		public static function getAllMaterial(){
			$sql = MySql::conect()->prepare("SELECT * FROM `material`");
			$sql->execute();
			return $sql->fetchAll(PDO::FETCH_ASSOC);
		}

		public static function getMaterialById($id){
			$sql = MySql::conect()->prepare("SELECT * FROM `material` WHERE id = ?");
			$sql->execute(array($id));
			return $sql->fetch(PDO::FETCH_ASSOC);
		}

		public function getMaterialFields($fields){
			$sql = MySql::conect()->prepare("SELECT ".$fields." FROM `material`");
			$sql->execute();
			return $sql->fetchAll(PDO::FETCH_ASSOC);
		}

		public function setMaterial($nome,$marca,$cor,$custo,$peso,$disponivel){
			$fields = 'nome,marca,cor';
			$verify = $this->getMaterialFields($fields);

			foreach ($verify as $key => $value) {
				if($value['nome'] == $nome && $value['marca'] == $marca && $value['cor'] == $cor){
					throw new Exception("O material já existe :/", 1);
				}
			}
			$sql = MySql::conect()->prepare("INSERT INTO `material` VALUES (null,?,?,?,?,?,?)");
			$sql = $sql->execute(array($nome,$marca,$cor,$custo,$peso,$disponivel));
			return $sql;
		}

		public static function deleteMaterial($id){
			$sql = MySql::conect()->prepare("DELETE FROM `material` WHERE id = ?");
			$sql = $sql->execute(array($id));
			return $sql;
		}
	}
?>