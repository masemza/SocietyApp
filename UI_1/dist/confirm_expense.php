<?php
require 'core/init.php';
$general->logged_out_protect();
$username = htmlentities($user['username']);

$expenses_id =$_GET['expenses_id'];
$view_expense = $expenses->expensedata($expenses_id);	
foreach ($view_expense as $row) {}

$num = 0;

$dirname = "demo/brand/S  F Logo";
$images = glob($dirname."*.jpg");

foreach($images as $image) {}

if(isset($_POST['edit']))
{
  header('Location: edit_expense.php?expenses_id='.$expenses_id);
}

if(isset($_POST['confirm']))
{
  Print '<script>alert("Expense Successfully Created");;
  window.location.assign("index.php")</script>';

  exit();
  
  // header('Location: index.php');
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
              <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">

                  <li class="nav-item">
                    <a href="./index.php" class="nav-link active"><i class="fe fe-home"></i> Home</a>
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
                <?php foreach ($view_expense as $row) ?>
                  <a href="./view_expense.php" style="text-decoration: none;"> <i class="fe fe-arrow-left"></i>View Expenses</a> | Expense
                <?php ?>
              </h1>
            </div>

            <div class="card">
              <div class="card-header">
                <h1 class="page-title">
                  Please Confirm if the below information is correct
                </h1>
              </div>
            </div>

            <br>

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Expense</h3>
                <div class="card-options">
                  <!-- <button type="button" class="btn btn-primary btn-sm" onclick="javascript:window.print();"><i class="fe fe-download"></i> Download Expense</button> -->
                </div>
              </div>

              <div class="card-body">
                <div class=" text-center">
                    <p class="h2"> <u>Expense</u> </p>
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
                    <p class="h3">To: <u> <?php echo $row['name'] ?></u> </p>
                  </div>
                  
                  <div class="col-6 text-right">
                    <p class="h4"> <?php echo "Date: "?> <u><?php echo date("d-m-Y");?> </u> </p>
                  </div>
                </div>

                <h4> <p class="text-right"> INVOICE NO: <?php echo $row['expenses_id'] ?></p> </h4>

                <div class="table-responsive push">
                  <table class="table table-bordered table-hover">
                    <tr>
                      <th class="text-left" >Expense made On</th>
                      <td class="text-center">
                      <?php
                          $date = date_create($row['expense_date']);
                          echo date_format($date, 'd-m-Y');
                      ?>
                      </td>
                    </tr>

                    <tr>
                      <th class="text-left" >Description</th>
                      <td class="text-center"><?php echo $row['description']; ?></td>
                    </tr>

                    <tr>
                      <th class="text-left" >Name</th>
                      <td class="text-center"><?php echo $row['name']; ?></td>
                    </tr>

                    <tr>
                      <th class="text-left" >Category</th>
                      <td class="text-center"><?php echo $row['categories']; ?></td>
                    </tr>

                    <tr>
                      <th class="text-left font-weight-bold text-uppercase text-left" >Amount</th>
                      <td class="text-center font-weight-bold text-uppercase text-right" >R<?php echo number_format($row['amount'],2); ?></td>
                    </tr>

                  </table>
                </div>

                <hr>
                <div class="row my-12">
                  <div class="col-12 text-right">
                    <form action="" method="post">
                     <button type="submit" name="edit" class="btn btn-primary">Edit Expense</button>
                     <button type="submit" name="confirm" class="btn btn-primary">Confirm</button>
                    </form>
                  </div>
                </div>

                <!-- <hr>
                <p class="text-muted text-center">
                  Thank you very much for doing business with us. We look forward to working with you again!
                </p> -->

              </div>
            </div>
          </div>
        </div>
      </div>

      <?php include 'incl/footer.php' ;?>
    </div>
  </body>
</html>