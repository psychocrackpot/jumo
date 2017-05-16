<?php
define('BP', $_SERVER['DOCUMENT_ROOT']);
define('DS', DIRECTORY_SEPARATOR);


/* Simple autoloader for models, controllers, views */
spl_autoload_register(function ($className) {
    $classPath = str_replace('_', DS, $className);
    if (file_exists($classPath . '.php')) { 
          require_once $classPath . '.php'; 
          return true; 
    }
    throw new Exception("$className doesn't exist.");
});


$app = App::getInstance();

$app::run();
?>