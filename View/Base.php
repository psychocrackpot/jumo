<?php
abstract class View_Base {

	public function render($template =  'index.html', $vars = array(), $type = 'html') {
		
		if ($type == 'csv') {
			header('Content-Type: text/csv');
			header("Content-Transfer-Encoding: Binary"); 
			header("Content-disposition: attachment; filename=\"Output.csv\"");
			echo print_r($vars);
			return;
		}
		
		$config = Config::getInstance();
		$template = $config->getTemplatePath().DS.$template;
		if (!file_exists($template)) {
			throw new Exception("$template not found.");
		}
		$vars = array_merge($vars, $config->getTemplateVars());
		
		$html = file_get_contents($template);
		

		// TODO: This regex could use some flexibility
		$html = preg_replace_callback('!\{\{([a-zA-Z0-9._]+)\}\}!', function($matches) use ($vars) {
			if (strrpos($matches[1], '.html') === strlen($matches[1])-strlen('.html')) {
				return self::render($matches[1]);
			}
			if (!empty($vars[$matches[1]])) {
				if (strrpos($vars[$matches[1]], '.html') === strlen($vars[$matches[1]])-strlen('.html')) {
					return self::render($vars[$matches[1]], $vars);
				}				
				return $vars[$matches[1]];	
			}
			return '';//$matches[0];

		}, $html);	
		return $html;
		
	}
}
