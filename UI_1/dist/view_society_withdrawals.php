<?php
require 'core/init.php';
$general->logged_out_protect();
$username = htmlentities($user['username']);

$society_id = $_GET['society_id'];

$view_total_deposit = $payment->get_all_withdrawals_for_society($society_id);
$num = 0;


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

                  <li class="nav-item dropdown">
                    <a href="./view_members.php?society_id=<?php echo $society_id ?>" class="nav-link"><i class="fe fe-users"></i>View Members</a>
                  </li>

                  <li class="nav-item dropdown">
                    <a href="./addMember.php?society_id=<?php echo $society_id; ?>" class="nav-link"><i class="fe fe-user-plus"></i>Add a new Member</a>
                  </li>

                  <li class="nav-item dropdown">
                    <a href="./view_package.php?society_id=<?php echo $society_id ?>" class="nav-link"><i class="dropdown-icon fe fe-layers"></i> View Package</a>
                  </li>

                  <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-menu"></i>More</a>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="./create_invoice.php" class="dropdown-item "><i class="fe fe-file-plus"></i>Capture Invoice</a>
                      <a href="./create_expense.php" class="dropdown-item "><i class="fe fe-file-plus"></i>Capture Expense</a>
                      <a href="./view_report.php" class="dropdown-item "><i class="fe fe-file-text"></i>View Report</a>
                      <a href="./manage_members.php" class="dropdown-item "><i class="fe fe-users"></i>Main Member's Dashboard</a>
                    </div>
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
                <a href="./view_statements.php?society_id=<?php echo $society_id ?>" style="text-decoration: none;"> <i class="fe fe-arrow-left"></i>Society Details</a> | View Total Withdrawals
              </h1>
            </div>

            <div class="row row-cards row-deck">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <div class="table-responsive push">
                      <table class="table table-bordered table-hover">
                        <tr>
                          <th class="text-center" style="width: 0.5%"></th>
                          <th class="text-center" style="width: 2%">Date of transaction</th>
                          <th class="text-center" style="width: 0.5%">Receipt NO</th>
                          <th class="text-center" style="width: 5%">Name</th>
                          <th class="text-center" style="width: 5%">Deceased name</th>
                          <th class="text-center" style="width: 2%">Amount Withdrawn</th>
                          <!-- <th class="text-center" style="width: 2%" >Balance</th> -->
                        </tr>
                        
                          <?php foreach ($view_total_deposit as $total_withdrawals_row) 
                          {?>
                            <tr>
                              <td class="text-center">
                                <?php echo $num += 1; ?>
                              </td>
                              
                              <td>
                                <p class="font-w600 mb-1 text-center">
                                  <?php $date=date_create($total_withdrawals_row['date_transaction']);
                                  echo date_format($date,"d-m-Y");?> 
                                </p>
                              </td>

                              <td class="text-center">
                                <a href="receipt.php?payment_id=<?php echo $total_withdrawals_row['payment_id'] ?>"> 
                                  <?php echo $total_withdrawals_row['payment_id'] ?>
                                </a>
                              </td>
                              
                              <td class="text-center">
                                <?php echo $total_withdrawals_row['name']; ?>
                              </td>

                              <td class="text-center">
                                <?php echo $total_withdrawals_row['deceased_name']; ?>
                              </td>
                              
                              <td class="text-center"><?php echo number_format($total_withdrawals_row['debit'],2) ?></td>
                              
                              <!-- <td class="text-center"><?php //echo number_format($total_withdrawals_row['balance'],2) ?></td> -->
                            </tr>
                          <?php 
                          } ?>
                          
                          <!-- <td colspan="5" class="font-weight-bold text-uppercase text-right">Current Balance</td>
                          <td class="font-weight-bold text-center">R<?php //echo number_format($balance, 2) ?> </td>  -->        

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