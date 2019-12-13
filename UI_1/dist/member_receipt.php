<?php
require 'core/init.php';
$general->logged_out_protect();
$username = htmlentities($user['username']);
$type = htmlentities($user['type']);

$member_payment_id =$_GET['member_payment_id'];
$view_receipt = $main_member->receipt_data($member_payment_id);
foreach($view_receipt as $receipt_row)
{
    $main_member_id = $receipt_row['member_id'];
}

$view_member = $main_member->memberdata($main_member_id);
foreach($view_member as $member_row)
{

}

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
                    <?php if($type == 'user')
                    {?>
                      <a href="./index.php" class="nav-link active"><i class="fe fe-home"></i> Home</a>
                    <?php
                    }
                    else if($type == 'admin' || $type == 'manager')
                    {?>
                      <a href="./manage_members.php" class="nav-link active"><i class="fe fe-home"></i> Home</a>
                    <?php
                    }?>
                  </li>

                  <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-users"></i>Manage Spouse</a>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="./view_spouse.php?main_member_id=<?php echo $main_member_id ?>" class="dropdown-item "><i class="fe fe-users"></i>View Spouse</a>
                      <a href="./spouse.php?main_member_id=<?php echo $main_member_id ?>" class="dropdown-item "><i class="fe fe-user-plus"></i>Add Spouse</a>
                    </div>
                  </li>

                  <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-users"></i>Manage Children Details</a>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="./view_children.php?main_member_id=<?php echo $main_member_id ?>" class="dropdown-item "><i class="fe fe-users"></i>View Children</a>
                      <a href="./children.php?main_member_id=<?php echo $main_member_id ?>" class="dropdown-item "><i class="fe fe-user-plus"></i>Add A Child</a>
                    </div>
                  </li>

                  <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-users"></i>Manage Extended Family</a>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="./view_extended_family.php?main_member_id=<?php echo $main_member_id ?>" class="dropdown-item "><i class="fe fe-users"></i>View Extended Family</a>
                      <a href="./extended_family.php?main_member_id=<?php echo $main_member_id ?>" class="dropdown-item "><i class="fe fe-user-plus"></i>Add Extended Family</a>
                    </div>
                  </li>

                  <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-menu"></i>More</a>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="./member_details.php?main_member_id=<?php echo $main_member_id ?>" class="dropdown-item"><i class="fe fe-users"></i>View All Members </a>
                      <?php if($type === "manager") 
                      {?>
                          <a href="./view_member_report.php" class="dropdown-item"><i class="fe fe-file-text"></i> View Reports </a>
                      <?php 
                      }?>
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

                <a href="./member_statement.php?main_member_id=<?php echo $receipt_row['member_id'] ?>" style="text-decoration: none;"> <i class="fe fe-arrow-left"></i>Statement</a> | Receipt
              

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
                      <h4> <p>Policy Holder Name: <u><?php echo $member_row['first_name'] ?> <?php echo $member_row['last_name'] ?></u> </p></h4>
                      <br>
                      <h4> <p>Policy No: <u><?php echo $member_row['policy_number']?></u> </p></h4>
                  </div>
                  <div class="col-6 text-right">
                    <address>
                      <h4><p> Date: <u><?php echo date("d-m-Y"); ?></u> </p></h4>
                      <br>
                      <h4> <p class="text-right"> RECEIPT NO: <?php echo $receipt_row['member_payment_id'] ?></p> </h4>
                      
                    </address>
                  </div>
                </div>

                <div class="table-responsive push">
                  <table class="table table-bordered table-hover">
                    <tr>
                      <th class="text-left" >Being Paid for</th>
                        <td class="text-center">
                        <?php 
                          echo $receipt_row['paid_for']
                        ?>
                        </td>
                    </tr>

                    <tr>
                      <th class="text-left" >Name(s)</th>
                      <td class="text-center"><?php echo $receipt_row['name']; ?></td>
                    </tr>

                    <tr>
                      <th class="text-left" >Address</th>
                        <td class="text-center">
                          <?php echo $member_row['street']; ?> <br> 
                          <?php echo $member_row['suburb']; ?> <br>
                          <?php echo $member_row['city']; ?> <br> 
                          <?php echo $member_row['province']; ?>
                        </td>
                    </tr>

                    <tr>
                      <?php 
                      if($receipt_row['credit'] == 0)
                      {?>
                        <tr>
                          <th class="text-left" >Name of deceased</th>
                          <td class="text-center"><?php echo $receipt_row['deceased_name']; ?></td>
                        </tr>

                        <th class="text-left" >Amount Withdrawn</th>
                        <td class="text-center">R<?php echo number_format($receipt_row['debit'],2); ?></td>

                      <?php
                      } 
                      else 
                      { ?>
                        <th class="text-left" >Premium Amount</th>
                        <td class="text-center">R<?php echo number_format($receipt_row['credit'],2); ?></td>
                      <?php 
                      } 
                      ?> 
                    </tr>

                    <!-- <tr>
                      <?php 
                        //$balance = number_format($last_balance, 2);
                      //if($receipt_row['balance'] >= 0)  //if($last_balance >= 0)
                      {?>
                        <th class="text-left" >Current Balance</th>
                        <td class="text-center">R<?php //echo number_format($receipt_row['balance'],2); //echo $balance?></td>

                      <?php
                      } 
                      //else 
                      { //$balance = number_format($bal, 2);
                        ?>
                        <th class="text-left" >Due To us</th>
                        <td class="text-center"><?php //echo substr($row['balance'],0,1)?>(R<?php //echo number_format(substr($receipt_row['balance'],1),2); //echo $balance?>) </td>
                      <?php 
                      } 
                      ?> 
                    </tr> -->

                    

                    
                    
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