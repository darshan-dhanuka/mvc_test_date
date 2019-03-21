<?php

class Index{
    function __construct(){
        $url = explode('/',$_GET['url']);
        //check session here
        //throw out if session does not exist !
        //set session after verifying credentials
        if($url[0] == '' || $url[0] == 'index.php'){
            if(file_exists('./controllers/home.php')){
                require_once('./controllers/home.php');
            }
            $controller = new Home();
            $controller->Index();
        }else{
            if(file_exists('./controllers/'.trim(strtolower($url[0]).'.php'))){
                require_once('./controllers/'.trim(strtolower($url[0])).'.php');
                $name = trim(ucwords(strtolower($url[0])));
                $controller = new $name;
                $controller->getModel(trim(strtolower($url[0])));

                if(isset($url[1])){
                    if(method_exists($controller,$url[1])){
                        $controller->{$url[1]}();
                    }else{
                        echo "There was some error. Please check your URL";
                    }
                }else{
                    $controller->Index();
                }
            }else{
                if(file_exists('./controllers/home.php')){
                    require_once('./controllers/home.php');
                }
                $controller = new Home();
                $controller->Index();
            }
        }


    }
}

?>