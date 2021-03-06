<?php
require 'core/init.php';
$general->logged_in_protect();
      
if (empty($_POST) === false) {

	$email = trim($_POST['email']);
	$password = trim($_POST['password']);

	if (empty($email) === true || empty($password) === true) {
		$errors[] = 'Sorry, but we need your email and password.';
	} else if ($users->user_exists($email) === false) {
		$errors[] = 'Sorry that email doesn\'t exist';
	//} else if ($users->email_confirmed($username) === false) {
	//	$errors[] = 'Sorry, but you need to activate your account. 
	//				 Please check your email.';
	} else {
		if (strlen($password) > 18) {
			$errors[] = 'The password should be less than 18 characters, without spacing.';
		}
		$login = $users->login($email, $password);
		if ($login === false) {
			$errors[] = 'Sorry, that email or password is invalid';
		}else {
			$_SESSION['id'] =  $login;
			header('Location: index.php');
			exit();
		}
	}
} 
?>

<!doctype html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en" />
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#4188c9">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <link rel="icon" href="./favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />
    <!-- Generated: 2018-04-16 09:29:05 +0200 -->
    <title>Login page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
    <script src="./assets/js/require.min.js"></script>
    <script>
      requirejs.config({
          baseUrl: '.'
      });
    </script>
    <!-- Dashboard Core -->
    <link href="./assets/css/dashboard.css" rel="stylesheet" />
    <script src="./assets/js/dashboard.js"></script>
    <!-- c3.js Charts Plugin -->
    <link href="./assets/plugins/charts-c3/plugin.css" rel="stylesheet" />
    <script src="./assets/plugins/charts-c3/plugin.js"></script>
    <!-- Google Maps Plugin -->
    <link href="./assets/plugins/maps-google/plugin.css" rel="stylesheet" />
    <script src="./assets/plugins/maps-google/plugin.js"></script>
    <!-- Input Mask Plugin -->
    <script src="./assets/plugins/input-mask/plugin.js"></script>
  </head>
  <body class="">
    <div class="page">
      <div class="page-single">
        <div class="container">
          <div class="row">
            <div class="col col-login mx-auto">
              <div class="text-center mb-6">
                <img src="./demo/brand/S  F Logo.jpg" class="h-6" alt="">
              </div>
              <form class="card" action="" method="post" >
                <div class="card-body p-6">
                  <div class="card-title">Login to your account</div>
                  <!-- <?php //if(isset($_POST['submit']) && empty($_POST['email']) === true || empty($_POST['password']) === true ) {?> <span class="form-required">*</span> Required Fields<?php //} ?> -->
                  <fieldset class="form-fieldset">
                  <div class="form-group">
                    <label class="form-label">Email address <?php if(isset($_POST['submit']) && empty($_POST['email']) ){ ?><span class="form-required">*</span><?php } ?> </label>
                    <input type="text" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" value="<?php if(isset($_POST['email'])) echo htmlentities($_POST['email']); ?>">
                  </div>
                  <div class="form-group">
                    <label class="form-label">
                      Password 
                      <a href="./forgot-password.php" class="float-right small">I forgot password</a>
                      <?php if(isset($_POST['submit']) && empty($_POST['password']) ){ ?><span class="form-required">*</span><?php } ?></label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                  </div>
                  </fieldset>
                  <div class="form-footer">
                    <button type="submit" name="submit" class="btn btn-primary btn-block">Sign in</button>
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
                <!-- Don't have account yet? <a href="./register.php">Sign up</a> -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>