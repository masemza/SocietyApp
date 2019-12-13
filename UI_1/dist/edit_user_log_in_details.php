<?php
require 'core/init.php';
$general->logged_out_protect();
$username = htmlentities($user['username']);
$type = htmlentities($user['type']);

$id = $_GET['user_id'];

$user_id = $id;

$view_user = $users->user_information($id);
foreach($view_user as $user_row)
{

}

$View_main_member = $main_member->memberdata2($id);
foreach($View_main_member as $main_member_row)
{
    $main_member_id = $main_member_row['main_member_id'];
}

if (isset($_POST['update_details'])) 
{
  if (empty($_POST['email']) === true || empty($_POST['username']) === true) 
    {
        $errors[] = 'You must fill in all of the fields';
    } 

    // else if ($users->email_exists($_POST['email']) === true) 
    // {
    //     $errors[] = 'That email already exists.';
    // } 

    else if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) 
    {
        $errors[] = 'Please enter a valid email address';
    }

    // else if ($users->username_exists($_POST['username']) === true) 
    // {
    //     $errors[] = 'That username already exists.';
    // }

    else if(!ctype_alnum($_POST['username']))
    {
        $errors[] = 'Please enter a username with only alphabets and numbers, with no spaces in between'; 
    }

    if(empty($errors) === true)
    {		
        $username   = $_POST['username'];
        $email      = $_POST['email'];

        $users->updateUser($email, $username, $id); 
        
        if($type == 'admin' || $type == 'manager')
        {
          header('Location: view_main_member.php?main_member_id='.$main_member_id);
        }
        else if($type == 'user')
        {
            Print '<script>alert("User Details Successfully Updated");;
            window.location.assign("index.php")</script>';
        }
    }
}

if (isset($_POST['change_password'])) 
{
    if (empty($_POST['new_password']) === true || empty($_POST['repeat_password']) === true) 
    {
        $errors[] = 'You must fill in all of the fields';
    } 

    else if (strlen($_POST['new_password']) < 6)
    {
        $errors[] = 'Password must be atleast 6 characters';
    }

    else if (strlen($_POST['new_password']) > 15)
    {
        $errors[] = 'Password cannot be more than 15 characters long';
    }

    else if (strlen($_POST['new_password']) != strlen($_POST['repeat_password']))
    {
        $errors[] = 'Your Passwords dont match';
    }

    if(empty($errors) === true)
    {   
        $password = $_POST['new_password'];

        $users->change_password($user_id, $password); 

        if($type == 'admin' || $type == 'manager')
        {
          header('Location: view_main_member.php?main_member_id='.$main_member_id);
        }
        else if($type == 'user')
        {
            Print '<script>alert("Password Successfully Changed");;
            window.location.assign("index.php")</script>';
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

              <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">

                  <?php if($type == 'admin' || $type == 'manager')
                  {?>
                    <li class="nav-item">
                      <a href="./manage_members.php" class="nav-link"><i class="fe fe-home"></i> Home</a>
                    </li>
                  <?php
                  }
                  else if($type == 'user')
                  {?>
                    <li class="nav-item">
                      <a href="./index.php" class="nav-link"><i class="fe fe-home"></i> Home</a>
                    </li>
                  <?php
                  }?>

                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="my-3 my-md-5">
          <div class="container">
              <div class="page-header">
                  <h1 class="page-title">
                    <?php if($type == 'admin' || $type == 'manager')
                    {?>
                      <a href="view_main_member.php?main_member_id=<?php echo $main_member_id ?>" style="text-decoration: none;"> <i class="fe fe-arrow-left"></i>Member Details</a> | Edit Details
                    <?php
                    }
                    else if($type == 'user')
                    {?>
                      <a href="index.php" style="text-decoration: none;"> <i class="fe fe-arrow-left"></i>Home</a> | Edit Details
                    <?php
                    }?>
                    </h1>
              </div>
            <div class="row">
            <div class="col-lg-12">
              <form class="card" action="" method="post">
                <div class="card-body">
                  <div class="row">
                  
                    <div class="col-sm-6 col-md-6">
                      <div class="form-group">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Enter username" value="<?php echo $user_row['username'] ?>">
                      </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                      <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter e-mail" value="<?php echo $user_row['email'] ?>">
                      </div>
                    </div>

                  </div>
                </div>

                <div class="card-footer text-right">
                  <button type="submit" name="update_details" class="btn btn-primary">Update Details</button>
                  <!-- <input type="reset" class="btn btn-primary" value="Reset" /> -->
                </div>

                
                    <div class="col-md-12">
                      <h1 class="page-title">
                        Change Password
                      </h1>
                      <div class="form-group">
                        <label class="form-label">New Password</label>
                        <input type="Password" name="new_password" class="form-control" placeholder="Enter new password" >
                      </div>
                    </div>

                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-label">Repeat Password</label>
                        <input type="Password" name="repeat_password" class="form-control" placeholder="Enter repeat password" >
                      </div>
                    </div>
                
                <div class="card-footer text-right">
                  <button type="submit" name="change_password" class="btn btn-primary">Change Password</button>
                  <!-- <input type="reset" class="btn btn-primary" value="Reset" /> -->
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

    <?php include 'incl/footer.php' ;?>
  </div>
</body>
</html>