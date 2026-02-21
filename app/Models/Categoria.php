<?php

	class Categoria{
		public static function getAllCategoria(){
			$sql = MySql::conect()->prepare("SELECT * FROM `categoria`");
			$sql->execute();
			return $sql->fetchAll(PDO::FETCH_ASSOC);
		}

		public function getCategoriaById($id){
			$sql = MySql::conect()->prepare("SELECT * FROM `categoria` WHERE id = ?");
			$sql->execute(array($id));
			return $sql->fetch(PDO::FETCH_ASSOC);
		}

		public function setCategoria($categoria){
			$verify = $this->getAllCategoria();

			foreach ($verify as $key => $value) {
				if($value['categoria'] == $categoria){
					throw new Exception("A categoria já existe :/", 1);
				}
			}
			$sql = MySql::conect()->prepare("INSERT INTO `categoria` VALUES (null,?)");
			$sql = $sql->execute(array($categoria));
			return $sql;
		}

		public static function deleteCategoria($id){
			$sql = MySql::conect()->prepare("DELETE FROM `categoria` WHERE id = ?");
			$sql = $sql->execute(array($id));
			return $sql;
		}
	}
?>