<?php
require 'core/init.php';
$general->logged_out_protect();
$username = htmlentities($user['username']);

$payment_id =$_GET['payment_id'];
$view_receipt = $payment->receipt_data($payment_id);	
global $num;

$dirname = "demo/brand/S  F Logo";
$images = glob($dirname."*.jpg");

foreach($images as $image) 




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
                    <a href="./view_members.php?society_id=<?php echo $society_id ?>" class="nav-link"><i class="fe fe-users"></i>View Members</a>
                  </li>

                  <li class="nav-item dropdown">
                    <a href="./addMember.php?society_id=<?php echo $society_id; ?>" class="nav-link"><i class="fe fe-user-plus"></i>Add a new Member</a>
                  </li>

                  <li class="nav-item dropdown">
                    <a href="./view_package.php?society_id=<?php echo $society_id ?>" class="nav-link"><i class="dropdown-icon fe fe-layers"></i> View Package</a>
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

                         <div class=" text-center">
                    <p class="h2"> <u>RECEIPT</u></p>
                </div>


                  <div class="row my-6">
                  <div class="col-6">
                    <!-- <p class="h3">Company</p> -->
                    <?php foreach ($view_receipt as $row) ?>
                    
                    <?php
                        echo "<img src='$image' style='max-width:250px; max-height:250px;' /> ";
                    ?>
                  <br><p class="h5">PO Box 22
                  <br>Jane Furse 1085</p>
                  </div>
                  

                    <div class="col-6 text-right">
                      <p class="h2">SAMELLEN FUNERALS cc</p>
                      <p class="h4">T/A HELPMEKAAR FUNERAL PARLOUR C.C.</p>

                      <!-- <p class="h2">SESHEGO FUNERALS </p> -->

                      <br><br><br>
                      <p class="h5">
                          Tel: (013) 265 1031 <br>
                          Fax: (015) 223 0378 <br>
                          Email: 
                      </p>
                    </div>
                </div>
                
                <hr>
                
                <div class="row my-6">
                  <div class="col-6">
                    <!-- <p class="h3">Company</p> -->
                    <?php foreach ($view_receipt as $row) ?>
                      <h3> Society name: <u><?php echo $row['society_name']?></u> </h3>
                    <address>
                    <?php //    foreach ($view_society as $row)?>
                        <!-- Location: <?php //echo $row['location'] ?> -->
                    </address>
                  </div>
                  <div class="col-6 text-right">
                    <!-- <p class="h3">Client</p> -->
                    <address>
                      <h4><p> Date: <u><?php echo date("d-m-Y"); ?></u> </p></h4>
                      <br>
                      <h4> <p class="text-right"> RECEIPT NO: <?php echo $row['payment_id'] ?></p> </h4>
                     
                    </address>
                  </div>
                </div>

                <div class="table-responsive push">
                  <table class="table table-bordered table-hover">
                    <tr>
                      <th class="text-left" >Transaction Date</th>
                        <td class="text-center">
                        <?php
                            $date = date_create($row['date_transaction']);
                            echo date_format($date, 'd-m-Y');
                        ?>
                        </td>
                    </tr>

                    <tr>
                      <th class="text-left" >Name</th>
                      <td class="text-center"><?php echo $row['name']; ?></td>
                    </tr>

                    <tr>
                      <?php 
                      if($row['credit'] == 0)
                      {?>
                        <tr>
                          <th class="text-left" >Name of deceased</th>
                          <td class="text-center"><?php echo $row['deceased_name']; ?></td>
                        </tr>

                        <th class="text-left" >Amount Withdrawn</th>
                        <td class="text-center">R<?php echo number_format($row['debit'],2); ?></td>

                      <?php
                      } 
                      else 
                      { ?>
                        <th class="text-left" >Amount Deposited</th>
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
                        <th class="text-left" >Current Balance</th>
                        <td class="text-center">R<?php echo number_format($row['balance'],2); //echo $balance?></td>

                      <?php
                      } 
                      else 
                      { //$balance = number_format($bal, 2);
                        ?>
                        <th class="text-left" >Due To us</th>
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