<?php
	class Modelo{

		public function __construct(
	        public string $produto,
	        public float $tempo,
	        public float $qmu,
	        public float $custo,
	        public float $markup,
	        public float $preco,
	        public string $arquivo,
	        public string $img,
	        public int $categoria_id,
	        public int $material_id
	    ) {}

	    public function setModelo(){
			$sql = MySql::conect()->prepare("INSERT INTO `catalogo` VALUES (null,?,?,?,?,?,?,?,?,?,?)");
			$sql = $sql->execute(array(
				$this->produto,
				$this->tempo,
				$this->qmu,
				$this->custo,
				$this->markup,
				$this->preco,
				$this->arquivo,
				$this->img,
				$this->categoria_id,
				$this->material_id));
			return $sql;
	    }

	    public static function getAllModelo(){
	    	$sql = MySql::conect()->prepare('SELECT * FROM `catalogo`');
	    	$sql->execute();
	    	return $sql->fetchAll(PDO::FETCH_ASSOC);
	    }

	    public static function getModeloById($id){
	    	$sql = MySql::conect()->prepare("
	    		SELECT c.produto,c.tempo,c.qmu,c.custo,c.markup,c.preco,ct.categoria,m.marca,m.cor 
	    		FROM catalogo c
	    		INNER JOIN categoria ct ON c.categoria_id = ct.id
	    		INNER JOIN material m ON c.material_id = m.id
	    		WHERE c.id = ?");
	    	$sql->execute(array($id));
	    	return $sql->fetch(PDO::FETCH_ASSOC);
	    }
	}
?>