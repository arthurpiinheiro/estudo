<?php 
	
	class Conexao extends PDO{
		private $dsn = "mysql:dbname=blog;host=localhost";
		private $user = "root";
		private $senha = "";
		private $handle = null;
		
		public function __construct()
		{
			try {
				if($this->handle == null){

					$dbh = parent::__construct($this->dsn, $this->user, $this->senha, array(PDO::ATTR_PERSISTENT => true));
					return $this->handle = $dbh;
				}
			} catch (PDOException $e) {
					die("Foi encontrado um erro: ") . $e->getMessage();
			}
		}

		public function __destruct(){
			$this->handle = null;
		}
	}

 ?>