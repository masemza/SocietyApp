<?php
require 'core/init.php';
$general->logged_out_protect();

$id = htmlentities($user['id']);
$username = htmlentities($user['username']);

// $daily_deposits = $payment->daily_deposits();
// $daily_invoices = $invoice->daily_invoices();
// $daily_deposits_total = $payment->sum_of_daily_deposits();
// $daily_invoices_total = $invoice->sum_of_daily_invoices();
// $daily_total = $daily_deposits_total + $daily_invoices_total;

// $weekly_deposits = $payment->weekly_deposits();
// $weekly_invoices = $invoice->weekly_invoices();
// $weekly_deposits_total = $payment->sum_of_weekly_deposits();
// $weekly_invoices_total = $invoice->sum_of_weekly_invoices();
// $weekly_total = $weekly_deposits_total + $weekly_invoices_total;

// $monthly_deposits = $payment->monthly_deposits();
// $monthly_invoices = $invoice->monthly_invoice();
// $monthly_deposits_total = $payment->sum_of_monthly_deposits();
// $monthly_invoices_total = $invoice->sum_of_monthly_invoices();
// $monthly_total = $monthly_deposits_total + $monthly_invoices_total ;

$deposits = $payment->daily_deposits();
$invoices = $payment->daily_invoices();
$deposits_total = $payment->sum_of_daily_deposits();
$invoices_total = $payment->sum_of_daily_invoices();
$total = $deposits_total + $invoices_total;

global $num;


if(isset($_POST['submit']))
{if (isset($_POST['transaction'])) 
    {
    $choice_selected = $_POST['transaction'];  // Storing Selected Value In Variable
    
    if($choice_selected == "Daily")
    {
        $deposits = $payment->daily_deposits();
        $invoices = $payment->daily_invoices();
        $deposits_total = $payment->sum_of_daily_deposits();
        $invoices_total = $payment->sum_of_daily_invoices();
        $total = $deposits_total + $invoices_total;
    }
    else if ($choice_selected == "Weekly")
    {
        $deposits = $payment->weekly_deposits();
        $invoices = $payment->weekly_invoices();
        $deposits_total = $payment->sum_of_weekly_deposits();
        $invoices_total = $payment->sum_of_weekly_invoices();
        $total = $deposits_total + $invoices_total;
    }
    else if ($choice_selected == "Monthly")
    {
        $deposits = $payment->monthly_deposits();
        $invoices = $payment->monthly_invoices();
        $deposits_total = $payment->sum_of_monthly_deposits();
        $invoices_total = $payment->sum_of_monthly_invoices();
        $total = $deposits_total + $invoices_total;
    }}
}

?>

<!doctype html>
<html lang="en" dir="ltr">
<?php include 'incl/head.php' ;?>
<?php include 'incl/header.php' ;?>
  <body class="">
    <div class="page">
      <div class="page-main">
        <div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">        
          <div class="container">           
            <div class="row align-items-center">

              <div class="col-lg-3 ml-auto">

              </div>

              <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                  <li class="nav-item">
                    <a href="./index.php" class="nav-link"><i class="fe fe-home"></i> Home</a>
                  </li>

                  <!-- <li class="nav-item dropdown">
                    <a href="./view_invoice.php" class="nav-link" ><i class="fe fe-file"></i>View Invoices</a>
                  </li>

                  <li class="nav-item dropdown">
                    <a href="./view_expense.php" class="nav-link"><i class="fe fe-check-square"></i> View Expenses</a>
                  </li>

                  <li class="nav-item dropdown">
                    <a href="./view_withdrawals.php" class="nav-link"><i class="fe fe-check-square"></i> View Withdrawals</a>
                  </li> -->

                  <li class="nav-item dropdown">
                    <a href="./report.php" class="nav-link active"><i class="fe fe-check-square"></i> View Transactions</a>
                  </li>

                </ul>
              </div>
            </div>
          </div>
        </div>

        
        
        
        <div class="my-3 my-md-5">
                <div class="container">
                  <div class="page-header">
                      <h1 class="page-title">
                          <a href="index.php" style="text-decoration: none;"> <i class="fe fe-arrow-left"></i>Home</a> | 
                                <?php 
                                if(isset($_POST['transaction']) )  
                                { 
                                    echo $choice_selected; ?> Transactions <?php 
                                } 
                                else 
                                    if(isset($_POST['submit']) && empty($_POST['transaction']) === true )
                                    {
                                        echo "Transactions";
                                    } 
                                    else 
                                    {
                                        echo "Daily Transactions";
                                    }?>
                        </h1>
                  </div>
                  
                    <!-- <p>Click the button to sort the table alphabetically, by date of transactions:</p>
                    <p><button onclick="sortTable()">Sort</button></p> -->


