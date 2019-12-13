<?php 
require 'core/init.php';
$general->logged_out_protect();
$username = htmlentities($user['username']);
$type = htmlentities($user['type']);

$family_id = $_GET['family_id'];
$view_spouse = $spouse->spouse_data($family_id);
foreach($view_spouse as $spouse_row)
{
    $main_member_id = $spouse_row['main_member_id'];
}

if (isset($_POST['submit'])) 
{    
  	if(empty($_POST['first_name']) || empty($_POST['last_name']) || empty($_POST['gender']) || empty($_POST['contact_num']) || empty($_POST['relation']))
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
      	$first_name     = $_POST['first_name'];
      	$last_name      = $_POST['last_name'];
      	$gender         = $_POST['gender'];
      	$contact_number = $_POST['contact_num'];
      	$relation       = $_POST['relation'];

		    $spouse->update_spouse($first_name, $last_name, $gender, $contact_number, $relation, $family_id, $main_member_id);

        if($type == 'admin' || $type == 'manager')
        {
            Print '<script>alert("Spouse Successfully edited");;
            window.location.assign("manage_members.php")</script>';
        }
        else if($type == 'user')
        {
            Print '<script>alert("Spouse Successfully edited");;
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
                  <li class="nav-item">
                    <?php if($type == 'user')
                    {?>
                      <a href="./index.php" class="nav-link"><i class="fe fe-home"></i> Home</a>
                    <?php
                    }
                    else if($type == 'admin' || $type == 'manager')
                    {?>
                      <a href="./manage_members.php" class="nav-link"><i class="fe fe-home"></i> Home</a>
                    <?php
                    }?>

                    <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link active" data-toggle="dropdown"><i class="fe fe-users"></i>Manage Spouse</a>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="./view_spouse.php?main_member_id=<?php echo $main_member_id ?>" class="dropdown-item "><i class="fe fe-users"></i>View Spouse</a>
                      <a href="./spouse.php?main_member_id=<?php echo $main_member_id ?>" class="dropdown-item "><i class="fe fe-user-plus"></i>Add Spouse</a>
                      <a href="./edit_spouse.php?main_member_id=<?php echo $main_member_id ?>" class="dropdown-item active"><i class="fe fe-edit"></i>Edit Spouse</a>
                    </div>
                  </li>

                  <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-users"></i>Manage Children Details</a>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="./view_children.php?main_member_id=<?php echo $main_member_id ?>" class="dropdown-item "><i class="fe fe-users"></i>View Children</a>
                      <a href="./children.php?main_member_id=<?php echo $main_member_id ?>" class="dropdown-item "><i class="fe fe-user-plus"></i>Add A Child</a>
                    </div>
                  </li>

                  <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-users"></i>Manage Extended Family</a>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="./view_extended_family.php?main_member_id=<?php echo $main_member_id ?>" class="dropdown-item "><i class="fe fe-users"></i>View Extended Family</a>
                      <a href="./extended_family.php?main_member_id=<?php echo $main_member_id ?>" class="dropdown-item "><i class="fe fe-user-plus"></i>Add Extended Family</a>
                    </div>
                  </li>
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
                <a href="./view_spouse.php?main_member_id=<?php echo $spouse_row['main_member_id'] ?>" style="text-decoration: none;"> <i class="fe fe-arrow-left"></i>Spouse Details</a> | Edit Spouse Details
              </h1>
            </div>


            <div class="col-lg-12">
              <script>
                require(['input-mask']);
              </script>
              <div class="card">
                <div class="card-body">
                  <h3 class="card-title">Edit Member Details</h3>
                  <form action="" method="post">
                  
                      <div class="form-group">
                          <label class="form-label">First name(s)</label>
                          <input type="text" name="first_name" class="form-control" placeholder="First Name" value="<?php echo $spouse_row['first_name']?>" >
                      </div>

                      <div class="form-group">
                        <label class="form-label">Surname</label>
                        <input type="text" name="last_name" class="form-control" placeholder="Last Name" value="<?php echo $spouse_row['last_name']?>">
                      </div>

                      <div class="form-group">
                          <label class="gender">Gender</label>
                          <select name = gender class="form-control" required="true">
                              <option ><?php echo $spouse_row['gender'] ?></option>
                              <option value="Male">Male</option>
                              <option value="Female">Female</option>
                          </select>
                      </div>

                      <div class="form-group">
                        <label class="form-label">Contact Number</label>
                        <input type="number" name="contact_num" class="form-control" placeholder="Contact Number" value="<?php echo $spouse_row['contact_number']?>">
                      </div>

                      <div class="form-group">
                          <label class="relation">Relation</label>
                          <select name = "relation" class="form-control" required="true">
                              <option ><?php echo $spouse_row['relation'] ?></option>
                              <option value="Husband">Husband</option>
                              <option value="Wife">Wife</option>
                          </select>
                      </div>

                    <div class="card-footer">
                      <button onclick ="return confirm('Are you sure you want to edit this spouse?')" type="submit" name="submit" class="btn btn-primary btn-block" > Update Spouse</button>
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

      <?php include 'incl/footer.php' ;?>
    </div>
  </body>
</html>