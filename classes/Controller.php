<?php

class Controller{

    function __construct(){
        $this->view = new View();
    }
    public function getModel($name){
        $paths = 'models/'.$name.'_model.php';
        if(file_exists($paths)){
            require './models/'.$name.'_model.php';
            $modelName = ucwords($name).'_Model';
            $this->model = new $modelName();
        }

    }

}
?>