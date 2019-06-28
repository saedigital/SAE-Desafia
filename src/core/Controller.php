<?php 
class Controller {

	public function __construct(){
		
	}

	public function loadview($viewName, $viewData = array()){
		extract($viewData);
		include 'views/'.$viewName.'.php';
	}

	public function loadTemplate($viewName, $viewData = array()){
		include 'views/template.php';
	}

	public function loadViewInTemplate($viewName, $viewData = array()){
		extract($viewData);
		include 'views/'.$viewName.'.php';
	}

	public function loadIndexTemplate($viewName, $viewData = array()){
		extract($viewData);
		include 'views/indexTemplate.php';
	}
}