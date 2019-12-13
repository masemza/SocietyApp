<?php
require 'core/init.php';
$general->logged_out_protect();
$username = htmlentities($user['username']);
// $type = htmlentities($user['type']);

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
      $total_invoices = $invoices->search_invoices($date1, $date2);
      $total_deposits = $payment->search_deposits($date1, $date2);

      $invoice = $invoices->display_invoices($date1, $date2);
      $view_expenses = $expenses->display_expenses($date1, $date2);
      $view_deposits = $payment->display_deposits($date1, $date2);

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
              <div class="col-lg-3 ml-auto">
              </div>
              <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                  <li class="nav-item">
                    <a href="./index.php" class="nav-link"><i class="fe fe-home"></i> Home</a>
                  </li>

                  <?php if($type == 'admin' || $type == 'manager')
                  {?>
                    <li class="nav-item">
                      <a href="javascript:void(0)" class="nav-link active" data-toggle="dropdown"><i class="fe fe-file"></i>Capture Invoices</a>
                      <div class="dropdown-menu dropdown-menu-arrow">
                        <a href="./view_invoice.php" class="dropdown-item active"><i class="fe fe-file-text"></i>View Invoice</a>
                        <a href="./create_invoice.php" class="dropdown-item "><i class="fe fe-file-plus"></i>Create a new Invoice</a>
                      </div>
                    </li>

                    <li class="nav-item">
                      <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-file"></i>Capture Expenses</a>
                      <div class="dropdown-menu dropdown-menu-arrow">
                        <a href="./view_expense.php" class="dropdown-item "><i class="fe fe-file-text"></i>View Expenses</a>
                        <a href="./create_expense.php" class="dropdown-item "><i class="fe fe-file-plus"></i>Create a new Expenses</a>
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
                  
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="my-3 my-md-5">
          <div class="container">
            <div class="page-header">        
            <h1 class="page-title">
              <a href="index.php" style="text-decoration: none;"> <i class="fe fe-arrow-left"></i>Home</a> | Invoice
              </h1>
            </div>

            <div class="col-sm-6 col-lg-12 ">
                <div class="card p-3 align-items-center">
                  <div class="d-flex align-items-center">
                    <div>
                      <form action="" method="post">
                        <h4 class="text-center">Select Invoice Statement </h4>&nbsp; 
                        From <input type="date" name="date1" >
                        To <input type="date" name="date2" > 

                        <input type="submit" name="submit" class="btn btn-primary" value="Search">
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
              else if(isset($_POST['submit']) && empty($invoice) )
              {?>
                <h1 class="page-title ">
                  <div class="card text-center">
                    No Invoice made
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
                    Invoice Statement <br><?php
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
                      <span class="stamp stamp-md bg-blue mr-3">
                        <i class="fe fe-plus-square"></i>
                      </span>
                      <div>
                      <h4 class="m-0"><a href="javascript:void(0)"> <small>Total Invoices</small></a></h4>
                      <small class="text-muted">R<?php echo number_format($total_invoices,2) ?></small>
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
                                        <th class="text-center" style="width: 1%">Invoice Date</th>
                                        <th class="text-center" style="width: 5%">Description</th>
                                        <th class="text-center" style="width: 5%">Invoice to</th>
                                        <th class="text-center" style="width: 2%">Amount</th>
                                        <th class="text-center" style="width: 3%">Action</th>
                                    
                                    </tr>

                                    <?php foreach ($invoice as $view_invoice) 
                                    { 
                                    ?>
                                    <tr>
                                        <td class="text-center"><?php echo $num += 1 ?></td>
                                        <td>
                                        <p class="font-w600 mb-1 text-center"><?php
                                            $date=date_create($view_invoice['invoice_date']);
                                            echo date_format($date,"d-m-Y");?>
                                        </p>
                                        </td>
                                        <td class="text-center">
                                        <?php echo $view_invoice['description']; ?>
                                        </td>
                                        <td class="text-center"><?php echo $view_invoice['name']; ?></td>
                                        <td class="text-center"><?php echo $view_invoice['amount']; ?></td>
                                        <td class="button-center">
                                        <div class="btn-list text-center" class="input-group button-center">
                                            <div class="btn-list text-center" class="input-group-prepend">
                                                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action
                                                </button>
                                                <div class="dropdown-menu">
                                                <!-- <a href="./edit_invoice.php?invoice_id=<?php //echo $view_invoice['invoice_id']?>" class="dropdown-item"><i class="dropdown-icon fe fe-edit"></i> Edit Invoice </a> -->
                                                <a href="./invoice.php?invoice_id=<?php echo $view_invoice['invoice_id']?>" class="dropdown-item"><i class="dropdown-icon fe fe-file"></i> View Invoice </a>
                                                <!-- <a onclick ="return confirm('Are you sure you want to delete this invoice?')" href="./delete_invoice.php?invoice_id=<?php //echo $view_invoice['invoice_id']?>" class="dropdown-item" class="dropdown-item"><i class="dropdown-icon fe fe-trash-2"></i> Delete Invoice</a> -->
                                                </div>
                                            </div>
                                        </div>
                                                    
                                        </td>
                                    </tr>
                                    <?php 
                                    } 
                                    ?>
                                    
                                    <td colspan="4" class="font-weight-bold text-uppercase text-right">Total</td>
                                    <td class="font-weight-bold text-center">R<?php echo $total_invoices; ?> </td>
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
                                  </div>
                                </div></div>
      
                </div>
              </div>


      <!-- <div class="footer">
        <div class="container">
          <div class="row">
            <div class="col-lg-8">
              <div class="row">
                <div class="col-6 col-md-3">
                  <ul class="list-unstyled mb-0">
                    <li><a href="#">First link</a></li>
                    <li><a href="#">Second link</a></li>
                  </ul>
                </div>
                <div class="col-6 col-md-3">
                  <ul class="list-unstyled mb-0">
                    <li><a href="#">Third link</a></li>
                    <li><a href="#">Fourth link</a></li>
                  </ul>
                </div>
                <div class="col-6 col-md-3">
                  <ul class="list-unstyled mb-0">
                    <li><a href="#">Fifth link</a></li>
                    <li><a href="#">Sixth link</a></li>
                  </ul>
                </div>
                <div class="col-6 col-md-3">
                  <ul class="list-unstyled mb-0">
                    <li><a href="#">Other link</a></li>
                    <li><a href="#">Last link</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-4 mt-4 mt-lg-0">
              Premium and Open Source dashboard template with responsive and high quality UI. For Free!
            </div>
          </div>
        </div>
      </div> -->


      <?php include 'incl/footer.php' ;?>
    </div>

<script type="text/javascript">
    $(document).ready(function(){
        $("#search_text").keyup(function(){
            var search = $(this).val();
            $.ajax({
                url:'viewMemberAction.php',
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