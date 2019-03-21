<?php
class View {
    public function __construct(){
        //echo "this is view";
    }
    public function createView($viewName){
        $file = './views/'.$viewName.'.php';
        if(file_exists($file)){
            require($file);
        }
    }

}
?>