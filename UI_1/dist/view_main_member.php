<?php
require 'core/init.php';
$general->logged_out_protect();
$username = htmlentities($user['username']);
$type = htmlentities($user['type']);

$main_member_id =$_GET['main_member_id'];
$view_main_member = $main_member->memberdata($main_member_id);
foreach($view_main_member as $main_member_row)
{

}

$balance = $main_member->get_last_balance($main_member_id);
$view_deposits = $main_member->member_deposits($main_member_id);
$view_withdrawals = $main_member->member_withdrawals($main_member_id);

$provinceData = $main_member->allProvinceInformation();
$cityData = $main_member->allCityInformation();

if (isset($_POST['update']))
{
    if($errors == false)
    {
        if(empty($_POST['gender']) === true || empty($_POST['plan_type']) === true)
        {
            $errors[] = 'Please fill all the field';
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
            $province       = $_POST['province'];
            $city           = $_POST['city'];
            $suburb         = $_POST['suburb'];
            $street         = $_POST['street'];
            $plan_type      = $_POST['plan_type'];
            $premium        = $_POST['premium'];
            $cover          = $_POST['cover'];
            $policy_number  = $_POST['policy_number'];
                                
            $main_member->update_member($first_name, $last_name, $gender, $contact_number, $province, $city, $suburb, $street, $plan_type, $premium, $cover, $policy_number, $main_member_id); 

            Print '<script>alert("Member Successfully updated");;
            window.location.assign("manage_members.php")</script>';
                              
          // header('Location:spouse.php?society_id='.$society_id);
        }
    }
}

?>

<!doctype html>
<html lang="en" dir="ltr">
<?php include 'incl/head.php' ;?>
<?php include 'incl/header.php' ;?>

<style>

	div.a 
	{
		text-align: right;
	}

