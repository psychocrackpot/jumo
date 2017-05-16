<?php
class Controller_Index extends Controller_Base {
	
	public function index() {
		$view = new View_Index();
		$vars = array(
			'content'	=> 'forms/csv_upload.html'	
		);
		echo $view->render('index.html', $vars);
	}
}