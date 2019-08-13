<?php
require 'core/init.php';
$general->logged_out_protect();
$username = htmlentities($user['username']);

$society_id =$_GET['society_id'];
$view_statement = $payment->payment_data($society_id);	

$view_society = $society->societydata($society_id);

$last_balance = $payment->get_last_balance($society_id);

global $num;

if (isset($_POST['submit']))
{
	$search = $_POST['search'];
	
	if ($payment->statement_exists($search) === false) 
	{
		$errors[] = 'Sorry that society does\'nt exists.';
	}

	$view_statement = $payment->view_search($search);
	
}

if (isset($_POST['submit1']))
{
	$view_statement = $payment->payment_data($society_id);
}


?>

<!doctype html>
<html lang="en" dir="ltr">
<?php include 'incl/head.php' ;?>
<?php include 'incl/header.php' ;?>

  <body class="">
    <div class="page">
      <div class="page-main">







      

        <!-- <div class="header py-4">
          <div class="container">
            <div class="d-flex">
              <a class="header-brand" href="./index.php">
                <img src="./demo/brand/tabler.svg" class="header-brand-img" alt="tabler logo">
              </a>
              <div class="d-flex order-lg-2 ml-auto">
                <div class="nav-item d-none d-md-flex">
                  <a href="https://github.com/tabler/tabler" class="btn btn-sm btn-outline-primary" target="_blank">Source code</a>
                </div>
                <div class="dropdown d-none d-md-flex">
                  <a class="nav-link icon" data-toggle="dropdown">
                    <i class="fe fe-bell"></i>
                    <span class="nav-unread"></span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                    <a href="#" class="dropdown-item d-flex">
                      <span class="avatar mr-3 align-self-center" style="background-image: url(demo/faces/male/41.jpg)"></span>
                      <div>
                        <strong>Nathan</strong> pushed new commit: Fix page load performance issue.
                        <div class="small text-muted">10 minutes ago</div>
                      </div>
                    </a>
                    <a href="#" class="dropdown-item d-flex">
                      <span class="avatar mr-3 align-self-center" style="background-image: url(demo/faces/female/1.jpg)"></span>
                      <div>
                        <strong>Alice</strong> started new task: Tabler UI design.
                        <div class="small text-muted">1 hour ago</div>
                      </div>
                    </a>
                    <a href="#" class="dropdown-item d-flex">
                      <span class="avatar mr-3 align-self-center" style="background-image: url(demo/faces/female/18.jpg)"></span>
                      <div>
                        <strong>Rose</strong> deployed new version of NodeJS REST Api V3
                        <div class="small text-muted">2 hours ago</div>
                      </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item text-center text-muted-dark">Mark all as read</a>
                  </div>
                </div>
                <div class="dropdown">
                  <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                    <span class="avatar" style="background-image: url(./demo/faces/female/25.jpg)"></span>
                    <span class="ml-2 d-none d-lg-block">
                      <span class="text-default">Jane Pearson</span>
                      <small class="text-muted d-block mt-1">Administrator</small>
                    </span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                    <a class="dropdown-item" href="#">
                      <i class="dropdown-icon fe fe-user"></i> Profile
                    </a>
                    <a class="dropdown-item" href="#">
                      <i class="dropdown-icon fe fe-settings"></i> Settings
                    </a>
                    <a class="dropdown-item" href="#">
                      <span class="float-right"><span class="badge badge-primary">6</span></span>
                      <i class="dropdown-icon fe fe-mail"></i> Inbox
                    </a>
                    <a class="dropdown-item" href="#">
                      <i class="dropdown-icon fe fe-send"></i> Message
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">
                      <i class="dropdown-icon fe fe-help-circle"></i> Need help?
                    </a>
                    <a class="dropdown-item" onclick ="return confirm('Are you sure you want to logout?')" href="./logout.php">
                      <i class="dropdown-icon fe fe-log-out"></i> Sign out
                    </a>
                  </div>
                </div>
              </div>
              <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
                <span class="header-toggler-icon"></span>
              </a>
            </div>
          </div>
        </div> -->












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
                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-box"></i>Transaction</a>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="./deposit.html" class="dropdown-item ">Deposit</a>
                      <a href="./withdraw.html" class="dropdown-item ">Withdraw</a>
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
                    <a href="javascript:void(0)" class="nav-link active" data-toggle="dropdown"><i class="fe fe-file"></i>View Statement</a>
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
              <?php foreach ($view_statement as $row) ?>
                <a href="./view_statements.php?society_id=<?php echo $row['society_id']?>" style="text-decoration: none;"> <i class="fe fe-arrow-left"></i>Society Details</a> | Statements
              <?php ?>
              </h1>
            </div>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"> Statement</h3>
                <div class="card-options">
                  <button type="button" class="btn btn-primary btn-sm" onclick="javascript:window.print();"><i class="fe fe-download"></i> Download Statement</button>
                </div>
              </div>
              <div class="card-body">
              <?php foreach ($view_statement as $row) { 
                        $society_name = $row['society_name'];
                        $society_id = $row['society_id'];
                    }
                        ?>
 
                <div class="row my-6">
                  <div class="col-6">
                    <!-- <p class="h3">Company</p> -->
                    <p class="h2">Seshego Funerals</p><p class="h4">Society Name: <?php echo $society_name; ?></p>
                    <address>
                    <?php foreach ($view_society as $row)?>
                        <p class="h4">Location: </p>
                        <?php echo $row['addr1'] ?> <br>
                        <?php echo $row['addr2'] ?> <br>
                        <?php echo $row['addr3'] ?> <br>
                        <?php echo $row['addr4'] ?> <br>
                    </address>
                  </div>
                  <div class="col-6 text-right">
                    <!-- <p class="h3">Client</p> -->
                    <address>

                        <p class="h4"> Society ID: #<?php echo $society_id; ?></p>
                     <p> Date: <?php echo date("d-m-Y"); ?> </p>
                    </address>
                  </div>
                </div>
                <div class="table-responsive push">
                  <table class="table table-bordered table-hover">
                    <tr>
                      <th class="text-center" style="width: 0.5%"></th>
                      <th class="text-center" style="width: 1.5%">Transaction Date</th>
                      <th class="text-center" style="width: 5%">Name</th>
                      <th class="text-center" style="width: 1%">Receipt No</th>
                      <th class="text-center" style="width: 3%">Credit</th>
                      <th class="text-center" style="width: 3%">Debit</th>
                    </tr>

                    <tr>
                    <?php foreach ($view_statement as $row) { $num++?>
                      <td class="text-center"><?php echo $num?></td>
                      <td>
                        <p class="font-w600 mb-1 text-center"><?php $date=date_create($row['date_transaction']);
                                    echo date_format($date,"d-m-Y");  //echo $row['date_transaction']; ?></p>
                        <!-- <div class="text-muted">Logo and business cards design</div> -->
                      </td>
                      <td class="text-center">
                      <?php echo $row['name']; ?>
                      </td>
                      <td class="text-center"><a href="receipt.php?payment_id=<?php echo $row['payment_id'] ?>"> <?php echo $row['payment_id'] //echo $num ?> </a> </td>
                      <td class="text-center"><?php echo $row['credit']; ?></td>
                      <td class="text-center"><?php echo $row['debit']; ?></td>
                    </tr>
                    <?php } ?>

                    <!-- <tr>
                      <td class="text-center">2</td>
                      <td>
                        <p class="font-w600 mb-1 text-center">2019-07-18</p>
                         <div class="text-muted">Design/Development for all popular modern browsers</div>
                      </td>
                      <td class="text-center">
                        Oupa Mosotho
                      </td>
                      <td class="text-center">0</td>
                      <td class="text-center">3500</td>
                    </tr> -->

                    <tr>

                      <?php $balance = number_format($last_balance, 2);
                      if($last_balance >= 0) 
                      { 
                        
                      ?>
                        
                        <td colspan="4" class="font-weight-bold text-uppercase text-right">Current Balance</td>
                        <td class="font-weight-bold text-center">R <?php echo $balance; ?> </td>
                        <!-- <td class="font-weight-bold text-center"> </td> -->
                        
                      <?php 
                      }
                      else 
                          {?>
                              <td colspan="5" class="font-weight-bold text-uppercase text-right">Due to us</td>
                              <td class="font-weight-bold text-center">(R<?php echo substr($balance,1); ?>) </td>
                          <?php
                          }?>

                    </tr>
                    
                    
                  </table>
                </div>
                <p class="text-muted text-center">Thank you very much for doing business with us. We look forward to working with you again!</p>
              </div>
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