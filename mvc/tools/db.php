<?php
class DB{
		private $db;
		private $host;
		private $user;
		private $pass;
		private $name;
		
		public function getDB(){
			return $this->db;
		}
		
		function __construct($config){
			$this->host = $config['host'];
			$this->user = $config['user'];
			$this->pass = $config['pass'];
			$this->name = $config['name'];
			$this->open_connection();
		}

		private function open_connection()
		{

			try{
				$this->db = new PDO('mysql:host='.$this->host.';dbname='.$this->name, $this->user, $this->pass);
				$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
			catch(PDOException $e){
				echo 'Ошибка доступа к БД :: Error accessing database';
				exit;
			}

		}

		public function sql($select)
		{
			$sth = $this->link->prepare($sql);
			return $sth->execute();
		}

	}
?>	