<?php
require_once ('mvc/core/view.php');
class ViewHTML extends View{
	protected $data=[];
	protected $styles=[];
	protected $scripts=[];
	protected $template;
	protected $title="";
	
	public function __construct(){
		// ---
		// ---
	}

	public function display(){
		$config=[
			'scripts' =>$this->scripts,
			'styles' => $this->styles
		];
		$this->printHeader($this->title, $config);
		$this->displayTemplate();
		$this->printFooter();
		unset($_SESSION['info']); unset($_SESSION['error']);
	}
	
	protected function displayTemplate(){
		require_once($this->template);
	}

	public function setTitle($title){
		$this->title = $title;
	}

	public function setTemplate($template){
		$this->template = $template;
	}

	protected function printHeader($title, $config){
        require_once($this->header);
	}

	protected function printFooter(){
        require_once($this->footer);
	}

}

?>