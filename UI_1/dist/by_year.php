<?php
require 'core/init.php';
?>

<!doctype html>
    <head>
        <title>
        
        </title>
    </head>
    <body>
        <form action="" method="post">
            
            Report Statement<br>
            From <input type="date" name="date1" >
            To <input type="date" name="date2" > 
            <input type="submit" name="submit" value="Search">
        </form>

<br>


<br>
<?php

if (isset($_POST['submit']) && !empty($_POST['date1']) && !empty($_POST['date2'])) 
{   
    //&& !empty($_POST['date1']) && !empty($_POST['date2'])
    $date1 = $_POST['date1'];
    $date2 = $_POST['date2'];
        
    $total_expense = $expenses->search_expenses($date1, $date2);
    $total_invoices = $invoices->search_invoices($date1, $date2);
    $total_deposits = $payment->search_deposits($date1, $date2);

    $total_income = $total_invoices + $total_deposits;
    $total_balance = $total_income - $total_expense;

   

if($date1 <> $date2)
{
    echo "Report Statement From ".$date1." To ".$date2?> <br> <br>
<?php 
} 
else
{ 
    echo "Report Statement For ".$date1?> <br> <br>
<?php 
}?>

<?php echo "Total Income: R".$total_income; ?> 
<a href="kb.php?date1=<?php echo $date1 ?> &date2=<?php echo $date2 ?>"> View Details </a> <br>

<?php echo "Total Expense: R".$total_expense ; ?> <br>
<?php echo "Total Balance: R".$total_balance; ?>

<?php
}
?>


    </body>
</html>