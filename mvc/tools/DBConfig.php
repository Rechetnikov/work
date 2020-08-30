<?php
class DBConfig{
	protected $host = "127.0.0.1";
	protected $user = "root";
	protected $pass = "";
	protected $name;
	protected $prefix = "r63_";

	protected $db_names = [
		'127.0.0.1' => 'work'
	];

	public function __construct(){
		$server_name = $_SERVER['SERVER_NAME'];
		if(array_key_exists($server_name, $this->db_names)){
			$this->name = $this->db_names[$server_name];	
		}else{
			$this->name = 'work';
		}
	}
	
	public function getConfig(){
		$config=[
			'host' => $this->host,
			'user' => $this->user,
			'pass' => $this->pass,
			'name' => $this->name,
			'prefix' => $this->prefix,
		];
		return $config;
	}
}
	
?>	