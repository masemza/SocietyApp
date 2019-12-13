<?php
require 'core/init.php';
$general->logged_out_protect();
$username = htmlentities($user['username']);

if (isset($_POST['submit'])) 
{
  if (empty($_POST['email']) === true || empty($_POST['password']) === true || empty($_POST['username']) === true) 
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

    else if ($users->username_exists($_POST['username']) === true) 
    {
        $errors[] = 'That username already exists.';
    }

    else if(!ctype_alnum($_POST['username']))
    {
        $errors[] = 'Please enter a username with only alphabets and numbers, with no spaces in between'; 
    }

    else if (strlen($_POST['password']) < 6)
    {
        $errors[] = 'Password must be atleast 6 characters';
    }

    else if (strlen($_POST['password']) > 15)
    {
        $errors[] = 'Password cannot be more than 15 characters long';
    }

    if(empty($errors) === true)
    {		
      $username   = $_POST['username'];
      $email      = $_POST['email'];
      $password   = $_POST['password'];

      $main_member->register_user($password, $email, $username); 
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


                  <!-- <li class="nav-item dropdown">
                    <a href="./view_societies.php" class="nav-link active"><i class="fe fe-user"></i>View Main Members</a>
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
                      <a href="index.php" style="text-decoration: none;"> <i class="fe fe-arrow-left"></i>Home</a> | Create a new member 
                    </h1>
              </div>
            <div class="row">
            <div class="col-lg-12">
              <form class="card" action="" method="post">
                <div class="card-body">
                  <div class="row">
                    
                    <div class="col-sm-6 col-md-4">
                      <div class="form-group">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Enter username" required="required" value="<?php if(isset($_POST['username'])) echo htmlentities($_POST['username']); ?>">
                      </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                      <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter e-mail" required="required" value="<?php if(isset($_POST['email'])) echo htmlentities($_POST['email']); ?>">
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-label">Password</label>
                        <input type="Password" name="password" class="form-control" placeholder="Enter password" required="required" value="<?php if(isset($_POST['password'])) echo htmlentities($_POST['password']); ?>">
                      </div>
                    </div>

                  </div>
                </div>

                <div class="card-footer text-right">
                  <button type="submit" name="submit" class="btn btn-primary">Add member and continue</button>
                  <input type="reset" class="btn btn-primary" value="Reset" />


                <?php 
                if(empty($errors) === false)
                {
                  echo '<p class="text-center">' . implode('</p><p>', $errors) . '</p>';  
                }
                ?>
                </div>

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