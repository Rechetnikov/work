<?php
    session_start();
    ini_set('error_reporting', E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);

	$root = $_SERVER['DOCUMENT_ROOT'];
	
	require_once ($root.'/mvc/init.php');
	require_once('mvc/context/controllers/mainController.php');


    require_once('mvc/context/views/mainView.php');
    $view = new MainView();

    require_once('mvc/context/models/mainModel.php');
    $model = new MainModel();

    $controller = new MainController($model, $view);
    $action = "main";

    if(isset($_REQUEST['action'])):
        $action = $_REQUEST['action']."Action";
    endif;

    // echo "<pre>"; print_r(password_hash("123", PASSWORD_BCRYPT, ['cost' => 12])); echo "</pre>";
    $controller->$action();

?>