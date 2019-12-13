<?php
require 'core/init.php';
$general->logged_out_protect();
$username = htmlentities($user['username']);
$type = htmlentities($user['type']);

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

    	$total_deposits = $main_member->total_of_search_deposits($date1, $date2);

    	$total_withdrawals = $main_member->total_of_search_withdrawals($date1, $date2);

    	$view_deposits = $main_member->display_search_deposits($date1, $date2);

    	$view_withdrawals = $main_member->display_search_withdrawals($date1, $date2);

    	$total_balance = $total_deposits - $total_withdrawals; 
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
                    				<a href="./manage_members.php" class="nav-link"><i class="fe fe-home"></i> Home</a>
                  				</li>

                  				<li class="nav-item">
			                      <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-users"></i>View Members</a>
			                      <div class="dropdown-menu dropdown-menu-arrow">
			                        <a href="./view_all_spouse.php" class="dropdown-item "><i class="fe fe-users"></i>View Spouse</a>
			                        <a href="./view_all_children.php" class="dropdown-item "><i class="fe fe-users"></i>View Children </a>
			                        <a href="./view_all_extended_family.php" class="dropdown-item "><i class="fe fe-users"></i>View Extended Family</a>
			                      </div>
			                    </li>

			                    <?php if($type === "manager") 
			                    {?>
			                      <li class="nav-item dropdown">
			                        <a href="./view_member_report.php" class="nav-link active"><i class="fe fe-file-text"></i> View Reports </a>
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
              				<a href="manage_members.php" style="text-decoration: none;"> <i class="fe fe-arrow-left"></i>Home</a> | Reports
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
			            else if(isset($_POST['submit']) && empty($view_deposits) && empty($view_withdrawals) )
			            {?>
			                <h1 class="page-title ">
			                  	<div class="card text-center">
			                    	No transaction made
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
				            Report Statement <br><?php
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
			                <div class="col-sm-6 col-lg-6">
			                  	<div class="card p-3">
			                    	<div class="d-flex align-items-center">
			                      		<span class="stamp stamp-md bg-blue mr-3">
			                        		<i class="fe fe-plus-square"></i>
			                      		</span>
			                      	
			                      		<div>
					                      	<h4 class="m-0"><a href="view_member_deposit_report.php?date1=<?php $date1 = $_POST['date1']; $date2 = $_POST['date2']; echo $date1 ?> &date2=<?php echo $date2 ?>"> <small>Total Deposits</small></a></h4>
					                      	<small class="text-muted">R<?php echo number_format($total_deposits,2) ?></small>
			                      		</div>
			                    	</div>
			                  	</div>
			                </div>
			                
			                <div class="col-sm-6 col-lg-6">
			                  	<div class="card p-3">
			                    	<div class="d-flex align-items-center">
			                      		<span class="stamp stamp-md bg-red mr-3">
			                        		<i class="fe fe-minus-square"></i>
			                      		</span>
			                      		
			                      		<div>
			                        		<h4 class="m-0"><a href="view_member_withdrawal_report.php?date1=<?php $date1 = $_POST['date1']; $date2 = $_POST['date2']; echo $date1 ?> &date2=<?php echo $date2 ?>"><small>Total Withdrawals</small></a></h4>
			                        		<small class="text-muted">R<?php echo number_format($total_withdrawals,2) ?> </small>
			                      		</div>
			                    	</div>
			                  	</div>
			                </div>
			                
			                <!-- <div class="col-sm-6 col-lg-4">
			                  	<div class="card p-3">
			                    	<div class="d-flex align-items-center">
			                      		<span class="stamp stamp-md bg-teal mr-3">
			                        		<i class="fe fe-dollar-sign"></i>
			                      		</span>
			                      	
			                      		<div>
			                        		<h4 class="m-0"><a href="javascript:void(0)"><small> Total Balance</small></a></h4>
			                        		<small class="text-muted">R<?php //echo number_format($total_balance,2) ?></small>
			                      		</div>
			                    	</div>
			                  	</div>
			                </div> -->

			                <div class="col-sm-6"> 
			                    <a href="view_member_deposit_report.php?date1=<?php echo $date1 ?> &date2=<?php echo $date2 ?>"class="btn btn-sm btn-outline-primary">Total Deposits Details</a>
			                </div>

			                <div class="col-sm-6"> 
			                    <a href="view_member_withdrawal_report.php?date1=<?php echo $date1 ?> &date2=<?php echo $date2 ?>" class="btn btn-sm btn-outline-danger" >Total Withdrawals Details</a>
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
		            	}?>
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