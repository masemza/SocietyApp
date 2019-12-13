<?php
require 'core/init.php';
$general->logged_out_protect();
$username = htmlentities($user['username']);

$view_total_withdrawals = $payment->get_all_withdrawals();
$num = 0;

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
      	$view_total_withdrawals = $payment->search_withdrawals($date1, $date2);
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

            	<?php if($type == 'admin' || $type == 'manager')
              	{?>
                	<div class="col-lg-3 ml-auto">
                  		<form class="input-icon my-3 my-lg-0" action="" method="post">
                    		<br>
		                    <div class="form-group">
		                      	<div class="row gutters-xs">
		                        	<div class="col">
		                          		<input type="text" name="search" id="myInput" onkeyup="myFunction()" class="form-control" required="required" placeholder="Enter Withdrawer Name">
		                        	</div>
		                        	<span class="col-auto">
		                          		<button class="btn btn-secondary" type="submit" name="submit"><i class="fe fe-search"></i></button><br>              
		                        	</span>
		                      	</div>
		                    </div>

                  		</form>
                	</div>
              <?php
              }?>

              <div class="col-lg order-lg-first">

                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">

                  <?php if($type == 'admin' || $type == 'manager')
                  {?>
                    <li class="nav-item">
                      <a href="./index.php" class="nav-link active"><i class="fe fe-home"></i> Home</a>
                    </li>

                    <li class="nav-item">
                      <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-file"></i>Capture Invoices</a>
                      <div class="dropdown-menu dropdown-menu-arrow">
                        <a href="./view_invoice.php" class="dropdown-item "><i class="fe fe-file-text"></i>View Invoice</a>
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

        <div class="my-3 my-md-5 ">
          <div class="container ">
            <div class="page-header">
              <h1 class="page-title">
                <a href="index.php" style="text-decoration: none;"> <i class="fe fe-arrow-left"></i>Home</a> | View Total Withdrawals
              </h1>
            </div>

            <div class="col-sm-6 col-lg-12 ">
                <div class="card p-3 align-items-center">
                    <div class="d-flex align-items-center">
                      	<div>
                            <form action="" method="post">
                                <h4 class="text-center">Select Withdrawal Statement </h4>&nbsp; 
                                From <input type="date" name="date1" >
                                To <input type="date" name="date2" >
                                <input type="submit" name="submit" class="btn btn-primary" value="Search">
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            
            <hr>

            <?php 
            if(empty($errors) === false)
            {?>
                <h1 class="page-title">
       	            <div class="card text-center">
                    <?php 
                        echo '<p class="text-center">' . implode('</p><p>', $errors) . '</p>'; 

      		}?>
      			</h1>


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



				else 
				if(isset($_POST['submit']) && empty($view_total_withdrawals) )
				{?>
					<h1 class="page-title ">
						<div class="card text-center">
	                       	No transaction made
						</div>
					</h1>
				<?php 
				}

				else
				if(isset($_POST['submit']))
				{
					$date1 = $_POST['date1'];
					$date2 = $_POST['date2'];
				?> 
					<h3>  
		                Withdrawals Statement <br><?php
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
	            
		      		<br>
		        <?php 
			    }?>
	        <?php 
	    	}?>

	    	<?php if(($view_total_withdrawals) && (empty($errors) === true))
	    	{?>
		    	<div class="row row-cards row-deck">
			        <div class="col-12">
			           	<div class="card">
			           		<div class="card-body">
			               		<div class="table-responsive push">
			               			<table id="myTable" class="table table-bordered table-hover">
			                      		<tr>
					                       	<th class="text-center" style="width: 0.5%"></th>
					                       	<th class="text-center" style="width: 2%">Date of transaction</th>
					                       	<th class="text-center" style="width: 0.5%">Receipt NO</th>
					                       	<th class="text-center" style="width: 5%">Name</th>
					                       	<th class="text-center" style="width: 5%">Deceased name</th>
					                       	<th class="text-center" style="width: 2%">Amount Withdrawn</th>
					                    </tr>
			                        
					                    <?php foreach ($view_total_withdrawals as $total_withdrawals_row) 
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
						                              
						                    </tr>
					                    <?php 
					                    }?>       

					                </table>
			                    </div>
			                </div>  
			            </div> 
			        </div>
			    </div>
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

<!-- Table filter -->
<script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 1; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[3];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>

  </body>
</html>