<form action="" method="post">
    <!-- <div class="col-sm-6 col-md-3">
        <div class="form-group text-center">
            <label class="form-label"></label>
                <select name="transaction" class="" >

                    <option value="" >---Select a transaction---</option>
                    <option value="Daily">Daily</option>
                    <option value="Weekly">Weekly</option>
                    <option value="Monthly">Monthly</option>
        
                </select>
        

    <input type="submit" name="submit" class="btn btn-sm btn-outline-primary" value="Click here to view selected transactions" />
        </div>
    </div> -->





    <div class="form-group">
        <div class="form-label">Select a Transaction</div>
            <div class="custom-switches-stacked">
                <label class="custom-switch">
                    <input type="radio" name="transaction" value="Daily" class="custom-switch-input" checked>
                        <span class="custom-switch-indicator"></span>
                        <span class="custom-switch-description">Daily</span>
                </label>
                         
                <label class="custom-switch">
                    <input type="radio" name="transaction" value="Weekly" class="custom-switch-input">
                        <span class="custom-switch-indicator"></span>
                        <span class="custom-switch-description">Weekly</span>
                    </label>
                
                <label class="custom-switch">
                    <input type="radio" name="transaction" value="Monthly" class="custom-switch-input">
                        <span class="custom-switch-indicator"></span>
                        <span class="custom-switch-description">Monthly</span>
                </label>
            </div>
    </div>

    <input type="submit" name="submit" class="btn btn-sm btn-outline-primary" value="Click here to view selected transaction" />

</form>

<br>


                          <div class="col-lg-12">
                                  <div class="card">

                                    <div class="card-body">

                                    <?php 
                                
                                    ?>

                                    <form action="" method="post" class="text-center">

                                        <div class="table-responsive push">
                                        
                                        <?php if(isset($_POST['submit']) &&  empty($_POST['transaction']) === false )
                                        {?> 
                                            <!-- <div class="card-header">
                                                <div class="card-options">
                                                    <button type="button" class="btn btn-primary btn-sm" onclick="javascript:window.print();"><i class="fe fe-download"></i> Download</button>
                                                </div>
                                            </div> -->

                                            <table class="table table-bordered table-hover" id="myTable">
                                            <tr>
                                                <!-- <th class="text-center" style="width: 0.5%"></th> -->
                                                <th class="text-center" style="width: 1%">Date of transaction</th>
                                                <th class="text-center" style="width: 5%">Description</th>
                                                <th class="text-center" style="width: 5%">Name</th>
                                                <th class="text-center" style="width: 1%">Transaction Type</th>
                                                <th class="text-center" style="width: 2%">Amount</th> 
                                            
                                            </tr>

                                            <?php  foreach ($deposits as $view_deposits) 
                                            {   
                                            ?>
                                            <?php //$date_of_today = "2019-08-01"; if($row['date_transaction'] === $date_of_today ) {?>
                                            <tr>
                                                <!-- <td class="text-center"><?php //echo $num += 1 ?></td> -->
                                                <td>
                                                <p class="font-w600 mb-1 text-center"><?php echo $view_deposits['date_transaction']; ?></p>
                                                </td>
                                                <td class="text-center">
                                                Society name: <?php echo $view_deposits['society_name']; ?>
                                                </td>
                                                <td class="text-center"><?php echo $view_deposits['name']; ?></td>
                                                <td class="text-center">Deposit</td>
                                                <td class="text-center"><?php echo $view_deposits['credit']; ?></td>
                                            </tr>

                                            <?php }foreach ($invoices as $view_invoice) 
                                            {?>
                                            <tr>
                                                <!-- <td class="text-center"><?php //echo $num += 1 ?></td> -->
                                                <td>
                                                <p class="font-w600 mb-1 text-center"><?php echo $view_invoice['invoice_date']; ?></p>
                                                <!-- <div class="text-muted">Logo and business cards design</div> -->
                                                </td>
                                                <td class="text-center">
                                                <?php echo $view_invoice['description']; ?>
                                                </td>
                                                <td class="text-center"><?php echo $view_invoice['name']; ?></td>
                                                <td class="text-center">Invoice</td>
                                                <td class="text-center"><?php echo $view_invoice['amount']; ?></td>
                                            
                                            </tr>
                                            <?php 
                                            }
                                            ?>

                                                <td colspan="4" class="font-weight-bold text-uppercase text-right">Total</td>
                                                <td class="font-weight-bold text-center">R<?php echo number_format($total,2); ?> </td>

                                            </table>
                                        

<script>
    function sortTable() 
    {
        var table, rows, switching, i, x, y, shouldSwitch;
        table = document.getElementById("myTable");
        switching = true;
        
        /*Make a loop that will continue until
        no switching has been done:*/
        while (switching) 
        {
            //start by saying: no switching is done:
            switching = false;
            rows = table.rows;
            
            /*Loop through all table rows (except the
            first, which contains table headers):*/
            for (i = 1; i < (rows.length - 1); i++) 
            {
                //start by saying there should be no switching:
                shouldSwitch = false;
                
                /*Get the two elements you want to compare,
                one from current row and one from the next:*/
                x = rows[i].getElementsByTagName("TD")[0];
                y = rows[i + 1].getElementsByTagName("TD")[0];
                
                //check if the two rows should switch place:
                if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) 
                {
                    //if so, mark as a switch and break the loop:
                    shouldSwitch = true;
                    break;
                }
            }
            if (shouldSwitch) 
            {
                /*If a switch has been marked, make the switch
                and mark that a switch has been done:*/
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
            }
        }
    }
