<?php 
require 'core/init.php';
$general->logged_out_protect();
$username = htmlentities($user['username']);

$invoice_id =$_GET['invoice_id'];
$view_invoice = $invoices->invoicedata($invoice_id);

if (isset($_POST['submit'])) {
	
	if(empty($errors) === true)
	{		
        $description   = $_POST['description'];
        $name      = $_POST['name'];
        $amount      = $_POST['amount'];

		$invoices->updateInvoice($description, $name, $amount, $invoice_id);
        {
            Print '<script>alert("Invoice Successfully edited");;
            window.location.assign("view_invoice.php")</script>';

			exit();    
        }
		exit();
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
              <?php //foreach ($view_invoice as $row) ?>
                <a href="./view_invoice.php<?php //echo $row['invoice_id'] ?>" style="text-decoration: none;"> <i class="fe fe-arrow-left"></i>View Invoice</a> | Edit Invoice Details
                <?php ?>

              </h1>
            </div>

            <div class="row row-cards row-deck">
            <div class="col-lg-12">
              <script>
                require(['input-mask']);
              </script>
              <div class="card">
                <div class="card-body">
                  <h3 class="card-title">Edit Invoice Details</h3>
                  <form action="" method="post">
                  <?php foreach ($view_invoice as $row) { ?>
                      <div class="form-group">
                          <label class="form-label">Description</label>
                          <input type="text" name="description" class="form-control" required="required" placeholder="Description" value="<?php echo $row['description']?>" >
                      </div>

                      <div class="form-group">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" required="required" placeholder="Name" value="<?php echo $row['name']?>" >
                      </div>

                      <div class="form-group">
                            <label class="form-label">Amount</label>
                            <input type="number" name="amount" class="form-control" required="required" placeholder="Amount" value="<?php echo $row['amount']?>" >
                        </div>

                        <?php } ?>

                    <div class="card-footer">
                      <button onclick ="return confirm('Are you sure you want to edit that Invoice?')" type="submit" name="submit" class="btn btn-primary btn-block" > Update Invoice</button>
                    </div>
                  </form>
                </div>
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