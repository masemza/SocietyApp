<?php
require 'core/init.php';
$general->logged_out_protect();
$username = htmlentities($user['username']);

$view_societies = $society->societyInformation();

$total_societies = $society->total_societies();
$total_members = $society->total_members();

$total_transaction = $payment->total_transaction();
$total_deposit = $payment->total_deposit();
$total_withdrawals = $payment->total_withdrawals();

if (isset($_POST['submit']))
{
	$search = $_POST['search'];
	
	if(empty($_POST['search']))
	{
		$errors[] = "Enter society name or id";
	}

	else 
		if ($society-> society_exists($search) === false) 
		{
			$errors[] = 'Sorry that society does\'nt exists.';
		}

	$view_societies = $society->search_society($search);
	
}

if (isset($_POST['submit1']))
{
	$view_societies = $society->societyInformation();
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

                <form class="input-icon my-3 my-lg-0" action="" method="post">

                  <!-- <input type="search" class="form-control header-search" placeholder="Search&hellip;" tabindex="1">
                  <div class="input-icon-addon">
                    <i class="fe fe-search"></i>
                  </div> -->

                  <br>
                  <div class="form-group">
                          <!-- <label class="form-label">Separated inputs</label> -->
                          <div class="row gutters-xs">
                            <div class="col">
                              <input type="text" name="search" id="search_text" class="form-control" required="required" placeholder="Enter Society Name">
                            </div>
                            <span class="col-auto">
                              <button class="btn btn-secondary" type="submit" name="submit"><i class="fe fe-search"></i></button><br>
                            
                              
                            </span>
                          </div>
                        </div>

                </form>

              </div>

              <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                  <li class="nav-item">
                    <a href="./index.php" class="nav-link active"><i class="fe fe-home"></i> Home</a>
                  </li>
                  
                  <!-- <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-box"></i>Transaction</a>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="./deposit.html" class="dropdown-item ">Deposit</a>
                      <a href="./withdraw.html" class="dropdown-item ">Withdraw</a>
                      <a href="./balance.html" class="dropdown-item ">View Balance</a>
                    </div>
                  </li> -->

                  <!-- <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-calendar"></i> Blog</a>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="./maps.html" class="dropdown-item ">Maps</a>
                      <a href="./icons.html" class="dropdown-item ">Icons</a>
                      <a href="./store.html" class="dropdown-item ">Store</a>
                      <a href="./blog.html" class="dropdown-item ">Blog</a>
                      <a href="./carousel.html" class="dropdown-item ">Carousel</a>
                    </div>
                  </li> -->

                  <!-- <li class="nav-item dropdown">
                    <a href="./create_society.php" class="nav-link" ><i class="fe fe-user"></i>Add a new Society</a>
                  </li> -->

                  <!-- <li class="nav-item dropdown">
                    <a href="./create_invoice.php" class="nav-link" ><i class="fe fe-file-plus"></i>Create a new Invoice</a>
                  </li> -->

                  <li class="nav-item dropdown">
                    <a href="./view_invoice.php" class="nav-link" ><i class="fe fe-file"></i>View Invoices</a>
                  </li>

                  <li class="nav-item dropdown">
                    <a href="./view_expense.php" class="nav-link"><i class="fe fe-check-square"></i> View Expenses</a>
                  </li>

                  <li class="nav-item dropdown">
                    <a href="./view_withdrawals.php" class="nav-link"><i class="fe fe-shopping-cart"></i> View Withdrawals</a>
                  </li>

                  <li class="nav-item dropdown">
                    <a href="./report.php" class="nav-link"><i class="fe fe-file-text"></i> View Transactions</a>
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



                      <?php 
                      if(empty($errors) === false)
                      {	
                      ?>
                        <form action="" method="post" class="text-center">
                            Sorry!!! <br>
                            Society name: <?php echo $search ?> does'nt exist
                            <br>
                            <button class="btn btn-secondary" type="submit" name="submit1" >Click here to view all societies</button>
                        </form>

                      <?php }?>     

                      <?php 
                      if(empty($errors) === true){   
                        
                      ?>
                  
              <h1 class="page-title">
                Dashboard
              </h1>
            </div>
            <div class="row row-cards">
              <!-- <div class="col-6 col-sm-4 col-lg-2">
                <div class="card">
                  <div class="card-body p-3 text-center">
                    <div class="text-right text-green">
                      6%
                      <i class="fe fe-chevron-up"></i>
                    </div>
                    <div class="h1 m-0">43</div>
                    <div class="text-muted mb-4">New Tickets</div>
                  </div>
                </div>
              </div>
              <div class="col-6 col-sm-4 col-lg-2">
                <div class="card">
                  <div class="card-body p-3 text-center">
                    <div class="text-right text-red">
                      -3%
                      <i class="fe fe-chevron-down"></i>
                    </div>
                    <div class="h1 m-0">17</div>
                    <div class="text-muted mb-4">Closed Today</div>
                  </div>
                </div>
              </div>
              <div class="col-6 col-sm-4 col-lg-2">
                <div class="card">
                  <div class="card-body p-3 text-center">
                    <div class="text-right text-green">
                      9%
                      <i class="fe fe-chevron-up"></i>
                    </div>
                    <div class="h1 m-0">7</div>
                    <div class="text-muted mb-4">New Replies</div>
                  </div>
                </div>
              </div>
              <div class="col-6 col-sm-4 col-lg-2">
                <div class="card">
                  <div class="card-body p-3 text-center">
                    <div class="text-right text-green">
                      3%
                      <i class="fe fe-chevron-up"></i>
                    </div>
                    <div class="h1 m-0">27.3K</div>
                    <div class="text-muted mb-4">Followers</div>
                  </div>
                </div>
              </div>
              <div class="col-6 col-sm-4 col-lg-2">
                <div class="card">
                  <div class="card-body p-3 text-center">
                    <div class="text-right text-red">
                      -2%
                      <i class="fe fe-chevron-down"></i>
                    </div>
                    <div class="h1 m-0">$95</div>
                    <div class="text-muted mb-4">Daily Earnings</div>
                  </div>
                </div>
              </div>
              <div class="col-6 col-sm-4 col-lg-2">
                <div class="card">
                  <div class="card-body p-3 text-center">
                    <div class="text-right text-red">
                      -1%
                      <i class="fe fe-chevron-down"></i>
                    </div>
                    <div class="h1 m-0">621</div>
                    <div class="text-muted mb-4">Products</div>
                  </div>
                </div>
              </div> -->
<!--               <div class="col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Development Activity</h3>
                  </div>
                  <div id="chart-development-activity" style="height: 10rem"></div>
                  <div class="table-responsive">
                    <table class="table card-table table-striped table-vcenter">
                      <thead>
                        <tr>
                          <th colspan="2">User</th>
                          <th>Commit</th>
                          <th>Date</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="w-1"><span class="avatar" style="background-image: url(./demo/faces/male/9.jpg)"></span></td>
                          <td>Ronald Bradley</td>
                          <td>Initial commit</td>
                          <td class="text-nowrap">May 6, 2018</td>
                          <td class="w-1"><a href="#" class="icon"><i class="fe fe-trash"></i></a></td>
                        </tr>
                        <tr>
                          <td><span class="avatar">BM</span></td>
                          <td>Russell Gibson</td>
                          <td>Main structure</td>
                          <td class="text-nowrap">April 22, 2018</td>
                          <td><a href="#" class="icon"><i class="fe fe-trash"></i></a></td>
                        </tr>
                        <tr>
                          <td><span class="avatar" style="background-image: url(./demo/faces/female/1.jpg)"></span></td>
                          <td>Beverly Armstrong</td>
                          <td>Left sidebar adjustments</td>
                          <td class="text-nowrap">April 15, 2018</td>
                          <td><a href="#" class="icon"><i class="fe fe-trash"></i></a></td>
                        </tr>
                        <tr>
                          <td><span class="avatar" style="background-image: url(./demo/faces/male/4.jpg)"></span></td>
                          <td>Bobby Knight</td>
                          <td>Topbar dropdown style</td>
                          <td class="text-nowrap">April 8, 2018</td>
                          <td><a href="#" class="icon"><i class="fe fe-trash"></i></a></td>
                        </tr>
                        <tr>
                          <td><span class="avatar" style="background-image: url(./demo/faces/female/11.jpg)"></span></td>
                          <td>Sharon Wells</td>
                          <td>Fixes #625</td>
                          <td class="text-nowrap">April 9, 2018</td>
                          <td><a href="#" class="icon"><i class="fe fe-trash"></i></a></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <script>
                  require(['c3', 'jquery'], function(c3, $) {
                  	$(document).ready(function(){
                  		var chart = c3.generate({
                  			bindto: '#chart-development-activity', // id of chart wrapper
                  			data: {
                  				columns: [
                  				    // each columns data
                  					['data1', 0, 5, 1, 2, 7, 5, 6, 8, 24, 7, 12, 5, 6, 3, 2, 2, 6, 30, 10, 10, 15, 14, 47, 65, 55]
                  				],
                  				type: 'area', // default type of chart
                  				groups: [
                  					[ 'data1', 'data2', 'data3']
                  				],
                  				colors: {
                  					'data1': tabler.colors["blue"]
                  				},
                  				names: {
                  				    // name of each serie
                  					'data1': 'Purchases'
                  				}
                  			},
                  			axis: {
                  				y: {
                  					padding: {
                  						bottom: 0,
                  					},
                  					show: false,
                  						tick: {
                  						outer: false
                  					}
                  				},
                  				x: {
                  					padding: {
                  						left: 0,
                  						right: 0
                  					},
                  					show: false
                  				}
                  			},
                  			legend: {
                  				position: 'inset',
                  				padding: 0,
                  				inset: {
                                      anchor: 'top-left',
                  					x: 20,
                  					y: 8,
                  					step: 10
                  				}
                  			},
                  			tooltip: {
                  				format: {
                  					title: function (x) {
                  						return '';
                  					}
                  				}
                  			},
                  			padding: {
                  				bottom: 0,
                  				left: -1,
                  				right: -1
                  			},
                  			point: {
                  				show: false
                  			}
                  		});
                  	});
                  });
                </script>
              </div> -->
<!--               <div class="col-md-6">
                <div class="alert alert-primary">Are you in trouble? <a href="./docs/index.html" class="alert-link">Read our documentation</a> with code samples.</div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Chart title</h3>
                      </div>
                      <div class="card-body">
                        <div id="chart-donut" style="height: 12rem;"></div>
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
                  <div class="col-sm-6">
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Chart title</h3>
                      </div>
                      <div class="card-body">
                        <div id="chart-pie" style="height: 12rem;"></div>
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
                  <div class="col-sm-6">
                    <div class="card">
                      <div class="card-body text-center">
                        <div class="h5">New feedback</div>
                        <div class="display-4 font-weight-bold mb-4">62</div>
                        <div class="progress progress-sm">
                          <div class="progress-bar bg-red" style="width: 28%"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="card">
                      <div class="card-body text-center">
                        <div class="h5">Today profit</div>
                        <div class="display-4 font-weight-bold mb-4">$652</div>
                        <div class="progress progress-sm">
                          <div class="progress-bar bg-green" style="width: 84%"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div> -->
              <div class="col-sm-6 col-lg-4">
                <div class="card p-3">
                  <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-blue mr-3">
                      <i class="fe fe-plus-square"></i>
                    </span>
                    <div>
                      <h4 class="m-0"><a href="javascript:void(0)"><!-- 132 --> <small>Total Transactions</small></a></h4>
                      <small class="text-muted"><?php echo $total_transaction ?></small>
                    </div>
                  </div>
                </div>
              </div>
              <!-- <div class="col-sm-6 col-lg-3">
                <div class="card p-3">
                  <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-green mr-3">
                      <i class="fe fe-bar-chart"></i>
                    </span>
                    <div>
                      <h4 class="m-0"><a href="javascript:void(0)">10% <small>Fixed Interest</small></a></h4>
                      <small class="text-muted">32 Investors</small>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-lg-3">
                <div class="card p-3">
                  <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-yellow mr-3">
                      <i class="fe fe-bar-chart-2"></i>
                    </span>
                    <div>
                      <h4 class="m-0"><a href="javascript:void(0)">17% <small>Variable Interest</small></a></h4>
                      <small class="text-muted">38 Investors</small>
                    </div>
                  </div>
                </div>
              </div>               -->
              

              <div class="col-sm-6 col-lg-4">
                <div class="card p-3">
                  <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-red mr-3">
                      <i class="fe fe-database"></i>
                    </span>
                    <div>
                      <h4 class="m-0"><a href="javascript:void(0)"><!-- 1,352  --><small>Total Deposits</small></a></h4>
                      <small class="text-muted"><?php echo $total_deposit?> </small>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-lg-4">
                <div class="card p-3">
                  <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-teal mr-3">
                      <i class="fe fe-shopping-cart"></i>
                    </span>
                    <div>
                      <h4 class="m-0"><a href="javascript:void(0)"><!-- 1,352  --><small> Total Withdrawals</small></a></h4>
                      <small class="text-muted"><?php echo $total_withdrawals?></small>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-sm-6 col-lg-6">
                  <div class="card p-3">
                    <div class="d-flex align-items-center">
                      <span class="stamp stamp-md bg-lime mr-3">
                        <i class="fe fe-user"></i>
                      </span>
                      <div>
                        <h4 class="m-0"><a href="./view_societies.php"><!-- 1,352  --><small>Societies</small></a></h4>
                        <small class="text-muted"><?php echo $total_societies?> registered societies</small>
                      </div>
                    </div>
                  </div>
                </div>
  
                <div class="col-sm-6 col-lg-6">
                    <div class="card p-3">
                      <div class="d-flex align-items-center">
                        <span class="stamp stamp-md bg-lime mr-3">
                          <i class="fe fe-users"></i>
                        </span>
                        <div>
                          <h4 class="m-0"><a href="./viewMembers.php"><!-- 1,352  --><small>Members</small></a></h4>
                          <small class="text-muted"><?php echo $total_members?> registered members</small>
                        </div>
                      </div>
                    </div>
                  </div>
              <!-- <div class="col-sm-12 col-lg-4">
                <div class="card p-3">
                  <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-green mr-3">
                      <i class="fe fe-refresh-cw"></i>
                    </span>
                    <div>
                      <h4 class="m-0"><a href="javascript:void(0)"><small>Retention</small></a></h4>
                      <small class="text-muted">R163,000.00</small>
                    </div>
                  </div>
                </div>
              </div>                             -->
            </div>
            <div class="row row-cards row-deck">
              <!-- <div class="col-lg-6">
                <div class="card card-aside">
                  <a href="#" class="card-aside-column" style="background-image: url(./demo/photos/david-klaasen-54203-500.jpg)"></a>
                  <div class="card-body d-flex flex-column">
                    <h4><a href="#">And this isn't my nose. This is a false one.</a></h4>
                    <div class="text-muted">Look, my liege! The Knights Who Say Ni demand a sacrifice! …Are you suggesting that coconuts migr...</div>
                    <div class="d-flex align-items-center pt-5 mt-auto">
                      <div class="avatar avatar-md mr-3" style="background-image: url(./demo/faces/female/18.jpg)"></div>
                      <div>
                        <a href="./profile.html" class="text-default">Rose Bradley</a>
                        <small class="d-block text-muted">3 days ago</small>
                      </div>
                      <div class="ml-auto text-muted">
                        <a href="javascript:void(0)" class="icon d-none d-md-inline-block ml-3"><i class="fe fe-heart mr-1"></i></a>
                      </div>
                    </div>
                  </div>
                </div>
              </div> -->
              <!-- <div class="col-lg-6">
                <div class="card card-aside">
                  <a href="#" class="card-aside-column" style="background-image: url(./demo/photos/david-marcu-114194-500.jpg)"></a>
                  <div class="card-body d-flex flex-column">
                    <h4><a href="#">Well, I didn't vote for you.</a></h4>
                    <div class="text-muted">Well, we did do the nose. Why? Shut up! Will you shut up?! You don't frighten us, English pig-dog...</div>
                    <div class="d-flex align-items-center pt-5 mt-auto">
                      <div class="avatar avatar-md mr-3" style="background-image: url(./demo/faces/male/16.jpg)"></div>
                      <div>
                        <a href="./profile.html" class="text-default">Peter Richards</a>
                        <small class="d-block text-muted">3 days ago</small>
                      </div>
                      <div class="ml-auto text-muted">
                        <a href="javascript:void(0)" class="icon d-none d-md-inline-block ml-3"><i class="fe fe-heart mr-1"></i></a>
                      </div>
                    </div>
                  </div>
                </div>
              </div> -->
            </div>
            <div class="row row-cards row-deck">

              <div class="col-12">
              <h1 class="page-title">
                <?php if(isset($_POST['submit']))
                    {
                        echo "Results for Society Name: ".$search; 
                    } 
                ?>
              </h1>
                  <div class="card">
                  <div class="table-responsive">

                    <table class="table table-hover table-outline table-vcenter text-nowrap card-table" id="table-data">
                      <thead>
                        <tr>
                          <th class="text-center w-1"><i class="icon-people"></i></th>
                          <th>Society Name</th>
                          <th>Opening Balance</th>
                          <!-- <th class="text-center">Payment</th> -->
                          <th>Date Inception</th>
                          <th class="text-center">Location</th>
                          <th class="text-center"><i class="icon-settings"></i></th>
                          
                        </tr>
                        
                      </thead>
                      <tbody>
                      <?php foreach ($view_societies as $row) { ?>
                        <tr>
                          <td class="text-center">
                            <!-- <div class="avatar d-block" style="background-image: url(demo/faces/avatar/avatar-001.jpg)">
                              <span class="avatar-status bg-green"></span>
                            </div> -->
                          </td>
                          <td>
                            <div><?php echo $row['society_name']; ?></div>
                            <div class="small text-muted">
                              <!-- 82 Bok Street -->
                            </div>
                          </td>
                          <td>
                            <div class="clearfix">
                              <div class="float-left">
                                <strong><?php echo $row['init_capital']; ?></strong>
                              </div>
                              <!-- <div class="float-right">
                                <small class="text-muted">Jun 11, 2019</small>
                              </div> -->
                            </div>
                            <div class="progress progress-xs">
                              <div class="progress-bar bg-yellow" role="progressbar" style="width: 0%"
                 aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </td>
                          <!-- <td class="text-center">
                            <i class="payment payment-visa"></i>
                          </td> -->
                          <td>
                            <!-- <div class="small text-muted">Last login</div> -->
                            <div>
                                <?php $date=date_create($row['date_inception']);
                                    echo date_format($date,"d-m-Y"); 
                                ?>
                            </div>
                          </td>
                          
                          <td class="text-center">
                            <div>
                              <div>
                                  <?php echo $row['addr1']; ?> <br> 
                                  <?php echo $row['addr2']; ?> <br> 
                                  <?php echo $row['addr3']; ?> <br>
                                  <?php echo $row['addr4']; ?>
                              </div>
                          
                            </div> 
                          </td> 
                          <td class="text-center">
                            <div class="item-action dropdown p-1" >
                              <a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i class="fe fe-more-vertical"></i></a>
                              <div class="dropdown-menu dropdown-menu-right">
                                <a href="./view_statements.php?society_id=<?php echo $row['society_id']?>" class="dropdown-item"><i class="dropdown-icon fe fe-file-text"></i> View Details </a>
                                <a href="./view_members.php?society_id=<?php echo $row['society_id']?>" class="dropdown-item"><i class="dropdown-icon fe fe-users"></i> View Members </a>
                                <a href="./view_package.php?society_id=<?php echo $row['society_id'] ?>" class="dropdown-item"><i class="dropdown-icon fe fe-layers"></i> View Package History</a>
                                <a href="./deposit.php?society_id=<?php echo $row['society_id']?>" class="dropdown-item"><i class="dropdown-icon fa fa-plus-square-o"></i> Deposit </a>
                                <a href="./withdraw.php?society_id=<?php echo $row['society_id']?>" class="dropdown-item"><i class="dropdown-icon fa fa-minus-square-o"></i> Withdraw </a>
                                <a href="./edit_society.php?society_id=<?php echo $row['society_id']?>" class="dropdown-item"><i class="dropdown-icon fe fe-edit"></i> Edit Society </a>
                                <a href="./addMember.php?society_id=<?php echo $row['society_id']?>" class="dropdown-item"><i class="dropdown-icon fe fe-user-plus"></i> Add Member </a>
                                <!-- <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-message-square"></i> Something else here</a> -->
                                <div class="dropdown-divider"></div>
                                <a onclick ="return confirm('Are you sure you want to delete this society?')" href="./deleteSociety.php?society_id=<?php echo $row['society_id']?>" class="dropdown-item"><i class="dropdown-icon fe fe-trash-2"></i> Remove Society</a>

                                <!-- _using_packageID.php?society_id=<?php //echo $row['society_id'] ?> -->

                              </div>
                            </div>
                          </td>
                        </tr>  
                        <?php } ?>   
                        
                        <?php } ?>
                      </tbody>
                    </table>

                    

                  </div>
                </div>
              </div>
              <!-- <div class="col-sm-6 col-lg-4">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">Browser Stats</h4>
                  </div>
                  <table class="table card-table">
                    <tr>
                      <td width="1"><i class="fa fa-chrome text-muted"></i></td>
                      <td>Google Chrome</td>
                      <td class="text-right"><span class="text-muted">23%</span></td>
                    </tr>
                    <tr>
                      <td><i class="fa fa-firefox text-muted"></i></td>
                      <td>Mozila Firefox</td>
                      <td class="text-right"><span class="text-muted">15%</span></td>
                    </tr>
                    <tr>
                      <td><i class="fa fa-safari text-muted"></i></td>
                      <td>Apple Safari</td>
                      <td class="text-right"><span class="text-muted">7%</span></td>
                    </tr>
                    <tr>
                      <td><i class="fa fa-internet-explorer text-muted"></i></td>
                      <td>Internet Explorer</td>
                      <td class="text-right"><span class="text-muted">9%</span></td>
                    </tr>
                    <tr>
                      <td><i class="fa fa-opera text-muted"></i></td>
                      <td>Opera mini</td>
                      <td class="text-right"><span class="text-muted">23%</span></td>
                    </tr>
                    <tr>
                      <td><i class="fa fa-edge text-muted"></i></td>
                      <td>Microsoft edge</td>
                      <td class="text-right"><span class="text-muted">9%</span></td>
                    </tr>
                  </table>
                </div>
              </div> -->
              <!-- <div class="col-sm-6 col-lg-4">
                <div class="card">
                  <div class="card-header">
                    <h2 class="card-title">Projects</h2>
                  </div>
                  <table class="table card-table">
                    <tr>
                      <td>Admin Template</td>
                      <td class="text-right">
                        <span class="badge badge-default">65%</span>
                      </td>
                    </tr>
                    <tr>
                      <td>Landing Page</td>
                      <td class="text-right">
                        <span class="badge badge-success">Finished</span>
                      </td>
                    </tr>
                    <tr>
                      <td>Backend UI</td>
                      <td class="text-right">
                        <span class="badge badge-danger">Rejected</span>
                      </td>
                    </tr>
                    <tr>
                      <td>Personal Blog</td>
                      <td class="text-right">
                        <span class="badge badge-default">40%</span>
                      </td>
                    </tr>
                    <tr>
                      <td>E-mail Templates</td>
                      <td class="text-right">
                        <span class="badge badge-default">13%</span>
                      </td>
                    </tr>
                    <tr>
                      <td>Corporate Website</td>
                      <td class="text-right">
                        <span class="badge badge-warning">Pending</span>
                      </td>
                    </tr>
                  </table>
                </div>
              </div> -->
              <!-- <div class="col-md-6 col-lg-4">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Members</h3>
                  </div>
                  <div class="card-body o-auto" style="height: 15rem">
                    <ul class="list-unstyled list-separated">
                      <li class="list-separated-item">
                        <div class="row align-items-center">
                          <div class="col-auto">
                            <span class="avatar avatar-md d-block" style="background-image: url(demo/faces/female/12.jpg)"></span>
                          </div>
                          <div class="col">
                            <div>
                              <a href="javascript:void(0)" class="text-inherit">Amanda Hunt</a>
                            </div>
                            <small class="d-block item-except text-sm text-muted h-1x">amanda_hunt@example.com</small>
                          </div>
                          <div class="col-auto">
                            <div class="item-action dropdown">
                              <a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i class="fe fe-more-vertical"></i></a>
                              <div class="dropdown-menu dropdown-menu-right">
                                <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-tag"></i> Action </a>
                                <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-edit-2"></i> Another action </a>
                                <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-message-square"></i> Something else here</a>
                                <div class="dropdown-divider"></div>
                                <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-link"></i> Separated link</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </li>
                      <li class="list-separated-item">
                        <div class="row align-items-center">
                          <div class="col-auto">
                            <span class="avatar avatar-md d-block" style="background-image: url(demo/faces/female/21.jpg)"></span>
                          </div>
                          <div class="col">
                            <div>
                              <a href="javascript:void(0)" class="text-inherit">Laura Weaver</a>
                            </div>
                            <small class="d-block item-except text-sm text-muted h-1x">lauraweaver@example.com</small>
                          </div>
                          <div class="col-auto">
                            <div class="item-action dropdown">
                              <a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i class="fe fe-more-vertical"></i></a>
                              <div class="dropdown-menu dropdown-menu-right">
                                <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-tag"></i> Action </a>
                                <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-edit-2"></i> Another action </a>
                                <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-message-square"></i> Something else here</a>
                                <div class="dropdown-divider"></div>
                                <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-link"></i> Separated link</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </li>
                      <li class="list-separated-item">
                        <div class="row align-items-center">
                          <div class="col-auto">
                            <span class="avatar avatar-md d-block" style="background-image: url(demo/faces/female/29.jpg)"></span>
                          </div>
                          <div class="col">
                            <div>
                              <a href="javascript:void(0)" class="text-inherit">Margaret Berry</a>
                            </div>
                            <small class="d-block item-except text-sm text-muted h-1x">margaret88@example.com</small>
                          </div>
                          <div class="col-auto">
                            <div class="item-action dropdown">
                              <a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i class="fe fe-more-vertical"></i></a>
                              <div class="dropdown-menu dropdown-menu-right">
                                <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-tag"></i> Action </a>
                                <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-edit-2"></i> Another action </a>
                                <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-message-square"></i> Something else here</a>
                                <div class="dropdown-divider"></div>
                                <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-link"></i> Separated link</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </li>
                      <li class="list-separated-item">
                        <div class="row align-items-center">
                          <div class="col-auto">
                            <span class="avatar avatar-md d-block" style="background-image: url(demo/faces/female/2.jpg)"></span>
                          </div>
                          <div class="col">
                            <div>
                              <a href="javascript:void(0)" class="text-inherit">Nancy Herrera</a>
                            </div>
                            <small class="d-block item-except text-sm text-muted h-1x">nancy_83@example.com</small>
                          </div>
                          <div class="col-auto">
                            <div class="item-action dropdown">
                              <a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i class="fe fe-more-vertical"></i></a>
                              <div class="dropdown-menu dropdown-menu-right">
                                <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-tag"></i> Action </a>
                                <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-edit-2"></i> Another action </a>
                                <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-message-square"></i> Something else here</a>
                                <div class="dropdown-divider"></div>
                                <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-link"></i> Separated link</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </li>
                      <li class="list-separated-item">
                        <div class="row align-items-center">
                          <div class="col-auto">
                            <span class="avatar avatar-md d-block" style="background-image: url(demo/faces/male/34.jpg)"></span>
                          </div>
                          <div class="col">
                            <div>
                              <a href="javascript:void(0)" class="text-inherit">Edward Larson</a>
                            </div>
                            <small class="d-block item-except text-sm text-muted h-1x">edward90@example.com</small>
                          </div>
                          <div class="col-auto">
                            <div class="item-action dropdown">
                              <a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i class="fe fe-more-vertical"></i></a>
                              <div class="dropdown-menu dropdown-menu-right">
                                <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-tag"></i> Action </a>
                                <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-edit-2"></i> Another action </a>
                                <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-message-square"></i> Something else here</a>
                                <div class="dropdown-divider"></div>
                                <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-link"></i> Separated link</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </li>
                      <li class="list-separated-item">
                        <div class="row align-items-center">
                          <div class="col-auto">
                            <span class="avatar avatar-md d-block" style="background-image: url(demo/faces/female/11.jpg)"></span>
                          </div>
                          <div class="col">
                            <div>
                              <a href="javascript:void(0)" class="text-inherit">Joan Hanson</a>
                            </div>
                            <small class="d-block item-except text-sm text-muted h-1x">joan.hanson@example.com</small>
                          </div>
                          <div class="col-auto">
                            <div class="item-action dropdown">
                              <a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i class="fe fe-more-vertical"></i></a>
                              <div class="dropdown-menu dropdown-menu-right">
                                <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-tag"></i> Action </a>
                                <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-edit-2"></i> Another action </a>
                                <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-message-square"></i> Something else here</a>
                                <div class="dropdown-divider"></div>
                                <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-link"></i> Separated link</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div> -->
              <!-- <div class="col-md-6 col-lg-12">
                <div class="row">
                  <div class="col-sm-6 col-lg-3">
                    <div class="card">
                      <div class="card-body">
                        <div class="card-value float-right text-blue">+5%</div>
                        <h3 class="mb-1">423</h3>
                        <div class="text-muted">Users online</div>
                      </div>
                      <div class="card-chart-bg">
                        <div id="chart-bg-users-1" style="height: 100%"></div>
                      </div>
                    </div>
                    <script>
                      require(['c3', 'jquery'], function (c3, $) {
                      	$(document).ready(function() {
                      		var chart = c3.generate({
                      			bindto: '#chart-bg-users-1',
                      			padding: {
                      				bottom: -10,
                      				left: -1,
                      				right: -1
                      			},
                      			data: {
                      				names: {
                      					data1: 'Users online'
                      				},
                      				columns: [
                      					['data1', 30, 40, 10, 40, 12, 22, 40]
                      				],
                      				type: 'area'
                      			},
                      			legend: {
                      				show: false
                      			},
                      			transition: {
                      				duration: 0
                      			},
                      			point: {
                      				show: false
                      			},
                      			tooltip: {
                      				format: {
                      					title: function (x) {
                      						return '';
                      					}
                      				}
                      			},
                      			axis: {
                      				y: {
                      					padding: {
                      						bottom: 0,
                      					},
                      					show: false,
                      					tick: {
                      						outer: false
                      					}
                      				},
                      				x: {
                      					padding: {
                      						left: 0,
                      						right: 0
                      					},
                      					show: false
                      				}
                      			},
                      			color: {
                      				pattern: ['#467fcf']
                      			}
                      		});
                      	});
                      });
                    </script>
                  </div>
                  <div class="col-sm-6 col-lg-3">
                    <div class="card">
                      <div class="card-body">
                        <div class="card-value float-right text-red">-3%</div>
                        <h3 class="mb-1">423</h3>
                        <div class="text-muted">Users online</div>
                      </div>
                      <div class="card-chart-bg">
                        <div id="chart-bg-users-2" style="height: 100%"></div>
                      </div>
                    </div>
                    <script>
                      require(['c3', 'jquery'], function (c3, $) {
                      	$(document).ready(function() {
                      		var chart = c3.generate({
                      			bindto: '#chart-bg-users-2',
                      			padding: {
                      				bottom: -10,
                      				left: -1,
                      				right: -1
                      			},
                      			data: {
                      				names: {
                      					data1: 'Users online'
                      				},
                      				columns: [
                      					['data1', 30, 40, 10, 40, 12, 22, 40]
                      				],
                      				type: 'area'
                      			},
                      			legend: {
                      				show: false
                      			},
                      			transition: {
                      				duration: 0
                      			},
                      			point: {
                      				show: false
                      			},
                      			tooltip: {
                      				format: {
                      					title: function (x) {
                      						return '';
                      					}
                      				}
                      			},
                      			axis: {
                      				y: {
                      					padding: {
                      						bottom: 0,
                      					},
                      					show: false,
                      					tick: {
                      						outer: false
                      					}
                      				},
                      				x: {
                      					padding: {
                      						left: 0,
                      						right: 0
                      					},
                      					show: false
                      				}
                      			},
                      			color: {
                      				pattern: ['#e74c3c']
                      			}
                      		});
                      	});
                      });
                    </script>
                  </div>
                  <div class="col-sm-6 col-lg-3">
                    <div class="card">
                      <div class="card-body">
                        <div class="card-value float-right text-green">-3%</div>
                        <h3 class="mb-1">423</h3>
                        <div class="text-muted">Users online</div>
                      </div>
                      <div class="card-chart-bg">
                        <div id="chart-bg-users-3" style="height: 100%"></div>
                      </div>
                    </div>
                    <script>
                      require(['c3', 'jquery'], function (c3, $) {
                      	$(document).ready(function() {
                      		var chart = c3.generate({
                      			bindto: '#chart-bg-users-3',
                      			padding: {
                      				bottom: -10,
                      				left: -1,
                      				right: -1
                      			},
                      			data: {
                      				names: {
                      					data1: 'Users online'
                      				},
                      				columns: [
                      					['data1', 30, 40, 10, 40, 12, 22, 40]
                      				],
                      				type: 'area'
                      			},
                      			legend: {
                      				show: false
                      			},
                      			transition: {
                      				duration: 0
                      			},
                      			point: {
                      				show: false
                      			},
                      			tooltip: {
                      				format: {
                      					title: function (x) {
                      						return '';
                      					}
                      				}
                      			},
                      			axis: {
                      				y: {
                      					padding: {
                      						bottom: 0,
                      					},
                      					show: false,
                      					tick: {
                      						outer: false
                      					}
                      				},
                      				x: {
                      					padding: {
                      						left: 0,
                      						right: 0
                      					},
                      					show: false
                      				}
                      			},
                      			color: {
                      				pattern: ['#5eba00']
                      			}
                      		});
                      	});
                      });
                    </script>
                  </div>
                  <div class="col-sm-6 col-lg-3">
                    <div class="card">
                      <div class="card-body">
                        <div class="card-value float-right text-yellow">9%</div>
                        <h3 class="mb-1">423</h3>
                        <div class="text-muted">Users online</div>
                      </div>
                      <div class="card-chart-bg">
                        <div id="chart-bg-users-4" style="height: 100%"></div>
                      </div>
                    </div>
                    <script>
                      require(['c3', 'jquery'], function (c3, $) {
                      	$(document).ready(function() {
                      		var chart = c3.generate({
                      			bindto: '#chart-bg-users-4',
                      			padding: {
                      				bottom: -10,
                      				left: -1,
                      				right: -1
                      			},
                      			data: {
                      				names: {
                      					data1: 'Users online'
                      				},
                      				columns: [
                      					['data1', 30, 40, 10, 40, 12, 22, 40]
                      				],
                      				type: 'area'
                      			},
                      			legend: {
                      				show: false
                      			},
                      			transition: {
                      				duration: 0
                      			},
                      			point: {
                      				show: false
                      			},
                      			tooltip: {
                      				format: {
                      					title: function (x) {
                      						return '';
                      					}
                      				}
                      			},
                      			axis: {
                      				y: {
                      					padding: {
                      						bottom: 0,
                      					},
                      					show: false,
                      					tick: {
                      						outer: false
                      					}
                      				},
                      				x: {
                      					padding: {
                      						left: 0,
                      						right: 0
                      					},
                      					show: false
                      				}
                      			},
                      			color: {
                      				pattern: ['#f1c40f']
                      			}
                      		});
                      	});
                      });
                    </script>
                  </div>
                </div>
              </div> -->
              <!-- <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Invoices</h3>
                  </div>
                  <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                      <thead>
                        <tr>
                          <th class="w-1">No.</th>
                          <th>Invoice Subject</th>
                          <th>Client</th>
                          <th>VAT No.</th>
                          <th>Created</th>
                          <th>Status</th>
                          <th>Price</th>
                          <th></th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><span class="text-muted">001401</span></td>
                          <td><a href="invoice.html" class="text-inherit">Design Works</a></td>
                          <td>
                            Carlson Limited
                          </td>
                          <td>
                            87956621
                          </td>
                          <td>
                            15 Dec 2017
                          </td>
                          <td>
                            <span class="status-icon bg-success"></span> Paid
                          </td>
                          <td>$887</td>
                          <td class="text-right">
                            <a href="javascript:void(0)" class="btn btn-secondary btn-sm">Manage</a>
                            <div class="dropdown">
                              <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">Actions</button>
                            </div>
                          </td>
                          <td>
                            <a class="icon" href="javascript:void(0)">
                              <i class="fe fe-edit"></i>
                            </a>
                          </td>
                        </tr>
                        <tr>
                          <td><span class="text-muted">001402</span></td>
                          <td><a href="invoice.html" class="text-inherit">UX Wireframes</a></td>
                          <td>
                            Adobe
                          </td>
                          <td>
                            87956421
                          </td>
                          <td>
                            12 Apr 2017
                          </td>
                          <td>
                            <span class="status-icon bg-warning"></span> Pending
                          </td>
                          <td>$1200</td>
                          <td class="text-right">
                            <a href="javascript:void(0)" class="btn btn-secondary btn-sm">Manage</a>
                            <div class="dropdown">
                              <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">Actions</button>
                            </div>
                          </td>
                          <td>
                            <a class="icon" href="javascript:void(0)">
                              <i class="fe fe-edit"></i>
                            </a>
                          </td>
                        </tr>
                        <tr>
                          <td><span class="text-muted">001403</span></td>
                          <td><a href="invoice.html" class="text-inherit">New Dashboard</a></td>
                          <td>
                            Bluewolf
                          </td>
                          <td>
                            87952621
                          </td>
                          <td>
                            23 Oct 2017
                          </td>
                          <td>
                            <span class="status-icon bg-warning"></span> Pending
                          </td>
                          <td>$534</td>
                          <td class="text-right">
                            <a href="javascript:void(0)" class="btn btn-secondary btn-sm">Manage</a>
                            <div class="dropdown">
                              <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">Actions</button>
                            </div>
                          </td>
                          <td>
                            <a class="icon" href="javascript:void(0)">
                              <i class="fe fe-edit"></i>
                            </a>
                          </td>
                        </tr>
                        <tr>
                          <td><span class="text-muted">001404</span></td>
                          <td><a href="invoice.html" class="text-inherit">Landing Page</a></td>
                          <td>
                            Salesforce
                          </td>
                          <td>
                            87953421
                          </td>
                          <td>
                            2 Sep 2017
                          </td>
                          <td>
                            <span class="status-icon bg-secondary"></span> Due in 2 Weeks
                          </td>
                          <td>$1500</td>
                          <td class="text-right">
                            <a href="javascript:void(0)" class="btn btn-secondary btn-sm">Manage</a>
                            <div class="dropdown">
                              <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">Actions</button>
                            </div>
                          </td>
                          <td>
                            <a class="icon" href="javascript:void(0)">
                              <i class="fe fe-edit"></i>
                            </a>
                          </td>
                        </tr>
                        <tr>
                          <td><span class="text-muted">001405</span></td>
                          <td><a href="invoice.html" class="text-inherit">Marketing Templates</a></td>
                          <td>
                            Printic
                          </td>
                          <td>
                            87956621
                          </td>
                          <td>
                            29 Jan 2018
                          </td>
                          <td>
                            <span class="status-icon bg-danger"></span> Paid Today
                          </td>
                          <td>$648</td>
                          <td class="text-right">
                            <a href="javascript:void(0)" class="btn btn-secondary btn-sm">Manage</a>
                            <div class="dropdown">
                              <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">Actions</button>
                            </div>
                          </td>
                          <td>
                            <a class="icon" href="javascript:void(0)">
                              <i class="fe fe-edit"></i>
                            </a>
                          </td>
                        </tr>
                        <tr>
                          <td><span class="text-muted">001406</span></td>
                          <td><a href="invoice.html" class="text-inherit">Sales Presentation</a></td>
                          <td>
                            Tabdaq
                          </td>
                          <td>
                            87956621
                          </td>
                          <td>
                            4 Feb 2018
                          </td>
                          <td>
                            <span class="status-icon bg-secondary"></span> Due in 3 Weeks
                          </td>
                          <td>$300</td>
                          <td class="text-right">
                            <a href="javascript:void(0)" class="btn btn-secondary btn-sm">Manage</a>
                            <div class="dropdown">
                              <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">Actions</button>
                            </div>
                          </td>
                          <td>
                            <a class="icon" href="javascript:void(0)">
                              <i class="fe fe-edit"></i>
                            </a>
                          </td>
                        </tr>
                      </tbody>
                    </table>
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