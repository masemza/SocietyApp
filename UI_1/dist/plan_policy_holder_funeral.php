<?php
require 'core/init.php';

// require_once("helpers.php");

$general->logged_out_protect();
$username = htmlentities($user['username']);

$family_id = $_GET['family_id'];
$view_member = $main_member->get_member_data_using_family_id($family_id);

foreach($view_member as $member_row)
{
  $main_member_id = $member_row['main_member_id'];
  $first_name = $member_row['first_name'];
  $last_name = $member_row['last_name'];
  $id_number = $member_row['id_number'];
  $deceased_name = $first_name." ".$last_name;
  $member_type = $member_row['type'];
  $id_number_of_deceased = $member_row['id_number'];

}

$member_data = $main_member->getiingAllMembersInformation($main_member_id);
foreach($member_data as $memberrow)
{

}

//Get the current UNIX timestamp.
$now = time();
                       
$day = substr($id_number, 4, 2);
$month = substr($id_number, 2, 2);
$year = substr($id_number, 0, 2);

//Get the timestamp of the person's date of birth.
$dob = strtotime($year.'-'.$month.'-'.$day);
                       
//Calculate the difference between the two timestamps.
$difference = $now - $dob;
                       
//There are 31556926 seconds in a year.
$age = floor($difference / 31556926);


$provinceData = $main_member->allProvinceInformation();
$cityData = $main_member->allCityInformation();

