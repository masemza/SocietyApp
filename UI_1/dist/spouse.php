<?php
require 'core/init.php';
$general->logged_out_protect();
$username = htmlentities($user['username']);
$type = htmlentities($user['type']);

$main_member_id = $_GET['main_member_id'];

$spouse_data = $spouse->all_spouse_data($main_member_id);

if (isset($_POST['submit'])) 
{
  if($errors == false)
  {
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $contact_num = trim($_POST['contact_num']);
  	$id_number = trim($_POST['id_number']);

    if(empty($_POST['gender']) === true)
    {
        $errors[] = 'Please fill the gender field';
    }
    
    else if (strlen($_POST['id_number']) !=13)
		{
		$errors[] = 'Your ID number number must be 13 characters, without spacing';
    } 
		
    else
        if(!preg_match("/^[a-zA-Z ]*$/",$_POST['first_name']))
        {
          $errors[] = 'Only letters and white space allowed for First name';
        }
        
        else
            if(!preg_match("/^[a-zA-Z ]*$/",$_POST['last_name']))
            {
              $errors[] = 'Only letters and white space allowed for Last name';
            }
            
                else
                    if($spouse->spouse_id_exists($_POST['id_number']) === true) 
                    {
                        $errors[] = 'Sorry, That ID Number already exists.';
                    }

                    else
                        if (strlen($_POST['contact_num']) !=10)
                        {
                            $errors[] = 'Your Contact number must be 10 characters, without spacing';
                        }
                  
                        if(empty($errors) === true)
                        {			
                          $first_name 		= $_POST['first_name'];
                          $last_name 			= $_POST['last_name'];
                          $gender 		  	= $_POST['gender'];
                          $contact_number = $_POST['contact_num'];
                          $id_number 			= $_POST['id_number'];
                          $relation       = $_POST['relation'];
                          
                          $spouse->add_spouse($main_member_id, $first_name, $last_name, $gender, $id_number, $contact_number, $relation);
                          
                          Print '<script>alert("Spouse successfully added");
                          </script>';
                          
                          // header('Location:spouse.php?society_id='.$society_id);
                        }
  }
}

