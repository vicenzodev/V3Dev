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
			$sql->execute();
			return $sql->fetch(PDO::FETCH_ASSOC);
		}

		public function setCusto($nome,$custo,$quantidade,$data_inicio,$data_final,$ativo){
			$sql = MySql::conect()->prepare("INSERT INTO `custos` VALUES (null,?,?,?,?,?,?)");
			return $sql->execute(array($nome,$custo,$quantidade,$data_inicio,$data_final,$ativo));
		}

		public static function deleteCusto($id){
			$sql = MySql::conect()->prepare("DELETE FROM `custos` WHERE id = ?");
			return $sql->execute(array($id));
		}

		public static function updateCusto($id,$field,$value){
			$allowedFields = [
				'nome',
				'custo',
				'quantidade',
				'data_inicio',
				'data_final',
				'ativo'
			];

			if (!in_array($field, $allowedFields, true)) {
				throw new InvalidArgumentException("Campo inválido para atualização.");
			}

			$sql = MySql::conect()->prepare(
				"UPDATE `custos` SET {$field} = ? WHERE id = ?"
			);

			return $sql->execute(array($value,$id));
		}
	}
?>