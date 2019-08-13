<?php
require 'core/init.php';
$general->logged_out_protect();
$username = htmlentities($user['username']);

$payment_id =$_GET['payment_id'];
$view_receipt = $payment->receipt_data($payment_id);	

foreach($view_receipt as $row)
{
    $society_id = $row['society_id'];
}
$last_balance = $payment->get_last_balance($society_id);

$bal = substr($last_balance,1);

global $num;

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

              <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">

                  <li class="nav-item">
                    <a href="./index.php" class="nav-link active"><i class="fe fe-home"></i> Home</a>
                  </li>

                  <li class="nav-item dropdown">
                    <a href="./view_invoice.php" class="nav-link" ><i class="fe fe-file"></i>View Invoices</a>
                  </li>

                  <li class="nav-item dropdown">
                    <a href="./view_expense.php" class="nav-link"><i class="fe fe-check-square"></i> View Expenses</a>
                  </li>

                  <li class="nav-item dropdown">
                    <a href="./view_withdrawals.php" class="nav-link"><i class="fe fe-shopping-cart"></i> View Withdrawals</a>
                  </li>

                  <li class="nav-item dropdown">
                    <a href="./report.php" class="nav-link"><i class="fe fe-file-text"></i> View Transactions</a>
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

              <?php foreach ($view_receipt as $row) ?>
                <a href="./statement.php?society_id=<?php echo $row['society_id'] ?>" style="text-decoration: none;"> <i class="fe fe-arrow-left"></i>Statement</a> | Receipt
              <?php ?>

              </h1>
            </div>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"> Receipt</h3>
                <div class="card-options">
                  <button type="button" class="btn btn-primary btn-sm" onclick="javascript:window.print();"><i class="fe fe-download"></i> Download Receipt</button>
                </div>
              </div>
              <div class="card-body">
              <?php //foreach ($view_statement as $row) { 
                        //$society_name = $row['society_name'];
                        //$society_id = $row['society_id'];
                    //}
                        ?>
 
                <div class="row my-6">
                  <div class="col-6">
                    <!-- <p class="h3">Company</p> -->
                    <?php foreach ($view_receipt as $row) ?>
                    <p class="h2">Seshego Funerals</p><p class="h4">Society Name: <?php echo $row['society_name'] ?></p>
                    <address>
                    <?php //    foreach ($view_society as $row)?>
                        <!-- Location: <?php //echo $row['location'] ?> -->
                    </address>
                  </div>
                  <div class="col-6 text-right">
                    <!-- <p class="h3">Client</p> -->
                    <address>

                        <p class="h4"> Receipt no: #<?php echo $row['payment_id'] ?></p>
                     <p> Date: <?php echo date("d/F/Y"); ?> </p>
                    </address>
                  </div>
                </div>
                <div class="table-responsive push">
                  <table class="table table-bordered table-hover">
                    <tr>
                      <th class="text-center" >Transaction Date</th>
                        <td class="text-center">
                        <?php
                            $date = date_create($row['date_transaction']);
                            echo date_format($date, 'd/F/Y');
                        ?>
                        </td>
                    </tr>

                    <tr>
                      <th class="text-center" >Name</th>
                      <td class="text-center"><?php echo $row['name']; ?></td>
                    </tr>

                    <tr>
                      <?php 
                      if($row['credit'] == 0)
                      {?>
                        <tr>
                          <th class="text-center" >Name of deceased</th>
                          <td class="text-center"><?php echo $row['deceased_name']; ?></td>
                        </tr>

                        <th class="text-center" >Amount Withdrawn</th>
                        <td class="text-center">R<?php echo number_format($row['debit'],2); ?></td>

                      <?php
                      } 
                      else 
                      { ?>
                        <th class="text-center" >Amount Deposited</th>
                        <td class="text-center">R<?php echo number_format($row['credit'],2); ?></td>
                      <?php 
                      } 
                      ?> 
                    </tr>

                    <tr>
                      <?php 
                        //$balance = number_format($last_balance, 2);
                      if($row['balance'] >= 0)  //if($last_balance >= 0)
                      {?>
                        <th class="text-center" >Current Balance</th>
                        <td class="text-center">R<?php echo number_format($row['balance'],2); //echo $balance?></td>

                      <?php
                      } 
                      else 
                      { //$balance = number_format($bal, 2);
                        ?>
                        <th class="text-center" >Due To us</th>
                        <td class="text-center"><?php //echo substr($row['balance'],0,1)?>(R<?php echo number_format(substr($row['balance'],1),2); //echo $balance?>) </td>
                      <?php 
                      } 
                      ?> 
                    </tr>

                    

                    
                    
                  </table>
                </div>
                <p class="text-muted text-center">Thank you very much for doing business with us. We look forward to working with you again!</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <?php include 'incl/footer.php' ;?>
    </div>
  </body>
</html>