if (isset($_POST['skip'])) 
{
    header('Location: immediate_family.php?main_member_id='.$main_member_id);
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
            <div class="nav-item d-md-flex">

            </div>
                    
             
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
                  </li>

                  <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link active" data-toggle="dropdown"><i class="fe fe-users"></i>Manage Spouse</a>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="./view_spouse.php?main_member_id=<?php echo $main_member_id ?>" class="dropdown-item "><i class="fe fe-users"></i>View Spouse</a>
                      <a href="./spouse.php?main_member_id=<?php echo $main_member_id ?>" class="dropdown-item active"><i class="fe fe-user-plus"></i>Add Spouse</a>
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

                </ul>
              </div>
            </div>
          </div>
        </div>

        <div class="my-3 my-md-5">
          <div class="container">
            <div class="page-header">
              <h1 class="page-title">
                <a href="view_spouse.php?main_member_id=<?php echo $main_member_id?>"> <i class="fe fe-arrow-left"></i>View Spouse Details</a> | Add Spouse
              </h1>
            </div>

            <div class="row row-cards">
              <div class="col-sm-6 col-lg-4">
                <div class="card p-1 align-items-center">
                  <div class="d-flex align-items-center">
                    <div class="col-lg order-lg-first">
                      <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                        <li class="nav-item">
                          <a href="javascript:void(0)" class="nav-link active"><i class="fe fe-user-plus"></i>Add Spouse</a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-sm-6 col-lg-4">
                <div class="card p-1 align-items-center">
                  <div class="d-flex align-items-center">
                    <div class="col-lg order-lg-first">
                      <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                        <li class="nav-item">
                          <a href="./children.php?main_member_id=<?php echo $main_member_id ?>" class="nav-link"><i class="fe fe-user-plus"></i>Add Children</a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-sm-6 col-lg-4">
                <div class="card p-1 align-items-center">
                  <div class="d-flex">
                    <div class="col-lg order-lg-first">
                      <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                        <li class="nav-item">
                          <a href="./extended_family.php?main_member_id=<?php echo $main_member_id ?>" class="nav-link"><i class="fe fe-user-plus"></i>Add Extended Family</a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <?php 
            if(!empty($spouse_data))
            {?>
              <?php foreach($spouse_data as $spouse_row)
              {?>
                <div class="col-lg-12">
                  <div class="card">
                    <div class="card-body">
                      <div class="card-body">
                        <div class="row">

                          <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                              <label class="form-label">First Name(s)</label>
                              <input type="text" class="form-control" disabled="disabled" value="<?php echo $spouse_row['first_name'] ?>" >
                            </div>
                          </div>
                  
                          <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                              <label class="form-label">Surname</label>
                              <input type="text" class="form-control" disabled="disabled" value="<?php echo $spouse_row['last_name'] ?>" >
                            </div>
                          </div>

                          <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                              <label class="form-label">Gender</label>
                              <select class="form-control custom-select" disabled="disabled">
                                <option value="<?php echo $spouse_row['gender'] ?>" disabled selected>Select Gender</option>
                              </select>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="form-label">Contact Number</label>
                              <input type="number" class="form-control" disabled="disabled" value="<?php echo $spouse_row['contact_number'] ?>">
                            </div>
                          </div> 

                          <div class="col-md-12">
                            <div class="form-group">
                              <label class="form-label">ID Number</label>
                              <input type="number" class="form-control" disabled="disabled" value="<?php echo $spouse_row['id_number'] ?>">
                            </div>
                          </div>

                          <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                              <label class="form-label">Relation</label>
                              <select class="form-control custom-select" disabled="disabled">
                                <option disabled selected><?php echo $spouse_row['relation'] ?></option>
                              </select>
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php 
              }?>

              <div class="col-lg-12">
                <div class="card">
                  <a href="./children.php?main_member_id=<?php echo $main_member_id?>" class="btn btn-primary" role="button">Save and continue</a>
                </div>
              </div>

            <?php
            }?>

            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <?php 
                    if(empty($errors) === false)
                    {
                      echo '<p class="text-center">' . implode('</p><p>', $errors) . '</p>';  
                    }
                  ?>
      
                  <form class="card" action="" method="POST">
                    <div class="card-body">
                      <div class="row">

                        <div class="col-sm-6 col-md-6">
                          <div class="form-group">
                            <label class="form-label">First Name(s)</label>
                            <input type="text" name="first_name" class="form-control" required="required" placeholder="Enter First Name" value="<?php if(isset($_POST['first_name'])) echo htmlentities($_POST['first_name']); ?>" >
                          </div>
                        </div>
                  
                        <div class="col-sm-6 col-md-6">
                          <div class="form-group">
                            <label class="form-label">Surname</label>
                            <input type="text" name="last_name" class="form-control" required="required" placeholder="Enter Last Name" value="<?php if(isset($_POST['last_name'])) echo htmlentities($_POST['last_name']); ?>" >
                          </div>
                        </div>

                        <div class="col-sm-6 col-md-6">
                          <div class="form-group">
                            <label class="form-label">Gender</label>
                            <select name="gender" class="form-control custom-select" required="true">
                              <option value="<?php if(isset($_POST['gender'])) echo htmlentities($_POST['gender']); ?>" disabled selected>Select Gender</option>
                              <option value="Male">Male</option>
                              <option value="Female">Female</option>
                            </select>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="form-label">Contact Number</label>
                            <input type="number" name="contact_num" class="form-control" required="required" placeholder="Enter Contact Number" value="<?php if(isset($_POST['contact_num'])) echo htmlentities($_POST['contact_num']); ?>">
                          </div>
                        </div> 

                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="form-label">ID Number</label>
                            <input type="number" name="id_number" class="form-control" required="required" placeholder="Enter ID Number" value="<?php if(isset($_POST['id_number'])) echo htmlentities($_POST['id_number']); ?>">
                          </div>
                        </div>

                        <div class="col-sm-6 col-md-6">
                          <div class="form-group">
                            <label class="form-label">Relation</label>
                            <select name="relation" class="form-control custom-select" required="true">
                              <option value="<?php if(isset($_POST['relation'])) echo htmlentities($_POST['relation']); ?>" disabled selected>Select Spouse</option>
                              <option value="Husband">Husband</option>
                              <option value="Wife">Wife</option>
                            </select>
                          </div>
                        </div>    

                      </div>
                    </div>

                      <div class="card-footer text-right">
                        <button type="submit" name="submit" class="btn btn-primary">Add</button>
                        <input type="reset" class="btn btn-primary" value="Reset" />
                        <a href="./children.php?main_member_id=<?php echo $main_member_id?>" class="btn btn-primary" role="button">Skip</a>
                      </div>

                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    <?php include 'incl/footer.php' ;?>
  </body>
</html>