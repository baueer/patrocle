<?php

class Bootstrap {

    function __construct() {
        if(empty($_GET['url'])) { // daca nu exista controller dupa dns, redirectioneaza pe login page (temporar)
            // TODO - redirect in functie de existenta unei sesiuni fie pe login, fie pe dashboard
            // TODO - daca exista landing page, redirect acolo
            // require 'Controllers/login.php';
            // $controller = new Login;
            
            header('location: '.ROOT.LOGIN_ROUTE);
            return false;
        }

        $url = explode('/', rtrim($_GET['url'], '/'));
        
        // $url[0] = controller, $url[1] = method

        $file = 'Controllers/' . $url[0] . '.php';
        if(file_exists($file)) {
            require $file;
        } else {
            require_once 'Controllers/error.php';
            $controller = new ErrorController;

            return false;
        }
        if($url[0] == 'error') $url[0] = 'ErrorController';
        $controller = new $url[0];

        if(isset($url[2])) {
            $controller -> {$url[1]}($url[2]);
        } else {
            if(isset($url[1])) {
                $controller -> {$url[1]}();
            }
        }
    }

}