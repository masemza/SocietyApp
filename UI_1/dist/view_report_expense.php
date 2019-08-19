<?php
require 'core/init.php';
$general->logged_out_protect();
$username = htmlentities($user['username']);


$date1 = $_GET['date1'];
$date2 = $_GET['date2'];

$total_expense = $expenses->search_expenses($date1, $date2);
$amount = $expenses->total_amount($date1, $date2);
$cleaning_materials = $expenses->total_cleaning_materials($date1, $date2);
$coffin = $expenses->total_coffin($date1, $date2);
$dry_clean = $expenses->total_dry_clean($date1, $date2);
$grave_mark = $expenses->total_grave_mark($date1, $date2);
$maintenance_equipments = $expenses->total_maintenance_equipments($date1, $date2);
$petrol = $expenses->total_petrol($date1, $date2);
$refreshments = $expenses->total_refreshments($date1, $date2);
$repair_maintenance = $expenses->total_repair_maintenance($date1, $date2);
$stationery = $expenses->total_stationery($date1, $date2);
$sundries = $expenses->total_sundries($date1, $date2);
$transport = $expenses->total_transport($date1, $date2);
$tollgate = $expenses->total_tollgate($date1, $date2);
$wages = $expenses->total_wages($date1, $date2);

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
              <a href="view_report.php" style="text-decoration: none;"> <i class="fe fe-arrow-left"></i>Report</a> | Expense Report
              </h1>
            </div>

            
            <div class="row row-cards">
              <div class="col-sm-6 col-lg-4">
                <div class="card p-3">
                  <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-blue mr-3">
                      <i class="fe fe-plus-square"></i>
                    </span>
                    <div>
                      <h4 class="m-0"><a href="javascript:void(0)"><small>Total Expenses</small></a></h4>
                      <small class="text-muted">R<?php echo number_format($total_expense,2) ?></small>
                      
                    </div>
                  </div>
                </div>
              </div>
              
            </div>
            <div class="row row-cards row-deck">

              <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <div class="table-responsive push">
                        <table class="table table-bordered table-hover">
                          <tr>
                            <th class="text-center" style="width: 1.5%"></th>
                            <th class="text-center" style="width: 5%">Categories</th>
                            <th class="text-center" style="width: 5%">Amount</th>
                          </tr>
                          <?php //foreach ($deposits as $view_deposits) 
                          {?>
                            <tr>
                              <td class="text-center"><?php echo $num += 1 ?></td>
                              <td class="text-center">AMOUNT</td>
                              <td class="text-center"><?php //echo number_format($amount,2);?></td>
                            </tr>

                            <tr>
                              <td class="text-center"><?php echo $num += 1 ?></td>
                              <td class="text-center">CLEANING MATERIALS</td>
                              <td class="text-center"><?php //echo number_format($cleaning_materials,2);?></td>
                            </tr>
                            
                            <tr>
                              <td class="text-center"><?php echo $num += 1 ?></td>
                              <td class="text-center">COFFIN</td>
                              <td class="text-center"><?php //echo number_format($coffin,2);?></td>
                            </tr>

                            <tr>
                              <td class="text-center"><?php echo $num += 1 ?></td>
                              <td class="text-center">DRY-CLEAN</td>
                              <td class="text-center"><?php //echo number_format($dry_clean,2);?></td>
                            </tr>

                            <tr>
                              <td class="text-center"><?php echo $num += 1 ?></td>
                              <td class="text-center">GRAVE-MARK</td>
                              <td class="text-center"><?php //echo number_format(grave_mark,2);?></td>
                            </tr>

                            <tr>
                              <td class="text-center"><?php echo $num += 1 ?></td>
                              <td class="text-center">MAINTENANCE EQUIPMENTS</td>
                              <td class="text-center"><?php //echo number_format($maintenance_equipments,2);?></td>
                            </tr>

                            <tr>
                              <td class="text-center"><?php echo $num += 1 ?></td>
                              <td class="text-center">PETROL</td>
                              <td class="text-center"><?php //echo number_format($petrol,2);?></td>
                            </tr>

                            <tr>
                              <td class="text-center"><?php echo $num += 1 ?></td>
                              <td class="text-center">REFRESHMENTS</td>
                              <td class="text-center"><?php //echo number_format($refreshments,2);?></td>
                            </tr>

                            <tr>
                              <td class="text-center"><?php echo $num += 1 ?></td>
                              <td class="text-center">REPAIR MAINTENANCE</td>
                              <td class="text-center"><?php //echo number_format($repair_maintenance,2);?></td>
                            </tr>

                            <tr>
                              <td class="text-center"><?php echo $num += 1 ?></td>
                              <td class="text-center">STATIONERY</td>
                              <td class="text-center"><?php //echo number_format($stationery,2);?></td>
                            </tr>

                            <tr>
                              <td class="text-center"><?php echo $num += 1 ?></td>
                              <td class="text-center">SUNDRIES</td>
                              <td class="text-center"><?php //echo number_format($sundries,2);?></td>
                            </tr>

                            <tr>
                              <td class="text-center"><?php echo $num += 1 ?></td>
                              <td class="text-center">TRANSPORT</td>
                              <td class="text-center"><?php //echo number_format($transport,2);?></td>
                            </tr>

                            <tr>
                              <td class="text-center"><?php echo $num += 1 ?></td>
                              <td class="text-center">TOLLGATE</td>
                              <td class="text-center"><?php //echo number_format($tollgate,2);?></td>
                            </tr>

                            <tr>
                              <td class="text-center"><?php echo $num += 1 ?></td>
                              <td class="text-center">WAGES</td>
                              <td class="text-center"><?php //echo number_format($wages,2);?></td>
                            </tr>

                            
                          <?php 
                          } ?>  

                          <td colspan="2" class="font-weight-bold text-uppercase text-right">Total</td>
                          <td class="font-weight-bold text-center">R<?php echo number_format($total_expense,2); ?> </td>              
                      </table>
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