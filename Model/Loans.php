<?php
class Model_Loans {
	
	protected $_loans;
	protected $_aggregateData;

	public function __construct(array $data) {
		
		if (empty($data)) {
			throw new Exception('No loan data received.');
		}
		
		$loans = array();
		
		foreach ($data as $d) {
			$loan = new Model_Loan($d);
			$loans[] = $loan;
		}
		$this->_loans = $loans;
		$this->_aggregateData = $this->_getAggregateData();
	}
	
	protected function _getAggregateData() {
		$return = array();
		
		foreach ($this->_loans as $l) {
			if (!array_key_exists($l->getNetwork(), $return)) {
				$return[$l->getNetwork()] = array();
			}
			if (!array_key_exists($l->getProduct(), $return[$l->getNetwork()])) {
				$return[$l->getNetwork()][$l->getProduct()] = array();
			}
			if (!array_key_exists($l->getMonth(), $return[$l->getNetwork()][$l->getProduct()])) {
				$return[$l->getNetwork()][$l->getProduct()][$l->getMonth()] = array(
					'count'		=> 0,
					'total'		=> 0,
					'aggregate' => 0
				);
			}
			$return[$l->getNetwork()][$l->getProduct()][$l->getMonth()]['count']++;
			$return[$l->getNetwork()][$l->getProduct()][$l->getMonth()]['total'] += $l->getAmount();
			$return[$l->getNetwork()][$l->getProduct()][$l->getMonth()]['aggregate'] = $return[$l->getNetwork()][$l->getProduct()][$l->getMonth()]['total'] / $return[$l->getNetwork()][$l->getProduct()][$l->getMonth()]['count'];

		}
		
		return $return;
	}
	
	public function getCsv() {
		$return = array();
		$return[] = implode(Config::CSV_DELIMITER, array(
			Config::CSV_ENCLOSURE."Network".Config::CSV_ENCLOSURE,
			Config::CSV_ENCLOSURE."Product".Config::CSV_ENCLOSURE,
			Config::CSV_ENCLOSURE."Month".Config::CSV_ENCLOSURE,
			Config::CSV_ENCLOSURE."Count".Config::CSV_ENCLOSURE,
			Config::CSV_ENCLOSURE."Aggregate".Config::CSV_ENCLOSURE
		));
		
		foreach ($this->_aggregateData as $network => $products) {
			foreach ($products as $product => $months) {
				foreach ($months as $month => $data) {
					$return[] = implode(Config::CSV_DELIMITER, array(
						Config::CSV_ENCLOSURE.$network.Config::CSV_ENCLOSURE,
						Config::CSV_ENCLOSURE.$product.Config::CSV_ENCLOSURE,
						Config::CSV_ENCLOSURE.$month.Config::CSV_ENCLOSURE,
						$data['count'],
						$data['aggregate'],
						
					));
					
				}
			}
		}

		return implode("\n", $return);
	}

}