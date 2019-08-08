<?php
require 'core/init.php';
$general->logged_out_protect();

$id = htmlentities($user['id']);
$username = htmlentities($user['username']);

$withdrawal = $payment->daily_withdrawals();
$withdrawal_total = $payment->sum_of_daily_withdrawals();

if(isset($_POST['submit']))
{
    $choice_selected = $_POST['withdrawal'];  // Storing Selected Value In Variable
    
    if($choice_selected == "Daily")
    {
        $withdrawal = $payment->daily_withdrawals();
        $withdrawal_total = $payment->sum_of_daily_withdrawals();
    }
    else if ($choice_selected == "Weekly")
    {
        $withdrawal = $payment->weekly_withdrawals();
        $withdrawal_total = $payment->sum_of_weekly_withdrawals();
    }
    else if ($choice_selected == "Monthly")
    {
        $withdrawal = $payment->monthly_withdrawals();
        $withdrawal_total = $payment->sum_of_monthly_withdrawals();
    }
    
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
                  </li> -->

                  <li class="nav-item dropdown">
                    <a href="./view_withdrawals.php" class="nav-link active"><i class="fe fe-check-square"></i> View Withdrawals</a>
                  </li>

                  <!-- <li class="nav-item dropdown">
                    <a href="./report.php" class="nav-link"><i class="fe fe-check-square"></i> View Transactions</a>
                  </li> -->

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
                                if(isset($_POST['withdrawal']) )  
                                { 
                                    echo $choice_selected; ?> Withdrawals <?php 
                                } 
                                else 
                                    if(isset($_POST['submit']) && empty($_POST['withdrawal']) === true )
                                    {
                                        echo "Withdrawal";
                                    } 
                                    else 
                                    {
                                        echo "Daily Withdrawals";
                                    }?>
                        </h1>
                  </div>

<form action="" method="post">
      <div class="form-group">
        <div class="form-label">Select a Withdrawal</div>
            <div class="custom-switches-stacked">
                <label class="custom-switch">
                    <input type="radio" name="withdrawal" value="Daily" class="custom-switch-input" checked>
                        <span class="custom-switch-indicator"></span>
                        <span class="custom-switch-description">Daily</span>
                </label>
                         
                <label class="custom-switch">
                    <input type="radio" name="withdrawal" value="Weekly" class="custom-switch-input">
                        <span class="custom-switch-indicator"></span>
                        <span class="custom-switch-description">Weekly</span>
                    </label>
                
                <label class="custom-switch">
                    <input type="radio" name="withdrawal" value="Monthly" class="custom-switch-input">
                        <span class="custom-switch-indicator"></span>
                        <span class="custom-switch-description">Monthly</span>
                </label>
            </div>
      </div>

    <input type="submit" name="submit" class="btn btn-sm btn-outline-primary" value="Click here to view selected withdrawal" />
</form>

<br>

<?php foreach ($withdrawal as $view_withdrawal) ?>

                          <div class="col-lg-12">
                                  <div class="card">

                                    <div class="card-body">

                                    <?php 
                                
                                    ?>

                                    <form action="" method="post" class="text-center">

                                        <div class="table-responsive push">
                                        
                                        <?php if(isset($_POST['submit']) &&  empty($_POST['withdrawal']) === false && !empty($view_withdrawal['date_transaction']))
                                        {?> 
                                            <table class="table table-bordered table-hover" id="myTable">
                                            <tr>
                                                <th class="text-center" style="width: 1%">Date of withdrawal</th>
                                                <th class="text-center" style="width: 5%">Society Name</th>
                                                <th class="text-center" style="width: 5%">Name</th>
                                                <th class="text-center" style="width: 2%">Amount</th> 
                                            
                                            </tr>

                                            <?php  foreach ($withdrawal as $view_withdrawal) 
                                            {   
                                            ?>
                                            <tr>
                                                <td>
                                                <p class="font-w600 mb-1 text-center"><?php echo $view_withdrawal['date_transaction']; ?></p>
                                                </td>
                                                <td class="text-center">
                                                Society name: <?php echo $view_withdrawal['society_name']; ?>
                                                </td>
                                                <td class="text-center"><?php echo $view_withdrawal['name']; ?></td>
                                                <td class="text-center"><?php echo $view_withdrawal['debit']; ?></td>
                                            </tr>

                                            <?php 
                                            }
                                            ?>
                                                
                                                <td colspan="3" class="font-weight-bold text-uppercase text-right">Total</td>
                                                <td class="font-weight-bold text-center">R<?php echo number_format($withdrawal_total,2); ?> </td>

                                            </table>

                        
                                            <?php 
                                        } 
                                        else 
                                        if(isset($_POST['submit']) &&  empty($_POST['transaction']) === true && !empty($view_withdrawal['date_transaction'])){?> 
                                            Select a transaction 
                                        <?php }   
                                             
                                        else  if(!empty($view_withdrawal['date_transaction']) )
                                        {?>
                                        <table class="table table-bordered table-hover" id="myTable">
                                            <tr>
                                                <th class="text-center" style="width: 1%">Date of withdrawal</th>
                                                <th class="text-center" style="width: 5%">Society Name</th>
                                                <th class="text-center" style="width: 5%">Name</th>
                                                <th class="text-center" style="width: 2%">Amount</th> 
                                            
                                            </tr>

                                            <?php  foreach ($withdrawal as $view_withdrawal) 
                                            {   
                                            ?>
                                            <tr>
                                                <td>
                                                <p class="font-w600 mb-1 text-center"><?php echo $view_withdrawal['date_transaction']; ?></p>
                                                </td>
                                                <td class="text-center">
                                                Society name: <?php echo $view_withdrawal['society_name']; ?>
                                                </td>
                                                <td class="text-center"><?php echo $view_withdrawal['name']; ?></td>
                                                <td class="text-center"><?php echo $view_withdrawal['debit']; ?></td>
                                            </tr>

                                            <?php 
                                            }
                                            ?>
                                                
                                                <td colspan="3" class="font-weight-bold text-uppercase text-right">Total</td>
                                                <td class="font-weight-bold text-center">R<?php echo number_format($withdrawal_total,2); ?> </td>

                                            </table>
                                            <?php } else echo"No transaction made today";?>
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