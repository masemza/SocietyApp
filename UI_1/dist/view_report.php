<?php
require 'core/init.php';
$general->logged_out_protect();
$username = htmlentities($user['username']);

if (isset($_POST['submit']))
{
    $date1 = $_POST['date1'];
    $date2 = $_POST['date2'];
        
    $total_expense = $expenses->search_expenses($date1, $date2);
    $total_invoices = $invoices->search_invoices($date1, $date2);
    $total_deposits = $payment->search_deposits($date1, $date2);

    $total_income = $total_invoices + $total_deposits;
    $total_balance = $total_income - $total_expense;
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
              <a href="index.php" style="text-decoration: none;"> <i class="fe fe-arrow-left"></i>Home</a> | Report
              </h1>
            </div>

            <div class="col-sm-6 col-lg-12 ">
                <div class="card p-3 align-items-center">
                  <div class="d-flex align-items-center">
                    <div>
                      <form action="" method="post">
                        <h4 class="text-center">Select Report Statement </h4>&nbsp; 
                        From <input type="date" name="date1" >
                        To <input type="date" name="date2" > 
                        
                            <!-- <input type="date" name="date1" class="form-control" placeholder="Name" required="required" value="<?php if(isset($_POST['name'])) echo htmlentities($_POST['name']); ?>">
                
                            <input type="date" name="date2" class="form-control" placeholder="Name" required="required" value="<?php if(isset($_POST['name'])) echo htmlentities($_POST['name']); ?>">
                          -->
                        

                        <input type="submit" name="submit" class="btn btn-primary" value="Search">
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            
              <hr>
            <h3> 
            <?php if (isset($_POST['submit']) && !empty($_POST['date1']) && !empty($_POST['date2'])) 
              { ?> Report Statement <br><?php
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
                  }
              } ?>
            </h3>
            
            <?php if (isset($_POST['submit']) && !empty($_POST['date1']) && !empty($_POST['date2'])) 
            {
              $date1 = $_POST['date1'];
              $date2 = $_POST['date2'];
            ?> 
            
            <div class="row row-cards">
              <div class="col-sm-6 col-lg-4">
                <div class="card p-3">
                  <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-blue mr-3">
                      <i class="fe fe-plus-square"></i>
                    </span>
                    <div>
                      <h4 class="m-0"><a href="view_report_income.php?date1=<?php echo $date1 ?> &date2=<?php echo $date2 ?>"> <small>Total Income</small></a></h4>
                      <small class="text-muted">R<?php echo number_format($total_income,2) ?></small>
                      
                    </div>
                  </div>
                </div>
              </div>
              

              <div class="col-sm-6 col-lg-4">
                <div class="card p-3">
                  <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-red mr-3">
                      <i class="fe fe-minus-square"></i>
                    </span>
                    <div>
                      <h4 class="m-0"><a href="javascript:void(0)"><small>Total Expense</small></a></h4>
                      <small class="text-muted">R<?php echo number_format($total_expense,2) ?> </small>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="col-sm-6 col-lg-4">
                <div class="card p-3">
                  <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-teal mr-3">
                      <i class="fe fe-dollar-sign"></i>
                    </span>
                    <div>
                      <h4 class="m-0"><a href="javascript:void(0)"><small> Total Balance</small></a></h4>
                      <small class="text-muted">R<?php echo number_format($total_balance,2) ?></small>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card">
                <a href="view_report_income.php?date1=<?php echo $date1 ?> &date2=<?php echo $date2 ?>" class="btn btn-primary" >Click here to view Total Income</a>
              </div>
            <?php }
            else if (!empty($_POST['date1']) || !empty($_POST['date2'])) 
            {?>
              <h1 class="page-title">
                <div class="card text-center">
                      Choose both dates
                  </div>
            <?php
            } ?>
            
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