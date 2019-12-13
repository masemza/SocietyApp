<?php
require 'core/init.php';
$general->logged_out_protect();
$username = htmlentities($user['username']);

$society_id =$_GET['society_id'];
$view_statement = $payment->payment_data($society_id);	
foreach($view_statement as $row){}

$view_society = $society->societydata($society_id);
foreach($view_society as $society_row){}

$last_balance = $payment->get_last_balance($society_id);

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
                    <a href="./index.php" class="nav-link active"><i class="fe fe-home"></i> Home</a>
                  </li>

                  <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-users"></i>Manage Members</a>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="./view_members.php?society_id=<?php echo $society_id ?>" class="dropdown-item "><i class="fe fe-users"></i>View Members</a>
                      <a href="./addMember.php?society_id=<?php echo $society_id; ?>" class="dropdown-item "><i class="fe fe-user-plus"></i>Add A New Member</a>
                    </div>
                  </li>

                  <li class="nav-item dropdown">
                    <a href="./view_package.php?society_id=<?php echo $society_id ?>" class="nav-link"><i class="dropdown-icon fe fe-layers"></i> View Package</a>
                  </li>

                  <li class="nav-item dropdown">
                    <a href="./view_society_funeral_arrangement.php?society_id=<?php echo $society_id ?>" class="nav-link"><i class="dropdown-icon fe fe-activity"></i> View Funeral Arrangements</a>
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

                <a href="./view_statements.php?society_id=<?php echo $society_id?>" style="text-decoration: none;"> <i class="fe fe-arrow-left"></i>Society Details</a> | Statement

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
                    <!-- <p class="h3">Company</p> -->
                    <?php foreach ($view_statement as $row) ?>
                    
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

                    <!-- <div class="col-12 text-center">
                        <p class="h2"> INVOICE</p>
                    </div> -->
 
                <div class="row my-6">
                  <div class="col-6">
                    <!-- <p class="h3">Company</p> -->

                    <p class="h3">To: <u> <?php echo $society_row['society_name'] ?></u></p>
                    <!-- <p class="h3">Company: </p> -->
                  </div>
                  <div class="col-6 text-right">
                     <p class="h4"> <?php echo "Date: "?> <u><?php echo date("d-m-Y");  //$date = date_create($row['invoice_date']);
                            //echo date_format($date, 'd F Y');     ?> </u> </p>
                  </div>
                </div>

                <h4> <p class="text-right"> STATEMENT NO: <?php echo $society_id ?></p> </h4>

                <div class="table-responsive push">
                  <table class="table table-bordered table-hover">
                    <tr>
                      <th class="text-center" style="width: 0.5%"></th>
                      <th class="text-center" style="width: 2%">Transaction Date</th>
                      <th class="text-center" style="width: 8%">Name</th>
                      <th class="text-center" style="width: 1%">Receipt No</th>
                      <th class="text-center" style="width: 4%">Credit</th>
                      <th class="text-center" style="width: 3%">Debit</th>
                      <th class="text-center" style="width: 3%">Total</th>
                    </tr>

                    <tr>
                    <?php foreach ($view_statement as $row) { $num++?>
                      <td class="text-center"><?php echo $num?></td>
                      <td>
                        <p class="font-w600 mb-1 text-center"><?php $date=date_create($row['date_transaction']);
                                    echo date_format($date,"d-m-Y");  //echo $row['date_transaction']; ?></p>
                      </td>
                      <td class="text-center">
                      <?php echo $row['name']; ?>
                      </td>
                      <td class="text-center"><a href="receipt.php?payment_id=<?php echo $row['payment_id'] ?>"> <?php echo $row['payment_id'] //echo $num ?> </a> </td>
                      <td class="text-center"><?php echo $row['credit']; ?></td>
                      <td class="text-center"><?php echo $row['debit']; ?></td>
                      <td class="text-center"><?php echo $row['balance']; ?></td>
                    </tr>
                    <?php } ?>

                    <tr>

                        <?php $balance = number_format($last_balance, 2);
                        if($last_balance >= 0) 
                        {?>
                            <td colspan="6" class="font-weight-bold text-uppercase text-right">Current Balance</td>
                            <td class="font-weight-bold text-center">R <?php echo $balance; ?> </td>
                            
                        <?php 
                        }
                            
                        else 
                        {?>
                                <td colspan="6" class="font-weight-bold text-uppercase text-right">Due to us</td>
                                <td class="font-weight-bold text-center">(R<?php echo substr($balance,1); ?>) </td>
                        <?php
                        }?>

                    </tr>
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