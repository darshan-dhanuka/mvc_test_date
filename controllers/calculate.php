<?php
class Calculate extends Controller{
    function __construct(){
        parent::__construct();
    }
    function Index(){
        $this->view->createView('default_home');
    }
    function get_dates(){
        $dataArr =  $this->model->get_date_array();
        echo"<table border=1>";
        echo"<tr><th>Month</th><th>Salary Payout Day</th><th>Bonus Payout Day</th></tr>";
        foreach($dataArr as $k=>$v){
            echo "<tr><td>".$v['month']."</td><td>".$v['last_day']."</td><td>".$v['bonus_day']."</td></tr>";
        }
        echo"</table>";
    }
    function get_dates_view(){
        $this->view->dataArr =  $this->model->get_date_array();
        $this->view->createView('date_views');
    }
    function get_dates_view_js(){
        $this->view->createView('date_views_js');
    }
    function get_dates_for_js(){
        echo  $this->model->get_dates_for_js();
    }
    function download_csv(){
       $dateArr = $this->model->get_date_array();
       $file = fopen('php://output', 'w');
       fputcsv($file, array('month','salary date','bonus date'));
       foreach ($dateArr as $k=>$v) 
       {
           fputcsv($file,array($v['month'],$v['last_day'],$v['bonus_day']));
       }
       fclose($file);
        $file_name = "file.csv";
        header( "Content-Type: text/csv;charset=utf-8" );
        header( "Content-Disposition: attachment;filename=\"$file_name\"" );
        header("Pragma: no-cache");
        header("Expires: 0");

    }
    function insert_in_table(){
        echo  $this->model->insert_in_table();
    }
    function fetch_from_table(){
        echo  $this->model->fetch_from_table();
    }

}

?>