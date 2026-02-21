<?php
	class MySql{

		private static $pdo;

		public static function conect(){
			if(self::$pdo == null){
				try{
					self::$pdo = new PDO("mysql:host=".HOST.";dbname=".DBNAME,USER,PASSWORD,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
					self::$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				}catch(Exception $e){
					echo '<script>alert("Não foi possível se conectar, verifique a conexão com internet :/")</script>';
				}
			}
			return self::$pdo;
		}
	}
?>