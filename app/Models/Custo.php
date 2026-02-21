<?php

	class Custo{
		public static function getAllCusto(){
			$sql = MySql::conect()->prepare("SELECT * FROM `custos`");
			$sql->execute();
			return $sql->fetchAll(PDO::FETCH_ASSOC);
		}

		public function getCustoById($id){
			$sql = MySql::conect()->prepare("SELECT * FROM `custos` WHERE id = ?");
			$sql->execute(array($id));
			return $sql->fetch(PDO::FETCH_ASSOC);
		}

		public function getCustoFields($fields){
			$sql = MySql::conect()->prepare("SELECT ".$fields." FROM `custos`");
			$sql->execute(array());
			return $sql->fetch(PDO::FETCH_ASSOC);
		}

		public function setCusto($nome,$custo,$quantidade,$data_inicio,$data_final,$ativo){
			$sql = MySql::conect()->prepare("INSERT INTO `custos` VALUES (null,?,?,?,?,?,?)");
			$sql = $sql->execute(array($nome,$custo,$quantidade,$data_inicio,$data_final,$ativo));
			return $sql;
		}

		public static function deleteCusto($id){
			$sql = MySql::conect()->prepare("DELETE FROM `custos` WHERE id = ?");
			$sql = $sql->execute(array($id));
			return $sql;
		}

		public static function updateCusto($id,$field,$value){
			$sql = MySql::conect()->prepare('UPDATE `custos` SET '.$field.' = ? WHERE id = ?');
			$sql = $sql->execute(array($field,$id));
			return $sql;
		}
	}
?>