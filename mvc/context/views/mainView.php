<?php
require_once ('mvc/core/viewHTML.php');
class MainView extends ViewHTML{
	public function __construct(){
        $this->header = "public/blocks/header.php";
        $this->footer = "public/blocks/footer.php";

        $this->styles=['public/css/bootstrap.min.css', 'public/css/jquery-ui.css', 'public/css/main.css'];
		$this->scripts=['public/js/jquery.min.js', 'public/js/jquery-ui.js', 'public/js/main.js'];
	}
}
?>