</script>
                                        <tr>
                                            <?php 
                                            if(isset($_POST['submit'])) 
                                            { 
                                                echo $choice_selected ?> Deposits Total <?php
                                            } 
                                            else echo "Daily Total" ?>: R<?php echo number_format($deposits_total,2); ?>

                                            <br>
                                            <?php 
                                            if(isset($_POST['submit'])) 
                                            { 
                                                echo $choice_selected ?> Invoice Total <?php 
                                            } 
                                            else echo "Daily Total" ?>: R<?php echo number_format($invoices_total,2); ?>

                                            <br>
                                            <!-- Weekly Total of Deposits and Invoices: R<?php //echo number_format($total,2) ?> -->
                                            <?php 
                                                //$date = new DateTime('7 days ago');
                                                //echo $date->format('Y-m-d'); 
                                            
                                                // $date = strtotime("-6 day");
                                                // echo date('Y-m-d', $date);
                                            ?>
                                            </td>
                                        </tr> 


                                            
                                        <?php 
                                    } 
                                    else 
                                        if(isset($_POST['submit']) &&  empty($_POST['transaction']) === true ){?> 
                                            Select a transaction 
                                        <?php } 
                                        else
                                        {?>
                                        <table class="table table-bordered table-hover" id="myTable">
                                            <tr>
                                                <!-- <th class="text-center" style="width: 0.5%"></th> -->
                                                <th class="text-center" style="width: 1%">Date of transaction</th>
                                                <th class="text-center" style="width: 5%">Description</th>
                                                <th class="text-center" style="width: 5%">Name</th>
                                                <th class="text-center" style="width: 1%">Transaction Type</th>
                                                <th class="text-center" style="width: 2%">Amount</th> 
                                            
                                            </tr>

                                            <?php  foreach ($deposits as $view_deposits) 
                                            {   
                                            ?>
                                            <?php //$date_of_today = "2019-08-01"; if($row['date_transaction'] === $date_of_today ) {?>
                                            <tr>
                                                <!-- <td class="text-center"><?php //echo $num += 1 ?></td> -->
                                                <td>
                                                <p class="font-w600 mb-1 text-center"><?php echo $view_deposits['date_transaction']; ?></p>
                                                </td>
                                                <td class="text-center">
                                                Society name: <?php echo $view_deposits['society_name']; ?>
                                                </td>
                                                <td class="text-center"><?php echo $view_deposits['name']; ?></td>
                                                <td class="text-center">Deposit</td>
                                                <td class="text-center"><?php echo $view_deposits['credit']; ?></td>
                                            </tr>

                                            <?php }foreach ($invoices as $view_invoice) 
                                            {?>
                                            <tr>
                                                <!-- <td class="text-center"><?php //echo $num += 1 ?></td> -->
                                                <td>
                                                <p class="font-w600 mb-1 text-center"><?php echo $view_invoice['invoice_date']; ?></p>
                                                <!-- <div class="text-muted">Logo and business cards design</div> -->
                                                </td>
                                                <td class="text-center">
                                                <?php echo $view_invoice['description']; ?>
                                                </td>
                                                <td class="text-center"><?php echo $view_invoice['name']; ?></td>
                                                <td class="text-center">Invoice</td>
                                                <td class="text-center"><?php echo $view_invoice['amount']; ?></td>
                                            
                                            </tr>
                                            <?php 
                                            }
                                            ?>

                                                <td colspan="4" class="font-weight-bold text-uppercase text-right">Total</td>
                                                <td class="font-weight-bold text-center">R<?php echo number_format($total,2); ?> </td>

                                            </table>

                                            <tr> 
                                                Daily Deposits Total: R<?php echo number_format($deposits_total,2); ?>
                                                <br>
                                                Daily Invoice Total: R<?php echo number_format($invoices_total,2); ?>
                                            
                                            </tr> 

                                        <?php } ?>

                                        </div>                                            
                                    </form>
                                    
                                    

                  
                                  </div>
                                  </div>
                                </div>
      
                </div>
        
        
        
                </div>
      </div>     

      <?php include 'incl/footer.php' ;?>
    </div>
  </body>
</html>