if (isset($_POST['submit'])) 
{ 
    $transport_amount = $_POST['transport_amount'];
    $funeral_time = $_POST['funeral_time'];
    $date_of_funeral = $_POST['date_of_funeral'];
    $street = $_POST['street'];
    $suburb = $_POST['suburb'];
    $city = $_POST['city'];
    $province = $_POST['province'];

    $deceased_name = $first_name." ".$last_name;

    $last_balance = $main_member->get_last_balance($main_member_id);    

    if(empty($_POST['province']))
    {
      $errors[] = 'Please Select province for Burial place';
    }

    else if(empty($_POST['informant_province']))
    {
      $errors[] = 'Please Select informant province';
    }

    if(empty($errors) === true)
    {   
      $informant_first_name = $_POST['informant_first_name'];
      $informant_surname = $_POST['informant_surname'];
      $informant_id_number = $_POST['informant_id_number'];
      $informant_contact_number = $_POST['informant_contact_number'];
      $informant_street = $_POST['informant_street'];
      $informant_suburb = $_POST['informant_suburb'];
      $informant_city = $_POST['informant_city'];
      $informant_province = $_POST['informant_province'];

      if($age >= 15)
      {
        $total_package = $transport_amount + $memberrow['premium'];
        $new_bal = $last_balance - $total_package;

        $type_of_package = "Adult";

        $funeral->plan_a_policy_holder_funeral_for_adult($main_member_id, $informant_first_name, $informant_surname, $informant_id_number, $informant_contact_number, $informant_street, $informant_suburb, $informant_city, $informant_province, $id_number_of_deceased, $transport_amount, $funeral_time, $date_of_funeral, $street, $suburb, $city, $province, $new_bal, $total_package, $deceased_name, $type_of_package, $family_id, $member_type);
      }
      else
      if($age < 15)
      {
        $flower_amount = $_POST['flower_amount'];
        $coffin_amount = $_POST['coffin_amount'];
        $grave_marker_amount = $_POST['grave_marker_amount'];
        $funeral_service_amount = $_POST['funeral_service_amount'];

        $total_package = $flower_amount + $coffin_amount + $grave_marker_amount + $transport_amount + $funeral_service_amount;
        $new_bal = $last_balance - $total_package;

        $type_of_package = "Child";

        $funeral->plan_a_policy_holder_funeral_for_child($main_member_id, $informant_first_name, $informant_surname, $informant_id_number, $informant_contact_number, $informant_street, $informant_suburb, $informant_city, $informant_province, $id_number_of_deceased, $flower_amount, $coffin_amount, $grave_marker_amount, $transport_amount, $funeral_service_amount, $funeral_time, $date_of_funeral, $street, $suburb, $city, $province, $new_bal, $total_package, $deceased_name, $type_of_package, $family_id, $member_type);

        
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
                <a href="view_statements.php?society_id=<?php echo $society_id ?>" style="text-decoration: none;"> <i class="fe fe-arrow-left"></i>Member Details</a> | Plan A funeral
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
                    <div class="card-body">
                      <h3 class="card-title">Informant Details</h3>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="form-label">First Name(s)</label>
                            <input type="text" name="informant_first_name" class="form-control" placeholder="Enter First Name(s)" value="<?php if(isset($_POST['informant_first_name'])) echo htmlentities($_POST['informant_first_name']); ?>">
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="form-label">Surname</label>
                            <input type="text" name="informant_surname" class="form-control" required="required" placeholder="Enter Surname" value="<?php if(isset($_POST['informant_surname'])) echo htmlentities($_POST['informant_surname']); ?>">
                          </div>
                        </div> 

                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="form-label">ID Number</label>
                            <input type="number" name="informant_id_number" class="form-control" required="required" placeholder="Enter ID Number" value="<?php if(isset($_POST['informant_id_number'])) echo htmlentities($_POST['informant_id_number']); ?>">
                          </div>
                        </div> 

                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="form-label">Contact Number</label>
                            <input type="number" name="informant_contact_number" class="form-control" required="required" placeholder="Enter Contact Number" value="<?php if(isset($_POST['informant_contact_number'])) echo htmlentities($_POST['informant_contact_number']); ?>">
                          </div>
                        </div> 
                      </div>

                      <br>
                      <h3 class="card-title">Address</h3>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="form-label">Street</label>
                            <input type="text" name="informant_street" class="form-control" placeholder="Enter Street" value="<?php if(isset($_POST['informant_street'])) echo htmlentities($_POST['informant_street']); ?>">
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="form-label">Suburb</label>
                            <input type="text" name="informant_suburb" class="form-control" required="required" placeholder="Enter Suburb" value="<?php if(isset($_POST['informant_suburb'])) echo htmlentities($_POST['informant_suburb']); ?>">
                          </div>
                        </div> 

                        <div class="col-sm-6 col-md-6">
                          <div class="form-group">
                            <label class="form-label">City</label>
                            <input list="informant_city" name="informant_city" class="form-control" placeholder="Enter City" required="true" size="" value="<?php if(isset($_POST['informant_city'])) echo htmlentities($_POST['informant_city']); ?>" >
                            <datalist id="informant_city">
                              <?php  
                              foreach($cityData as $cityrow)
                              {?>
                                <option value="<?php echo $cityrow['city_name'] ?> "></option>
                              <?php 
                              }?>   
                            </datalist>
                          </div>
                        </div>

                        <div class="col-sm-6 col-md-6">
                          <div class="form-group">
                            <label class="form-label">Province</label>
                            <select name="informant_province" class="form-control custom-select" required="required">
                              <option value="<?php if(isset($_POST['informant_province'])) echo htmlentities($_POST['informant_province']); ?>" disabled selected>Select Province</option>
                                <?php foreach($provinceData as $provincerow)
                                {?>
                                  <option value="<?php echo $provincerow['province_name'] ?>"><?php echo $provincerow['province_name'] ?></option>
                                <?php
                                }?>
                            </select>
                          </div>
                        </div>
                      
                      </div>

                      <hr>
                    <div class="row">
    
                      <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                          <label class="form-label">First Name</label>
                          <input type="text" class="form-control" disabled="true" placeholder="First Name" value="<?php echo $member_row['first_name'] ?>" >
                        </div>
                      </div>
                  
                      <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                          <label class="form-label">Last Name</label>
                          <input type="text" class="form-control" disabled="true" placeholder="Last Name" value="<?php echo $member_row['last_name'] ?>" >
                        </div>
                      </div>

                      <div class="col-sm-6 col-md-12">
                        <div class="form-group">
                          <label class="form-label">ID Number</label>
                          <input type="text" class="form-control" disabled="true" placeholder="Last Name" value="<?php echo $member_row['id_number'] ?>" >
                        </div>
                      </div>

                      <?php if($age >= 15)
                      {?>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="form-label">Transport</label>
                            <input type="number" name="transport_amount" class="form-control" required="required" placeholder="Enter Transport Amount" value="<?php if(isset($_POST['transport_amount'])) echo htmlentities($_POST['transport_amount']); ?>">
                          </div>
                        </div>
                      <?php
                      }
                      else
                      if($age < 15)
                      {?>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="form-label">Flower</label>
                            <input type="number" name="flower_amount" class="form-control" required="required" placeholder="Enter Flower Amount" value="<?php if(isset($_POST['flower_amount'])) echo htmlentities($_POST['flower_amount']); ?>">
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="form-label">Coffin</label>
                            <input type="number" name="coffin_amount" class="form-control" required="required" placeholder="Enter Coffin Amount" value="<?php if(isset($_POST['coffin_amount'])) echo htmlentities($_POST['coffin_amount']); ?>">
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="form-label">Grave Marker</label>
                            <input type="number" name="grave_marker_amount" class="form-control" required="required" placeholder="Enter Grave Marker Amount" value="<?php if(isset($_POST['grave_marker_amount'])) echo htmlentities($_POST['grave_marker_amount']); ?>">
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="form-label">Transport</label>
                            <input type="number" name="transport_amount" class="form-control" required="required" placeholder="Enter Transport Amount" value="<?php if(isset($_POST['transport_amount'])) echo htmlentities($_POST['transport_amount']); ?>">
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="form-label">Funeral Service</label>
                            <input type="number" name="funeral_service_amount" class="form-control" required="required" placeholder="Enter Funeral Service Amount" value="<?php if(isset($_POST['funeral_service_amount'])) echo htmlentities($_POST['funeral_service_amount']); ?>">
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="form-label">Programmes</label>
                            <input type="number" class="form-control" disabled="true" placeholder="No Amount" >
                          </div>
                        </div>
                      <?php
                      }?>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="form-label">Funeral Time</label>
                          <input type="time" name="funeral_time" class="form-control" required="required" placeholder="Time" value="<?php if(isset($_POST['time'])) echo htmlentities($_POST['time']); ?>">
                        </div>
                      </div> 

                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="form-label">Date of Funeral</label>
                          <input type="date" name="date_of_funeral" class="form-control" value="<?php if(isset($_POST['date_of_funeral'])) echo htmlentities($_POST['date_of_funeral']); ?>">
                        </div>
                      </div>        
                    </div>

                    <hr>
    
                    <h3 class="card-title">Burial Place</h3>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="form-label">Street</label>
                          <input type="text" name="street" class="form-control" placeholder="Street" value="<?php if(isset($_POST['street'])) echo htmlentities($_POST['street']); ?>">
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="form-label">Suburb</label>
                          <input type="text" name="suburb" class="form-control" required="required" placeholder="Suburb" value="<?php if(isset($_POST['suburb'])) echo htmlentities($_POST['suburb']); ?>">
                        </div>
                      </div> 

                      <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                          <label class="form-label">City</label>
                          <input list="city" name="city" class="form-control" placeholder="Enter City" required="true" size="" value="<?php if(isset($_POST['city'])) echo htmlentities($_POST['city']); ?>" >
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

                      <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                          <label class="form-label">Province</label>
                          <select name="province" class="form-control custom-select" required="true">
                            <option value="<?php if(isset($_POST['province'])) echo htmlentities($_POST['province']); ?>" disabled selected>Select Province</option>
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

                <div class="card-footer text-right">
                  <button type="submit" name="submit" class="btn btn-primary">Next</button>

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