<?php
require 'core/init.php';
$general->logged_out_protect();
$username = htmlentities($user['username']);

$society_id = $_GET['society_id'];
$view_society = $society->societydata($society_id);

if (isset($_POST['submit'])) 
{
  global $society_name; 
  
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
                    if($member->member_id_exists($_POST['id_number']) === true) 
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
                          $first_name     = $_POST['first_name'];
                          $last_name      = $_POST['last_name'];
                          $gender         = $_POST['gender'];
                          $contact_num    = $_POST['contact_num'];
                          $id_number      = $_POST['id_number'];
                          $society_name = $member->get_society_name($society_id);
                          
                          $member->register_member($society_id, $society_name, $first_name, $last_name, $gender, $contact_num, $id_number);
                          
                          Print '<script>alert("Member successfully added");
                          </script>';
                          
                          header('Location:view_members.php?society_id='.$society_id);
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
              <div class="nav-item d-md-flex">
              </div>       
             
              <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                  
                  <li class="nav-item">
                    <a href="./index.php" class="nav-link"><i class="fe fe-home"></i> Home</a>
                  </li>
                  
                  <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link active" data-toggle="dropdown"><i class="fe fe-users"></i>Manage Members</a>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="./view_members.php?society_id=<?php echo $society_id ?>" class="dropdown-item "><i class="fe fe-users"></i>View Members</a>
                      <a href="./addMember.php?society_id=<?php echo $society_id; ?>" class="dropdown-item active"><i class="fe fe-user-plus"></i>Add A New Member</a>
                    </div>
                  </li>

                  <li class="nav-item dropdown">
                    <a href="./view_package.php?society_id=<?php echo $society_id ?>" class="nav-link"><i class="dropdown-icon fe fe-layers"></i> View Package</a>
                  </li>

                  <li class="nav-item dropdown">
                    <a href="./view_society_funeral_arrangement.php?society_id=<?php echo $society_id ?>" class="nav-link"><i class="dropdown-icon fe fe-activity"></i> View Funeral Arrangements</a>
                  </li>

                  <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-menu"></i>More</a>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="./create_invoice.php" class="dropdown-item "><i class="fe fe-file-plus"></i>Capture Invoice</a>
                      <a href="./create_expense.php" class="dropdown-item "><i class="fe fe-file-plus"></i>Capture Expense</a>
                      <a href="./view_report.php" class="dropdown-item "><i class="fe fe-file-text"></i>View Report</a>
                      <a href="./manage_members.php" class="dropdown-item "><i class="fe fe-users"></i>Main Member's Dashboard</a>
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
                          <a href="view_statements.php?society_id=<?php echo $society_id ?>" style="text-decoration: none;"> <i class="fe fe-arrow-left"></i>Society Details</a> | Add a new Member
                        </h1>
                  </div>
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

                      <?php foreach ($view_society as $row) { ?>
                        <input type="hidden" value="<?php echo $row['society_id']?>" />

                      <?php } ?>
                        
                      <label class="form-label">First Name</label>
                      <input type="text" name="first_name" class="form-control" required="required" placeholder="First Name" value="<?php if(isset($_POST['first_name'])) echo htmlentities($_POST['first_name']); ?>" >
                      
                    </div>
                    
                  </div>
                  
                  <div class="col-sm-6 col-md-6">
                  
                  <div class="form-group">
                  <label class="form-label">Last Name</label>
                  <input type="text" name="last_name" class="form-control" required="required" placeholder="Last Name" value="<?php if(isset($_POST['last_name'])) echo htmlentities($_POST['last_name']); ?>" >
                  
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
                        <input type="number" name="contact_num" class="form-control" required="required" placeholder="Contact Number" value="<?php if(isset($_POST['contact_num'])) echo htmlentities($_POST['contact_num']); ?>">
                      </div>
                    </div> 

                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-label">ID Number</label>
                        <input type="number" name="id_number" class="form-control" required="required" placeholder="ID NUmber" value="<?php if(isset($_POST['id_number'])) echo htmlentities($_POST['id_number']); ?>">
                      </div>
                    </div>          



                    </div>
                </div>

                <div class="card-footer text-right">
                  <button type="submit" name="submit" class="btn btn-primary">Save Member</button>

                  <input type="reset" class="btn btn-primary" value="Reset" />
                </div>

              </form>

            </div>
            <div class="col-lg-4">

                                  </div>
                                  </div>
                                </div>
      
                </div>
              </div>
      
    </div>
    <?php include 'incl/footer.php' ;?>
  </body>
</html>