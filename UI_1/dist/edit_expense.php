<?php 
require 'core/init.php';
$general->logged_out_protect();
$username = htmlentities($user['username']);

$expenses_id =$_GET['expenses_id'];
$member_payment_id =$_GET['member_payment_id'];

$view_expense = $expenses->expensedata($expenses_id);
foreach ($view_expense as $row){}

if (isset($_POST['save'])) 
{

  if(empty($errors) === true)
  {   
        $description   = $_POST['description'];
        $name      = $_POST['name'];
        $categories     =$_POST['categories'];
        $amount      = $_POST['amount'];
        //$expense_id     = $_POST['expense_id'];

        $expenses->updateexpense($description, $name, $categories, $amount, $expenses_id);
        {
            Print '<script>alert("Expense Successfully Updated");;
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
                <a href="./view_expense.php<?php?>" style="text-decoration: none;"> <i class="fe fe-arrow-left"></i>View expense</a> | Edit expense Details
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
                  }
                  ?>

                    <div class="card">

                      <form action="" method="post">
                      
                        <div class="card-body">
                          <h3 class="card-title">
                            Edit expense Details
                          </h3>
                        
                          <div class="form-group">
                            <label class="form-label">Expenses for</label>
                            <Select name="categories" class="form-control custom-select" required="true">
                              <Option Value="<?php echo $row['categories']?>" disabled checked>---Select Category---</Option>
                              <Option Value="<?php echo $row['categories'] ?>"><?php echo $row['categories']?></Option>
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
                            </Select>
                          </div>

                          <div class="form-group">
                            <label class="form-label">Paid by</label>
                            <input type="text" name="name" class="form-control" required="required" placeholder="Name" value="<?php echo $row['name']?>" >
                          </div>
                          
                          <div class="form-group">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" id="" cols="100" rows="4" placeholder="Supplier Name plus Details" required="required" ><?php echo $row['description']?>
                            </textarea>
                          </div>

                          <div class="form-group">
                            <label class="form-label">Amount</label>
                            <input type="number" name="amount" class="form-control" required="required" placeholder="Amount" value="<?php echo $row['amount']?>" >
                          </div>

                        </div>

                        <div class="card-footer text-left">
                          <button onclick ="return confirm('Are you sure you want to create this expense?')" type="submit" name="save" class="btn btn-primary ">Save Expense</button>
                          <a href="./delete_expense.php?expenses_id=<?php echo $expenses_id ?>" class="btn btn-primary" role="button">Cancel Expense</a>
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

      <?php include 'incl/footer.php' ;?>
    </div>
  </body>
</html>