</style>

  <body class="">
    <div class="page">
      <div class="page-main">

        <div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
          <div class="container">
            <div class="row align-items-center">
              <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                  
                  <li class="nav-item">
                    <?php
                    if($type == 'admin' || $type == 'manager')
                    {?>
                      <a href="./manage_members.php" class="nav-link active"><i class="fe fe-home"></i> Home</a>
                    <?php
                    }
                    else 
                    if($type == 'user')
                    {?>
                      <a href="./index.php" class="nav-link active"><i class="fe fe-home"></i> Home</a>
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
                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-users"></i>Manage Children Details</a>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="./view_children.php?main_member_id=<?php echo $main_member_id ?>" class="dropdown-item "><i class="fe fe-users"></i>View Children</a>
                      <a href="./children.php?main_member_id=<?php echo $main_member_id ?>" class="dropdown-item "><i class="fe fe-user-plus"></i>Add A Child</a>
                    </div>
                  </li>

                  <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-users"></i>Manage Extended Family</a>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="./view_extended_family.php?main_member_id=<?php echo $main_member_id ?>" class="dropdown-item"><i class="fe fe-users"></i>View Extended Family</a>
                      <a href="./extended_family.php?main_member_id=<?php echo $main_member_id ?>" class="dropdown-item "><i class="fe fe-user-plus"></i>Add Extended Family</a>
                    </div>
                  </li>

                  <li class="nav-item">
                     
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
                <?php
                if($type == 'admin' || $type == 'manager')
                  {?>
                    <a href="manage_members.php" style="text-decoration: none;"> <i class="fe fe-arrow-left"></i>Home</a> | Member Details
                  <?php
                  }
                  else
                  if($type == 'user')
                  {?>
                    Dashboard
                  <?php
                  }?>
              </h1>
            </div>

            <?php 
            if($type == 'admin' || $type == 'manager')
            {?>
              <div class="row row-cards">
                
                <div class="col-sm-6 col-lg-3">
                  <div class="card p-3 align-items-left">
                    <div class="d-flex align-items-left">
                      <span class="stamp stamp-md bg-blue mr-3">
                        <i class="fe fe-plus-square"></i>
                      </span>
                      <div>
                        <h4 class="m-0"><a href="javascript:void(0)"><!-- 132 --> <small>Cover</small></a></h4>
                        <small class="text-muted">R<?php echo number_format($main_member_row['cover'], 2) ?></small>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                  <div class="card p-3 align-items-left">
                    <div class="d-flex align-items-left">
                      <span class="stamp stamp-md bg-red mr-3">
                        <i class="fe fe-database"></i>
                      </span>
                      <div>
                        <h4 class="m-0"><a href="javascript:void(0)"><small>Total Premiums</small></a></h4>
                        <small class="text-muted"><?php echo $view_deposits ?></small>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-sm-3 col-lg-3">
                  <div class="card p-3 align-items-center">
                    <a href="./pay_premium.php?main_member_id=<?php echo $main_member_id ?>" class="btn btn-success" role="button">Pay Premium</a>
                  </div>
                </div>

                <div class="col-sm-3 col-lg-3">
                  <div class="card p-3 align-items-center">
                    <a href="./member_statement.php?main_member_id=<?php echo $main_member_id ?>" class="btn btn-primary" role="button">View Statement</i></a>
                  </div>
                </div> 

              </div>
            <?php
            }?>

            <?php 
            if($type == 'user')
            {?>
              <div class="row row-cards">
              
                <div class="col-sm-6 col-lg-4">
                  <div class="card p-3 align-items-left">
                    <div class="d-flex align-items-left">
                      <span class="stamp stamp-md bg-blue mr-3">
                        <i class="fe fe-plus-square"></i>
                      </span>
                      <div>
                        <h4 class="m-0"><a href="javascript:void(0)"><!-- 132 --> <small>Cover</small></a></h4>
                        <small class="text-muted">R<?php echo number_format($main_member_row['cover'], 2) ?></small>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-sm-6 col-lg-4">
                  <div class="card p-3 align-items-left">
                    <div class="d-flex align-items-left">
                      <span class="stamp stamp-md bg-red mr-3">
                        <i class="fe fe-database"></i>
                      </span>
                      <div>
                        <h4 class="m-0"><a href="javascript:void(0)"><small>Total Premiums</small></a></h4>
                        <small class="text-muted"><?php echo $view_deposits ?></small>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-sm-6 col-lg-4">
                  <div class="card p-3 align-items-left">
                    <div class="d-flex align-items-left">
                      <span class="stamp stamp-md bg-cyan mr-3">
                        <i class="fe fe-dollar-sign"></i>
                      </span>
                      <div>

                        <?php 
                        $bal = number_format($balance, 2);
                        if($balance >= 0) 
                        { 
                        ?>

                            <h4 class="m-0"><a href="javascript:void(0)"><small>Current Balance</small></a></h4>
                            <small class="text-muted">R<?php echo $bal ?></small>
                        
                        <?php 
                        }
                        else 
                        { ?>

                            <h4 class="m-0"><a href="javascript:void(0)"><small>Due to us</small></a></h4>
                            <small class="text-muted">(R<?php echo substr($bal,1) ?>) </small>

                        <?php 
                        }
                        ?>
                      
                      </div>
                    </div>
                  </div>
                </div> 

              </div>
            <?php
            }?>











            <div class="row row-cards row-deck">

            <div class="col-lg-12">
              <script>
                require(['input-mask']);
              </script>
              <div class="card">
                <div class="card-body">
                  <h3 class="card-title">Member Details</h3>
                  <form action="" method="post">

                    <div class="card-body">
                      <div class="row">
                        <div class="col-sm-6 col-md-6">
                          <div class="form-group">
                            <label class="form-label">First name(s)</label>
                            <input type="text" name="first_name" class="form-control" value="<?php echo $main_member_row['first_name']?>">
                          </div>
                        </div>

                        <div class="col-sm-6 col-md-6">
                          <div class="form-group">
                              <label class="form-label">Surname</label>
                              <input type="text" name="last_name" class="form-control" value="<?php echo $main_member_row['last_name']?>">
                          </div>
                        </div>

                        <div class="col-sm-6 col-md-6">
                          <div class="form-group">
                              <label class="form-label">ID number</label>
                              <input disabled="true" type="number" name="id_number" class="form-control" value="<?php echo $main_member_row['id_number']?>">
                          </div>
                        </div>

                        <div class="col-sm-6 col-md-6">
                          <div class="form-group">
                              <label class="form-label">Contact number</label>
                              <input type="number" name="contact_num" class="form-control" value="<?php echo $main_member_row['contact_number']?>">
                          </div>
                        </div>

                        <div class="col-sm-6 col-md-6">
                          <div class="form-group">
                                <label class="gender">Gender</label>
                                <select name= gender class="form-control">
                                    <option ><?php echo $main_member_row['gender'] ?></option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                          </div>
                        </div>

                        <div class="col-sm-6 col-md-6">
                          <div class="form-group">
                              <label class="form-label">Date Inception</label>
                              <input type="text" name="inception_date" class="form-control" data-mask-clearifnotmatch="true" autocomplete="off" maxlength="10" value="<?php echo date(("d-m-Y"), $main_member_row['inception_date']) ?>">
                          </div>
                        </div>

                        <div class="col-sm-6 col-md-6">
                          <div class="form-group">
                                <label class="plan_type">Plan type</label>
                                <select name= plan_type class="form-control custom-select" required="true">
                                  <option ><?php echo $main_member_row['plan_type']; ?></option>
                                  <option value="Bronze">Bronze</option>
                                  <option value="Silver">Silver</option>
                                  <option value="Gold">Gold</option>
                                  <option value="Platinum">Platinum</option>
                                  <option value="Pensioner">Pensioner</option>
                                  <option value="Seshebo">Seshebo</option>
                                  <option value="Tomnstone">Tomnstone</option>
                                  <option value="Pensioner +">Pensioner +</option>
                                </select>
                          </div>
                        </div>

                        <div class="col-sm-6 col-md-6">
                          <div class="form-group">
                              <label class="form-label">Premium</label>
                              <input type="number" name="premium" class="form-control" value="<?php echo $main_member_row['premium']?>">
                          </div>
                        </div>

                        <div class="col-sm-6 col-md-6">
                          <div class="form-group">
                              <label class="form-label">Cover</label>
                              <input type="number" name="cover" class="form-control" value="<?php echo $main_member_row['cover']?>">
                          </div>
                        </div>

                        <div class="col-sm-6 col-md-6">
                          <div class="form-group">
                              <label class="form-label">Policy number</label>
                              <input type="text" name="policy_number" class="form-control" value="<?php echo $main_member_row['policy_number']?>">
                          </div>
                        </div>
                          
                      </div>
                    </div>
                  
                        <h3 class="card-title">Location</h3>
                        <div class="card-body">
                          <div class="row">

                            <div class="col-sm-3 col-md-3">
                              <div class="form-group">
                                <label class="form-label">Street</label>
                                <input type="text" name="street" class="form-control" value="<?php echo $main_member_row['street']?> ">
                              </div>
                            </div>

                            <div class="col-sm-3 col-md-3">
                              <div class="form-group">
                                <label class="form-label">Suburb</label>
                                <input type="text" name="suburb" class="form-control" value="<?php echo $main_member_row['suburb']?> ">
                              </div>
                            </div>
                                
                            <div class="col-sm-3 col-md-3">
                              <div class="form-group">
                                <label class="form-label">City</label>
                                <input list="city" name="city" class="form-control" placeholder="Enter City" required="true" size="" value="<?php echo $main_member_row['city']; ?>" >
                                  <datalist id="city">
                                    <?php  
                                      foreach($cityData as $cityrow)
                                      {?>
                                          <option value="<?php echo $cityrow['city_name'] ?> "></option>
                                      <?php 
                                      }?>   
                                  </datalist>
                              </div>
                            </div>

                            <div class="col-sm-3 col-md-3">
                              <div class="form-group">
                                <label class="province">Province</label>
                                <select name = province class="form-control custom-select" required="true">
                                  <option ><?php echo $main_member_row['province']; ?></option>
                                  <?php foreach($provinceData as $provincerow)
                                  {?>
                                    <option value="<?php echo $provincerow['province_name'] ?>"><?php echo $provincerow['province_name'] ?></option>
                                  <?php
                                  }?>
                                </select>
                              </div>
                            </div>

                          </div>
                        </div>

                    <div class="card-footer">
                      <button type="submit" name="update" class="btn btn-primary">Update Details</button>
                      <a href="./edit_user_log_in_details.php?user_id=<?php echo $main_member_row['user_id'] ?>" class="btn btn-primary" role="button">Edit log in details</a>
                    </div>

                    <br>
                    <?php 
                    if(empty($errors) === false)
                    {
                      echo '<p class="text-center">' . implode('</p><p>', $errors) . '</p>';  
                    }
                    ?>

                  </form>
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