<a href="by_year.php"> Click here to go back </a> <br><br>

<?php
require 'core/init.php';

$date1 = $_GET['date1'];
$date2 = $_GET['date2'];

$total_invoices = $invoices->search_invoices($date1, $date2);
$total_deposits = $payment->search_deposits($date1, $date2);
$total_income = $total_invoices + $total_deposits;

if($date1=$date2)
{
    echo "Report Statement From ".$date1." To ".$date2;
}
else if($date1=$date2)
{ 
    echo "Report Statement For ".$date1;
}?>

<br> <br>
<?php echo "Total Invoice: R".$total_invoices?> <br>
<?php echo "Total Deposits: R".$total_deposits?> <br>
<?php echo "Total Income: R".$total_income?>