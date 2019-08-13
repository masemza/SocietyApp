<?php 
require 'core/init.php';
$general->logged_out_protect();
$username = htmlentities($user['username']);

$expenses_id =$_GET['expenses_id'];
$view_expense = $expenses->expensedata($expenses_id);

if (isset($_POST['submit'])) {
  
  if(empty($errors) === true)
  {   
        $description   = $_POST['description'];
        $name      = $_POST['name'];
        $categories     =$_POST['categories'];
        $amount      = $_POST['amount'];
        //$expense_id     = $_POST['expense_id'];

        $expenses->updateexpense($description, $name, $categories, $amount, $expenses_id);
        {
            Print '<script>alert("Expense Successfully Edited");;
            window.location.assign("view_expense.php")</script>';

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
              <?php //foreach ($view_expense as $row) ?>
                <a href="./view_expense.php<?php //echo $row['expense_id'] ?>" style="text-decoration: none;"> <i class="fe fe-arrow-left"></i>View expense</a> | Edit expense Details
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
                  <h3 class="card-title">Edit expense Details</h3>
                  <form action="" method="post">
                  <?php foreach ($view_expense as $row) { ?>
                      <div class="form-group">
                          <label class="form-label">Description</label>
                          <input type="text" name="description" class="form-control" required="required" placeholder="Description" value="<?php echo $row['description']?>" >
                      </div>

                      <div class="form-group">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" required="required" placeholder="Name" value="<?php echo $row['name']?>" >
                      </div>

                       <div class="form-group">
                            <label class="form-label">Category</label>
                            <Select name="categories" class="form-control custom-select" >
                                <Option Value="" disabled checked>---Select Category---</Option>
                                <Option Value="<?php if(isset($_POST['categories'])) echo htmlentities($_POST['categories']); ?>"><?php echo $row['categories']?></Option>
                                <Option Value="Repair Maintanance">Repair Maintanance</Option>
                                <Option Value="Petrol">Petrol</Option>
                                <Option Value="Cleaning Materials">Cleaning Materials</Option>
                                <Option Value="Refreshments">Refreshements</Option>
                                <Option Value="Stationary">Stationary</Option>
                                <Option Value="Maintanance Equipments">Maintanance Equipments</Option>
                                <Option Value="Dry-clean">Dry-Clean</Option>
                                <Option value="Wages">Wages</Option>
                                <Option Value="Tollgate">Tollgate</Option>
                                <Option Value="Transport">Transport</Option>
                                <Option Value="Grave-Mark">Grave-Mark</Option>
                                <Option Value="Coffin">Coffin</Option>
                                <Option Value="Sundries">Sundries</Option>
                            </select>
                      </div>


                      <div class="form-group">
                            <label class="form-label">Amount</label>
                            <input type="number" name="amount" class="form-control" required="required" placeholder="Amount" value="<?php echo $row['amount']?>" >
                        </div>

                        <?php } ?>

                    <div class="card-footer">
                      <button onclick ="return confirm('Are you sure you want to edit that expense?')" type="submit" name="submit" class="btn btn-primary btn-block" > Update expense</button>
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
        </div>
      </div>

      <?php include 'incl/footer.php' ;?>
    </div>
  </body>
</html>