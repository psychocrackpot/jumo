<?php
class Controller_Http_Error extends Controller_Base {
	
    /**
     * Error Handler
     *
     * @param integer $code
     * @param string $message
	 *
     */

	public function index($code = 404, $message = false) {
		http_response_code($code);
		
		$view = new View_Index();
		$vars = array(
			'content'	=> "errors/$code.html",
			'message'	=> $message
			
		);
		echo $view->render('index.html', $vars);
	}
}