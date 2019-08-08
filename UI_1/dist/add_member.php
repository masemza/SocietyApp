<?php
require 'core/init.php';
$general->logged_out_protect();
$username = htmlentities($user['username']);

if (isset($_POST['submit'])) 
{
    global $society_id; 
    $society_name 	= $_POST['society_name'];
	  $first_name 		= $_POST['first_name'];
	  $last_name 			= $_POST['last_name'];
    $gender   			= $_POST['gender'];
    $contact_num 		= $_POST['contact_num'];
	  $id_number 			= $_POST['id_number'];
	
	    if (strlen($_POST['id_number']) !=13)
		  {
			$errors[] = 'Your ID number number must be 13 characters, without spacing';
      } 
		
      else
        if(!preg_match("/^[a-zA-Z ]*$/",$first_name))
		    {
			    $errors[] = 'Only letters and white space allowed for First name';
		    }
		
            else
            if(!preg_match("/^[a-zA-Z ]*$/",$last_name))
		        {
			        $errors[] = 'Only letters and white space allowed for Last name';
		        }
		
                else
                    if($member->member_id_exists($_POST['id_number']) === true) 
                    {
                        $errors[] = 'That ID Number already exists.';
                    }

                    else
                        if($society->society_name_exists($_POST['society_name']) == false)
                        {
                            $errors[] = 'Sorry that society name does\'nt exists';
                        }

                        else
                            if (strlen($_POST['contact_num']) !=10)
                            {
                                $errors[] = 'Your Contact number must be 10 characters, without spacing';
                            }
	
		if(empty($errors) === true)
		{			
			$society_id = $society->get_society_id($society_name);
			
			$member->register_member($society_id, $society_name, $first_name, $last_name, $gender, $contact_num, $id_number);
			
			Print '<script>alert("Member successfully added");
			window.location.assign("index.php")</script>';
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
                    <a href="./index.php" class="nav-link active"><i class="fe fe-home"></i> Home</a>
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
                    <a href="javascript:void(0)" class="nav-link"><i class="fe fe-file"></i>View Statement</a>
                  </li> -->

                  <!-- <li class="nav-item dropdown">
                    <a href="./form-elements.html" class="nav-link active"><i class="fe fe-check-square"></i> Forms</a>
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
                      <a href="index.php" style="text-decoration: none;"> <i class="fe fe-arrow-left"></i>Home</a> | Add a new member
                    </h1>
              </div>


        <div class="my-3 my-md-5">
          <div class="container">
            <div class="row">
            <div class="col-lg-12">
              
              
              <form class="card" action="" method="POST">
                <div class="card-body">
                  <div class="row">
                    
                    <div class="col-sm-6 col-md-12">
                      <div class="form-group">
                        <label class="form-label">Society Name</label>
                        <input type="text" name="society_name" required="required" class="form-control" placeholder="Society Name" value="<?php if(isset($_POST['society_name'])) echo htmlentities($_POST['society_name']); ?>">
                      </div>
                    </div>
                    
                    <div class="col-sm-6 col-md-6">
                      <div class="form-group">
                        <label class="form-label">First Name</label>
                        <input type="text" name="first_name" required="required" class="form-control" placeholder="First Name" value="<?php if(isset($_POST['first_name'])) echo htmlentities($_POST['first_name']); ?>">
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
                      <div class="form-group">
                        <label class="form-label">Last Name</label>
                        <input type="text" name="last_name" required="required" class="form-control" placeholder="Last Name" value="<?php if(isset($_POST['last_name'])) echo htmlentities($_POST['last_name']); ?>">
                      </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                      <div class="form-group">
                        <label class="form-label">Gender</label>
                        <select class="form-control custom-select" name="gender" required="required">
                                <option value="<?php if(isset($_POST['gender'])) echo htmlentities($_POST['gender']); ?>" disabled selected>Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-label">Contact Number</label>
                        <input type="number" name="contact_num" required="required" class="form-control" placeholder="Contact Number" value="<?php if(isset($_POST['contact_num'])) echo htmlentities($_POST['contact_num']); ?>">
                      </div>
                    </div> 

                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-label">ID Number</label>
                        <input type="number" name="id_number" required="required" class="form-control" placeholder="ID NUmber" value="<?php if(isset($_POST['id_number'])) echo htmlentities($_POST['id_number']); ?>">
                      </div>
                    </div>                    
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
                  <button type="submit" name="submit" class="btn btn-primary">Add Member</button>

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
            <div class="col-lg-4">
              <!-- <script>
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