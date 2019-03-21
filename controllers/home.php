<?php
class Home extends Controller{
    function __construct(){
        parent::__construct();
    }
    function Index(){
        $this->view->createView('default_home');
    }
    function get_my_view(){
        //echo"testing_method_call";
        $this->model->test_function();
    }

}

?>