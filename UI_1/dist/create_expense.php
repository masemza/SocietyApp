<?php
require 'core/init.php';
$general->logged_out_protect();
$username = htmlentities($user['username']);
$type = htmlentities($user['type']);

if (isset($_POST['submit'])) 
{		
		if(!preg_match("/^[a-zA-Z ]*$/",$_POST['name'] ))
		{
			$errors[] = 'Only letters and white space allowed for name';
    }
    
    else
      if(empty($_POST['description']) === true || empty($_POST['name']) === true || empty($_POST['amount']) === true)
      {
        $errors[] = 'You must fill in all of the fields';
      }

      else
        if(empty($_POST['categories']) === true)
        {
          $errors[] = 'Select category';
        }

        else
        if($_POST['categories'] == '') 
        {
          $errors[] = 'Select category';
        }


		if(empty($errors) === true)
		{			
      $description 		= $_POST['description'];
      $name 			= $_POST['name'];
      $categories = $_POST['categories'];
      $amount 		= $_POST['amount'];

      $expenses->create_expense($description, $name, $categories , $amount);
      
      Print '<script>alert("Expense Successfully created");;
      window.location.assign("view_expense.php")</script>';
      
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
                    <a href="./index.php" class="nav-link"><i class="fe fe-home"></i> Home</a>
                  </li>

                  <?php if($type == 'admin' || $type == 'manager')
                  {?>
                    <li class="nav-item">
                      <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-file"></i>Capture Invoices</a>
                      <div class="dropdown-menu dropdown-menu-arrow">
                        <a href="./view_invoice.php" class="dropdown-item "><i class="fe fe-file-text"></i>View Invoice</a>
                        <a href="./create_invoice.php" class="dropdown-item "><i class="fe fe-file-plus"></i>Create a new Invoice</a>
                      </div>
                    </li>

                    <li class="nav-item">
                      <a href="javascript:void(0)" class="nav-link active" data-toggle="dropdown"><i class="fe fe-file"></i>Capture Expenses</a>
                      <div class="dropdown-menu dropdown-menu-arrow">
                        <a href="./view_expense.php" class="dropdown-item "><i class="fe fe-file-text"></i>View Expenses</a>
                        <a href="./create_expense.php" class="dropdown-item active"><i class="fe fe-file-plus"></i>Create a new Expenses</a>
                      </div>
                    </li>

                    <?php if($type === "manager") 
                    {?>
                      <li class="nav-item dropdown">
                        <a href="./view_report.php" class="nav-link"><i class="fe fe-file-text"></i> View Reports </a>
                      </li>
                    <?php 
                    }?>
                       
                    <li class="nav-item">
                      <a href="./manage_members.php" class="nav-link"><i class="fe fe-users"></i>Main Member's Dashboard</a>
                    </li>
                  <?php
                  }?>

                  <!-- <li class="nav-item dropdown">
                    <a href="./view_invoice.php" class="nav-link" ><i class="fe fe-file"></i>View Invoices</a>
                  </li> -->

                  <!-- <li class="nav-item dropdown">
                    <a href="./view_expense.php" class="nav-link"><i class="fe fe-check-square"></i> View Expenses</a>
                  </li> -->

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
            <div class="col-lg-8">
              <form class="card" action="" method="post">
                <div class="card-body">
                  
                  <div class="row">
                    <div class="col-sm-6 col-md-12">
                      <div class="form-group">
                        <label class="form-label">Expense for</label>
                        <Select name="categories" class="form-control custom-select" required="true"> 
                          <Option Value="<?php if(isset($_POST['categories'])) echo htmlentities($_POST['categories']); ?>" disabled selected >Select Category</Option>
                          <Option Value="Repair Maintenance">Repair Maintenance</Option>
                          <Option Value="Petrol">Petrol</Option>
                          <Option Value="Cleaning Materials">Cleaning Materials</Option>
                          <Option Value="Refreshments">Refreshements</Option>
                          <Option Value="Stationary">Stationary</Option>
                          <Option Value="Maintenance Equipments">Maintenance Equipments</Option>
                          <Option Value="Dry-clean">Dry-Clean</Option>
                          <Option value="Wages">Wages</Option>
                          <Option Value="Tollgate">Tollgate</Option>
                          <Option Value="Transport">Transport</Option>
                          <Option Value="Grave-Mark">Grave-Mark</Option>
                          <Option Value="Coffin">Coffin</Option>
                          <Option Value="Sundries">Sundries</Option>
                          <Option Value="Casual-Staff">Casual Staff</Option>
                        </Select>
                      </div>
                    </div>

                    <div class="col-sm-6 col-md-12">
                      <div class="form-group">
                        <label class="form-label">Paid by</label>
                        <input type="text" name="name" class="form-control" placeholder="Name" required="required" value="<?php if(isset($_POST['name'])) echo htmlentities($_POST['name']); ?>">
                      </div>
                    </div>

                    <div class="col-sm-6 col-md-12">
                      <div class="form-group">
                        <label class="form-label">Description</label>
                        <!-- <input type="text" name="description" class="form-control" placeholder="Description" required="required" value="<?php //if(isset($_POST['description'])) echo htmlentities($_POST['description']); ?>"> -->
                        <!-- <textarea name="description" id="" cols="100" rows="4" placeholder="Description" required="true" value="<?php //if(isset($_POST['description'])) echo htmlentities($_POST['description']); ?> "> </textarea> -->
                        <textarea name="description" class="form-control" id="" cols="100" rows="4" placeholder="Supplier Name plus Details" required="true" ><?php if(isset($_POST['description'])) echo htmlentities($_POST['description']); ?></textarea>
                      </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                      <div class="form-group">
                        <label class="form-label">Amount</label>
                        <input type="number" name="amount" class="form-control" placeholder="Amount" required="required" value="<?php if(isset($_POST['amount'])) echo htmlentities($_POST['amount']); ?>">
                      </div>
                    </div>

                  </div>
                </div>
                <div class="card-footer text-left">
                  <button onclick ="return confirm('Are you sure you want to create this expense?')" type="submit" name="submit" class="btn btn-primary">Save Expense</button>
                  <input type="reset" class="btn btn-primary" value="Reset" />
                </div>

              </form>

              <br>
              <?php 
			          if(empty($errors) === false)
                {
                  echo '<p class="text-center">' . implode('</p><p>', $errors) . '</p>';	
                }
              ?>
            </div>
            
          </div>
        </div>
      </div>
    </div>

    <?php include 'incl/footer.php' ;?>
  </div>
</body>
</html>