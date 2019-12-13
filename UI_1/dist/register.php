<?php 
require 'core/init.php';
$general->logged_in_protect();

if (isset($_POST['submit'])) {

	if(empty($_POST['password']) || empty($_POST['email']) || empty($_POST['username'])){

		$errors[] = 'You must fill in all of the fields.';

	}else{
	      	      
        if ($users->username_exists($_POST['username']) === true) 
        {
            $errors[] = 'That username already exists';
        }
        else 
        if(!ctype_alnum($_POST['username']))
        {
            $errors[] = 'Please enter a username with only alphabets and numbers, with no spaces in between';	
        }

        if (strlen($_POST['password']) <6)
        {
            $errors[] = 'Your password must be atleast 6 characters';
        }
        else 
          if (strlen($_POST['password']) >18)
          {
              $errors[] = 'Your password cannot be more than 18 characters long';
          }
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) 
        {
            $errors[] = 'Please enter a valid email address';
        }
        else 
          if ($users->email_exists($_POST['email']) === true) 
          {
            $errors[] = 'That email already exists.';
          }
	}

	if(empty($errors) === true){
			
		$username 	= htmlentities($_POST['username']);
		$password 	= $_POST['password'];
		$email 		  = htmlentities($_POST['email']);
		
		$users->register($password, $email, $username);
		$login = $users->login($email, $password);
		if ($login === false) {
			$errors[] = 'Sorry, that email or password is invalid';
		}else {
			$_SESSION['id'] =  $login;
			header('Location: index.php');
			exit();
		}
		exit();
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
    <title>Registration page</title>
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
              <form class="card" action="" method="post">
                <div class="card-body p-6">
                  <div class="card-title">Create new account</div>
                  
                  <div class="form-group">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Enter username">
                  </div>

                  <div class="form-group">
                    <label class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter email">
                  </div>

                  <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password">
                  </div>

                  <!-- <div class="form-group">
                    <label class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" />
                      <span class="custom-control-label">Agree the <a href="terms.html">terms and policy</a></span>
                    </label>
                  </div> -->
                  <div class="form-footer">
                    <button type="submit" name="submit" class="btn btn-primary btn-block">Create new account</button>
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
                Already have account? <a href="./login.php">Sign in</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>