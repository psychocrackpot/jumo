<?php
abstract class Controller_Base {
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