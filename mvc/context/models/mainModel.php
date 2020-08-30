<?php
require_once ('mvc/core/model.php');
class MainModel extends Model{
	protected $user_id = null;
		
	public function __construct(){
		parent::__construct();
	}

    public function getUsers(){
        $select = "
            SELECT
                `".$this->prefix."users`.`id`,
                `".$this->prefix."users`.`email`,
                `".$this->prefix."users`.`login`,
                `".$this->prefix."users`.`password`
            FROM
                `".$this->prefix."users`";
        $query = $this->sql($select);
        $row = $query->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }

    public function login($login, $password){
        $select = "
            SELECT
                `".$this->prefix."users`.`id`,
                `".$this->prefix."users`.`login`,
                `".$this->prefix."users`.`email`,
                `".$this->prefix."users`.`password`,
                `".$this->prefix."users`.`fio`
            FROM
                `".$this->prefix."users`
            WHERE
                `".$this->prefix."users`.`email` = '".$login."' OR `".$this->prefix."users`.`login` = '".$login."'";
        $query = $this->sql($select);
        $row = $query->fetchAll(PDO::FETCH_ASSOC);
       
        if(count($row) > 0){
            return [
                'auth' => password_verify($password, $row[0]['password']), 
                'id' => $row[0]['id'], 
                'login' => $row[0]['login'], 
                'email' => $row[0]['email'],
                'fio' => $row[0]['fio']
            ];
        }else{
            return false;
        }
    }

    public function update_password($id, $password){
        $stmt = $this->db->prepare("UPDATE `".$this->prefix."users` SET `".$this->prefix."users`.`password`=:pass WHERE `".$this->prefix."users`.`id`=:id;");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':pass', $password);
        $stmt->execute();       
    }

    public function insert_token($id, $token){
        $stmt = $this->db->prepare("UPDATE `".$this->prefix."users` SET `".$this->prefix."users`.`token`=:token WHERE `".$this->prefix."users`.`id`=:id;");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':token', $token);
        $stmt->execute();
    }

    public function auth($token){
        $row = [];
        $select = "
            SELECT
                `".$this->prefix."users`.`id`,
                `".$this->prefix."users`.`login`,
                `".$this->prefix."users`.`email`,
                `".$this->prefix."users`.`fio`,
                `".$this->prefix."users`.`password`
            FROM
                `".$this->prefix."users`
            WHERE
                `".$this->prefix."users`.`token` = '".$token."'";
        $query = $this->sql($select);
        $row = $query->fetchAll(PDO::FETCH_ASSOC);
        if(count($row) == 0){
            return ['auth' => false];
        }else{
            return [
                'auth' => true, 
                'id'=>$row[0]['id'], 
                'login'=>$row[0]['login'], 
                'email'=>$row[0]['email'],
                'password'=>$row[0]['password'],
                'fio'=>$row[0]['fio']
            ];             
        }
      
    }

    public function update_fio($id, $fio){
        $stmt = $this->db->prepare("UPDATE `".$this->prefix."users` SET `".$this->prefix."users`.`fio`=:fio WHERE `".$this->prefix."users`.`id`=:id;");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':fio', $fio);
        $stmt->execute(); 
    }

    public function check_id($id){
        $select = "
            SELECT
                COUNT(*) as `count`
            FROM
                `".$this->prefix."users`
            WHERE
                `".$this->prefix."users`.`id` = '".$id."'";
        $query = $this->sql($select);
        $row = $query->fetchAll(PDO::FETCH_ASSOC);
        if($row[0]['count'] > 0){
            return true;
        }else{
            return false;
        }
    }

    public function logout($id){
        $stmt = $this->db->prepare("UPDATE `".$this->prefix."users` SET `".$this->prefix."users`.`token`='' WHERE `".$this->prefix."users`.`id`=:id;");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function check_login($login) {
        $row = [];
         $select = "
            SELECT
                COUNT(*) as `COUNT`
            FROM
                `".$this->prefix."users`
            WHERE
                `".$this->prefix."users`.`login` = '".$login."'";
        $query = $this->sql($select);
        $row = $query->fetchAll(PDO::FETCH_ASSOC);
        if($row[0]['COUNT'] > 0){
            return false;
        }
        return true;
    }

    public function insert_user($login, $email, $fio, $password) {
        $stmt = $this->db->prepare("INSERT INTO `".$this->prefix."users` (`".$this->prefix."users`.`email`, `".$this->prefix."users`.`login`, `".$this->prefix."users`.`fio`, `".$this->prefix."users`.`password`, `".$this->prefix."users`.`token`) VALUES (:email, :log, :fio, :pass, '')");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':log', $login);
        $stmt->bindParam(':fio', $fio);
        $stmt->bindParam(':pass', $password);
        $stmt->execute();
    }

}