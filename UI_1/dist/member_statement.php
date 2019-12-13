<?php
require 'core/init.php';
$general->logged_out_protect();
$username = htmlentities($user['username']);
$type = htmlentities($user['type']);

$main_member_id = $_GET['main_member_id'];
$view_statement = $main_member->payment_data($main_member_id);

$view_member = $main_member->memberdata($main_member_id);
foreach($view_member as $member_row)
{

}

$last_balance = $main_member->get_last_balance($main_member_id);

global $num;

if (isset($_POST['submit']))
{
	$search = $_POST['search'];
	
	if ($payment->statement_exists($search) === false) 
	{
		$errors[] = 'Sorry that society does\'nt exists.';
	}

	$view_statement = $payment->view_search($search);
	
}

if (isset($_POST['submit1']))
{
	$view_statement = $payment->payment_data($society_id);
}

$dirname = "demo/brand/S  F Logo";
$images = glob($dirname."*.jpg");

foreach($images as $image) 


?>

<!doctype html>
<html lang="en" dir="ltr">
<?php include 'incl/head.php' ;?>
<?php include 'incl/header.php' ;?>

<style>
  .tab 
  { 
    position:absolute;left:150px; 
  }
</style>

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

                <?php if($type == 'admin' || $type == 'manager')
                {?>
                  <a href="./view_main_member.php?main_member_id=<?php echo $main_member_id ?>" style="text-decoration: none;"> <i class="fe fe-arrow-left"></i>Member Details</a> | Statement
                <?php
                }
                else if($type == 'user')
                {?>
                  <a href="./index.php" style="text-decoration: none;"> <i class="fe fe-arrow-left"></i>Home</a> | Statement
                <?php
                }?>
              </h1>
            </div>


            <div class="card">
              <div class="card-header">
                <h3 class="card-title"> Statement</h3>
                <div class="card-options">
                  <button type="button" class="btn btn-primary btn-sm" onclick="javascript:window.print();"><i class="fe fe-download"></i> Download Statement</button>
              </div>
            </div>

              <div class="card-body">



                <div class=" text-center">
                    <p class="h2"> <u>Statement</u> </p>
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

                    <p class="h3">To: <u> <?php echo $member_row['first_name'] ?> <?php echo $member_row['last_name'] ?></u></p>
                  </div>
                  <div class="col-6 text-right">
                     <p class="h4"> <?php echo "Date: "?> <u><?php echo date("d-m-Y") ?> </u> </p>
                  </div>
                </div>

                <h4> <p class="text-right"> STATEMENT NO: <?php echo $member_row['main_member_id'] ?></p> </h4>

                <div class="table-responsive push">
                  <table class="table table-bordered table-hover">
                    <tr>
                      <th class="text-center" style="width: 0.5%"></th>
                      <th class="text-center" style="width: 1.5%">Transaction date</th>
                      <th class="text-center" style="width: 3%">Being Paid for</th>
                      <th class="text-center" style="width: 3%">Received from</th>
                      <!-- <th class="text-center" style="width: 3%">Address</th> -->
                      <th class="text-center" style="width: 1%">Receipt No</th>
                      <th class="text-center" style="width: 3%">Premium Amount</th>
                      <!-- <th class="text-center" style="width: 3%">Total</th> -->
                      <!-- <th class="text-center" style="width: 3%">Debit</th> -->
                    </tr>

                    <tr>
                    <?php foreach ($view_statement as $statement_row) { $num++?>
                      <td class="text-center"><?php echo $num?></td>

                      <td>
                        <p class="font-w600 mb-1 text-center">
                          <?php 
                            echo date(("d-m-Y"), $statement_row['date_transaction']) 
                          ?>
                        </p>
                      </td>

                      <td class="text-center"><?php echo $statement_row['paid_for'] ?></td>

                      <td class="text-center">
                        <?php echo $statement_row['name']; ?>
                      </td>

                      <!-- <td class="text-center">
                        <?php //echo $member_row['street']; ?> <br>
                        <?php //echo $member_row['suburb']; ?> <br>
                        <?php //echo $member_row['city']; ?> <br>
                        <?php //echo $member_row['province']; ?>
                      </td> -->

                      <td class="text-center"><a href="member_receipt.php?member_payment_id=<?php echo $statement_row['member_payment_id'] ?>"> <?php echo $statement_row['member_payment_id'] //echo $num ?> </a> </td>
                      <td class="text-center"><?php echo $statement_row['credit']; ?></td>

                      <!-- <td class="text-center"> <?php //echo $statement_row['balance']; ?> </td> -->
                    </tr>
                    <?php } ?>

                    <!-- <tr>

                        <?php //$balance = number_format($last_balance, 2);
                        //if($last_balance >= 0) 
                        {?>
                            <td colspan="7" class="font-weight-bold text-uppercase text-right">Current Balance</td>
                            <td class="font-weight-bold text-center">R <?php //echo $balance; ?> </td>
                            
                        <?php 
                        }
                            
                        //else 
                        {?>
                                <td colspan="7" class="font-weight-bold text-uppercase text-right">Due to us</td>
                                <td class="font-weight-bold text-center">(R<?php //echo substr($balance,1); ?>) </td>
                        <?php
                        }?>

                    </tr> -->

                  </table>
                </div>
                  
                <div class="row my-6">
                  <div class="col-6">
                    <!-- <p class="h3">Bank Details</p>
                    <p class="h4">Account holder <span class="tab"> : </span></p>
                    <p class="h4">Bank <span class="tab"> : </span></p>
                    <p class="h4">Account number <span class="tab"> : </span></p>
                    <p class="h4">Reference <span class="tab"> : </span></p> -->
                  </div>
                  <div class="col-6 text-right">
                     <!-- <p class="h4">Total: R<?php //echo number_format($row['amount'],2); ?></p> -->
                  </div>
                </div>

                <hr>
                <p class="text-muted text-center">Thank you very much for doing business with us. We look forward to working with you again!</p>


            </div>
          </div>
        </div>
      </div>

      <?php include 'incl/footer.php' ;?>
    </div>
  </body>
</html>