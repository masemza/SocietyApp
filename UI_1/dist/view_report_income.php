<?php
require 'core/init.php';
$general->logged_out_protect();
$username = htmlentities($user['username']);


$date1 = $_GET['date1'];
$date2 = $_GET['date2'];

$total_invoices = $invoices->search_invoices($date1, $date2);
$total_deposits = $payment->search_deposits($date1, $date2);
$total_income = $total_invoices + $total_deposits;

$deposits = $payment->display_deposits($date1, $date2);
$invoices = $invoices->display_invoices($date1, $date2);
$total = $total_invoices + $total_deposits;


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
              <a href="view_report.php" style="text-decoration: none;"> <i class="fe fe-arrow-left"></i>Report</a> | Income Report
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
                      <h4 class="m-0"><a href="javascript:void(0)"><small>Total Income</small></a></h4>
                      <small class="text-muted">R<?php echo number_format($total_income,2) ?></small>
                      
                    </div>
                  </div>
                </div>
              </div>
              

              <div class="col-sm-6 col-lg-4">
                <div class="card p-3">
                  <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-red mr-3">
                      <i class="fe fe-plus-square"></i>
                    </span>
                    <div>
                      <h4 class="m-0"><a href="javascript:void(0)"><small>Total Deposits</small></a></h4>
                      <small class="text-muted">R<?php echo number_format($total_deposits,2) ?> </small>

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
                      <h4 class="m-0"><a href="javascript:void(0)"><small> Total Invoice</small></a></h4>
                      <small class="text-muted">R<?php echo number_format($total_invoices,2) ?></small>
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
                            <th class="text-center" style="width: 1.5%">Date of transaction</th>
                            <th class="text-center" style="width: 5%">Description</th>
                            <th class="text-center" style="width: 5%">Name</th>
                            <th class="text-center" style="width: 1%">Type</th>
                            <th class="text-center" style="width: 2%">Amount</th>
                          </tr>
                          <?php foreach ($deposits as $view_deposits) 
                          {?>
                            <tr>
                              <!-- <td class="text-center"><?php //echo $num += 1 ?></td> -->
                              <td>
                                <p class="font-w600 mb-1 text-center">
                                  <?php $date=date_create($view_deposits['date_transaction']);
                                  echo date_format($date,"d-m-Y");?> 
                                </p>
                              </td>
                              <td class="text-center">
                                Society name: <?php echo $view_deposits['society_name']; ?>
                              </td>
                              <td class="text-center"><?php echo $view_deposits['name']; ?></td>
                              <td class="text-center">Deposit</td>
                              <td class="text-center"><?php echo $view_deposits['credit']; ?></td>
                            </tr>
                          <?php 
                          } ?>
                          
                          <?php foreach ($invoices as $view_invoice) 
                          {?>
                            <tr>
                              <td>
                                <p class="font-w600 mb-1 text-center">
                                  <?php $date=date_create($view_invoice['invoice_date']);
                                  echo date_format($date,"d-m-Y");?> 
                                </p>
                              </td>
                              <td class="text-center">
                                <?php echo $view_invoice['description']; ?>
                              </td>
                              <td class="text-center"><?php echo $view_invoice['name']; ?></td>
                              <td class="text-center">Invoice</td>
                              <td class="text-center"><?php echo $view_invoice['amount']; ?></td>               
                            </tr>
                          <?php 
                          }?>  

                          <td colspan="4" class="font-weight-bold text-uppercase text-right">Total</td>
                          <td class="font-weight-bold text-center">R<?php echo number_format($total,2); ?> </td>              
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