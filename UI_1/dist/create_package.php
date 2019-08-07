<?php
require 'core/init.php';
$general->logged_out_protect();
$username = htmlentities($user['username']);

$society_id = $_GET['society_id'];

if (isset($_POST['submit'])) 
{
	$flower 		        = $_POST['flower'];
	$coffin 		    	= $_POST['coffin'];
	$grave_marker 	    	= $_POST['grave_marker'];
  $transport          	= $_POST['transport'];
  $funeral_service 		= $_POST['funeral_service'];

		if(empty($errors) === true)
		{			
            $package->create_package($society_id, $flower, $coffin, $grave_marker, $transport, $funeral_service);
        }
        
        Print '<script>alert("Package Successfully created");;
        window.location.assign("index.php")</script>';
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

              <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                  <!-- <li class="nav-item">
                    <a href="./index.php" class="nav-link"><i class="fe fe-home"></i> Home</a>
                  </li> -->
                  
                  <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link active"><i class="fe fe-layers"></i>Create Package</a>
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
                      <a href="index.php" style="text-decoration: none;"> <i class="fe fe-arrow-left"></i>Home</a> | Create Package
                    </h1>
              </div>
            <div class="row">
            <div class="col-lg-12">
              <form class="card" action="" method="post">
                <div class="card-body">
                  
                  <div class="row">
                    
                    <div class="col-sm-6 col-md-6">
                      <div class="form-group">
                        <label class="form-label">Flower</label>
                        <input type="number" name="flower" class="form-control" placeholder="Flower" >
                      </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                      <div class="form-group">
                        <label class="form-label">Coffin</label>
                        <input type="number" name="coffin" class="form-control" placeholder="Coffin" >
                      </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                      <div class="form-group">
                        <label class="form-label">Grave Marker</label>
                        <input type="number" name="grave_marker" class="form-control" placeholder="Grave Marker" >
                      </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                      <div class="form-group">
                        <label class="form-label">Transport</label>
                        <input type="number" name="transport" class="form-control" placeholder="Transport" >
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-label">Funeral Service</label>
                        <input type="number" name="funeral_service" class="form-control" placeholder="Funeral Service">
                      </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                      <div class="form-group">
                        <label class="form-label">Programmes</label>
                        <input type="number" disabled="true" name="programmes" class="form-control" placeholder="No Amount" >
                      </div>
                    </div>

                  </div>
                </div>
                <div class="card-footer text-right">
                  <button onclick ="return confirm('Are you sure you want to create that Package?')" type="submit" name="submit" class="btn btn-primary">Create</button>
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
            
          </div>
        </div>
      </div>
    </div>
    
    <?php include 'incl/footer.php' ;?>
  </div>
</body>
</html>