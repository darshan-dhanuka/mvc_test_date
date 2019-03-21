<?php


class Home_Model extends Model{
    function __construct(){
        parent::__construct();
    }
    function test_function(){
        $conn = $this->connect();

        $cr_table = "CREATE TABLE test(test VARCHAR(10))";      
        $con_check = mysqli_query($conn,$cr_table) or die(mysqli_error($conn));
    }

}


?>