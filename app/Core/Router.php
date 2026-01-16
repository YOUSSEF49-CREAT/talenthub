<?php

class Router
{
    public function handleRequest()
    {
        $uri = $_SERVER['REQUEST_URI'] ;

        $uri = parse_url($uri , PHP_URL_PATH) ;

        $scriptName = $_SERVER['SCRIPT_NAME'];

        if(strops($uri , $scriptName) === 0)
        {
           $uri = substr($uri , strlen($scriptName)) ;
        }

        if($uri == '' || $uri == '/'){
            $controller = 'AuthController';
            $method = 'home' ;
        }else{
            $parts = explode('/' , trim($uri , '/')) ;

            $controller = ucfirst($parts[0]).'Controller' ;
            $methode = $parts[1] ?? 'index' ;

        }

        $controllerFile = __DIR__ .'/../Controllers/'.$controller.'.php';
         
        if (!file_exists($controllerFile)) {
            die("404 - Controller not found");
        }

        require_once $controllerFile;

        if (!class_exists($controller)) {
            die("404 - Controller class not found");
        }

        $controllerInstance = new $controller();

        if (!method_exists($controllerInstance, $method)) {
            die("404 - Method not found");
        }

        $controllerInstance->$method();
    }
}