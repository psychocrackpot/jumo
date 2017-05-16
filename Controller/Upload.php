<?php
class Controller_Upload extends Controller_Base {
	
	public function index() {
		
		if (!isset($_FILES["filename"]) || empty($_FILES["filename"]['tmp_name'])) {
			throw new exception('No file uploaded.');
		}

		if (($handle = fopen($_FILES['filename']['tmp_name'], "r")) !== FALSE) {
			$headers = array();
			$formattedData = array();
		    while (($data = fgetcsv($handle, 0, Config::CSV_DELIMITER, Config::CSV_ENCLOSURE)) !== FALSE) {
		    	
		    	/* Let's get the headers so we can create a nice associative array */
		    	if (empty($headers)) {
		    		$headers = $data;
		    		continue;
		    	}
				if (sizeof($data) != sizeof($headers)) {
					throw new Exception('Errors in uploaded csv were found. Please check your file and try again.');
				}
		    	$formattedData[] = array_combine($headers, $data);
		    }
		    fclose($handle);
		    
		    $loans = new Model_Loans($formattedData);
		    
			$view = new View_Index();
			$vars = $loans->getCsv();
			echo $view->render(false, $loans->getCsv(), 'csv');

		} else {
			throw new Exception('Could not read uploaded file. Please make sure that your tmp directory is readable by the webserver');
		}

	}
}