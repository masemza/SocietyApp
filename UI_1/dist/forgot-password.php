<?php
require 'core/init.php';
$general->logged_in_protect();

if (isset($_POST['submit'])) 
{
    $email              = trim($_POST['email']);
    $new_password       = trim($_POST['new_password']);
	$confirm_password   = trim($_POST['confirm_password']);

    if (empty($email) === true || empty($new_password) === true || empty($confirm_password) === true) 
    {
		$errors[] = 'You must fill in all of the fields';
    }

    else if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) 
    {
        $errors[] = 'Please enter a valid email address';
    }

    else if ($users->email_exists($_POST['email']) === false) 
    {
        $errors[] = 'Sorry that email doesn\'t exist';
    }
        
    else if (strlen($_POST['new_password']) <6)
    {
        $errors[] = 'Your new password must be atleast 6 characters';
    }
    else if (strlen($_POST['new_password']) >18)
    {
        $errors[] = 'Your new password cannot be more than 18 characters long';
    }

    else if ((strlen($_POST['new_password'])) != (strlen($_POST['confirm_password'])))
    {
        $errors[] = 'New Password and Confirm password must be the same';
    }

    if(empty($errors) === true)
    {
        $user_id    = $users->get_user_id($email);
        $password   = $_POST['new_password'];

        $users->change_password($user_id, $password);
        
        $login = $users->login($email, $password);
        $_SESSION['id'] = $login;
        header('Location: index.php');
        
        Print '<script>alert("Password Successfully changed");;
        window.location.assign("login.php")</script>';  

    }
}

?>

<!doctype html>
<html lang="en" dir="ltr">
<?php include 'incl/head.php' ;?>
  <body class="">
    <div class="page">
      <div class="page-single">
        <div class="container">
          <div class="row">
            <div class="col col-login mx-auto">
              <div class="text-center mb-6">
                <img src="./demo/brand/S  F Logo.jpg" class="h-6" alt="">
              </div>
              <form class="card" action="" method="post">
                <div class="card-body p-6">
                  <div class="card-title">Forgot password</div>
                  <p class="text-muted">Enter your Email and your New password</p>
                    <br>
                  <div class="form-group">
                    <label class="form-label">Email address <?php if(isset($_POST['submit']) && empty($_POST['email']) ){ ?><span class="form-required">*</span><?php } ?> </label>
                    <input type="email" name="email" class="form-control" placeholder="Enter email" value="<?php if(isset($_POST['email'])) echo htmlentities($_POST['email']); ?>">
                  </div>

                  <div class="form-group">
                    <label class="form-label" for="exampleInputEmail1">New Password <?php if(isset($_POST['submit']) && empty($_POST['new_password']) ){ ?><span class="form-required">*</span><?php } ?> </label>
                    <input type="password" name="new_password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="New password">
                  </div>

                  <div class="form-group">
                    <label class="form-label" for="exampleInputEmail1">Confirm Password <?php if(isset($_POST['submit']) && empty($_POST['confirm_password']) ){ ?><span class="form-required">*</span><?php } ?></label>
                    <input type="password"  name="confirm_password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Confirm password">
                  </div>

                  
                  <div class="form-footer">
                    <button type="submit" name="submit" class="btn btn-primary btn-block">Resert Password</button>
                  </div>
                </div>

                <?php 
			        if(empty($errors) === false)
                    {
                        echo '<p class="text-center">' . implode('</p><p>', $errors) . '</p>';	
                    }
                ?>

              </form>
                <div class="text-center text-muted">
                    <a href="./login.php">Sign in</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>