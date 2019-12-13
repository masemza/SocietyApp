<?php
require 'core/init.php';
$general->logged_out_protect();
$username = htmlentities($user['username']);

if (empty($_POST) === false) 
{
	$email = trim($_POST['email']);
	$password = trim($_POST['password']);

    if (empty($email) === true || empty($password) === true) 
    {
		$errors[] = 'Sorry, but we need your email and password.';
    } 
    else if ($users->user_exists_for_report($email) === false) 
    {
		$errors[] = 'Sorry that email doesn\'t exist';
    } 
    else 
    {
        if (strlen($password) > 18) 
        {
			$errors[] = 'The password should be less than 18 characters, without spacing.';
		}
		$login = $users->login_for_report($email, $password);
        if ($login === false)
        {
			$errors[] = 'Sorry, that email or password is invalid';
        }
        else 
        {
			$_SESSION['id'] =  $login;
			header('Location: view_report.php');
			exit();
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

              <div class="col-lg- ml-auto">
              </div>

              <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                  <li class="nav-item">
                    <a href="./index.php" class="nav-link "><i class="fe fe-home"></i> Home</a>
                  </li>

                  <li class="nav-item dropdown">
                    <a href="./manager.php" class="nav-link active"><i class="fe fe-file-text"></i>View Reports</a>
                  </li>

                  <!-- <li class="nav-item">
                    <a href="./gallery.html" class="nav-link"><i class="fe fe-image"></i> Logout</a>
                  </li> -->

                  <!-- <li class="nav-item">
                    <a href="./docs/index.html" class="nav-link"><i class="fe fe-file-text"></i> Documentation</a>
                  </li> -->

                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="my-3 my-md-5 ">
          <div class="container ">
            <div class="page-header">

              <h1 class="page-title">
              <a href="index.php" style="text-decoration: none;"> <i class="fe fe-arrow-left"></i>Home</a> | Report
              </h1>
            </div>
            <div class="page">
      <div class="page-single">
        <div class="container">
          <div class="row">
            <div class="col col-login mx-auto">
              <form class="card" action="" method="post" >
                <div class="card-body p-6">
                  <div class="card-title">Login to view report</div>
                  <div class="form-group">
                    <label class="form-label">Email address</label>
                    <input type="text" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" value="<?php if(isset($_POST['email'])) echo htmlentities($_POST['email']); ?>">
                  </div>
                  <div class="form-group">
                    <label class="form-label">
                      Password
                      <!-- <a href="./forgot-password.html" class="float-right small">I forgot password</a> -->
                    </label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                  </div>
                  <!-- <div class="form-group">
                    <label class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" />
                      <span class="custom-control-label">Remember me</span>
                    </label>
                  </div> -->
                  <div class="form-footer">
                    <button type="submit" name="submit" class="btn btn-primary btn-block">Sign in</button>
                  </div>
                </div> 
        
              </form>

              <br>
              <?php 
			          if(empty($errors) === false)
                {
                  echo '<p class="text-center">' . implode('</p><p>', $errors) . '</p>';	
                }
              ?>
            </div>
          </div>
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
    </div>
  </body>
</html>