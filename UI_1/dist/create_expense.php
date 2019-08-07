<?php
require 'core/init.php';
$general->logged_out_protect();
$username = htmlentities($user['username']);

if (isset($_POST['submit'])) 
{
	$description 		= $_POST['description'];
	$name 			= $_POST['name'];
  $categories = $_POST['categories'];
	$amount 		= $_POST['amount'];
		
		if(!preg_match("/^[a-zA-Z ]*$/",$name ))
		{
			$errors[] = 'Only letters and white space allowed for name';
		}

		if(empty($errors) === true)
		{			
	
            @$expense->create_expense($description, $name, $categories ,  $amount);
            {
                Print '<script>alert("Expense Successfully created");;
                window.location.assign("view_expense.php")</script>';
    
                exit();    
            }
	
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
                    <a href="./index.php" class="nav-link"><i class="fe fe-home"></i> Home</a>
                  </li>

                  <li class="nav-item dropdown">
                    <a href="./create_expense.php" class="nav-link active" ><i class="fe fe-file-plus"></i>Create a new Expense</a>
                  </li>

                  <!-- <li class="nav-item dropdown">
                    <a href="./view_invoice.php" class="nav-link" ><i class="fe fe-file"></i>View Invoices</a>
                  </li> -->

                  <li class="nav-item dropdown">
                    <a href="./view_expense.php" class="nav-link"><i class="fe fe-check-square"></i> View Expenses</a>
                  </li>

                  <!-- <li class="nav-item dropdown">
                    <a href="./view_withdrawals.php" class="nav-link"><i class="fe fe-check-square"></i> View Withdrawals</a>
                  </li>

                  <li class="nav-item dropdown">
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
                      <a href="index.php" style="text-decoration: none;"> <i class="fe fe-arrow-left"></i>Home</a> | Create Expense
                    </h1>
              </div>
            <div class="row">
            <div class="col-lg-12">
              <form class="card" action="" method="post">
                <div class="card-body">
                  
                  <div class="row">
                    
                    <div class="col-sm-6 col-md-12">
                      <div class="form-group">
                        <label class="form-label">Description</label>
                        <input type="text" name="description" class="form-control" placeholder="Description" required="required" >
                      </div>
                    </div>

                    <div class="col-sm-6 col-md-12">
                      <div class="form-group">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Name" required="required" >
                      </div>
                    </div>

        <div class="col-sm-6 col-md-12">
          <div class="form-group">
            <label class="form-label">Category</label>
            <Select name="categories" class="form-control custom-select" > 
            
              <Option Value=""  disabled selected hidden>Select Category</Option>
              <Option Value="Repair Maintanance">Repair Maintanance</Option>
              <Option Value="Petrol">Petrol</Option>
              <Option Value="Cleaning Materials">Cleaning Materials</Option>
              <Option Value="Refreshments">Refreshements</Option>
              <Option Value="Stationary">Stationary</Option>
              <Option Value="Maintanance Equipments">Maintanance Equipments</Option>
              <Option Value="Dry-clean">Dry-Clean</Option>
              <Option Value="Tollgate">Tollgate</Option>
              <Option Value="Transport">Transport</Option>
              <Option Value="Grave-Mark">Grave-Mark</Option>
              <Option Value="Coffin">Coffin</Option>
              <Option Value="Sundries">Sundries</Option>
            </Select>

             <!--  <div class="col-sm-6 col-md-6">
                      <div class="form-group">
                        <label class="form-label">Gender</label>
                        <select class="form-control custom-select" name="gender" required="required">
                                <option value="">-Select-</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                        </select>
                      </div>
                    </div> -->


               </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                      <div class="form-group">
                        <label class="form-label">Amount</label>
                        <input type="number" name="amount" class="form-control" placeholder="Amount" required="required" >
                      </div>
                    </div>

                  </div>
                </div>
                <div class="card-footer text-right">
                  <button onclick ="return confirm('Are you sure you want to create that expense?')" type="submit" name="submit" class="btn btn-primary">Create</button>
                  <input type="reset" class="btn btn-primary" value="Reset" />
                </div>

                <?php 
			if(empty($errors) === false)
			{
				echo '<p>' . implode('</p><p>', $errors) . '</p>';	
			}
    ?>
    
              </form>
            </div>
            
          </div>
        </div>
      </div>
    </div>

    <?php include 'incl/footer.php' ;?>
  </div>
</body>
</html>