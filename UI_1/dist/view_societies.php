<?php
require 'core/init.php';
$general->logged_out_protect();

$id = htmlentities($user['id']);
$username = htmlentities($user['username']);

$view_societies = $society->societyInformation();
$view_admin = $users->userdata($id);

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

                  <!-- <input type="search" class="form-control header-search" placeholder="Enter Society name" tabindex="1">
                  <div class="input-icon-addon">
                    <i class="fe fe-search"></i>
                  </div> -->
                
                  <br>
                  <div class="form-group">
                          <!-- <label class="form-label">Separated inputs</label> -->
                          <div class="row gutters-xs">
                            <div class="col">
                              <input type="text" name="search" id="search_text" class="form-control" placeholder="Enter Society Name" required="required">
                            </div>
                            <span class="col-auto">
                              <button class="btn btn-secondary" type="submit" name="submit"><i class="fe fe-search"></i></button>
                              
                            </span>
                          </div>
                        </div>
                </form>
              </div>
              <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                  <li class="nav-item">
                    <a href="./index.php" class="nav-link active"><i class="fe fe-home"></i> Home</a>

                    
                  <!-- </li>
                  <li class="nav-item">
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
<!-- 
                  <li class="nav-item dropdown">
                    <a href="./transactions.html" class="nav-link"><i class="fe fe-file"></i>View Statement</a>
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
                  
                  <!-- <a href="./create_society.php" class="btn btn-md btn-outline-primary" >Add a new Society</a> -->

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
                          <a href="index.php" style="text-decoration: none;"> <i class="fe fe-arrow-left"></i>Home</a> | Society Details
                        </h1>
                  </div>
      
                  <!-- <div class="row"> -->
      
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
      
                                          <form action="" method="post" class="text-center">
                  

                                              <!-- <div class="col-lg-14">
                                                  <div class="card">
                                                    <div class="card-header">
                                                      <h3 class="card-title">Search</h3>
                                                       <div class="card-options">
                                                       
                                                          <div class="input-group">
                                                            <input type="text" class="form-control form-control-sm" placeholder="Enter Society Name" name="s">
                                                            <span class="input-group-btn ml-2">
                                                              <button class="btn btn-sm btn-default" type="submit">
                                                                <span class="fe fe-search"></span>
                                                              </button>
                                                            </span>
                                                          </div>
                                  
                                                          
                                  
                                                      </div>
                                                    </div>
                                                    </div>
                                              </div> -->




                                              

                                                      <?php 
                                          if(empty($errors) === false)
                                          {	
                                          ?>
                                            <form action="" method="post" class="text-center">
                                              <div class="form-group">
                                                <h3>Sorry!!! <br>
                                                  Society name: "<?php echo ucfirst($search) ?>" does'nt exist
                                                  <br>
                                              </div>
                                              <div class="form-group">
                                                <button class="btn btn-secondary" type="submit" name="submit1" >Click here to view all societies</button>
                                              </div>
                                                </h3>
                                            </form>
    
                                        <?php }?>
    
    
    
                                                  
    
                                                  <?php 
                                                      if(empty($errors) === true){   
                                                        
                                                  ?><div class="row row-cards row-deck">
              
                                                  <div class="col-12">
                                                    <h1 class="page-title">
                                                      <div class="form-group">
                                                      <?php if(isset($_POST['submit']))
                                                      {
                                                          echo 'Results for Society Name: "'.ucfirst($search).'"'; 
                                                      } 
                                                      ?>
                                                      </div>
                                                    </h1>
                                                    <div class="card">
                                                        <table class="table table-hover table-outline table-vcenter text-nowrap card-table" id="table-data">
                                                          <thead>

                                                            <tr>
                                                              <th class="text-center w-1"><i class="icon-people"></i></th>
                                                              <th>Society Name</th>
                                                              <th>Opening Balance</th>
                                                              <!-- <th class="text-center">Payment</th> -->
                                                              <th>Date Inception</th>
                                                             <!-- <th class="text-center">Location</th>-->
                                                              <th class="text-center">Location<i class="icon-settings"></i></th>
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
                                                              
                                                                <div> <?php echo $row['society_name']; ?> </div>
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
                                                                 <div><?php echo $row['addr1']; ?></div>
                                                                   <div><?php echo $row['addr2']; ?></div>
                                                                     <div><?php echo $row['addr3']; ?></div>
                                                                     <div><?php echo $row['addr4']; ?></div>
                                                                </div>
                                                              </td>
                                                              <td class="text-center">
                                                                <div class="item-action dropdown p-1">
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
                                              </div>
                                            
                                                                                           
                                          </form>
                  
                                  </div>
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

<script type="text/javascript">
    $(document).ready(function(){
        $("#search_text").keyup(function(){
            var search = $(this).val();
            $.ajax({
                url:'viewSocietyAction.php',
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