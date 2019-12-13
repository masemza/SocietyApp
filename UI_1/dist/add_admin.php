<?php
require 'core/init.php';
$general->logged_out_protect();
$username = htmlentities($user['username']);

if (empty($_POST) === false) 
{
    $email    = trim($_POST['email']);
    $username = trim($_POST['username']);
	$password = trim($_POST['password']);

    if (empty($email) === true || empty($password) === true || empty($username) === true) 
    {
		$errors[] = 'You must fill in all of the fields';
    } 

    else if ($users->email_exists($_POST['email']) === true) 
    {
        $errors[] = 'That email already exists.';
    } 

    else if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) 
    {
        $errors[] = 'Please enter a valid email address';
    }

    else if ($users->username_exists($username) === true) 
    {
        $errors[] = 'That username already exists.';
    }

    else if(!ctype_alnum($username))
    {
        $errors[] = 'Please enter a username with only alphabets and numbers, with no spaces in between';	
    }

    else if (strlen($password) <6)
    {
        $errors[] = 'Your password must be atleast 6 characters';
    }

    else if (strlen($password) >18)
    {
        $errors[] = 'Your password cannot be more than 18 characters long';
    }

    if(empty($errors) === true)
    {
        
        $users->register($password, $email, $username);
        
        Print '<script>alert("Admin Successfully added");;
        window.location.assign("view_user.php")</script>';

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

              <div class="col-lg- ml-auto">
              </div>

              <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                  <li class="nav-item">
                    <a href="./index.php" class="nav-link "><i class="fe fe-home"></i> Home</a>
                  </li>

                  <li class="nav-item dropdown">
                    <a href="./add_admin.php" class="nav-link active"><i class="fe fe-user-plus"></i>Add a new admin</a>
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
              <a href="view_user.php" style="text-decoration: none;"> <i class="fe fe-arrow-left"></i>View Users</a> | Add a new Admin
              </h1>
            </div>
            <div class="page">
      <div class="page-single">
        <div class="container">
          <div class="row">
            <div class="col col-login mx-auto">
              <form class="card" action="" method="post" >
                <div class="card-body p-6">
                  <div class="card-title">Add a new admin</div>
                  <div class="form-group">
                    <label class="form-label">Email address <?php if(isset($_POST['submit']) && empty($_POST['email']) ){ ?><span class="form-required">*</span><?php } ?> </label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" value="<?php if(isset($_POST['email'])) echo htmlentities($_POST['email']); ?>">
                  </div>
                  
                    <div class="form-group">
                        <label class="form-label">Username <?php if(isset($_POST['submit']) && empty($_POST['username']) ){ ?><span class="form-required">*</span><?php } ?> </label>
                        <input type="text" name="username" class="form-control" placeholder="Enter username" value="<?php if(isset($_POST['username'])) echo htmlentities($_POST['username']); ?>">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Password <?php if(isset($_POST['submit']) && empty($_POST['password']) ){ ?><span class="form-required">*</span><?php } ?> </label>
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>

                  <div class="form-footer">
                    <button type="submit" name="submit" class="btn btn-primary btn-block">Add Admin</button>
                  </div>
                </div> 
                
                <?php 
			          if(empty($errors) === false)
                {
                  echo '<p class="text-center">' . implode('</p><p>', $errors) . '</p>';	
                }
              ?>

              </form>

              <br>
              
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