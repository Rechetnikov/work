<?php
	require_once ('mvc/core/controller.php');
	class MainController extends Controller{
		public function main($page='index', $title="Главная страница"){
            if($this->auth()){
                $this->view->setTemplate("public/".$page.".php");
                $this->view->setTitle($title);
            }else{
                $this->view->setTemplate("public/auth.php");
                $this->view->setTitle("Авторизация");
            }
            $this->view->display();	
        }
        
        public function auth(){
            $auth['auth'] = false;
            if(isset($_COOKIE['PHPSESSID'])){
                $auth = $this->model->auth($_COOKIE['PHPSESSID']);
                if($auth['auth']){
                    $_SESSION['AUTH'] = $auth;
                }                
            }
            return $auth['auth']; 
        }

        public function loginAction(){
            $login = (!empty($_REQUEST['login']) ? $_REQUEST['login'] : '');
            $password = (!empty($_REQUEST['password']) ? $_REQUEST['password'] : '');
            $user = $this->model->login($login, $password);
            if($user['auth']){
                $_SESSION['info'] = 'Авторизация успешна';
                $_SESSION['AUTH'] = $user;
                $this->model->insert_token($user['id'], $_COOKIE['PHPSESSID']);
                $this->redirect('/');
            }else{
                $_SESSION['error'] = 'Не удалось авторизоваться!';
                $this->redirect('/');
            }
        }

        public function logoutAction(){
            $id = (isset($_SESSION['AUTH']['id']) ? $_SESSION['AUTH']['id'] : 0);
            unset($_SESSION['AUTH']);
            if($id > 0){
                $this->model->logout($id);
            }
            $this->redirect('/');
        }

        public function changepasswordAction(){
            $this->main('changepassword', "Смена пароля");
        }

        public function updatepasswordAction(){
            $error = "";

            if(!$this->auth()){
                $error .= "Вы не авторизованы!<br />";
            }

            if(empty($_REQUEST['new_password'])){
                $error .= "Пароль не должен быть пустым!<br />";
            }

            if($_REQUEST['new_password'] != $_REQUEST['retry_password']){
                $error .= "Новый пароль и повтор пароля не совпадают!<br />";
            }

            if(!password_verify($_REQUEST['old_password'], $_SESSION['AUTH']['password'])){
                $error .= "Старый пароль не верен!<br />";
            }

            if(!empty($error)){
                $_SESSION['error'] = $error;
                $this->redirect($url='/?action=changepassword');
            }else{
                $password_hash = $this->hash($_REQUEST['new_password']);
                $_SESSION['AUTH']['password'] = $password_hash;
                $this->model->update_password($_SESSION['AUTH']['id'], $password_hash);
                $_SESSION['info'] = 'Пароль успешно изменен!';
                $this->redirect('/');
            }
        }

        public function registrationAction(){
            $this->view->setTitle("Регистрация");
            $this->view->setTemplate("public/registration.php");
            $this->view->display();	
        }

        public function adduserAction(){
            $validation = $this->validation($_REQUEST);

            if(!$validation['valid']){
                $_SESSION['error'] = $validation['error'];
                $this->redirect('/?action=registration');
            }else{
                $this->model->insert_user($_REQUEST['login'], $_REQUEST['email'], $_REQUEST['fio'], $this->hash($_REQUEST['password']));
                $_SESSION['info'] = "Пользователь успешно добавлен!";
                $this->redirect('/');
            }
        }

        public function editfioAction(){
            $error = [];
            $info = [];
            if(!$this->auth()){
                $error['auth'] = "Вы не авторизованы!";
            }

            if(empty($_REQUEST['id'])){
                $error['id'] = "Не найден ID!";
            }else{
                if(!$this->model->check_id($_REQUEST['id'])){
                    $error['id'] = "Не найден ID в базе!";
                }
            }

            if(empty($_REQUEST['fio'])){
                $error['fio'] = "Не найден ФИО!";
            }

            if(count($error) > 0){
                $error['check'] = 0;
                echo json_encode($error);
            }else{
                $info['check'] = 1;
                $this->model->update_fio((int)$_REQUEST['id'], $_REQUEST['fio']);
                echo json_encode($info);
            }
            
        }

        private function validation($REQUEST){
            $error = '';

            if(empty($REQUEST['login'])){
                $error .= 'Логин не должен быть пустым!<br />';
            }else{
                if(!$this->model->check_login($REQUEST['login'])){
                    $error .= 'Данный логин уже имеется в базе!<br />';
                }
            }

            if(empty($REQUEST['email'])){
                $error .= 'E-mail не должен быть пустым!<br />';
            }else{
                if (!filter_var($REQUEST['email'], FILTER_VALIDATE_EMAIL)) {
                    $error .= "Формат ввода email не верен!<br />";
                }
            }

            if(empty($REQUEST['fio'])){
                $error .= 'ФИО не должен быть пустым!<br />';
            }

            if(empty($REQUEST['password'])){
                $error .= 'Пароль не должен быть пустым!<br />';
            }

            if(empty($REQUEST['retry_password'])){
                $error .= 'Повтор пароля не должен быть пустым!<br />';
            }

            if(!empty($REQUEST['retry_password']) AND !empty($REQUEST['password'])){
                if($REQUEST['retry_password'] != $REQUEST['password']){
                    $error .= 'Пароль и Повтор пароля должны совпадать!<br />';
                }else{
                    if(strlen($REQUEST['password']) <= 5){
                        $error .= 'Длина пароля должна быть не меньше 6-ти знаков!<br />';
                    }
                }
            }   

            if(empty($error)){
                return ['valid' => true];
            }else{
                return ['valid' => false, "error" => $error];
            }
        }

        private function hash($password){
            return password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
        }

        private function redirect($url='/'){
            echo "<script>window.location.href = 'http://work".$url."';</script>";
        }

        private function dump($par){
            echo '<pre>';
                print_r($par);
            echo '</pre>';
        }
	}
?>