<?php
require 'core/init.php';
$general->logged_out_protect();

$id = htmlentities($user['id']);
$username = htmlentities($user['username']);

//$view_package = $package->packageInformation();

$society_id = $_GET['society_id'];
$view_package = $package->packageData($society_id);
global $num;

$dirname = "demo/brand/S  F Logo";
$images = glob($dirname."*.jpg");

foreach($images as $image) 


?>




<!-- /*if (isset($_POST['submit']))
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
}*/

?> -->

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

                <!-- <form class="input-icon my-3 my-lg-0" action="" method="post">

                   <input type="search" class="form-control header-search" placeholder="Search&hellip;" tabindex="1">
                  <div class="input-icon-addon">
                    <i class="fe fe-search"></i>
                  </div> 

                  <br>
                  <div class="form-group">
                           <label class="form-label">Separated inputs</label> 
                          <div class="row gutters-xs">
                            <div class="col">
                              <input type="text" name="search" class="form-control" required="required" placeholder="Enter Society Name">
                            </div>
                            <span class="col-auto">
                              <button class="btn btn-secondary" type="submit" name="submit"><i class="fe fe-search"></i></button><br>
                            
                              
                            </span>
                          </div>
                        </div>

                </form> -->

              </div>

               <div class="col-lg order-lg-first"> 
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                  <li class="nav-item">
                    <a href="./index.php" class="nav-link active"><i class="fe fe-home"></i> Home</a>
                  </li>
                </ul>
              </div>
                  <!-- <li class="nav-item dropdown"> 
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

                </ul>
              </div>
            </div>
          </div>
        </div> -->

        
        
        
        <div class="my-3 my-md-5">
                <div class="container">
                  <div class="page-header">
                      <h1 class="page-title">
                          <a href="./view_statements.php" style="text-decoration: none;"> <i class="fe fe-arrow-left"></i>Society Details</a> | Package History Details
                        </h1>
                  </div>
        <div class="card">
              <div class="card-header">
                <h3 class="card-title"> Package</h3>
                <div class="card-options">
                  <button type="button" class="btn btn-primary btn-sm" onclick="javascript:window.print();"><i class="fe fe-download"></i> Download package</button>
              </div>
            </div>

              <div class="card-body">



                <div class=" text-center">
                    <p class="h2"> <u>PACKAGE</u> </p>
                </div>

                <div class="row my-6">
                  <div class="col-6">
                    <!-- <p class="h3">Company</p> -->
                    <?php foreach ($view_package as $row) ?>
                    
                    <?php
                        echo "<img src='$image' style='max-width:250px; max-height:250px;' /> ";
                    ?>
                  <br><p class="h5">PO Box 22
                  <br>Jane Furse 1085</p>
                  </div>
                  

                    <div class="col-6 text-right">
                      <p class="h2">SAMELLEN FUNERALS cc</p>
                      <p class="h4">T/A HELPMEKAAR FUNERAL PARLOUR C.C.</p>

                      <!-- <p class="h2">SESHEGO FUNERALS </p> -->

                      <br><br><br>
                      <p class="h5">
                          Tel: (013) 265 1031 <br>
                          Fax: (015) 223 0378 <br>
                          Email: 
                      </p>
                    </div>
                </div>
                          <div class="col-lg-12">
                                  <div class="card">

                                    <div class="card-body">
      
                                          <form action="" method="post" class="text-center">

                                              <div class="row row-cards row-deck">
              
                                                  <div class="col-12">
                                                  <?php 
                                                      if(empty($view_package)){ ?>
                                                        <h3>
                                                          Sorry!!! <br>
                                                          This Society does'nt have a Package <br>
                                                        </h3>
                                                          <div class="text-center">
                                                              <a href="./newPackage.php?society_id=<?php echo $society_id ?>" class="btn btn-sm btn-outline-primary" role="button"> Click here to create a Package </a>
                                                          </div>
                                                          
                                                      <?php } else {?>
                                                    <div class="card">
                                                      <div class="table-responsive">

                                                        <table class="table table-hover table-outline table-vcenter text-nowrap card-table ">
                                                          <thead>

                                                            <tr>
                                                              <th class="text-center w-1"><i class="icon-people"></i></th>
                                                              <th>Package was created on</th>
                                                              <th>Flowers</th>
                                                              <th>Coffins</th>
                                                              <th >Grave markers</th>
                                                              <th>Transports</th>
                                                              <th>Funeral service</th>
                                                              <!-- <th>Programmes</th> -->
                                                              <th>Total</th>
                                                              <th class="text-center"><i class="icon-settings"></i></th>
                                                            </tr>

                                                          </thead>
                                                          <tbody>
                                                          
                                                          <?php foreach ($view_package as $row) { ?>
                                                            <tr>
                                                              <td class="text-center">

                                                              </td>

                                                              <td>
                                                                <div> 
                                                                    <?php $date=date_create($row['package_created']);
                                                                        echo date_format($date,"d-m-Y"); 
                                                                    ?> 
                                                                </div>
                                                              </td>

                                                              <td>
                                                                <div> <?php echo $row['flower']; ?> </div>
                                                              </td>

                                                              <td>
                                                                <div> <?php echo $row['coffin']; ?> </div>
                                                              </td>
                                                              
                                                              <td class="text-center">
                                                                <div>
                                                                  <div><?php echo $row['grave_marker']; ?></div>
                                                                </div>
                                                              </td>

                                                              <td>
                                                                <div> <?php echo $row['transport']; ?> </div>
                                                              </td>
                                                              
                                                              <td class="text-center">
                                                                <div>
                                                                  <div><?php echo $row['funeral_service']; ?></div>
                                                                </div>
                                                              </td>

                                                              <!-- <td>
                                                                <div> <?php //echo $row['programmes']; ?> </div>
                                                              </td> -->
                                                              
                                                              <td class="text-center">
                                                                <div>
                                                                  <div><?php echo $row['total']; ?></div>
                                                                </div>
                                                              </td>

                                                              <td class="text-center">
                                                                <div class="item-action dropdown p-1">
                                                                  <a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i class="fe fe-more-vertical"></i></a>
                                                                  <div class="dropdown-menu dropdown-menu-right">
                                                                    <a href="./edit_package.php?package_id=<?php echo $row['package_id']?>" class="dropdown-item"><i class="dropdown-icon fe fe-edit"></i> Edit Package </a>
                                                                    <a href="./package.php?package_id=<?php echo $row['package_id']?>" class="dropdown-item"><i class="dropdown-icon fe fe-eye"></i> View Package </a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <a onclick ="return confirm('Are you sure you want to delete this Package?')" href="./delete_package.php?package_id=<?php echo $row['package_id'] ?>" class="dropdown-item"><i class="dropdown-icon fe fe-trash-2"></i> Remove Package</a>
                                                                    
                                                                   
                                                                    
                                                                  </div>
                                                                </div>
                                                              </td>
                                                            </tr>  
                                                            <?php } ?>

                                                          </tbody>
                                                        </table>
                                                          <?php } ?>
                                                        
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

      <?php include 'incl/footer.php' ;?>
    </div>
  </body>
</html>