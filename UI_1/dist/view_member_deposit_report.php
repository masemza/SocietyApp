<?php
require 'core/init.php';
$general->logged_out_protect();
$username = htmlentities($user['username']);

$date1 = $_GET['date1'];
$date2 = $_GET['date2'];

$view_deposits = $main_member->display_search_deposits($date1, $date2);

$total_deposits = $main_member->total_of_search_deposits($date1, $date2);

$num = 0;

// $view_deposits = $main_member->display_search_deposits($date1, $date2);

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
                    <a href="./manage_members.php" class="nav-link"><i class="fe fe-home"></i>Home</a>
                  </li>

                  <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link active"><i class="fe fe-file-text"></i>Deposit Report</a>
                  </li>

                </ul>

              </div>
            </div>
          </div>
        </div>

        <div class="my-3 my-md-5 ">
          <div class="container ">
            <div class="page-header">
              <h1 class="page-title">
                <a href="view_member_report.php" style="text-decoration: none;"> <i class="fe fe-arrow-left"></i>View Report</a> | View Deposit Report
              </h1>
            </div>

            <?php if($view_deposits)
            {?>
              <div class="col-sm-6 col-lg-">
                <div class="card p-3">
                  <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-blue mr-3">
                      <i class="fe fe-plus-square"></i>
                    </span>
                    
                    <div>
                      <h4 class="m-0"><a href="javascript:void(0)"><small>Total Deposits</small></a></h4>
                        <small class="text-muted">R<?php echo number_format($total_deposits,2) ?></small>    
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
                            <th class="text-center" style="width: 0.5%" > Receipt NO</th>
                            <th class="text-center" style="width: 2%" > Date of transaction</th>
                            <th class="text-center" style="width: 0.5%" > Receipt NO</th>
                            <th class="text-center" style="width: 5%" >Name</th>
                            <th class="text-center" style="width: 2%" >Amount Deposited</th>
                            <!-- <th class="text-center" style="width: 2%" >Balance</th> -->
                          </tr>
                            
                            <?php foreach ($view_deposits as $view_deposits_row) 
                            {?>
                              <tr>
                                <td class="text-center">
                                  <?php echo $num += 1; ?>
                                </td>
                                
                                <td>
                                  <p class="font-w600 mb-1 text-center">
                                    <?php $date=date_create($view_deposits_row['date_transaction']);
                                    echo date_format($date,"d-m-Y");?> 
                                  </p>
                                </td>

                                <td class="text-center">
                                  <a href="receipt.php?payment_id=<?php echo $view_deposits_row['payment_id'] ?>"> 
                                    <?php echo $view_deposits_row['payment_id'] ?>
                                  </a>
                                </td>
                                  
                                <td class="text-center">
                                  <?php echo $view_deposits_row['name']; ?>
                                </td>
                                  
                                <td class="text-center"><?php echo number_format($view_deposits_row['credit'],2) ?></td>
                                
                                <!-- <td class="text-center"><?php echo number_format($view_deposits_row['balance'],2) ?></td> -->
                              </tr>
                            <?php 
                            }?>
                              
                            <td colspan="4" class="font-weight-bold text-uppercase text-right">Total</td>
                            <td class="font-weight-bold text-center">R<?php echo number_format($total_deposits, 2) ?> </td>         

                          </table>
                        </div>
                      </div>  
                    </div> 
                  </div>
                </div>
              <?php
              }
              else
              {?>
                <h3>
                  <div class="col-12">
                    <div class="card">
                      <div class="card-body text-center">
                        Sorry!!! <br>
                        No Deposits Made
                      </div>
                    </div>
                  </div>
                </h3>
              <?php
              }?>



              
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