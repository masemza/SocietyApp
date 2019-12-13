<?php
require 'core/init.php';
$general->logged_out_protect();
$username = htmlentities($user['username']);
$user_id = htmlentities($user['id']);
$type = htmlentities($user['type']);

//user dashboard
$main_member_id = $main_member->get_main_member_id($user_id);
$view_main_member = $main_member->memberdata($main_member_id);
foreach($view_main_member as $main_member_row)
{

}

$balance = $main_member->get_last_balance($main_member_id);
$view_deposits = $main_member->member_deposits($main_member_id);
$view_withdrawals = $main_member->member_withdrawals($main_member_id);

$provinceData = $main_member->allProvinceInformation();
$cityData = $main_member->allCityInformation();

//admin and manager dashboard
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
<head>
  <style type="text/css">
      table tr {
        cursor: pointer;
    }
  </style>
</head>
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
                          <input type="text" name="search" id="myInput" onkeyup="myFunction()" class="form-control" required="required" placeholder="Enter Society Name">
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
                  
                  <?php
                  if($type == 'user')
                  {?>
                    <li class="nav-item">
                      <a href="./index.php" class="nav-link active"><i class="fe fe-home"></i> Home</a>
                    </li>

                    <li class="nav-item">
                      <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-users"></i>Manage Spouse</a>
                      <div class="dropdown-menu dropdown-menu-arrow">
                        <a href="./view_spouse.php?main_member_id=<?php echo $main_member_id ?>" class="dropdown-item "><i class="fe fe-users"></i>View Spouse</a>
                        <a href="./spouse.php?main_member_id=<?php echo $main_member_id ?>" class="dropdown-item "><i class="fe fe-user-plus"></i>Add Spouse</a>
                      </div>
                    </li>

                    <li class="nav-item">
                      <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-users"></i>Manage Immediate Family</a>
                      <div class="dropdown-menu dropdown-menu-arrow">
                        <a href="./view_immediate_family.php?main_member_id=<?php echo $main_member_id ?>" class="dropdown-item "><i class="fe fe-users"></i>View Immediate Family</a>
                        <a href="./immediate_family.php?main_member_id=<?php echo $main_member_id ?>" class="dropdown-item "><i class="fe fe-user-plus"></i>Add Immediate Family</a>
                      </div>
                    </li>

                    <li class="nav-item">
                      <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-users"></i>Manage Extended Family</a>
                      <div class="dropdown-menu dropdown-menu-arrow">
                        <a href="./view_extended_family.php?main_member_id=<?php echo $main_member_id ?>" class="dropdown-item "><i class="fe fe-users"></i>View Extended Family</a>
                        <a href="./extended_family.php?main_member_id=<?php echo $main_member_id ?>" class="dropdown-item "><i class="fe fe-user-plus"></i>Add Extended Family</a>
                      </div>
                    </li>
                  <?php
                  }?>

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
              <?php 
              if(empty($errors) === false)
              {	
              ?>
                <div class="col-sm-6 col-lg-12 ">
                  <div class="card p-3 align-items-center">
                    <div class="d-flex align-items-center">
                      <form class="text-center" action="" method="post">                    
                        <div class="form-group">
                          <h3>
                          Sorry!!! <br>
                          Society name: "<?php echo ucfirst($search) ?>" does'nt exist
                        </div>
                        <div class="form-group">
                          <button class="btn btn-secondary" type="submit" name="submit1" >Click here to view all societies</button>
                        </div>
                          </h3>
                      </form>
                    </div>
                  </div>
                </div>
              <?php 
              }?>     

              <?php 
              if(empty($errors) === true)
              {?>
                  
              <h1 class="page-title">
                Dashboard
              </h1>
            </div>
            <div class="row row-cards">
              <?php
              if($type == 'manager' || $type == 'admin')
              {?>
                  <div class="col-sm-6 col-lg-4">
                    <div class="card p-3">
                      <div class="d-flex align-items-center">
                        <span class="stamp stamp-md bg-blue mr-3">
                          <i class="fe fe-plus-square"></i>
                        </span>
                        <div>
                          <h4 class="m-0"><a href="./view_total_transactions.php"><small>Total Transactions</small></a></h4>
                          <small class="text-muted"><?php echo $total_transaction ?></small>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-6 col-lg-4">
                    <div class="card p-3">
                      <div class="d-flex align-items-center">
                        <span class="stamp stamp-md bg-red mr-3">
                          <i class="fe fe-database"></i>
                        </span>
                        <div>
                          <h4 class="m-0"><a href="./view_total_deposits.php"><small>Total Deposits</small></a></h4>
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
                          <h4 class="m-0"><a href="./view_total_withdrawals.php"><small> Total Withdrawals</small></a></h4>
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
                          <h4 class="m-0"><a href="./view_societies.php"><small>Societies</small></a></h4>
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
                          <h4 class="m-0"><a href="./viewMembers.php"><small>Members</small></a></h4>
                          <small class="text-muted"><?php echo $total_members?> registered members</small>
                        </div>
                      </div>
                    </div>
                  </div>
              <?php 
              }
              else if($type == 'user') 
              {?>
                  <div class="col-sm-6 col-lg-4">
                <div class="card p-3 align-items-left">
                  <div class="d-flex align-items-left">
                    <span class="stamp stamp-md bg-blue mr-3">
                      <i class="fe fe-plus-square"></i>
                    </span>
                    <div>
                      <h4 class="m-0"><a href="javascript:void(0)"><!-- 132 --> <small>Cover</small></a></h4>
                      <small class="text-muted">R<?php echo number_format($main_member_row['cover'], 2) ?></small>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-sm-6 col-lg-4">
                <div class="card p-3 align-items-left">
                  <div class="d-flex align-items-left">
                    <span class="stamp stamp-md bg-red mr-3">
                      <i class="fe fe-database"></i>
                    </span>
                    <div>
                      <h4 class="m-0"><a href="javascript:void(0)"><small>Total Premiums</small></a></h4>
                      <small class="text-muted"><?php echo $view_deposits ?></small>
                    </div>
                  </div>
                </div>
              </div>

              <!-- <div class="col-sm-3 col-lg-3">
                <div class="card p-3 align-items-center">
                  <a href="./pay_premium.php?main_member_id=<?php echo $main_member_id ?>" class="btn btn-success" role="button">Pay Premium</a>
                </div>
              </div> -->

              <div class="col-sm-6 col-lg-4">
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

                          <h4 class="m-0"><a href="javascript:void(0)"><small>Current Balance</small></a></h4>
                          <small class="text-muted">R<?php echo $bal ?></small>
                      
                      <?php 
                      }
                      else 
                      { ?>

                          <h4 class="m-0"><a href="javascript:void(0)"><small>Due to us</small></a></h4>
                          <small class="text-muted">(R<?php echo substr($bal,1) ?>) </small>

                      <?php 
                      }
                      ?>
                    
                    </div>
                  </div>
                </div>
              </div>
              <?php
              }?>

            </div>

            <div class="row row-cards row-deck">
              <div class="col-12">
                
                <?php if($type == 'manager' || $type == 'admin')
                {?>
                  <div class="card">
                    <div class="table-responsive">

                      <table id="myTable" class="table table-hover table-outline table-vcenter text-nowrap card-table">
                        <thead>
                          <tr>
                            <th class="text-center w-1"><i class="icon-people"></i></th>
                            <th>Society Name</th>
                            <th>Opening Balance</th>
                            <th>Date Inception</th>
                            <th class="text-center">Location</th>
                            <th class="text-center"><i class="icon-settings"></i></th>
                          </tr>
                        </thead>
                      
                        <tbody>
                          <?php foreach ($view_societies as $row) 
                          {?>
                            <!-- onclick="window.location='/societyapp/UI_1/dist/view_statements.php?society_id=<?php //echo $row['society_id']?>'" -->
                            <tr>
                              <td class="text-center" onclick="window.location='/societyapp/UI_1/dist/view_statements.php?society_id=<?php echo $row['society_id']?>'"></td>

                              <td ++ onclick="window.location='/societyapp/UI_1/dist/view_statements.php?society_id=<?php echo $row['society_id']?>'">
                                <div>
                                  <?php 
                                    echo $row['society_name']; 
                                  ?> 
                                  (<?php
                                    $society_id = $row['society_id']; 
                                    echo $total_number_of_society = $member->total_num_society($society_id) 
                                  ?>) 
                                </div>
                              </td>

                              <td onclick="window.location='/societyapp/UI_1/dist/view_statements.php?society_id=<?php echo $row['society_id']?>'">
                                <div class="clearfix">
                                  <div class="float-left">
                                    <strong><?php echo $row['init_capital']; ?></strong>
                                  </div>
                                </div>
                                <div class="progress progress-xs">
                                  <div class="progress-bar bg-yellow" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                              </td>

                              <td onclick="window.location='/societyapp/UI_1/dist/view_statements.php?society_id=<?php echo $row['society_id']?>'">
                                <div>
                                    <?php $date=date_create($row['date_inception']);
                                        echo date_format($date,"d-m-Y"); 
                                    ?>
                                </div>
                              </td>
                              
                              <td class="text-center" onclick="window.location='/societyapp/UI_1/dist/view_statements.php?society_id=<?php echo $row['society_id']?>'">
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
                                    <a href="./view_society_funeral_arrangement.php?society_id=<?php echo $row['society_id']?>" class="dropdown-item"><i class="dropdown-icon fe fe-activity"></i> View Funeral Arrangement </a>
                                    <div class="dropdown-divider"></div>
                                    <a onclick ="return confirm('Are you sure you want to delete this society?')" href="./deleteSociety.php?society_id=<?php echo $row['society_id']?>" class="dropdown-item"><i class="dropdown-icon fe fe-trash-2"></i> Remove Society</a>
                                  </div>
                                </div>
                              </td>
                            </tr> 
                          <?php 
                          }?>   
                        
                        <?php 
                        }?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <?php 
                  }?>

                  <?php if($type == 'user')
                  {?>
                      



                      <div class="row row-cards row-deck">

            <div class="col-lg-8">
              <script>
                require(['input-mask']);
              </script>
              <div class="card">
                <div class="card-body">
                  <h3 class="card-title">Member Details</h3>
                  <form action="" method="post">

                    <div class="card-body">
                      <div class="row">
                        <div class="col-sm-6 col-md-6">
                          <div class="form-group">
                            <label class="form-label">First name(s)</label>
                            <input type="text" name="first_name" class="form-control" value="<?php echo $main_member_row['first_name']?>">
                          </div>
                        </div>

                        <div class="col-sm-6 col-md-6">
                          <div class="form-group">
                              <label class="form-label">Surname</label>
                              <input type="text" name="last_name" class="form-control" value="<?php echo $main_member_row['last_name']?>">
                          </div>
                        </div>

                        <div class="col-sm-6 col-md-6">
                          <div class="form-group">
                              <label class="form-label">ID number</label>
                              <input disabled="true" type="number" name="id_number" class="form-control" value="<?php echo $main_member_row['id_number']?>">
                          </div>
                        </div>

                        <div class="col-sm-6 col-md-6">
                          <div class="form-group">
                              <label class="form-label">Contact number</label>
                              <input type="number" name="contact_num" class="form-control" value="<?php echo $main_member_row['contact_number']?>">
                          </div>
                        </div>

                        <div class="col-sm-6 col-md-6">
                          <div class="form-group">
                                <label class="gender">Gender</label>
                                <select name= gender class="form-control">
                                    <option ><?php echo $main_member_row['gender'] ?></option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                          </div>
                        </div>

                        <div class="col-sm-6 col-md-6">
                          <div class="form-group">
                              <label class="form-label">Date Inception</label>
                              <input type="text" name="inception_date" class="form-control" data-mask-clearifnotmatch="true" autocomplete="off" maxlength="10" value="<?php echo date(("d-m-Y"), $main_member_row['inception_date']) ?>">
                          </div>
                        </div>

                        <div class="col-sm-6 col-md-6">
                          <div class="form-group">
                                <label class="plan_type">Plan type</label>
                                <select name= plan_type class="form-control custom-select" required="true">
                                  <option ><?php echo $main_member_row['plan_type']; ?></option>
                                  <option value="Bronze">Bronze</option>
                                  <option value="Silver">Silver</option>
                                  <option value="Gold">Gold</option>
                                  <option value="Platinum">Platinum</option>
                                  <option value="Pensioner">Pensioner</option>
                                  <option value="Seshebo">Seshebo</option>
                                  <option value="Tomnstone">Tomnstone</option>
                                  <option value="Pensioner +">Pensioner +</option>
                                </select>
                          </div>
                        </div>

                        <div class="col-sm-6 col-md-6">
                          <div class="form-group">
                              <label class="form-label">Premium</label>
                              <input type="number" name="premium" class="form-control" value="<?php echo $main_member_row['premium']?>">
                          </div>
                        </div>

                        <div class="col-sm-6 col-md-6">
                          <div class="form-group">
                              <label class="form-label">Cover</label>
                              <input type="number" name="cover" class="form-control" value="<?php echo $main_member_row['cover']?>">
                          </div>
                        </div>

                        <div class="col-sm-6 col-md-6">
                          <div class="form-group">
                              <label class="form-label">Policy number</label>
                              <input type="text" name="policy_number" class="form-control" value="<?php echo $main_member_row['policy_number']?>">
                          </div>
                        </div>
                          
                      </div>
                    </div>
                  
                        <h3 class="card-title">Location</h3>
                        <div class="card-body">
                          <div class="row">
                            <div class="col-sm-4 col-md-4">
                              <div class="form-group">
                                <label class="form-label">Suburb</label>
                                <input type="text" name="suburb" class="form-control" value="<?php echo $main_member_row['suburb']?> ">
                              </div>
                            </div>
                                
                            <div class="col-sm-4 col-md-4">
                              <div class="form-group">
                                <label class="form-label">City</label>
                                <input list="city" name="city" class="form-control" placeholder="Enter City" required="true" size="" value="<?php echo $main_member_row['city']; ?>" >
                                  <datalist id="city">
                                    <?php  
                                      foreach($cityData as $cityrow)
                                      {?>
                                          <option value="<?php echo $cityrow['city_name'] ?> "></option>
                                      <?php 
                                      }?>   
                                  </datalist>
                              </div>
                            </div>

                            <div class="col-sm-4 col-md-4">
                              <div class="form-group">
                                <label class="province">Province</label>
                                <select name = province class="form-control custom-select" required="true">
                                  <option ><?php echo $main_member_row['province']; ?></option>
                                  <?php foreach($provinceData as $provincerow)
                                  {?>
                                    <option value="<?php echo $provincerow['province_name'] ?>"><?php echo $provincerow['province_name'] ?></option>
                                  <?php
                                  }?>
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>

                    <div class="card-footer">
                      <button type="submit" name="update" class="btn btn-primary">Update Details</button>
                      <a href="./edit_user_log_in_details.php?user_id=<?php echo $main_member_row['user_id'] ?>" class="btn btn-primary" role="button">Edit log in details</a>
                    </div>

                    <br>
                    <?php 
                    if(empty($errors) === false)
                    {
                      echo '<p class="text-center">' . implode('</p><p>', $errors) . '</p>';  
                    }
                    ?>

                  </form>
                </div>
              </div>
            </div>              
              <div class="col-lg-4 col-sm-4">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Statement</h3>
                  </div>
                  <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                      <tbody>
                        <tr>
                          <td class="text-center">
                            <a href="member_statement.php?main_member_id=<?php echo $main_member_id ?>" class="btn btn-primary btn-sm"><i class="w-1">View Statement</i></a>
                          </td>
                        </tr>
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>




                  <?php 
                  }?>

                    

                  
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

<!-- Table filter -->
<script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 1; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
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