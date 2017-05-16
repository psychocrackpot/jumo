<?php
class Config extends Model_Base {
	
	
	/* Paths are relative to document root */
	const TEMPLATE_PATH = 'templates';
	const UPLOAD_PATH = 'var/uploads';

	
	const CSV_DELIMITER = ',';
	const CSV_ENCLOSURE = '\'';

	protected $_templatePath;
	protected $_uploadPath;
	
	protected $_templateVars = array(
		'author_name'		=> 'Steve van de Heuvel',
		'author_email'		=> 'steve@vdh.za.net',
		'copyright_year'	=> 2017,
		'page_title'		=> 'Jumo - Loan Account Aggregate calculator'
	);

	
	protected function __construct() {
		
		$this->_templatePath = BP.DS.self::TEMPLATE_PATH;

		$this->_uploadPath = realpath(self::UPLOAD_PATH);
		/* Let's make sure the upload path existed and is writable */
		if (!$this->_uploadPath) {
			mkdir(dirname(__FILE__).'/'.self::UPLOAD_PATH.'/processed', 0777, true);
			$this->_uploadPath = realpath(self::UPLOAD_PATH);
		}
	}
	
	public function getTemplatePath() {
		return $this->_templatePath;
	}
	
	public function getTemplateVars() {
		return $this->_templateVars;
	}
	
	public function getUploadPath() {
		return $this->_uploadPath;
	}
}