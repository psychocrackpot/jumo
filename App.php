<?php
class App extends Model_Base {
    
    /**
     * Start application
     *
     */
     public function run() {

        $requestUri = strtolower(strtok($_SERVER["REQUEST_URI"],'?'));
        $requestUri = trim($requestUri, '/');
        if (!$requestUri) { $requestUri = 'index'; }
        
        $requestUri = explode('/', $requestUri);
        $action = 'index';        
        
        if (sizeof($requestUri) == 1) {
            $controller = ucfirst($requestUri[0]);
        } elseif (sizeof($requestUri) > 1) {
            $action = array_pop($requestUri);
            $controller = str_replace(' ', '_', ucwords(implode(' ', $requestUri)));
        } else {
            $controller = 'Controller_Http_Error';
            $controllerClass = $controller::getInstance();
            $controllerClass->$action(404, 'Page not found.');
            
        }
        $controller = 'Controller_'.$controller;
        
        try {
            
            $controllerClass = $controller::getInstance();
            
            $controllerClass->$action();
        } catch (Exception $e) {
            $action = 'index';        
            $controller = 'Controller_Http_Error';
            $controllerClass = $controller::getInstance();
            $controllerClass->$action(404, 'Page not found.');
            
        }

    }
}
