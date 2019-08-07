<?php
error_reporting(E_ALL);
require 'core/init.php';
$general->logged_out_protect();

//$id = htmlentities($user['id']);

$username = htmlentities($user['username']);

$society_id = $_GET['society_id'];
$view_package = $package->packageData($society_id);

// $view_package = $package->packageInformation();

foreach ($view_package as $package_row)
{
    $package_id = $package_row['package_id'];
    $flower = $package_row['flower'];
    $coffin = $package_row['coffin'];
    $grave_marker = $package_row['grave_marker'];
    $transport = $package_row['transport'];
    $funeral_service = $package_row['funeral_service'];
    $total = $package_row['total'];
    $package_created = $package_row['package_created'];
}

$date_of_updated_package = $package->get_updated_date($package_id);

//$view_updated_package = $package->updatedPackageData($package_id);

//$date = date_create($date_of_updated_package);


//$view_admin = $users->userdata($id);

/*if (isset($_POST['submit']))
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
            </div>
          </div>
        </div>

        
        
        
        <div class="my-3 my-md-5">
                <div class="container">
                  <div class="page-header">
                      <h1 class="page-title">
                          <a href="index.php" style="text-decoration: none;"> <i class="fe fe-arrow-left"></i>Home</a> | Package Details
                        </h1>
                  </div>
      
                          <div class="col-lg-12">
                                  <div class="card">

                                    <div class="card-body">
      
                                          <form action="" method="post" class="text-center">

                                              <div class="row row-cards row-deck">
              
                                                  <div class="col-12">
                                                    <div class="card">
                                                      <div class="table-responsive">

                                                        <table class="table table-hover table-outline table-vcenter text-nowrap card-table ">
                                                          <thead>

                                                            <tr>
                                                              <th class="text-center w-1"><i class="icon-people"></i></th>
                                                              <th>Package was Created On</th>



                                                                <?php if(!empty($date_of_updated_package)) { ?>
                                                                <th>Package was Updated On</th>
                                                                <?php } ?>



                                                              <th>Flowers</th>
                                                              <th>Coffins</th>
                                                              <th >Grave markers</th>
                                                              <th>Transports</th>
                                                              <th>Funeral services</th>
                                                              <!-- <th>Programmes</th> -->
                                                              <th>Total</th>
                                                              <th class="text-center"><i class="icon-settings"></i></th>
                                                            </tr>

                                                          </thead>
                                                          <tbody>
                                                          
                                                            <tr>
                                                              <td class="text-center">

                                                              </td>

                                                              <td>
                                                                <div> 
                                                                    <?php echo $package_created;
                                                                    ?> 
                                                                </div>
                                                              </td>



                                                                  <?php if(!empty($date_of_updated_package)) { ?>
                                                                  <td>
                                                                      <?php
                                                                          echo $date_of_updated_package;
                                                                      ?>
                                                                  </td>
                                                                  <?php }?> 



                                                              <td>
                                                                <div> <?php echo $flower; ?> </div>
                                                              </td>

                                                              <td>
                                                                <div> <?php echo $coffin; ?> </div>
                                                              </td>
                                                              
                                                              <td class="text-center">
                                                                <div>
                                                                  <div><?php echo $grave_marker; ?></div>
                                                                </div>
                                                              </td>

                                                              <td>
                                                                <div> <?php echo $transport; ?> </div>
                                                              </td>
                                                              
                                                              <td class="text-center">
                                                                <div>
                                                                  <div><?php echo $funeral_service; ?></div>
                                                                </div>
                                                              </td>

                                                              <!-- <td>
                                                                <div> <?php //echo $row['programmes']; ?> </div>
                                                              </td> -->
                                                              
                                                              <td class="text-center">
                                                                <div>
                                                                  <div><?php echo $total; ?></div>
                                                                </div>
                                                              </td>

                                                              <td class="text-center">
                                                                <div class="item-action dropdown p-1">
                                                                  <a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i class="fe fe-more-vertical"></i></a>
                                                                  <div class="dropdown-menu dropdown-menu-right">
                                                                    <a href="./edit_package.php?package_id=<?php echo $package_id ?>" class="dropdown-item"><i class="dropdown-icon fe fe-edit"></i> Edit Package </a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <a onclick ="return confirm('Are you sure you want to delete this Package?')" href="./delete_package.php?package_id=<?php echo $package_id ?>" class="dropdown-item"><i class="dropdown-icon fe fe-trash-2"></i> Remove Package</a>
 
                                                                  </div>
                                                                </div>
                                                              </td>
                                                            </tr> 
                                                                 
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

      <?php include 'incl/footer.php' ;?>
    </div>
  </body>
</html>