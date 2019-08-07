<?php
require 'core/init.php';
$general->logged_out_protect();
$username = htmlentities($user['username']);

// $view_expense = $expense->expenseInformation();
global $num;

// $daily_total = $payment->sum_of_daily_expenses();

$expense = $expenses->daily_expense();
$expense_total = $payment->sum_of_daily_expense();

if(isset($_POST['submit']) && ! empty($_POST['submit']) )
{
    if (isset($_POST['expense'])) 
    {
        $choice_selected = $_POST['expense'];  // Storing Selected Value In Variable
        
        if($choice_selected == "Daily")
        {
            $expense = $expenses->daily_expense();
            $expense_total = $expenses->sum_of_daily_expense();
        }
        else if ($choice_selected == "Weekly")
        {
            $expense = $expenses->weekly_expense();
            $expense_total = $expenses->sum_of_weekly_expense();
        }
        else if ($choice_selected == "Monthly")
        {
            $expense = $expenses->monthly_expense();
            $expense_total = $expenses->sum_of_monthly_expense();
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

              <div class="col-lg-3 ml-auto">

                <!-- <form class="input-icon my-3 my-lg-0" action="" method="post">

                   <input type="search" class="form-control header-search" placeholder="Search&hellip;" tabindex="1">
                  <div class="input-icon-addon">
                    <i class="fe fe-search"></i>
                  </div> 

                  <br>
                  <div class="form-group">
                           <label class="form-label">Separated inputs</label> 
                          <div class="row gutters-xs">
                            <div class="col">
                              <input type="text" name="search" class="form-control" required="required" placeholder="Enter Society Name">
                            </div>
                            <span class="col-auto">
                              <button class="btn btn-secondary" type="submit" name="submit"><i class="fe fe-search"></i></button><br>
                            
                              
                            </span>
                          </div>
                        </div>

                </form> -->

              </div>

              <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                  <li class="nav-item">
                    <a href="./index.php" class="nav-link"><i class="fe fe-home"></i> Home</a>
                  </li>

                  <li class="nav-item dropdown">
                    <a href="./create_expense.php" class="nav-link" ><i class="fe fe-file-plus"></i>Create a new Expense</a>
                  </li>

                  <!-- <li class="nav-item dropdown">
                    <a href="./view_invoice.php" class="nav-link" ><i class="fe fe-file"></i>View Invoices</a>
                  </li> -->

                  <li class="nav-item dropdown">
                    <a href="./view_expense.php" class="nav-link active"><i class="fe fe-check-square"></i> View Expenses</a>
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
                          <a href="index.php" style="text-decoration: none;"> <i class="fe fe-arrow-left"></i>Home</a> | 
                                <?php 
                                if(isset($_POST['expense']) )  
                                { 
                                    echo $choice_selected; ?> Expenses <?php 
                                } 
                                else 
                                    if(isset($_POST['submit']) && empty($_POST['expense']) === true )
                                    {
                                        echo "Expense";
                                    } 
                                    else 
                                    {
                                        echo "Daily Expenses";
                                    }?>
                        </h1>
                  </div>

                  
<form action="" method="post">
      <div class="form-group">
        <div class="form-label">Select a Expense</div>
            <div class="custom-switches-stacked">
                <label class="custom-switch">
                    <input type="radio" name="expense" value="Daily" class="custom-switch-input" checked>
                        <span class="custom-switch-indicator"></span>
                        <span class="custom-switch-description">Daily</span>
                </label>
                         
                <label class="custom-switch">
                    <input type="radio" name="expense" value="Weekly" class="custom-switch-input">
                        <span class="custom-switch-indicator"></span>
                        <span class="custom-switch-description">Weekly</span>
                    </label>
                
                <label class="custom-switch">
                    <input type="radio" name="expense" value="Monthly" class="custom-switch-input">
                        <span class="custom-switch-indicator"></span>
                        <span class="custom-switch-description">Monthly</span>
                </label>
            </div>
      </div>

    <input type="submit" name="submit" class="btn btn-sm btn-outline-primary" value="Click here to view selected expense" />
</form>
<br>

                          <div class="col-lg-12">
                                  <div class="card">

                                    <div class="card-body">
      
                                    <form action="" method="post" class="text-center">

                                        <div class="table-responsive push">
                                        <?php if(isset($_POST['submit']) &&  empty($_POST['expense']) === false )
                                        {?>
                                            <table class="table table-bordered table-hover">
                                                <tr>
                                                    <th class="text-center" style="width: 0.5%"></th>
                                                    <th class="text-center" style="width: 1%">Expense Date</th>
                                                    <th class="text-center" style="width: 5%">Description</th>
                                                    <th class="text-center" style="width: 5%">Name</th>
                                                    <th class="text-center" style="width: 5%">Categories</th>
                                                    <th class="text-center" style="width: 2%">Amount</th>
                                                    <th class="text-center" style="width: 2%">Action</th>
                                                </tr>

                                                <?php foreach ($expense as $view_expense) 
                                                { 
                                                ?>
                                                  <tr>
                                                      <td class="text-center"><?php echo $num += 1 ?></td>
                                                      <td>
                                                        <p class="font-w600 mb-1 text-center"><?php echo $view_expense['expense_date']; ?></p>
                                                        <!-- <div class="text-muted">Logo and business cards design</div> -->
                                                      </td>
                                                      <td class="text-center">
                                                      <?php echo $view_expense['description']; ?>
                                                      </td>
                                                      <td class="text-center"><?php echo $view_expense['name']; ?></td>
                                                      <td class="text-center"><?php echo $view_expense['categories']; ?></td>
                                                      <td class="text-center"><?php echo $view_expense['amount']; ?></td>
                                                      <td class="button-center">

                                                      <div class="btn-list text-center" class="input-group button-center">
                                                          <div class="btn-list text-center" class="input-group-prepend">
                                                            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                              Action
                                                            </button>
                                                            <div class="dropdown-menu">
                                                              <a href="./edit_expense.php?expenses_id=<?php echo $view_expense['expenses_id']?>" class="dropdown-item"><i class="dropdown-icon fe fe-edit"></i> Edit Expense </a>
                                                              <a href="./expense.php?expenses_id=<?php echo $view_expense['expenses_id']?>" class="dropdown-item"><i class="dropdown-icon fe fe-file"></i> View Expense </a>
                                                              <a onclick ="return confirm('Are you sure you want to delete this invoice?')" href="./delete_invoice.php?invoice_id=<?php echo $row['invoice_id']?>" class="dropdown-item" class="dropdown-item"><i class="dropdown-icon fe fe-trash-2"></i> Delete Expense</a>
                                                            </div>
                                                          </div>
                                                      </div>
                                                    </td>

                                                  </tr>
                                                <?php 
                                                } 
                                                ?>
                                                
                                                      <td colspan="5" class="font-weight-bold text-uppercase text-right">Total</td>
                                                      <td class="font-weight-bold text-center">R<?php echo $expense_total; ?> </td>
                                            </table>
                                        
                                        </div> 
                                        <?php } 
                                        else 
                                        if(isset($_POST['submit']) &&  empty($_POST['transaction']) === true )
                                        {?> 
                                            Select a transaction 
                                        <?php } 
                                        else
                                        {?>  <table class="table table-bordered table-hover">
                                          <tr>
                                            <th class="text-center" style="width: 0.5%"></th>
                                            <th class="text-center" style="width: 1%">Expense Date</th>
                                            <th class="text-center" style="width: 5%">Description</th>
                                            <th class="text-center" style="width: 5%">Name</th>
                                            <th class="text-center" style="width: 5%">Categories</th>
                                            <th class="text-center" style="width: 2%">Amount</th>
                                            <th class="text-center" style="width: 2%">Action</th>
                                          </tr>
                                    
                                          <?php foreach ($expense as $view_expense) 
                                          { 
                                          ?>
                                          <tr>
                                              <td class="text-center"><?php echo $num += 1 ?></td>
                                              <td>
                                                <p class="font-w600 mb-1 text-center"><?php echo $view_expense['expense_date']; ?></p>
                                                <!-- <div class="text-muted">Logo and business cards design</div> -->
                                              </td>
                                              <td class="text-center">
                                              <?php echo $view_expense['description']; ?>
                                              </td>
                                              <td class="text-center"><?php echo $view_expense['name']; ?></td>
                                              <td class="text-center"><?php echo $view_expense['categories']; ?></td>
                                              <td class="text-center"><?php echo $view_expense['amount']; ?></td>
                                              <td> 
                                                  <div class="btn-list text-center" class="input-group button-center">
                                                          <div class="btn-list text-center" class="input-group-prepend">
                                                            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                              Action
                                                            </button>
                                                            <div class="dropdown-menu">
                                                              <a href="./edit_expense.php?expenses_id=<?php echo $view_expense['expenses_id']?>" class="dropdown-item"><i class="dropdown-icon fe fe-edit"></i> Edit Expense </a>
                                                              <a href="./expense.php?expenses_id=<?php echo $view_expense['expenses_id']?>" class="dropdown-item"><i class="dropdown-icon fe fe-file"></i> View Expense </a>
                                                              <a onclick ="return confirm('Are you sure you want to delete this invoice?')" href="./delete_invoice.php?invoice_id=<?php echo $row['invoice_id']?>" class="dropdown-item" class="dropdown-item"><i class="dropdown-icon fe fe-trash-2"></i> Delete Expense</a>
                                                            </div>
                                                          </div>
                                                      </div>
                                              </td>

                                          </tr>
                                    
                                          <td colspan="5" class="font-weight-bold text-uppercase text-right">Total</td>
                                              <td class="font-weight-bold text-center">R<?php echo $expense_total; ?> </td>
                                          <?php 
                                          } 
                                        
                                        }
                                          ?>
                                              
                                       
                                    
                                        </table>                                     
</form>
                  
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