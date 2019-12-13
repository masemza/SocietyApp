<?php
require 'core/init.php';
$general->logged_out_protect();
$username = htmlentities($user['username']);
$type = htmlentities($user['type']);

$main_member_id = $_GET['main_member_id'];
$view_member = $main_member->memberdata($main_member_id);
foreach($view_member as $member_row)
{

}

if (isset($_POST['pay_premium'])) 
{
    $name 		= $member_row['first_name'].' '.$member_row['last_name'];
    $amount       = $_POST['amount'];
    $date_of_premium       = $_POST['date_of_premium'];

    if(empty($amount) === true || empty($date_of_premium) === true)
    {
        $errors[] = 'You must fill in all of the fields';
    }

		else
    if ($amount < 2)
		{
        $errors[] = 'Your amount must be atleast 2 characters';
    }

    else
    if(!preg_match("/^[a-zA-Z ]*$/",$name))      
    {
        $errors[] = 'Only letters and white space allowed for first name(s)';
    }
			
		if(empty($errors) === true)
		{			
        $last_balance = $main_member->get_last_balance($main_member_id);
			
			  $balance = $last_balance + $amount;

			  $main_member->pay_premium($name, $amount, $date_of_premium, $balance, $main_member_id);

			  Print '<script>alert("Money Deposited Successfully");
			  window.location.assign("index.php")</script>';

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
                      <a href="./index.php" class="nav-link active"><i class="fe fe-home"></i> Home</a>
                    <?php
                    }
                    else if($type == 'admin' || $type == 'manager')
                    {?>
                      <a href="./manage_members.php" class="nav-link active"><i class="fe fe-home"></i> Home</a>
                    <?php
                    }?>
                  </li>

                  <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-users"></i>Manage Spouse</a>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="./view_spouse.php?main_member_id=<?php echo $main_member_id ?>" class="dropdown-item "><i class="fe fe-users"></i>View Spouse</a>
                      <a href="./spouse.php?main_member_id=<?php echo $main_member_id ?>" class="dropdown-item "><i class="fe fe-user-plus"></i>Add Spouse</a>
                    </div>
                  </li>

                  <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-users"></i>Manage Immediate Family</a>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="./view_immediate_family.php?main_member_id=<?php echo $main_member_id ?>" class="dropdown-item "><i class="fe fe-users"></i>View Immediate Family</a>
                      <a href="./immediate_family.php?main_member_id=<?php echo $main_member_id ?>" class="dropdown-item "><i class="fe fe-user-plus"></i>Add Immediate Family</a>
                    </div>
                  </li>

                  <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-users"></i>Manage Extended Family</a>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="./view_extended_family.php?main_member_id=<?php echo $main_member_id ?>" class="dropdown-item "><i class="fe fe-users"></i>View Extended Family</a>
                      <a href="./extended_family.php?main_member_id=<?php echo $main_member_id ?>" class="dropdown-item "><i class="fe fe-user-plus"></i>Add Extended Family</a>
                    </div>
                  </li>

                  <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-menu"></i>More</a>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="./member_details.php?main_member_id=<?php echo $main_member_id ?>" class="dropdown-item"><i class="fe fe-users"></i>View All Members </a>
                      <?php if($type === "manager") 
                      {?>
                          <a href="./view_member_report.php" class="dropdown-item"><i class="fe fe-file-text"></i> View Reports </a>
                      <?php 
                      }?>
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
                <a href="view_main_member.php?main_member_id=<?php echo $main_member_id ?>" style="text-decoration: none;"> <i class="fe fe-arrow-left"></i>Member Details</a> | Pay Premium  
              </h1>
            </div>

            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <br>
                  <?php 
                  if(empty($errors) === false)
                  {
                    echo '<p class="text-center">' . implode('</p><p class="text-center">', $errors) . '</p>';  
                  }
                  ?>
                  <form action="" method="POST">

                    <fieldset class="form-fieldset">
                      
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="form-label">Full Name(s)</label>
                          <input type="text" name="name" disabled="disabled" class="form-control" placeholder="Enter your names" value="<?php echo $member_row['first_name'].' '.$member_row['last_name'] ?>" />
                        </div>
                      </div>

                      <hr>

                      <div class="col-md-12">
                        <div class="form-group">
                        <h3 class="card-title">Location</h3>
                          <label class="form-label">Street</label>
                          <input disabled="disabled" type="text" name="field-name" class="form-control" value="<?php echo $member_row['street']?> ">
                        </div>
                          
                        <div class="form-group">
                          <label class="form-label">Suburb</label>
                          <input disabled="disabled" type="text" name="field-name" class="form-control" value="<?php echo $member_row['suburb']?> ">
                        </div>  
                          
                        <div class="form-group">
                          <label class="form-label">City</label>
                          <input disabled="disabled" type="text" name="field-name" class="form-control" value="<?php echo $member_row['city']?> ">
                        </div>

                        <div class="form-group">
                          <label class="form-label">Province</label>
                          <input disabled="disabled" type="text" name="field-name" class="form-control" value="<?php echo $member_row['province']?> ">
                        </div>
                      </div>

                      <hr>

                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="form-label">Amount </label>
                          <input type="number" name="amount" required="required" class="form-control" placeholder="Enter amount" value="" />
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="form-label">Being paid for</label>
                          <input type="text" name="date_of_premium" class="form-control" required="required" value="<?php if(isset($_POST['date_of_premium'])) echo htmlentities($_POST['date_of_premium']); ?>">
                        </div>
                      </div>

                    </fieldset>
                               
                    <div class="btn-list text-center">
                      <input onclick ="return confirm('Are you sure you want to pay this money?')" type="submit" name="pay_premium" class="btn btn-primary" value="Pay Premium" />    
                      <input type="reset" class="btn btn-primary" value="Reset" />
                    </div>
                              
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>   
    </div>

      <?php include 'incl/footer.php' ;?>

  </body>
</html>