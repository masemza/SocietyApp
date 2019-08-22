<?php
require 'core/init.php';
$general->logged_out_protect();
$username = htmlentities($user['username']);

if (isset($_POST['submit']))
{
    $date1 = $_POST['date1'];
    $date2 = $_POST['date2'];
    
    if(empty($date1) === true || empty($date2) === true )
    {
      $errors[] = 'Please select both dates';
    }

    if(empty($errors) === true)
    {
      if(!empty($_POST['category']) )
      { 
          if(!empty($_POST['category']))
          {
           $category = $_POST['category'];
          }
          $total_expense = $expenses->sum_of_category($date1, $date2, $category); 
          $expenses = $expenses->search_category($date1, $date2, $category);  
      }
      else
      {
          $total_expense = $expenses->search_expenses($date1, $date2);
          $expenses = $expenses->display_expenses($date1, $date2);
      }

      global $num;

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

              <div class="col-lg- ml-auto">
              </div>

              <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                  <li class="nav-item">
                    <a href="./index.php" class="nav-link"><i class="fe fe-home"></i> Home</a>
                  </li>

                  <li class="nav-item dropdown">
                    <a href="./create_expense.php" class="nav-link"><i class="fe fe-file-plus"></i> Create a new Expense</a>
                  </li>

                  <li class="nav-item dropdown">
                    <a href="./view_expense.php" class="nav-link active"><i class="fe fe-file"></i> Expense</a>
                  </li>

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
              <a href="index.php" style="text-decoration: none;"> <i class="fe fe-arrow-left"></i>Home</a> | Expenses
              </h1>
            </div>

            <div class="col-sm-6 col-lg-12 ">
                <div class="card p-3 align-items-center">
                  <div class="d-flex align-items-center">
                    <div>
                      <form action="" method="post">
                        <div class="form-group">
                          <h4 class="text-center">Select Expense Statement </h4>&nbsp; 
                          From <input type="date" name="date1" >
                          To <input type="date" name="date2" > 
                        </div>

                        <div class="form-group">
                          <label class="form-label text-center">Category</label>
                          <Select name="category" class="form-control custom-select" > 
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
                          </Select>
                        </div>
        
                        <div class="text-center">
                          <input type="submit" name="submit" class="btn btn-danger" value="Search">
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            
              <hr>
            
            <?php if(empty($errors) === true)
            { 
              if (isset($_POST['submit']) && $date1 > $date2 )
              {?>
                <h1 class="page-title">
                  <div class="card text-center">
                      Date 2 must be greater than date 1
                  </div>  
                </h1>
              <?php 

              }
              else if(isset($_POST['submit']) && empty($expenses) )
              {?>
                <h1 class="page-title ">
                  <div class="card text-center">
                    No Expenses made
                  </div>
                </h1>
              <?php 
              }

              else
              if (isset($_POST['submit']) )
              {
                $date1 = $_POST['date1'];
                $date2 = $_POST['date2'];
              ?> 
                <h3>  
                    Expense Statement <br><?php
                    if($date1 <> $date2)
                    {
                      $date1=date_create($date1);
                      $date2=date_create($date2);
                        echo "From ".date_format($date1,"d-M-Y")." To ".date_format($date2,"d-M-Y");
                    } 
                    else
                    { 
                        $date1=date_create($date1);
                        echo "For ".date_format($date1,"d-M-Y");
                    }?>
                </h3>

              <div class="row row-cards">
                <div class="col-sm-6 col-lg-4">
                  <div class="card p-3">
                    <div class="d-flex align-items-center">
                      <span class="stamp stamp-md bg-danger mr-3">
                        <i class="fe fe-minus-square"></i>
                      </span>
                      <div>
                      <h4 class="m-0"><a href="javascript:void(0)"> <small>Total Expenses</small></a></h4>
                      <small class="text-muted">R<?php echo number_format($total_expense,2) ?></small>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body"> 
                            <div class="table-responsive push">
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

                                                <?php foreach ($expenses as $view_expense) 
                                                { 
                                                ?>
                                                  <tr>
                                                      <td class="text-center"><?php echo $num += 1 ?></td>
                                                      <td>
                                                        <p class="font-w600 mb-1 text-center">
                                                          <?php 
                                                            $date=date_create($view_expense['expense_date']);
                                                            echo date_format($date,"d-m-Y");
                                                          ?>
                                                        </p>
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
                                                      <td class="font-weight-bold text-center">R<?php echo number_format($total_expense,2); ?> </td>
                                            </table>
                            </div>
                        </div>
                    </div>
                </div>

              <?php 
              }
            }?>

            <?php 
              if(empty($errors) === false)
              {?>
              <h1 class="page-title">
                <div class="card text-center">
                <?php 
                echo '<p class="text-center">' . implode('</p><p>', $errors) . '</p>';	
              }
            ?>

            </div>
            <div class="row row-cards row-deck">
            </div>
            <div class="row row-cards row-deck">

              <div class="col-12">
              <h1 class="page-title">

                  <!-- <div class="card">
                      J
                  </div> -->
                </div>
              </div>
              
            </div>
          </div>
        </div>
      </div>     

      <?php include 'incl/footer.php' ;?>
    </div>

<script type="text/javascript">
    $(document).ready(function(){
        $("#search_text").keyup(function(){
            var search = $(this).val();
            $.ajax({
                url:'indexAction.php',
                method:'post',
                data:{query:search},
                success:function(response){
                    $("#table-data").html(response)
                }
            });
        });
    });
</script>

  </body>
</html>