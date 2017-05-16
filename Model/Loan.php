<?php
class Model_Loan {
	
	protected $_msisdn;
	protected $_network;
	protected $_date;
	protected $_month;
	protected $_product;
	protected $_amount;
	
	
	public function __construct($data) {
		
		if (!$this->_validateData($data)) {
			throw new Exception('Invalid model data supplied.');
		}
		

		$date = DateTime::createFromFormat('d-M-Y', $data['Date']);
		$this->_msisdn	= $data['MSISDN'];
		$this->_network	= $data['Network'];
		$this->_date	= $date->format('Y-m-d H:i:s');
		$this->_month	= $date->format('M');
		$this->_product = $data['Product'];
		$this->_amount	= $data['Amount'];
	}
	
	protected function _validateData($data) {
		if (
			//(empty($data['MSISDN']) || sizeof($data['MSISDN']) != 11) ||
			(empty($data['Network'])) ||
			(empty($data['Date'])) ||
			(empty($data['Product'])) ||
			(empty($data['Amount']) || !is_numeric($data['Amount']))
		) { return false; }
		
		return true;
	}
	
	public function getMsisdn() {
		return $this->_msisdn;
	}
	public function getNetwork() {
		return $this->_network;
	}
	public function getDate() {
		return $this->_getDate();
	}
	public function getMonth() {
		return $this->_month;
	}
	public function getProduct() {
		return $this->_product;
	}
	public function getAmount() {
		return $this->_amount;
	}
}