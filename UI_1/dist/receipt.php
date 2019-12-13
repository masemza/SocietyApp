<?php
require 'core/init.php';
$general->logged_out_protect();
$username = htmlentities($user['username']);

$payment_id =$_GET['payment_id'];
$view_receipt = $payment->receipt_data($payment_id);
foreach ($view_receipt as $row) 
{
  $society_id = $row['society_id'];
}	

$view_package = $package->last_package_inserted($society_id);
foreach($view_package as $package_row) {}

$view_funeral = $funeral->get_all_society_funeral_arrangement($society_id);
foreach($view_funeral as $funeral_row){}

$num = 0;

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

                  <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-users"></i>Manage Members</a>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="./view_members.php?society_id=<?php echo $row['society_id'] ?>" class="dropdown-item "><i class="fe fe-users"></i>View Members</a>
                      <a href="./addMember.php?society_id=<?php echo $row['society_id'] ?>" class="dropdown-item "><i class="fe fe-user-plus"></i>Add A New Member</a>
                    </div>
                  </li>

                  <li class="nav-item dropdown">
                    <a href="./view_package.php?society_id=<?php echo $row['society_id'] ?>" class="nav-link"><i class="dropdown-icon fe fe-layers"></i> View Package</a>
                  </li>

                  <li class="nav-item dropdown">
                    <a href="./view_society_funeral_arrangement.php?society_id=<?php echo $row['society_id'] ?>" class="nav-link"><i class="dropdown-icon fe fe-activity"></i> View Funeral Arrangements</a>
                  </li>

                  <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-menu"></i>More</a>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="./create_invoice.php" class="dropdown-item "><i class="fe fe-file-plus"></i>Capture Invoice</a>
                      <a href="./create_expense.php" class="dropdown-item "><i class="fe fe-file-plus"></i>Capture Expense</a>
                      <a href="./view_report.php" class="dropdown-item "><i class="fe fe-file-text"></i>View Report</a>
                      <a href="./manage_members.php" class="dropdown-item "><i class="fe fe-users"></i>Main Member's Dashboard</a>
                    </div>
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
                <a href="./statement.php?society_id=<?php echo $row['society_id'] ?>" style="text-decoration: none;"> <i class="fe fe-arrow-left"></i>Statement</a> | Receipt
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
                <div class=" text-center">
                  <p class="h2"> <u>RECEIPT</u></p>
                </div>

                <div class="row my-6">
                  <div class="col-6">    
                    <?php
                      echo "<img src='$image' style='max-width:250px; max-height:250px;' /> ";
                    ?>
                    <br><p class="h5">PO Box 22
                    <br>Jane Furse 1085</p>
                  </div>

                  <div class="col-6 text-right">
                    <p class="h2">SAMELLEN FUNERALS cc</p>
                    <p class="h4">T/A HELPMEKAAR FUNERAL PARLOUR C.C.</p>
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
                    <h3> Society name: <u><?php echo $row['society_name']?></u> </h3>
                  </div>

                  <div class="col-6 text-right">
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

                        <tr>
                          <th class="text-left" >Flower Amount</th>
                          <td class="text-center"><?php echo $package_row['flower']; ?></td>
                        </tr>
                        <tr>
                          <th class="text-left" >Coffin Amount</th>
                          <td class="text-center"><?php echo $package_row['coffin']; ?></td>
                        </tr>
                        <tr>
                          <th class="text-left" >Grave-Marker Amount</th>
                          <td class="text-center"><?php echo $package_row['grave_marker']; ?></td>
                        </tr>
                        <tr>
                          <th class="text-left" >Transport Amount</th>
                          <td class="text-center"><?php echo $package_row['transport']; ?></td>
                        </tr>
                        <tr>
                          <th class="text-left" >Additional Transport Amount</th>
                          <td class="text-center"><?php echo $funeral_row['transport_amount']; ?></td>
                        </tr>
                        <tr>
                          <th class="text-left" >Funeral Service AMount</th>
                          <td class="text-center"><?php echo $package_row['funeral_service']; ?></td>
                        </tr>


                        <th class="text-left" >Total Amount Withdrawn</th>
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
                      if($row['balance'] >= 0) 
                      {?>
                        <th class="text-left" >Current Balance</th>
                        <td class="text-center">R<?php echo number_format($row['balance'],2); ?></td>

                      <?php
                      } 
                      else 
                      { 
                        ?>
                        <th class="text-left" >Due To us</th>
                        <td class="text-center">(R<?php echo number_format(substr($row['balance'],1),2); //echo $balance?>) </td>
                      <?php 
                      } 
                      ?> 
                    </tr>
                  </table>
                </div>
                
                <hr>
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