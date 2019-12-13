<?php 
require 'core/init.php';
$general->logged_out_protect();
$username = htmlentities($user['username']);

$invoice_id =$_GET['invoice_id'];
$view_invoice = $invoices->invoicedata($invoice_id);

foreach ($view_invoice as $row) {}

if (isset($_POST['save'])) {
	
	if(empty($errors) === true)
	{		
        $description   = $_POST['description'];
        $name      = $_POST['name'];
        $amount      = $_POST['amount'];

		$invoices->updateInvoice($description, $name, $amount, $invoice_id);
        {
            Print '<script>alert("Invoice Successfully Updated");;
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
                <a href="./view_invoice.php<?php?>" style="text-decoration: none;"> <i class="fe fe-arrow-left"></i>View Invoice</a> | Edit Invoice Details
              </h1>
            </div>

            <div class="row row-cards row-deck">
              <div class="col-lg-8">
                <script>
                  require(['input-mask']);
                </script>
                
                <div class="card">
                  <div class="card-body">
                    <?php 
                    if(empty($errors) === false)
                    {
                      echo '<p class="text-center">' . implode('</p><p>', $errors) . '</p>';  
                    }?>

                    <div class="card">
                      <form action="" method="post">
                        <div class="card-body">      
                          <h3 class="card-title">
                            Edit Invoice Details
                          </h3>
                          
                          <div class="form-group">
                            <label class="form-label">Invoice To</label>
                            <input type="text" name="name" class="form-control" required="required" placeholder="Name" value="<?php echo $row['name']?>" >
                          </div>

                          <div class="form-group">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" cols="100" rows="4" placeholder="Description" required="required" ><?php echo $row['description']?> </textarea>
                          </div>

                          <div class="form-group">
                            <label class="form-label">Amount</label>
                            <input type="number" name="amount" class="form-control" required="required" placeholder="Amount" value="<?php echo $row['amount']?>" >
                          </div>      

                        </div>
                        
                        <div class="card-footer text-left">
                          <button onclick ="return confirm('Are you sure you want to create this invoice?')" type="submit" name="save" class="btn btn-primary ">Save Invoice</button>
                          <a href="./delete_invoice.php?invoice_id=<?php echo $invoice_id ?>" class="btn btn-primary" role="button">Cancel Invoice</a>
                        </div>
                          
                      </form>
                    
                    </div>
                  </div>
                </div>
              </div>
            </div>    
          </div>
        </div>
      </div>
    </div>

      <?php include 'incl/footer.php' ;?>

  </body>
</html>