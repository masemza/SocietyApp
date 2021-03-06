<?php 
require 'core/init.php';
$general->logged_out_protect();
$username = htmlentities($user['username']);

$package_id =$_GET['package_id'];
$view_package = $package->package_data($package_id);
foreach ($view_package as $row) {}

$society_id = $package->get_society_id($package_id);

if (isset($_POST['submit'])) 
{
    if(empty($_POST['flower']) === true || empty($_POST['coffin']) === true || empty($_POST['grave_marker']) === true || empty($_POST['transport']) === true || empty($_POST['funeral_service']) )
    {
        $errors[] = 'You must fill in all of the fields';
    }
	
    if(empty($errors) === true)
    {		
        $flower   = $_POST['flower'];
        $coffin      = $_POST['coffin'];
        $grave_marker      = $_POST['grave_marker'];
        $transport   = $_POST['transport'];
        $funeral_service      = $_POST['funeral_service'];

		    $package->insert_package($society_id, $flower, $coffin, $grave_marker, $transport, $funeral_service);
            
        Print '<script>alert("Package Successfully updated");;
        window.location.assign("index.php")</script>';

		    exit();
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
                <a href="./view_package.php?society_id=<?php echo $society_id; ?>" style="text-decoration: none;"> <i class="fe fe-arrow-left"></i>View Packege History</a> | Edit Package Details
              </h1>
            </div>

            <div class="row row-cards row-deck">
              <div class="col-lg-12">
                <script>
                  require(['input-mask']);
                </script>
                
                <div class="card">
                  <div class="card-body">
                    <?php 
                    if(empty($errors) === false)
                    {
                      echo '<p class="text-center">' . implode('</p><p>', $errors) . '</p>';  
                    }?>

                    <div class="card">
                      <div class="card-body">
                        <h3 class="card-title">
                          Edit Package Details
                        </h3>
                        
                        <form action="" method="post">
                          
                          <div class="row">

                            <div class="col-sm-6 col-md-6">
                              <div class="form-group">
                                <label class="form-label">Flowers</label>
                                <input type="number" name="flower" class="form-control" value="<?php echo $row['flower']?>" >
                              </div>
                            </div>

                            <div class="col-sm-6 col-md-6">
                              <div class="form-group">
                                <label class="form-label">Coffins</label>
                                <input type="number" name="coffin" class="form-control" value="<?php echo $row['coffin']?>" >
                              </div>
                            </div>

                            <div class="col-sm-6 col-md-6">
                              <div class="form-group">
                                  <label class="form-label">Grave markers</label>
                                  <input type="number" name="grave_marker" class="form-control" value="<?php echo $row['grave_marker']?>" >
                              </div>
                            </div>

                            <div class="col-sm-6 col-md-6">
                              <div class="form-group">
                                  <label class="form-label">Transports</label>
                                  <input type="number" name="transport" class="form-control" value="<?php echo $row['transport']?>" >
                              </div>
                            </div>

                            <div class="col-sm-6 col-md-6">
                              <div class="form-group">
                                  <label class="form-label">Funeral services</label>
                                  <input type="number" name="funeral_service" class="form-control" value="<?php echo $row['funeral_service']?>" >
                              </div>
                            </div>

                            <div class="col-sm-6 col-md-6">
                              <div class="form-group">
                                  <label class="form-label">Programmes</label>
                                  <input type="number" disabled="true" name="programmes" class="form-control" placeholder="No Amount" value="<?php echo $row['programmes']?>" >
                              </div>
                            </div>
                          </div>

                      </div>

                      <div class="card-footer text-right">
                        <button onclick ="return confirm('Are you sure you want to edit this Package?')" type="submit" name="submit" class="btn btn-primary" > 
                          Update Package
                        </button>
                        <input type="reset" class="btn btn-primary" value="Reset" />
                      </div>

                        </form>
                    </div>
                  </div>    
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

      <?php include 'incl/footer.php' ;?>
  </body>
</html>