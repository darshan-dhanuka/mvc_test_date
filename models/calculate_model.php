<?php

class Calculate_Model extends Model{
    function __construct(){
        parent::__construct();
    }
    function get_date_array(){
        $conn = $this->connect();
       
        $curr_month = date('n');
        $n = 0;
        for($i = $curr_month;$i<=12;$i++){
            $last_day = date('Y-m-t',strtotime(date('Y-'.$i.'-01')));
            $check_weekend = $this->check_weekend_date($last_day);
            if($check_weekend > 0){
                if($check_weekend == 7){
                    $last_day = date('Y-m-d',strtotime($last_day .' -2 days'));
                }else{
                    $last_day = date('Y-m-d',strtotime($last_day .' -1 days'));
                }
            }
            $last_day_arr[] = $last_day;
            
            $bonus_day = date('Y-m-15',strtotime(date('Y-'.$i.'-01')));
            $check_weekend_bonus = $this->check_weekend_date($bonus_day);
            if($check_weekend_bonus > 0){
                if($check_weekend_bonus == 7){
                    $bonus_day = date('Y-m-d',strtotime($bonus_day .' +3 days'));
                }else{
                    $bonus_day = date('Y-m-d',strtotime($bonus_day .' +4 days'));
                }
            }
            $bonus_day_arr[] = $bonus_day;
            $dataArr[$n]['month'] = date('F Y',strtotime(date('Y-'.$i.'-01')));
            $dataArr[$n]['last_day'] = $last_day;
            $dataArr[$n]['bonus_day'] = $bonus_day;
            $n++;
        }
        return $dataArr;
    }
    public function check_weekend_date($date){
        if(date('N', strtotime($date)) >= 6){
            return date('N', strtotime($date));
        }else{
            return 0;
        }
    }
    public function get_dates_for_js(){
       $dates['data'] = $this->get_date_array();
       $dates['errorcode'] = 0;
       return json_encode($dates);
    }
    public function insert_in_table(){
        $conn = $this->connect();
        if(!$conn){
            $resp['errorcode'] = 1;
            return json_encode($resp);
        }

        $cr_table = "CREATE TABLE IF NOT EXISTS tbl_payout_dates(id int AUTO_INCREMENT NOT NULL PRIMARY KEY, month VARCHAR(20) NOT NULL UNIQUE KEY,bonus_date date , salary_date date)";      
        $con_cr = mysqli_query($conn,$cr_table);
        $dateArr = $this->get_date_array();
        $insert_str ='';
        foreach($dateArr as $k=>$v){
            $insert_str .= "('".$v['month']."','".$v['last_day']."','".$v['bonus_day']."'),";
        }
        $insert_str = rtrim($insert_str,',');
        $trunc_table = "TRUNCATE TABLE tbl_payout_dates";
        $con_trunc = mysqli_query($conn,$trunc_table);

        $ins_dates = "INSERT INTO tbl_payout_dates (month,salary_date,bonus_date) VALUES ".$insert_str;
        $con_ins = mysqli_query($conn,$ins_dates);
        if($con_ins){
            $resp['errorcode'] = 0;
        }else{
            $resp['errorcode'] = 1;
        }
        return json_encode($resp);
    }
    public function fetch_from_table(){
        $conn = $this->connect();
        if(!$conn){
            $resp['errorcode'] = 1;
            return json_encode($resp);
        }
        $fetch_dates = "SELECT * FROM tbl_payout_dates ORDER BY id";
        $con_fetch = mysqli_query($conn,$fetch_dates);
        if($con_fetch){
            $resp['errorcode'] = 0;
            if(mysqli_num_rows($con_fetch) > 0){
                while($row = mysqli_fetch_array($con_fetch,MYSQLI_ASSOC)){
                    $resp['data'][] = $row;
                }
            }
        }else{
            $resp['errorcode'] = 1;
        }
        return json_encode($resp);
    }
}


?>