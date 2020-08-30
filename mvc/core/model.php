<?php

require_once ('mvc/tools/db.php');
require_once ('mvc/tools/DBConfig.php');

class Model{
	protected $db;
	protected $dbConfig;
	protected $prefix;
	protected $user_group_page;
	protected $user_id = null;
	protected $auth = null;


	public function __construct(){
		$this->dbConfig = new DBConfig();
		$config = $this->dbConfig->getConfig();
		$this->prefix = $config['prefix'];
		$dbCreator = new DB($config);
		$this->db = $dbCreator->getDB();
	}
	
	public function sql($select){
		$result = $this->db->query($select);	
		return $result;
	}
}

?>