<!DOCTYPE html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $('#get_dates').click(function(){
        $.ajax({
            type:"GET",
            dataType:'json',
            url: "./get_dates_for_js",
            success:function(result){
                if(result.errorcode ==0){
                    var html = '';
                    html += '<table border=1 style="border-collapse:collapse;">';
                    html += '<tr><th>Month</th><th>Salary Payout Day</th><th>Bonus Payout Day</th></tr>';
                    $.each(result.data,function(k,v){
                        html += '<tr><td>'+v['month']+'</td><td>'+v['last_day']+'</td><td>'+v['bonus_day']+'</td></str>';
                    });
                    html += '</table>';
                    $('#html_data').empty();
                    $('#html_data').append(html);
                }
            }
        });
    });
    $('#download').click(function(){
        window.location.href = './download_csv';
    });
    $('#insert_in_table').click(function(){
        $.ajax({
            type:"GET",
            dataType:'json',
            url: "./insert_in_table",
            success:function(result){
                if(result.errorcode ==0){
                    alert('Inserted successfully');
                }else{
                    alert('Some error occured. Please try later');
                }
            }
        });
    });
    $('#fetch_from_table').click(function(){
        $.ajax({
            type:"GET",
            dataType:'json',
            url: "./fetch_from_table",
            success:function(result){
                if(result.errorcode ==0){
                    var html = '';
                    html += '<table border=1 style="border-collapse:collapse;">';
                    html += '<tr><th>Month</th><th>Salary Payout Day</th><th>Bonus Payout Day</th></tr>';
                    $.each(result.data,function(k,v){
                        html += '<tr><td>'+v['month']+'</td><td>'+v['salary_date']+'</td><td>'+v['bonus_date']+'</td></str>';
                    });
                    html += '</table>';
                    $('#html_data').empty();
                    $('#html_data').append(html);
                }else{
                    alert('Some error occured. Please try later');
                }
            }
        });
    });
});
</script>
</head>

<h1>Welcome</h1>

<input type="button" id="get_dates" value = "Get Dates For Year"><br><br>
<input type="button" id="download" value = "Download"><br><br>
<input type="button" id="insert_in_table" value = "Insert Dates In Table"><br><br>
<input type="button" id="fetch_from_table" value = "Fetch Dates From Table"><br><br>

<div id ="html_data"></div>

