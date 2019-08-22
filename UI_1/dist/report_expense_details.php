<?php
require 'core/init.php';
$general->logged_out_protect();
$username = htmlentities($user['username']);

$date1 = $_GET['date1'];
$date2 = $_GET['date2'];
$category = $_GET['category'];

// $total_expense = $expenses->search_expenses($date1, $date2);
// $cleaning_materials = $expenses->total_cleaning_materials($date1, $date2);
// $coffin = $expenses->total_coffin($date1, $date2);
// $dry_clean = $expenses->total_dry_clean($date1, $date2);
// $grave_mark = $expenses->total_grave_mark($date1, $date2);
// $maintenance_equipments = $expenses->total_maintenance_equipments($date1, $date2);
// $petrol = $expenses->total_petrol($date1, $date2);
// $refreshments = $expenses->total_refreshments($date1, $date2);
// $repair_maintenance = $expenses->total_repair_maintenance($date1, $date2);
// $stationery = $expenses->total_stationery($date1, $date2);
// $sundries = $expenses->total_sundries($date1, $date2);
// $transport = $expenses->total_transport($date1, $date2);
// $tollgate = $expenses->total_tollgate($date1, $date2);
// $wages = $expenses->total_wages($date1, $date2);

// $expenses = $expenses->display_expenses($date1, $date2);

$total_expense_category = $payment->sum_of_category($date1, $date2, $category);
$expense = $payment->displaying_category_details($date1, $date2, $category);

if(isset($_POST['submit']))
{  

  if(empty($_POST['category']) === true)
  {
      $errors[] = 'Please select category';
  }


  if(empty($errors) === true)
  {
    if(!empty($_POST['category']))
    {
      $category = $_POST['category'];
      $total_expense_category = $payment->sum_of_category($date1, $date2, $category);
    }
    //$total_expense_category = $payment->search_expenses($date1, $date2);
    //$total_expense_category = $expenses->search_expenses($date1, $date2);
    //$expenses = $expenses->display_expenses($date1, $date2);
  }

  if(!empty($_POST['category']))
  {
    if($_POST['category'] == "All")
    {
      
      $total_expense_category = $expenses->search_expenses($date1, $date2);
    }
  }
}

global $num;

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

              <!-- <div class="col-lg- ml-auto">
              <form class="input-icon my-3 my-lg-0" action="" method="post">
                  <br>
                    <div class="row gutters-xs">
                      <div class="col">
                       
                      <div class="form-group">
                          <Select name="category" class="form-control custom-select" > 
                            <Option Value="All" disabled selected >Select Category</Option>
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
                      
                      </div>
                      <span class="col-auto">
                        <button class="btn btn-secondary" type="submit" name="submit"><i class="fe fe-search"></i></button>
                        <br>
                      </span>
                      
                    </div>
              </form>
              </div> -->

              <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                  <li class="nav-item">
                    <a href="./index.php" class="nav-link active"><i class="fe fe-home"></i> Home</a>
                  </li>

                  <!-- <li class="nav-item">
                    <a href="./gallery.html" class="nav-link"><i class="fe fe-image"></i> Logout</a>
                  </li> -->

                  <!-- <li class="nav-item">
                    <a href="./docs/index.html" class="nav-link"><i class="fe fe-file-text"></i> Documentation</a>
                  </li> -->

                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="my-3 my-md-5 ">
          <div class="container ">
            <div class="page-header">
                <h1 class="page-title">
                    <a href="view_report_expense.php?date1=<?php echo $date1 ?> &date2=<?php echo $date2?>" style="text-decoration: none;"> <i class="fe fe-arrow-left"></i>Report</a> | Expense Report
                </h1>
            </div>

            
            <div class="row row-cards">
            <?php if($expense)
                {?>
                <div class="col-sm-6 col-lg-">
                  <div class="card p-3">
                    <div class="d-flex align-items-center">
                      <span class="stamp stamp-md bg-blue mr-3">
                        <i class="fe fe-plus-square"></i>
                      </span>
                      <div>
                        <h4 class="m-0"><a href="javascript:void(0)"><small>Total <?php echo $category ?></small></a></h4>
                        <small class="text-muted">R<?php echo number_format($total_expense_category,2) ?></small>
                        
                      </div>
                    </div>
                  </div>
                </div>


                
                  <div class="card">
                    <div class="card-body">
                      <div class="table-responsive push">
                        <table class="table table-bordered table-hover">
                            <tr>
                                <th class="text-center" style="width: 1.5%"></th>
                                <th class="text-center" style="width: 5%">Date</th>
                                <th class="text-center" style="width: 5%">Description</th>
                                <th class="text-center" style="width: 5%">Name</th>
                                <th class="text-center" style="width: 5%">Category</th>
                                <th class="text-center" style="width: 5%">Amount</th>
                            </tr>

                            <?php foreach($expense as $view_expenses)
                            { ?>
                            <tr>
                              <td class="text-center"><?php echo $num += 1 ?></td>
                              <td class="text-center"><?php echo $view_expenses['expense_date'] ?></td>
                              <td class="text-center"><?php echo $view_expenses['description'] ?></td>
                              <td class="text-center"><?php echo $view_expenses['name'] ?></td>
                              <td class="text-center"><?php echo $category ?></td>
                              <td class="text-center">R<?php echo number_format($view_expenses['amount'],2);?></td>
                            </tr>
                            <?php
                            } ?>

                            <td colspan="5" class="font-weight-bold text-uppercase text-right">Total</td>
                            <td class="font-weight-bold text-center">R<?php echo number_format($total_expense_category,2); ?> </td> 
                        </table>
                      </div>
                <?php 
                } 
                else
                {?>
                    <div class="col-sm-6 col-lg-12 ">
                          <div class="card p-3 align-items-center">
                            <div class="d-flex align-items-center">
                              <form class="text-center" action="" method="post">                    
                                <div class="form-group">
                        <h3>
                        Sorry!!!
                        No expenses made for category: "<?php echo $category; ?>"
                        </div>
                    </h3>
                <?php
                }?>




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
    </div>

  </body>
</html>