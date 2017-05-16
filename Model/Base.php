<?php
abstract class Model_Base {
	
	/* Non-configurable constants go here */
    const MODEL_PATH = 'model';
    const CONTROLLER_PATH = 'controller';
    const VIEW_PATH = 'view';
    

    protected function __construct() {
    }

	/* Implement Singleton pattern for all classes */
	final public static function getInstance() {
        static $instances = array();

        $calledClass = get_called_class();

        if (!isset($instances[$calledClass])) {
            $instances[$calledClass] = new $calledClass();
        }

        return $instances[$calledClass];
    }
	
}