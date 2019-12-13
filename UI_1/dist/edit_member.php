<?php 
require 'core/init.php';
$general->logged_out_protect();
$username = htmlentities($user['username']);

$member_id =$_GET['member_id'];
$view_member = $member->memberdata($member_id);
foreach ($view_member as $row) 
{

}

if (isset($_POST['submit'])) {
    
  if(empty($_POST['first_name']) || empty($_POST['last_name']) || empty($_POST['gender']) || empty($_POST['contact_num']))
	{
		$errors[] = 'You must fill in all of the fields.';
  }

  else
      if (strlen($_POST['contact_num']) !=10)
      {
          $errors[] = 'Your Contact number must be 10 characters, without spacing';
      }
	
	if(empty($errors) === true)
	{		
        $first_name   = $_POST['first_name'];
        $last_name    = $_POST['last_name'];
        $gender       = $_POST['gender'];
        $contact_num  = $_POST['contact_num'];

		    $member->updateMember($first_name, $last_name, $gender, $contact_num, $member_id);
        {
            Print '<script>alert("Member Successfully edited");;
            window.location.assign("index.php")</script>';

			    exit();    
        }
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
              <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">

                  <li class="nav-item">
                    <a href="./index.php" class="nav-link active"><i class="fe fe-home"></i> Home</a>
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
                <a href="./view_members.php?society_id=<?php echo $row['society_id'] ?>" style="text-decoration: none;"> <i class="fe fe-arrow-left"></i>View Member Details</a> | Edit Member Details
              </h1>
            </div>


            <div class="row row-cards row-deck">
              <div class="col-lg-5">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Member Details</h3>
                  </div>

                  <div class="card-body">
                    <form action="" method="">
                      <div class="row">
                        <div class="col-auto">
                          <span class="avatar avatar-xl" style="background-image: url(demo/faces/avator/avatar-001.jpg)"></span>
                        </div>
                        <div class="col">
                          <div class="form-group">
                            <label class="form-label">Society Name : <?php echo $row['society_name'] ?></label>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

              <div class="col-lg-7">
                <div class="card">
                  <div class="card-body">
                    <?php 
                    if(empty($errors) === false)
                    {
                      echo '<p class="text-center">' . implode('</p><p>', $errors) . '</p>';  
                    }?>
                    <div class="card">
                      <div class="card-body">
                        <h3 class="card-title">
                          Edit Member Details
                        </h3>
                        <form>
                      
                          <div class="form-group">
                            <label class="form-label">First name</label>
                            <input type="text" name="first_name" class="form-control" placeholder="First Name" value="<?php echo $row['first_name']?>" >
                          </div>

                          <div class="form-group">
                            <label class="form-label">Last Name</label>
                            <input type="text" name="last_name" class="form-control" placeholder="Last Name" value="<?php echo $row['last_name']?>">
                          </div>

                          <div class="form-group">
                                <label class="gender">Gender</label>
                                <select name = gender class="form-control">
                                    <option ><?php echo $row['gender'] ?>  </option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                          </div>

                          <div class="form-group">
                            <label class="form-label">Contact Number</label>
                            <input type="number" name="contact_num" class="form-control" placeholder="Contact Number" value="<?php echo $row['contact_num']?>">
                          </div>

                          <div class="card-footer">
                            <button onclick ="return confirm('Are you sure you want to edit <?php echo $row['first_name'] ?> <?php echo $row['last_name'] ?>?')" type="submit" name="submit" class="btn btn-primary btn-block" > Update Member</button>
                          </div>

                        </form>

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