<?php
require 'core/init.php';
$general->logged_out_protect();
$username = htmlentities($user['username']);

if (isset($_POST['submit'])) 
{
	$society_name 		= $_POST['society_name'];
	//$location 			= $_POST['location'];
  $addr1            = $_POST['addr1'];
  $addr2            = $_POST['addr2'];
  $addr3            = $_POST['addr3'];
  $addr4            = $_POST['addr4'];

	$init_capital 		= $_POST['init_capital'];
	$date_inception 	= $_POST['date_inception'];
	
	global $payment_id;
	global $society_id;

	    if (strlen($_POST['init_capital']) <2)
		{
			$errors[] = 'Initial capital must be at least 2 characters';
        } 
		
		if(!preg_match("/^[a-zA-Z ]*$/",$society_name))
		{
			$errors[] = 'Only letters and white space allowed for society name';
		}

		if($society->society_name_exists($society_name) === true)
		{
			$errors[] = 'Sorry that society name already exist, select another society name';
		}

		if(empty($errors) === true)
		{			
	
			$society->register_society($society_id, $society_name, $addr1 , $addr2 , $addr3, $addr4, $init_capital, $date_inception);
	
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
                    <a href="./index.php" class="nav-link"><i class="fe fe-home"></i> Home</a>
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
                    <a href="./transactions.html" class="nav-link"><i class="fe fe-file"></i>View Statement</a>
                  </li> -->

                  <li class="nav-item dropdown">
                    <a href="./view_societies.php" class="nav-link active"><i class="fe fe-user"></i>View Societies</a>
                  </li>

                  
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
                      <a href="index.php" style="text-decoration: none;"> <i class="fe fe-arrow-left"></i>Home</a> | Create Society Profile
                    </h1>
              </div>
            <div class="row">
            <div class="col-lg-12">
              <form class="card" action="" method="post">
                <div class="card-body">
                  
                  <div class="row">
                    
                    <div class="col-sm-6 col-md-12">
                      <div class="form-group">
                        <label class="form-label">Society Name</label>
                        <input type="text" name="society_name" class="form-control" placeholder="Society Name" required="required" value="<?php if(isset($_POST['society_name'])) echo htmlentities($_POST['society_name']); ?>">
                      </div>
                    </div>

                    <!-- <div class="col-sm-6 col-md-4">
                      <div class="form-group">
                        <label class="form-label">Email address</label>
                        <input type="email" class="form-control" placeholder="Email">
                      </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                      <div class="form-group">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" placeholder="Password">
                      </div>
                    </div>   
                      <div class="col-sm-6 col-md-12">
                      <div class="form-group">
                        <label class="form-label">Location</label>
                        <input type="text" name="location" class="form-control" placeholder="Location" required="required" >
                      </div>
                    </div>                  -->

                

                      <div class="col-sm-6 col-md-12">
                  <div class="form-group">
                    <label class="form-label">Location </label>
                      <input type="text" name="addr1" class="form-control" placeholder="Street" value="<?php if(isset($_POST['addr1'])) echo htmlentities($_POST['addr1']); ?>"/>
                      </div>

                      <div class="form-group">
                      <input type="text" name="addr2" class="form-control" placeholder="Suburb" value="<?php if(isset($_POST['addr2'])) echo htmlentities($_POST['addr2']); ?>" />
                      </div>

                      <div class="form-group">
                      <input type="text" name="addr3" class="form-control" placeholder="City" required="required" value="<?php if(isset($_POST['addr3'])) echo htmlentities($_POST['addr3']); ?>"/>
                      </div>

                      <div class="form-group">
                      <input type="text" name="addr4" class="form-control" placeholder="Province" required="required" value="<?php if(isset($_POST['addr4'])) echo htmlentities($_POST['addr4']); ?>"/>
                      </div>
                  </div>


                    <div class="col-sm-6 col-md-6">
                      <div class="form-group">
                        <label class="form-label">Initial Capital</label>
                        <input type="number" name="init_capital" class="form-control" placeholder="Initial Capital" required="required" value="<?php if(isset($_POST['init_capital'])) echo htmlentities($_POST['init_capital']); ?>">
                      </div>
                    </div>



                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-label">Date Inception</label>
                        <input type="date" name="date_inception" class="form-control" required="required" value="<?php if(isset($_POST['date_inception'])) echo htmlentities($_POST['date_inception']); ?>">
                      </div>
                    </div>

                    <!-- <div class="col-sm-6 col-md-4">
                      <div class="form-group">
                        <label class="form-label">City</label>
                        <input type="text" class="form-control" placeholder="City" value="">
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                      <div class="form-group">
                        <label class="form-label">Postal Code</label>
                        <input type="text" class="form-control" placeholder="">
                      </div>
                    </div>
                    <div class="col-md-5">
                      <div class="form-group">
                        <label class="form-label">Company</label>
                        <input type="text" class="form-control" placeholder="Company" value="">
                      </div>
                    </div>                     -->
<!--                     <div class="col-md-5">
                      <div class="form-group">
                        <label class="form-label">Country</label>
                        <select class="form-control custom-select">
                          <option value="">Germany</option>
                        </select>
                      </div>
                    </div> -->
                    <!-- <div class="col-md-12">
                      <div class="form-group mb-0">
                        <label class="form-label">About Me</label>
                        <textarea rows="5" class="form-control" placeholder="Here can be your description" value="Mike">Oh so, your weak rhyme
You doubt I'll bother, reading into it
I'll probably won't, left to my own devices
But that's the difference in our opinions.</textarea>
                      </div>
                    </div> -->
                  </div>
                </div>
                <div class="card-footer text-right">
                  <button type="submit" name="submit" class="btn btn-primary">Add Society</button>
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
            <!-- <div class="col-lg-4">
              <script>
                require(['input-mask']);
              </script>
              <div class="card">
                <div class="card-body">
                  <h3 class="card-title">Investment Details</h3>
                  <form>
                    <div class="row">
                      <div class="col">
                      <div class="form-group">
                        <label class="form-label">Capital Invested</label>
                        <input type="text" name="field-name" class="form-control" data-mask="000.000.000.000.000,00" data-mask-reverse="true" autocomplete="off" maxlength="22">
                      </div>
                      </div>
                    </div>
                      <div class="form-group">
                        <label class="form-label">Investment Date</label>
                        <input type="text" name="field-name" class="form-control" data-mask="00/00/0000" data-mask-clearifnotmatch="true" placeholder="00/00/0000" autocomplete="off" maxlength="10">
                      </div>
                      <div class="form-group">
                        <label class="form-label">Product Type</label>
                        <select class="form-control custom-select">
                          <option value="">-Select-</option>
                          <option value="">Fixed</option>
                          <option value="">Variable</option>
                        </select>
                      </div>
                    <div class="card-footer">
                      <button class="btn btn-primary btn-block">Save</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>             -->
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