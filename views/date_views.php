<!DOCTYPE html>
<h1>Welcome</h1>

<h2>Below are the dates for payout of following year</h2>

<table border=1 style="border-collapse:collapse;">
<tr><th>Month</th><th>Salary Payout Day</th><th>Bonus Payout Day</th></tr>
<?php foreach ($this->dataArr as $k=>$v){?>

<tr><td><?=$v['month']?></td><td><?=$v['last_day']?></td><td><?=$v['bonus_day']?></td></tr>

<?php } ?>
</table>
