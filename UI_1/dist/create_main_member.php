<?php
require 'core/init.php';
$general->logged_out_protect();
$username = htmlentities($user['username']);

$provinceData = $main_member->allProvinceInformation();
$cityData = $main_member->allCityInformation();

$user_id = $_GET['user_id'];

if (isset($_POST['submit']))  
{
  	if($errors == false)
  	{
	    $first_name = trim($_POST['first_name']);
	    $last_name = trim($_POST['last_name']);
	    $contact_num = trim($_POST['contact_num']);
	  	$id_number = trim($_POST['id_number']);

	    if(empty($_POST['gender']) === true)
	    {
	        $errors[] = 'Please fill the gender field';
	    }
	    
	    else if (strlen($_POST['id_number']) !=13)
			{
			$errors[] = 'Your ID number number must be 13 characters, without spacing';
	    } 
			
	    else
	        if(!preg_match("/^[a-zA-Z ]*$/",$_POST['first_name']))
	        {
	          $errors[] = 'Only letters and white space allowed for First name';
	        }
	        
	        else
	            if(!preg_match("/^[a-zA-Z ]*$/",$_POST['last_name']))
	            {
	              $errors[] = 'Only letters and white space allowed for Last name';
	            }
	            
	                else
	                    if($main_member->member_id_exists($_POST['id_number']) === true) 
	                    {
	                        $errors[] = 'Sorry, That ID Number already exists.';
	                    }

	                    else
	                        if (strlen($_POST['contact_num']) !=10)
	                        {
	                            $errors[] = 'Your Contact number must be 10 characters, without spacing';
	                        }
	                  
	                        if(empty($errors) === true)
	                        {			
		                        $first_name 		= $_POST['first_name'];
		                        $last_name 			= $_POST['last_name'];
		                        $gender 		  	= $_POST['gender'];
		                        $contact_number = $_POST['contact_num'];
		                        $id_number 			= $_POST['id_number'];
		                        $province       = $_POST['province'];
		                        $city           = $_POST['city'];
		                        $suburb         = $_POST['suburb'];
		                        $street         = $_POST['street'];
		                        $plan_type      = $_POST['plan_type'];
		                        $premium        = $_POST['premium'];
		                        $cover          = $_POST['cover'];
		                        $policy_number  = $_POST['policy_number'];
		                          
		                        $main_member->create_member($user_id, $first_name, $last_name, $gender, $id_number, $contact_number, $province, $city, $suburb, $street, $plan_type, $premium, $cover, $policy_number);
		                          
		                        Print '<script>alert("Member successfully added");
		                        </script>';
		                          
		                        // header('Location:spouse.php?society_id='.$society_id);
	                        }
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
            <div class="nav-item d-md-flex">

            </div>
                    
             
              <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                  <li class="nav-item">
                    <a href="./index.php" class="nav-link"><i class="fe fe-home"></i> Home</a>
                  </li>

                  <li class="nav-item dropdown">
                    <a href="./view_members.php" class="nav-link active"><i class="fe fe-users"></i>View Main Members</a>
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
                <a href=""> <i class="fe fe-arrow-left"></i>Home</a> | Create a new member
              </h1>
            </div>
      
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <?php 
                  if(empty($errors) === false)
                  {
                    echo '<p class="text-center">' . implode('</p><p>', $errors) . '</p>';  
                  }
                  ?>
                  <form class="card" action="" method="POST">
                    <div class="card-body">
                      <div class="row">

                        <div class="col-sm-6 col-md-6">
                          <div class="form-group">
                            <label class="form-label">First Name(s)</label>
                            <input type="text" name="first_name" class="form-control" required="required" placeholder="Enter First Name" value="<?php if(isset($_POST['first_name'])) echo htmlentities($_POST['first_name']); ?>" >
                          </div>
                        </div>
                  
                        <div class="col-sm-6 col-md-6">
                          <div class="form-group">
                            <label class="form-label">Surname</label>
                            <input type="text" name="last_name" class="form-control" required="required" placeholder="Enter Last Name" value="<?php if(isset($_POST['last_name'])) echo htmlentities($_POST['last_name']); ?>" >
                          </div>
                        </div>

                        <div class="col-sm-6 col-md-6">
                          <div class="form-group">
                            <label class="form-label">Gender</label>
                            <select name="gender" class="form-control custom-select" required="true">
                                    <option value="<?php if(isset($_POST['gender'])) echo htmlentities($_POST['gender']); ?>" disabled selected>Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                            </select>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="form-label">Contact Number</label>
                            <input type="number" name="contact_num" class="form-control" required="required" placeholder="Enter Contact Number" value="<?php if(isset($_POST['contact_num'])) echo htmlentities($_POST['contact_num']); ?>">
                          </div>
                        </div> 

                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="form-label">ID Number</label>
                            <input type="number" name="id_number" class="form-control" required="required" placeholder="Enter ID Number" value="<?php if(isset($_POST['id_number'])) echo htmlentities($_POST['id_number']); ?>">
                          </div>
                        </div>

                        <div class="col-sm-6 col-md-6">
                          <div class="form-group">
                            <label class="form-label">Province</label>
                            <select name="province" class="form-control custom-select" required="true">
                              <option value="<?php if(isset($_POST['province'])) echo htmlentities($_POST['province']); ?>" disabled selected>Select Province</option>
                              <?php foreach($provinceData as $provincerow)
                              {?>
                                <option value="<?php echo $provincerow['province_name'] ?>"><?php echo $provincerow['province_name'] ?></option>
                              <?php
                              }?>
                            </select>
                          </div>
                        </div>

                        <div class="col-sm-6 col-md-6">
                          <div class="form-group">
                            <label class="form-label">City</label>
                            <input list="city" name="city" class="form-control" placeholder="Enter City" required="true" size="" value="<?php if(isset($_POST['city'])) echo htmlentities($_POST['city']); ?>" >
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

                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="form-label">Suburb</label>
                            <input type="text" name="suburb" class="form-control" placeholder="Enter suburb" value="<?php if(isset($_POST['suburb'])) echo htmlentities($_POST['suburb']); ?>">
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="form-label">Street</label>
                            <input type="text" name="street" class="form-control" placeholder="Enter street" value="<?php if(isset($_POST['street'])) echo htmlentities($_POST['street']); ?>">
                          </div>
                        </div>

                      </div>
                    </div>

                    <div class="card-body">
                      <div class="row">

                        <div class="col-sm-6 col-md-6">
                          <div class="form-group">
                            <label class="form-label">Plan type</label>
                            <select name="plan_type" class="form-control custom-select" required="true">
                              <option value="<?php if(isset($_POST['plan_type'])) echo htmlentities($_POST['plan_type']); ?>" disabled selected>Select plan type</option>
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
                            <input type="number" name="premium" class="form-control" placeholder="Enter premium" value="<?php if(isset($_POST['premium'])) echo htmlentities($_POST['premium']); ?>">
                          </div>
                        </div>

                        <div class="col-sm-6 col-md-6">
                          <div class="form-group">
                            <label class="form-label">Cover</label>
                            <input type="number" name="cover" class="form-control" placeholder="Enter cover" value="<?php if(isset($_POST['cover'])) echo htmlentities($_POST['cover']); ?>">
                          </div>
                        </div>

                        <div class="col-sm-6 col-md-6">
                          <div class="form-group">
                            <label class="form-label">Policy number</label>
                            <input type="text" name="policy_number" class="form-control" placeholder="Enter policy number" value="<?php if(isset($_POST['policy_number'])) echo htmlentities($_POST['policy_number']); ?>">
                          </div>
                        </div>

                      </div>

                      <div class="card-footer text-right">
                        <button type="submit" name="submit" class="btn btn-primary">Save member and continue</button>

                        <input type="reset" class="btn btn-primary" value="Reset" />
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
  </body>
</html>