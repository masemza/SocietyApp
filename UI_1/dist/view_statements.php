<?php
require 'core/init.php';
$general->logged_out_protect();
$username = htmlentities($user['username']);

$society_id =$_REQUEST['society_id'];
$view_societies = $society->societydata($society_id);

$balance = $payment->get_last_balance($society_id);
$transaction_date = $payment->get_last_transaction($society_id);

$society_deposit = $payment->society_deposit($society_id);
$society_withdrawal = $payment->society_withdrawal($society_id);

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
	$view_societies = $society->society($society_id);
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
                          <!-- <input type="text" name="search" id="myInput" onkeyup="myFunction()" class="form-control" required="required" placeholder="Enter Society Name"> -->
                        </div>
                        <span class="col-auto">
                          <!-- <button class="btn btn-secondary" type="submit" name="submit"><i class="fe fe-search"></i></button><br>               -->
                        </span>
                      </div>
                    </div>

                  </form>
                </div>
              <?php
              }?>
              <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                  
                  <li class="nav-item">
                    <a href="./index.php" class="nav-link active"><i class="fe fe-home"></i> Home</a>
                  </li>

                  <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-users"></i>Manage Members</a>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="./view_members.php?society_id=<?php echo $society_id ?>" class="dropdown-item "><i class="fe fe-users"></i>View Members</a>
                      <a href="./addMember.php?society_id=<?php echo $society_id; ?>" class="dropdown-item "><i class="fe fe-user-plus"></i>Add A New Member</a>
                    </div>
                  </li>

                  <li class="nav-item dropdown">
                    <a href="./view_package.php?society_id=<?php echo $society_id ?>" class="nav-link"><i class="dropdown-icon fe fe-layers"></i> View Package</a>
                  </li>

                  <li class="nav-item dropdown">
                    <a href="./view_society_funeral_arrangement.php?society_id=<?php echo $society_id ?>" class="nav-link"><i class="dropdown-icon fe fe-activity"></i> View Funeral Arrangements</a>
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
        <div class="my-3 my-md-5">
          <div class="container">
            <div class="page-header">
              <h1 class="page-title">
                <a href="index.php" style="text-decoration: none;"> <i class="fe fe-arrow-left"></i>Home</a> | Society Details
              </h1>
            </div>
          <div class="row row-cards">

              <div class="col-sm-6 col-lg-3">
                <div class="card p-3 align-items-left">
                  <div class="d-flex align-items-left">
                    <span class="stamp stamp-md bg-blue mr-3">
                      <i class="fe fe-plus-square"></i>
                    </span>
                    <div>
                    <?php foreach ($view_societies as $row) { ?>
                      <h4 class="m-0"><a href="javascript:void(0)"><!-- 132 --> <small>Initial Capital</small></a></h4>
                      <small class="text-muted">R<?php $opening_bal = number_format($row['init_capital'], 2, ".", ","); echo $opening_bal ?></small>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-sm-6 col-lg-3">
                <div class="card p-3 align-items-left">
                  <div class="d-flex align-items-left">
                    <span class="stamp stamp-md bg-success mr-3">
                      <i class="fe fe-database"></i>
                    </span>
                    <div>
                      <h4 class="m-0"><a href="./view_society_deposits.php?society_id=<?php echo $society_id ?>"><!-- 1,352  --><small>Total Deposits</small></a></h4>
                      <small class="text-muted"><?php echo $society_deposit ?></small>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-sm-6 col-lg-3">
                <div class="card p-3 align-items-left">
                  <div class="d-flex align-items-left">
                    <span class="stamp stamp-md bg-red mr-3">
                      <i class="fe fe-shopping-cart"></i>
                    </span>
                    <div>
                      <h4 class="m-0"><a href="./view_society_withdrawals.php?society_id=<?php echo $society_id ?>"><!-- 1,352  --><small>Total Withdrawals</small></a></h4>
                      <small class="text-muted"><?php echo $society_withdrawal ?></small>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-sm-6 col-lg-3">
                <div class="card p-3 align-items-left">
                  <div class="d-flex align-items-left">
                    <span class="stamp stamp-md bg-cyan mr-3">
                      <i class="fe fe-dollar-sign"></i>
                    </span>
                    <div>

                      <?php 
                      $bal = number_format($balance, 2);
                      if($balance >= 0) 
                      { 
                      ?>

                          <h4 class="m-0"><a href="javascript:void(0)"><!-- 1,352  --><small>Current Balance</small></a></h4>
                          <small class="text-muted">R<?php echo $bal ?></small>
                      
                      <?php 
                      }
                      else 
                      { ?>

                          <h4 class="m-0"><a href="javascript:void(0)"><!-- 1,352  --><small>Due to us</small></a></h4>
                          <small class="text-muted">(R<?php echo substr($bal,1) ?>) </small>

                      <?php 
                      }
                      ?>
                    
                    </div>
                  </div>
                </div>
              </div> 

              <div class="col-sm-4 col-lg-6">
                  <div class="card p-3 align-items-center">
                    <div class="d-flex">
                      <!-- <span class="stamp stamp-md bg-green mr-3">
                        <i class="fe fe-plus-circle"></i> -->
                      </span>
                      <div>
                        <a href="./deposit.php?society_id=<?php echo $row['society_id'] ?>" class="btn btn-success" role="button">Deposit Money</a>
                      </div>
                    </div>
                  </div>
                </div> 

                <!-- <div class="col-sm-4 col-lg-4">
                    <div class="card p-3 align-items-center">
                      <div class="d-flex">
                        
                        </span>
                        <div>
                          <a href="./withdraw.php?society_id=<?php// echo $row['society_id'] ?>" class="btn btn-red" role="button">Withdraw Money</a>
                        </div>
                      </div>
                    </div>
                  </div>  -->

                  <div class="col-sm-4 col-lg-6">
                    <div class="card p-3 align-items-center">
                      <div class="d-flex">
                        <!-- <span class="stamp stamp-md bg-green mr-3">
                          <i class="fe fe-minus-circle"></i> -->
                        </span>
                        <div>
                          <a href="statement.php?society_id=<?php echo $row ['society_id'] ?>" class="btn btn-primary" role="button" >View Statement</a>
                        </div>
                      </div>
                    </div>
                  </div> 

            </div>
            <!-- <div class="row row-cards row-deck">
              <div class="col-lg-6">
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
              </div>
              <div class="col-lg-6">
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
              </div>
            </div> -->
            <div class="row row-cards row-deck">
              <!-- <div class="col-12">
                <div class="card">
                  <div class="table-responsive">
                    <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                      <thead>
                        <tr>
                          <th class="text-center w-1"><i class="icon-people"></i></th>
                          <th>User</th>
                          <th>Usage</th>
                          <th class="text-center">Payment</th>
                          <th>Activity</th>
                          <th class="text-center">Satisfaction</th>
                          <th class="text-center"><i class="icon-settings"></i></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="text-center">
                            <div class="avatar d-block" style="background-image: url(demo/faces/female/26.jpg)">
                              <span class="avatar-status bg-green"></span>
                            </div>
                          </td>
                          <td>
                            <div>Elizabeth Martin</div>
                            <div class="small text-muted">
                              Registered: Mar 19, 2018
                            </div>
                          </td>
                          <td>
                            <div class="clearfix">
                              <div class="float-left">
                                <strong>42%</strong>
                              </div>
                              <div class="float-right">
                                <small class="text-muted">Jun 11, 2015 - Jul 10, 2015</small>
                              </div>
                            </div>
                            <div class="progress progress-xs">
                              <div class="progress-bar bg-yellow" role="progressbar" style="width: 42%"
						     aria-valuenow="42" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </td>
                          <td class="text-center">
                            <i class="payment payment-visa"></i>
                          </td>
                          <td>
                            <div class="small text-muted">Last login</div>
                            <div>4 minutes ago</div>
                          </td>
                          <td class="text-center">
                            <div class="mx-auto chart-circle chart-circle-xs" data-value="0.42" data-thickness="3" data-color="blue">
                              <div class="chart-circle-value">42%</div>
                            </div>
                          </td>
                          <td class="text-center">
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
                          </td>
                        </tr>
                        <tr>
                          <td class="text-center">
                            <div class="avatar d-block" style="background-image: url(demo/faces/female/17.jpg)">
                              <span class="avatar-status bg-green"></span>
                            </div>
                          </td>
                          <td>
                            <div>Michelle Schultz</div>
                            <div class="small text-muted">
                              Registered: Mar 2, 2018
                            </div>
                          </td>
                          <td>
                            <div class="clearfix">
                              <div class="float-left">
                                <strong>0%</strong>
                              </div>
                              <div class="float-right">
                                <small class="text-muted">Jun 11, 2015 - Jul 10, 2015</small>
                              </div>
                            </div>
                            <div class="progress progress-xs">
                              <div class="progress-bar bg-red" role="progressbar" style="width: 0%"
						     aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </td>
                          <td class="text-center">
                            <i class="payment payment-googlewallet"></i>
                          </td>
                          <td>
                            <div class="small text-muted">Last login</div>
                            <div>5 minutes ago</div>
                          </td>
                          <td class="text-center">
                            <div class="mx-auto chart-circle chart-circle-xs" data-value="0.0" data-thickness="3" data-color="blue">
                              <div class="chart-circle-value">0%</div>
                            </div>
                          </td>
                          <td class="text-center">
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
                          </td>
                        </tr>
                        <tr>
                          <td class="text-center">
                            <div class="avatar d-block" style="background-image: url(demo/faces/female/21.jpg)">
                              <span class="avatar-status bg-green"></span>
                            </div>
                          </td>
                          <td>
                            <div>Crystal Austin</div>
                            <div class="small text-muted">
                              Registered: Apr 7, 2018
                            </div>
                          </td>
                          <td>
                            <div class="clearfix">
                              <div class="float-left">
                                <strong>96%</strong>
                              </div>
                              <div class="float-right">
                                <small class="text-muted">Jun 11, 2015 - Jul 10, 2015</small>
                              </div>
                            </div>
                            <div class="progress progress-xs">
                              <div class="progress-bar bg-green" role="progressbar" style="width: 96%"
						     aria-valuenow="96" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </td>
                          <td class="text-center">
                            <i class="payment payment-mastercard"></i>
                          </td>
                          <td>
                            <div class="small text-muted">Last login</div>
                            <div>a minute ago</div>
                          </td>
                          <td class="text-center">
                            <div class="mx-auto chart-circle chart-circle-xs" data-value="0.96" data-thickness="3" data-color="blue">
                              <div class="chart-circle-value">96%</div>
                            </div>
                          </td>
                          <td class="text-center">
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
                          </td>
                        </tr>
                        <tr>
                          <td class="text-center">
                            <div class="avatar d-block" style="background-image: url(demo/faces/male/32.jpg)">
                              <span class="avatar-status bg-green"></span>
                            </div>
                          </td>
                          <td>
                            <div>Douglas Ray</div>
                            <div class="small text-muted">
                              Registered: Jan 15, 2018
                            </div>
                          </td>
                          <td>
                            <div class="clearfix">
                              <div class="float-left">
                                <strong>6%</strong>
                              </div>
                              <div class="float-right">
                                <small class="text-muted">Jun 11, 2015 - Jul 10, 2015</small>
                              </div>
                            </div>
                            <div class="progress progress-xs">
                              <div class="progress-bar bg-red" role="progressbar" style="width: 6%"
						     aria-valuenow="6" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </td>
                          <td class="text-center">
                            <i class="payment payment-shopify"></i>
                          </td>
                          <td>
                            <div class="small text-muted">Last login</div>
                            <div>a minute ago</div>
                          </td>
                          <td class="text-center">
                            <div class="mx-auto chart-circle chart-circle-xs" data-value="0.06" data-thickness="3" data-color="blue">
                              <div class="chart-circle-value">6%</div>
                            </div>
                          </td>
                          <td class="text-center">
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
                          </td>
                        </tr>
                        <tr>
                          <td class="text-center">
                            <div class="avatar d-block" style="background-image: url(demo/faces/female/12.jpg)">
                              <span class="avatar-status bg-green"></span>
                            </div>
                          </td>
                          <td>
                            <div>Teresa Reyes</div>
                            <div class="small text-muted">
                              Registered: Mar 4, 2018
                            </div>
                          </td>
                          <td>
                            <div class="clearfix">
                              <div class="float-left">
                                <strong>36%</strong>
                              </div>
                              <div class="float-right">
                                <small class="text-muted">Jun 11, 2015 - Jul 10, 2015</small>
                              </div>
                            </div>
                            <div class="progress progress-xs">
                              <div class="progress-bar bg-red" role="progressbar" style="width: 36%"
						     aria-valuenow="36" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </td>
                          <td class="text-center">
                            <i class="payment payment-ebay"></i>
                          </td>
                          <td>
                            <div class="small text-muted">Last login</div>
                            <div>2 minutes ago</div>
                          </td>
                          <td class="text-center">
                            <div class="mx-auto chart-circle chart-circle-xs" data-value="0.36" data-thickness="3" data-color="blue">
                              <div class="chart-circle-value">36%</div>
                            </div>
                          </td>
                          <td class="text-center">
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
                          </td>
                        </tr>
                        <tr>
                          <td class="text-center">
                            <div class="avatar d-block" style="background-image: url(demo/faces/female/4.jpg)">
                              <span class="avatar-status bg-green"></span>
                            </div>
                          </td>
                          <td>
                            <div>Emma Wade</div>
                            <div class="small text-muted">
                              Registered: Mar 20, 2018
                            </div>
                          </td>
                          <td>
                            <div class="clearfix">
                              <div class="float-left">
                                <strong>7%</strong>
                              </div>
                              <div class="float-right">
                                <small class="text-muted">Jun 11, 2015 - Jul 10, 2015</small>
                              </div>
                            </div>
                            <div class="progress progress-xs">
                              <div class="progress-bar bg-red" role="progressbar" style="width: 7%"
						     aria-valuenow="7" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </td>
                          <td class="text-center">
                            <i class="payment payment-paypal"></i>
                          </td>
                          <td>
                            <div class="small text-muted">Last login</div>
                            <div>a minute ago</div>
                          </td>
                          <td class="text-center">
                            <div class="mx-auto chart-circle chart-circle-xs" data-value="0.07" data-thickness="3" data-color="blue">
                              <div class="chart-circle-value">7%</div>
                            </div>
                          </td>
                          <td class="text-center">
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
                          </td>
                        </tr>
                        <tr>
                          <td class="text-center">
                            <div class="avatar d-block" style="background-image: url(demo/faces/female/27.jpg)">
                              <span class="avatar-status bg-green"></span>
                            </div>
                          </td>
                          <td>
                            <div>Carol Henderson</div>
                            <div class="small text-muted">
                              Registered: Feb 22, 2018
                            </div>
                          </td>
                          <td>
                            <div class="clearfix">
                              <div class="float-left">
                                <strong>80%</strong>
                              </div>
                              <div class="float-right">
                                <small class="text-muted">Jun 11, 2015 - Jul 10, 2015</small>
                              </div>
                            </div>
                            <div class="progress progress-xs">
                              <div class="progress-bar bg-green" role="progressbar" style="width: 80%"
						     aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </td>
                          <td class="text-center">
                            <i class="payment payment-visa"></i>
                          </td>
                          <td>
                            <div class="small text-muted">Last login</div>
                            <div>9 minutes ago</div>
                          </td>
                          <td class="text-center">
                            <div class="mx-auto chart-circle chart-circle-xs" data-value="0.8" data-thickness="3" data-color="blue">
                              <div class="chart-circle-value">80%</div>
                            </div>
                          </td>
                          <td class="text-center">
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
                          </td>
                        </tr>
                        <tr>
                          <td class="text-center">
                            <div class="avatar d-block" style="background-image: url(demo/faces/male/20.jpg)">
                              <span class="avatar-status bg-green"></span>
                            </div>
                          </td>
                          <td>
                            <div>Christopher Harvey</div>
                            <div class="small text-muted">
                              Registered: Jan 22, 2018
                            </div>
                          </td>
                          <td>
                            <div class="clearfix">
                              <div class="float-left">
                                <strong>83%</strong>
                              </div>
                              <div class="float-right">
                                <small class="text-muted">Jun 11, 2015 - Jul 10, 2015</small>
                              </div>
                            </div>
                            <div class="progress progress-xs">
                              <div class="progress-bar bg-green" role="progressbar" style="width: 83%"
						     aria-valuenow="83" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </td>
                          <td class="text-center">
                            <i class="payment payment-googlewallet"></i>
                          </td>
                          <td>
                            <div class="small text-muted">Last login</div>
                            <div>8 minutes ago</div>
                          </td>
                          <td class="text-center">
                            <div class="mx-auto chart-circle chart-circle-xs" data-value="0.83" data-thickness="3" data-color="blue">
                              <div class="chart-circle-value">83%</div>
                            </div>
                          </td>
                          <td class="text-center">
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
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-lg-4">
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
              </div>
              <div class="col-sm-6 col-lg-4">
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
              </div>
              <div class="col-md-6 col-lg-4">
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
              </div>
              <div class="col-md-6 col-lg-12">
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
              <!-- <div class="col-lg-3">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Society Details</h3>
                </div>
                <div class="card-body">
                  <form>
                    <div class="row">
                      <div class="col-auto">
                        <span class="avatar avatar-xl" style="background-image: url(demo/faces/avator/avatar-001.jpg)"></span>
                      </div>
                      <div class="col">
                        <div class="form-group">
                          <label class="form-label">Society Name : <?php //echo $row['society_name']; ?></label>
                          <label class="form-label">Location : <?php //echo $row['location']; ?></label>
                        </div>
                      </div>
                    </div>
                    <div class="form-footer">
                      <button class="btn btn-primary btn-block">Save</button>
                    </div> -->
                  <!-- </form>
                </div>
              </div>
            </div> -->

            <div class="col-lg-12">
              <script>
                require(['input-mask']);
              </script>
              <div class="card">
                <div class="card-body">
                  <h3 class="card-title">Society Details</h3>
                  <!-- <form> -->
                      <div class="form-group">
                          <label class="form-label">Society name</label>
                          <input disabled="disabled" type="text" name="field-name" class="form-control" value="<?php echo $row['society_name']?>">
                      </div>

                      <div class="form-group">
                            <label class="form-label">Date Inception</label>
                            <input disabled="disabled" type="text" name="field-name" class="form-control"
                             data-mask-clearifnotmatch="true" autocomplete="off" maxlength="10" value="<?php $date=date_create($row['date_inception']); echo date_format($date,"d-m-Y") ?>">
                      </div>
                      
                      <hr>

                      <div class="form-group">
                      <h3 class="card-title">Location</h3>
                        <label class="form-label">Street</label>
                        <input disabled="disabled" type="text" name="field-name" class="form-control" value="<?php echo $row['addr1']?> ">
                      </div>
                        
                      <div class="form-group">
                        <label class="form-label">Suburb</label>
                        <input disabled="disabled" type="text" name="field-name" class="form-control" value="<?php echo $row['addr2']?> ">
                      </div>  
                        
                      <div class="form-group">
                        <label class="form-label">City</label>
                        <input disabled="disabled" type="text" name="field-name" class="form-control" value="<?php echo $row['addr3']?> ">
                      </div>

                      <div class="form-group">
                        <label class="form-label">Province</label>
                        <input disabled="disabled" type="text" name="field-name" class="form-control" value="<?php echo $row['addr4']?> ">
                      </div>

                      <?php } ?>
                      <br>
                    <div class="card-footer text-left">
                      <a href="./edit_society.php?society_id=<?php echo $row['society_id'] ?>" class="btn btn-primary">Edit Society Details</a>
                    </div>
                  <!-- </form> -->
                </div>
              </div>
            </div>    

              <!-- <div class="col-lg-6 col-sm-6">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Statement</h3>
                  </div>
                  <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                      <tbody>
                        <tr>
                          <td class="text-center">
                            <a href="statement.php?society_id=<?php //echo $row ['society_id'] ?>" class="btn btn-primary btn-sm"><i class="w-1">View Statement</i></a>
                            
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
  </body>
</html>