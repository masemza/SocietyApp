<?php
require 'core/init.php';
$general->logged_out_protect();
$username = htmlentities($user['username']);

$society_id = $_REQUEST['society_id'];
$view_societies = $society->societydata($society_id);

if (isset($_POST['submit'])) 
{
	$amount 		= $_POST['amount'];
	$name 			= $_POST['name'];
	$deceased_name 			= $_POST['deceased_name'];
	
	global $payment_id;
			
	    if (strlen($amount) <2)
		{
			$errors[] = 'Your amount must be atleast 2 characters';
		}
		
		else
			if(!preg_match("/^[a-zA-Z ]*$/",$name))
      		{
        	$errors[] = 'Only letters and white space allowed for name';
      		}
	
		if(empty($errors) === true)
		{

			
			$last_balance = $payment->get_last_balance($society_id);
			
			/*if($last_balance >= $amount)
			{*/
				$balance = $last_balance - $amount;
				
				$society_name = $society->get_society_name($society_id);

				$payment->withdraw_money($payment_id, $name, $deceased_name, $society_id, $society_name, $amount, $balance);

			/*Print '<script>alert("Withdrawal Successful.");;
			window.location.assign("index.php")</script>';*/
			
			/*}
			else
			{
				$errors[] = "You don't have enough balance!";
			}*/
			
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
              <!-- <div class="col-lg-3 ml-auto">
                <form class="input-icon my-3 my-lg-0">
                  <input type="search" class="form-control header-search" placeholder="Search&hellip;" tabindex="1">
                  <div class="input-icon-addon">
                    <i class="fe fe-search"></i>
                  </div>
                </form>
              </div> -->
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
				  
                  <!-- <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link active" data-toggle="dropdown"><i class="fe fe-box"></i>Transaction</a>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="./deposit.html" class="dropdown-item ">Depost</a>
                      <a href="./withdraw.html" class="dropdown-item active">Withdraw</a>
                      <a href="./balance.html" class="dropdown-item ">View Balance</a>
                    </div>
                  </li> -->

                  <!-- <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-calendar"></i> Components</a>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="./maps.html" class="dropdown-item ">Maps</a>
                      <a href="./icons.html" class="dropdown-item ">Icons</a>
                      <a href="./store.html" class="dropdown-item ">Store</a>
                      <a href="./blog.html" class="dropdown-item ">Blog</a>
                      <a href="./carousel.html" class="dropdown-item ">Carousel</a>
                    </div>
                  </li> -->

                  <!-- <li class="nav-item dropdown">
                    <a href="./transactions.html" class="nav-link"><i class="fe fe-file"></i>View Statement</a>
                  </li> -->

                  <!-- <li class="nav-item dropdown">
                    <a href="./form-elements.html" class="nav-link"><i class="fe fe-check-square"></i> Forms</a>
                  </li> -->

                  <!-- <li class="nav-item">
                    <a href="./gallery.html" class="nav-link"><i class="fe fe-image"></i> Gallery</a>
                  </li> -->

                  <!-- <li class="nav-item">
                    <a href="./docs/index.html" class="nav-link"><i class="fe fe-file-text"></i> Documentation</a>
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
								<a href="view_statements.php?society_id=<?php echo $society_id ?>" style="text-decoration: none;"> <i class="fe fe-arrow-left"></i>Society Details</a> | Withdraw Money
							  </h1>
                </div>



        <div class="col-lg-12">
                <div class="card">
                  <!-- <div class="card-header">
                    <h3 class="card-title">Deposit Money</h3>
                     <div class="card-options">
                     
                        <form action="">

                        <div class="input-group">
                          <input type="text" class="form-control form-control-sm" placeholder="Search something..." name="s">
                          <span class="input-group-btn ml-2">
                            <button class="btn btn-sm btn-default" type="submit">
                              <span class="fe fe-search"></span>
                            </button>
                          </span>
                        </div>

                        </form>

                    </div>
                  </div> -->


                  
                  <div class="card-body">



                        <form action="" method="POST">

                                <span class="form-required">*</span> Required fields <br>
                                <fieldset class="form-fieldset">
                                        <!-- <div class="form-group">
                                          <label class="form-label">Society Name<span class="form-required">*</span></label>
                                          <input type="text" class="form-control" placeholder="Enter society name"/>
                                        </div> -->
                                        <div class="form-group">
                                          <label class="form-label">Full Name<span class="form-required">*</span></label>
                                          <input type="text" name="name" required="required" class="form-control" placeholder="Enter your names"/>
										</div>
										
										<div class="form-group">
                                          <label class="form-label">Name of Deceased<span class="form-required">*</span></label>
                                          <input type="text" name="deceased_name" required="required" class="form-control" placeholder="Enter the name of deceased"/>
										</div>
										
                                        <div class="form-group">
                                          <label class="form-label">Amount<span class="form-required">*</span></label>
                                          <input type="number" name="amount" required="required" class="form-control" placeholder="Enter amount"/>
                                        </div>

                                </fieldset>

                                
                            <div class="btn-list text-center">
                                <input onclick ="return confirm('Are you sure you want to withdraw this money?')" type="submit" name="submit" class="btn btn-primary" value="Withdraw" />
                            
                                <input type="reset" class="btn btn-primary" value="Reset" />
		
							</div>
							<?php 
			if(empty($errors) === false)
			{
				echo '<p>' . implode('</p><p>', $errors) . '</p>';	
			}
		?>
 
                        </form>

                


                </div>
               


        <!-- <div class="my-3 my-md-5">
          <div class="container">
            <div class="page-header">
              <h1 class="page-title">
                Charts
              </h1>
            </div>
            <div class="row row-cards">
              <div class="col-lg-6 col-xl-4">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Employment Growth</h3>
                  </div>
                  <div class="card-body">
                    <div id="chart-employment" style="height: 16rem"></div>
                  </div>
                </div>
                <script>
                  require(['c3', 'jquery'], function(c3, $) {
                  	$(document).ready(function(){
                  		var chart = c3.generate({
                  			bindto: '#chart-employment', // id of chart wrapper
                  			data: {
                  				columns: [
                  				    // each columns data
                  					['data1', 2, 8, 6, 7, 14, 11],
                  					['data2', 5, 15, 11, 15, 21, 25],
                  					['data3', 17, 18, 21, 20, 30, 29]
                  				],
                  				type: 'line', // default type of chart
                  				colors: {
                  					'data1': tabler.colors["orange"],
                  					'data2': tabler.colors["blue"],
                  					'data3': tabler.colors["green"]
                  				},
                  				names: {
                  				    // name of each serie
                  					'data1': 'Development',
                  					'data2': 'Marketing',
                  					'data3': 'Sales'
                  				}
                  			},
                  			axis: {
                  				x: {
                  					type: 'category',
                  					// name of each category
                  					categories: ['2013', '2014', '2015', '2016', '2017', '2018']
                  				},
                  			},
                  			legend: {
                                  show: false, //hide legend
                  			},
                  			padding: {
                  				bottom: 0,
                  				top: 0
                  			},
                  		});
                  	});
                  });
                </script>
              </div>
              <div class="col-lg-6 col-xl-4">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Monthly Average Temperature</h3>
                  </div>
                  <div class="card-body">
                    <div id="chart-temperature" style="height: 16rem"></div>
                  </div>
                </div>
                <script>
                  require(['c3', 'jquery'], function(c3, $) {
                  	$(document).ready(function(){
                  		var chart = c3.generate({
                  			bindto: '#chart-temperature', // id of chart wrapper
                  			data: {
                  				columns: [
                  				    // each columns data
                  					['data1', 7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6],
                  					['data2', 3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
                  				],
                  				labels: true,
                  				type: 'line', // default type of chart
                  				colors: {
                  					'data1': tabler.colors["blue"],
                  					'data2': tabler.colors["green"]
                  				},
                  				names: {
                  				    // name of each serie
                  					'data1': 'Tokyo',
                  					'data2': 'London'
                  				}
                  			},
                  			axis: {
                  				x: {
                  					type: 'category',
                  					// name of each category
                  					categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun']
                  				},
                  			},
                  			legend: {
                                  show: false, //hide legend
                  			},
                  			padding: {
                  				bottom: 0,
                  				top: 0
                  			},
                  		});
                  	});
                  });
                </script>
              </div>
              <div class="col-lg-6 col-xl-4">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Lorem ipsum</h3>
                  </div>
                  <div class="card-body">
                    <div id="chart-area" style="height: 16rem"></div>
                  </div>
                </div>
                <script>
                  require(['c3', 'jquery'], function(c3, $) {
                  	$(document).ready(function(){
                  		var chart = c3.generate({
                  			bindto: '#chart-area', // id of chart wrapper
                  			data: {
                  				columns: [
                  				    // each columns data
                  					['data1', 11, 8, 15, 18, 19, 17],
                  					['data2', 7, 7, 5, 7, 9, 12]
                  				],
                  				type: 'area', // default type of chart
                  				colors: {
                  					'data1': tabler.colors["blue"],
                  					'data2': tabler.colors["pink"]
                  				},
                  				names: {
                  				    // name of each serie
                  					'data1': 'Maximum',
                  					'data2': 'Minimum'
                  				}
                  			},
                  			axis: {
                  				x: {
                  					type: 'category',
                  					// name of each category
                  					categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun']
                  				},
                  			},
                  			legend: {
                                  show: false, //hide legend
                  			},
                  			padding: {
                  				bottom: 0,
                  				top: 0
                  			},
                  		});
                  	});
                  });
                </script>
              </div>
              <div class="col-lg-6 col-xl-4">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Lorem ipsum</h3>
                  </div>
                  <div class="card-body">
                    <div id="chart-area-spline" style="height: 16rem"></div>
                  </div>
                </div>
                <script>
                  require(['c3', 'jquery'], function(c3, $) {
                  	$(document).ready(function(){
                  		var chart = c3.generate({
                  			bindto: '#chart-area-spline', // id of chart wrapper
                  			data: {
                  				columns: [
                  				    // each columns data
                  					['data1', 11, 8, 15, 18, 19, 17],
                  					['data2', 7, 7, 5, 7, 9, 12]
                  				],
                  				type: 'area-spline', // default type of chart
                  				colors: {
                  					'data1': tabler.colors["blue"],
                  					'data2': tabler.colors["pink"]
                  				},
                  				names: {
                  				    // name of each serie
                  					'data1': 'Maximum',
                  					'data2': 'Minimum'
                  				}
                  			},
                  			axis: {
                  				x: {
                  					type: 'category',
                  					// name of each category
                  					categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun']
                  				},
                  			},
                  			legend: {
                                  show: false, //hide legend
                  			},
                  			padding: {
                  				bottom: 0,
                  				top: 0
                  			},
                  		});
                  	});
                  });
                </script>
              </div>
              <div class="col-lg-6 col-xl-4">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Lorem ipsum</h3>
                  </div>
                  <div class="card-body">
                    <div id="chart-area-spline-sracked" style="height: 16rem"></div>
                  </div>
                </div>
                <script>
                  require(['c3', 'jquery'], function(c3, $) {
                  	$(document).ready(function(){
                  		var chart = c3.generate({
                  			bindto: '#chart-area-spline-sracked', // id of chart wrapper
                  			data: {
                  				columns: [
                  				    // each columns data
                  					['data1', 11, 8, 15, 18, 19, 17],
                  					['data2', 7, 7, 5, 7, 9, 12]
                  				],
                  				type: 'area-spline', // default type of chart
                  				groups: [
                  					[ 'data1', 'data2']
                  				],
                  				colors: {
                  					'data1': tabler.colors["blue"],
                  					'data2': tabler.colors["pink"]
                  				},
                  				names: {
                  				    // name of each serie
                  					'data1': 'Maximum',
                  					'data2': 'Minimum'
                  				}
                  			},
                  			axis: {
                  				x: {
                  					type: 'category',
                  					// name of each category
                  					categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun']
                  				},
                  			},
                  			legend: {
                                  show: false, //hide legend
                  			},
                  			padding: {
                  				bottom: 0,
                  				top: 0
                  			},
                  		});
                  	});
                  });
                </script>
              </div>
              <div class="col-lg-6 col-xl-4">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Wind speed during two days</h3>
                  </div>
                  <div class="card-body">
                    <div id="chart-spline" style="height: 16rem"></div>
                  </div>
                </div>
                <script>
                  require(['c3', 'jquery'], function(c3, $) {
                  	$(document).ready(function(){
                  		var chart = c3.generate({
                  			bindto: '#chart-spline', // id of chart wrapper
                  			data: {
                  				columns: [
                  				    // each columns data
                  					['data1', 0.2, 0.8, 0.8, 0.8, 1, 1.3, 1.5, 2.9, 1.9, 2.6, 1.6, 3, 4, 3.6, 4.5, 4.2, 4.5, 4.5, 4, 3.1, 2.7, 4, 2.7, 2.3, 2.3, 4.1, 7.7, 7.1, 5.6, 6.1, 5.8, 8.6, 7.2, 9, 10.9, 11.5, 11.6, 11.1, 12, 12.3, 10.7, 9.4, 9.8, 9.6, 9.8, 9.5, 8.5, 7.4, 7.6],
                  					['data2', 0, 0, 0.6, 0.9, 0.8, 0.2, 0, 0, 0, 0.1, 0.6, 0.7, 0.8, 0.6, 0.2, 0, 0.1, 0.3, 0.3, 0, 0.1, 0, 0, 0, 0.2, 0.1, 0, 0.3, 0, 0.1, 0.2, 0.1, 0.3, 0.3, 0, 3.1, 3.1, 2.5, 1.5, 1.9, 2.1, 1, 2.3, 1.9, 1.2, 0.7, 1.3, 0.4, 0.3]
                  				],
                  				labels: true,
                  				type: 'spline', // default type of chart
                  				colors: {
                  					'data1': tabler.colors["blue"],
                  					'data2': tabler.colors["green"]
                  				},
                  				names: {
                  				    // name of each serie
                  					'data1': 'Hestavollane',
                  					'data2': 'Vik'
                  				}
                  			},
                  			axis: {
                  				x: {
                  					type: 'category',
                  					// name of each category
                  					categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun']
                  				},
                  			},
                  			legend: {
                                  show: false, //hide legend
                  			},
                  			padding: {
                  				bottom: 0,
                  				top: 0
                  			},
                  		});
                  	});
                  });
                </script>
              </div>
              <div class="col-lg-6 col-xl-4">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Lorem ipsum</h3>
                  </div>
                  <div class="card-body">
                    <div id="chart-spline-rotated" style="height: 16rem"></div>
                  </div>
                </div>
                <script>
                  require(['c3', 'jquery'], function(c3, $) {
                  	$(document).ready(function(){
                  		var chart = c3.generate({
                  			bindto: '#chart-spline-rotated', // id of chart wrapper
                  			data: {
                  				columns: [
                  				    // each columns data
                  					['data1', 11, 8, 15, 18, 19, 17],
                  					['data2', 7, 7, 5, 7, 9, 12]
                  				],
                  				type: 'spline', // default type of chart
                  				colors: {
                  					'data1': tabler.colors["blue"],
                  					'data2': tabler.colors["pink"]
                  				},
                  				names: {
                  				    // name of each serie
                  					'data1': 'Maximum',
                  					'data2': 'Minimum'
                  				}
                  			},
                  			axis: {
                  				x: {
                  					type: 'category',
                  					// name of each category
                  					categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun']
                  				},
                  				rotated: true,
                  			},
                  			legend: {
                                  show: false, //hide legend
                  			},
                  			padding: {
                  				bottom: 0,
                  				top: 0
                  			},
                  		});
                  	});
                  });
                </script>
              </div>
              <div class="col-lg-6 col-xl-4">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Lorem ipsum</h3>
                  </div>
                  <div class="card-body">
                    <div id="chart-step" style="height: 16rem"></div>
                  </div>
                </div>
                <script>
                  require(['c3', 'jquery'], function(c3, $) {
                  	$(document).ready(function(){
                  		var chart = c3.generate({
                  			bindto: '#chart-step', // id of chart wrapper
                  			data: {
                  				columns: [
                  				    // each columns data
                  					['data1', 11, 8, 15, 18, 19, 17],
                  					['data2', 7, 7, 5, 7, 9, 12]
                  				],
                  				type: 'step', // default type of chart
                  				colors: {
                  					'data1': tabler.colors["blue"],
                  					'data2': tabler.colors["pink"]
                  				},
                  				names: {
                  				    // name of each serie
                  					'data1': 'Maximum',
                  					'data2': 'Minimum'
                  				}
                  			},
                  			axis: {
                  				x: {
                  					type: 'category',
                  					// name of each category
                  					categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun']
                  				},
                  			},
                  			legend: {
                                  show: false, //hide legend
                  			},
                  			padding: {
                  				bottom: 0,
                  				top: 0
                  			},
                  		});
                  	});
                  });
                </script>
              </div>
              <div class="col-lg-6 col-xl-4">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Lorem ipsum</h3>
                  </div>
                  <div class="card-body">
                    <div id="chart-area-step" style="height: 16rem"></div>
                  </div>
                </div>
                <script>
                  require(['c3', 'jquery'], function(c3, $) {
                  	$(document).ready(function(){
                  		var chart = c3.generate({
                  			bindto: '#chart-area-step', // id of chart wrapper
                  			data: {
                  				columns: [
                  				    // each columns data
                  					['data1', 11, 8, 15, 18, 19, 17],
                  					['data2', 7, 7, 5, 7, 9, 12]
                  				],
                  				type: 'area-step', // default type of chart
                  				colors: {
                  					'data1': tabler.colors["blue"],
                  					'data2': tabler.colors["pink"]
                  				},
                  				names: {
                  				    // name of each serie
                  					'data1': 'Maximum',
                  					'data2': 'Minimum'
                  				}
                  			},
                  			axis: {
                  				x: {
                  					type: 'category',
                  					// name of each category
                  					categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun']
                  				},
                  			},
                  			legend: {
                                  show: false, //hide legend
                  			},
                  			padding: {
                  				bottom: 0,
                  				top: 0
                  			},
                  		});
                  	});
                  });
                </script>
              </div>
              <div class="col-lg-6 col-xl-4">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Lorem ipsum</h3>
                  </div>
                  <div class="card-body">
                    <div id="chart-bar" style="height: 16rem"></div>
                  </div>
                </div>
                <script>
                  require(['c3', 'jquery'], function(c3, $) {
                  	$(document).ready(function(){
                  		var chart = c3.generate({
                  			bindto: '#chart-bar', // id of chart wrapper
                  			data: {
                  				columns: [
                  				    // each columns data
                  					['data1', 11, 8, 15, 18, 19, 17],
                  					['data2', 7, 7, 5, 7, 9, 12]
                  				],
                  				type: 'bar', // default type of chart
                  				colors: {
                  					'data1': tabler.colors["blue"],
                  					'data2': tabler.colors["pink"]
                  				},
                  				names: {
                  				    // name of each serie
                  					'data1': 'Maximum',
                  					'data2': 'Minimum'
                  				}
                  			},
                  			axis: {
                  				x: {
                  					type: 'category',
                  					// name of each category
                  					categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun']
                  				},
                  			},
                  			bar: {
                  				width: 16
                  			},
                  			legend: {
                                  show: false, //hide legend
                  			},
                  			padding: {
                  				bottom: 0,
                  				top: 0
                  			},
                  		});
                  	});
                  });
                </script>
              </div>
              <div class="col-lg-6 col-xl-4">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Lorem ipsum</h3>
                  </div>
                  <div class="card-body">
                    <div id="chart-bar-rotated" style="height: 16rem"></div>
                  </div>
                </div>
                <script>
                  require(['c3', 'jquery'], function(c3, $) {
                  	$(document).ready(function(){
                  		var chart = c3.generate({
                  			bindto: '#chart-bar-rotated', // id of chart wrapper
                  			data: {
                  				columns: [
                  				    // each columns data
                  					['data1', 11, 8, 15, 18, 19, 17],
                  					['data2', 7, 7, 5, 7, 9, 12]
                  				],
                  				type: 'bar', // default type of chart
                  				colors: {
                  					'data1': tabler.colors["blue"],
                  					'data2': tabler.colors["pink"]
                  				},
                  				names: {
                  				    // name of each serie
                  					'data1': 'Maximum',
                  					'data2': 'Minimum'
                  				}
                  			},
                  			axis: {
                  				x: {
                  					type: 'category',
                  					// name of each category
                  					categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun']
                  				},
                  				rotated: true,
                  			},
                  			bar: {
                  				width: 16
                  			},
                  			legend: {
                                  show: false, //hide legend
                  			},
                  			padding: {
                  				bottom: 0,
                  				top: 0
                  			},
                  		});
                  	});
                  });
                </script>
              </div>
              <div class="col-lg-6 col-xl-4">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Lorem ipsum</h3>
                  </div>
                  <div class="card-body">
                    <div id="chart-bar-stacked" style="height: 16rem"></div>
                  </div>
                </div>
                <script>
                  require(['c3', 'jquery'], function(c3, $) {
                  	$(document).ready(function(){
                  		var chart = c3.generate({
                  			bindto: '#chart-bar-stacked', // id of chart wrapper
                  			data: {
                  				columns: [
                  				    // each columns data
                  					['data1', 11, 8, 15, 18, 19, 17],
                  					['data2', 7, 7, 5, 7, 9, 12]
                  				],
                  				type: 'bar', // default type of chart
                  				groups: [
                  					[ 'data1', 'data2']
                  				],
                  				colors: {
                  					'data1': tabler.colors["blue"],
                  					'data2': tabler.colors["pink"]
                  				},
                  				names: {
                  				    // name of each serie
                  					'data1': 'Maximum',
                  					'data2': 'Minimum'
                  				}
                  			},
                  			axis: {
                  				x: {
                  					type: 'category',
                  					// name of each category
                  					categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun']
                  				},
                  			},
                  			bar: {
                  				width: 16
                  			},
                  			legend: {
                                  show: false, //hide legend
                  			},
                  			padding: {
                  				bottom: 0,
                  				top: 0
                  			},
                  		});
                  	});
                  });
                </script>
              </div>
              <div class="col-lg-6 col-xl-4">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Lorem ipsum</h3>
                  </div>
                  <div class="card-body">
                    <div id="chart-pie" style="height: 16rem"></div>
                  </div>
                </div>
                <script>
                  require(['c3', 'jquery'], function(c3, $) {
                  	$(document).ready(function(){
                  		var chart = c3.generate({
                  			bindto: '#chart-pie', // id of chart wrapper
                  			data: {
                  				columns: [
                  				    // each columns data
                  					['data1', 63],
                  					['data2', 44],
                  					['data3', 12],
                  					['data4', 14]
                  				],
                  				type: 'pie', // default type of chart
                  				colors: {
                  					'data1': tabler.colors["blue-darker"],
                  					'data2': tabler.colors["blue"],
                  					'data3': tabler.colors["blue-light"],
                  					'data4': tabler.colors["blue-lighter"]
                  				},
                  				names: {
                  				    // name of each serie
                  					'data1': 'A',
                  					'data2': 'B',
                  					'data3': 'C',
                  					'data4': 'D'
                  				}
                  			},
                  			axis: {
                  			},
                  			legend: {
                                  show: false, //hide legend
                  			},
                  			padding: {
                  				bottom: 0,
                  				top: 0
                  			},
                  		});
                  	});
                  });
                </script>
              </div>
              <div class="col-lg-6 col-xl-4">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Lorem ipsum</h3>
                  </div>
                  <div class="card-body">
                    <div id="chart-donut" style="height: 16rem"></div>
                  </div>
                </div>
                <script>
                  require(['c3', 'jquery'], function(c3, $) {
                  	$(document).ready(function(){
                  		var chart = c3.generate({
                  			bindto: '#chart-donut', // id of chart wrapper
                  			data: {
                  				columns: [
                  				    // each columns data
                  					['data1', 63],
                  					['data2', 37]
                  				],
                  				type: 'donut', // default type of chart
                  				colors: {
                  					'data1': tabler.colors["green"],
                  					'data2': tabler.colors["green-light"]
                  				},
                  				names: {
                  				    // name of each serie
                  					'data1': 'Maximum',
                  					'data2': 'Minimum'
                  				}
                  			},
                  			axis: {
                  			},
                  			legend: {
                                  show: false, //hide legend
                  			},
                  			padding: {
                  				bottom: 0,
                  				top: 0
                  			},
                  		});
                  	});
                  });
                </script>
              </div>
              <div class="col-lg-6 col-xl-4">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Lorem ipsum</h3>
                  </div>
                  <div class="card-body">
                    <div id="chart-scatter" style="height: 16rem"></div>
                  </div>
                </div>
                <script>
                  require(['c3', 'jquery'], function(c3, $) {
                  	$(document).ready(function(){
                  		var chart = c3.generate({
                  			bindto: '#chart-scatter', // id of chart wrapper
                  			data: {
                  				columns: [
                  				    // each columns data
                  					['data1', 11, 8, 15, 18, 19, 17],
                  					['data2', 7, 7, 5, 7, 9, 12]
                  				],
                  				type: 'scatter', // default type of chart
                  				colors: {
                  					'data1': tabler.colors["blue"],
                  					'data2': tabler.colors["pink"]
                  				},
                  				names: {
                  				    // name of each serie
                  					'data1': 'Maximum',
                  					'data2': 'Minimum'
                  				}
                  			},
                  			axis: {
                  				x: {
                  					type: 'category',
                  					// name of each category
                  					categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun']
                  				},
                  			},
                  			legend: {
                                  show: false, //hide legend
                  			},
                  			padding: {
                  				bottom: 0,
                  				top: 0
                  			},
                  		});
                  	});
                  });
                </script>
              </div>
              <div class="col-lg-6 col-xl-4">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Combination chart</h3>
                  </div>
                  <div class="card-body">
                    <div id="chart-combination" style="height: 16rem"></div>
                  </div>
                </div>
                <script>
                  require(['c3', 'jquery'], function(c3, $) {
                  	$(document).ready(function(){
                  		var chart = c3.generate({
                  			bindto: '#chart-combination', // id of chart wrapper
                  			data: {
                  				columns: [
                  				    // each columns data
                  					['data1', 30, 20, 50, 40, 60, 50],
                  					['data2', 200, 130, 90, 240, 130, 220],
                  					['data3', 300, 200, 160, 400, 250, 250],
                  					['data4', 200, 130, 90, 240, 130, 220]
                  				],
                  				type: 'bar', // default type of chart
                  				types: {
                  					'data2': "line",
                  					'data3': "spline",
                  				},
                  				groups: [
                  					[ 'data1', 'data4']
                  				],
                  				colors: {
                  					'data1': tabler.colors["green"],
                  					'data2': tabler.colors["pink"],
                  					'data3': tabler.colors["green"],
                  					'data4': tabler.colors["blue"]
                  				},
                  				names: {
                  				    // name of each serie
                  					'data1': 'Development',
                  					'data2': 'Marketing',
                  					'data3': 'Sales',
                  					'data4': 'Sales'
                  				}
                  			},
                  			axis: {
                  				x: {
                  					type: 'category',
                  					// name of each category
                  					categories: ['2013', '2014', '2015', '2016', '2017', '2018']
                  				},
                  			},
                  			bar: {
                  				width: 16
                  			},
                  			legend: {
                                  show: false, //hide legend
                  			},
                  			padding: {
                  				bottom: 0,
                  				top: 0
                  			},
                  		});
                  	});
                  });
                </script>
              </div>
            </div>
          </div>
        </div> -->
</div>
          </div>
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

	  
	</div>
	<?php include 'incl/footer.php' ;?>
  </body>
</html>