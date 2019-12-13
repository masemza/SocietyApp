<?php
require 'core/init.php';
$general->logged_out_protect();
$username = htmlentities($user['username']);

$policy_holder_funeral_id = $_GET['policy_holder_funeral_id'];

$view_funeral = $funeral->policy_holder_funeral_data($policy_holder_funeral_id);
foreach($view_funeral as $funeral_row)
{
  $main_member_id = $funeral_row['main_member_id'];
  $type_of_package = $funeral_row['type_of_package'];
} 

$view_main_member = $main_member->memberdata($main_member_id);
foreach($view_main_member as $main_member_row)
{
  $main_member_id = $main_member_row['main_member_id'];
  $id_number =  $main_member_row['id_number'];
  
}

$provinceData = $main_member->allProvinceInformation();
$cityData = $main_member->allCityInformation();
$societyData = $society->societyInformation();

if (isset($_POST['submit'])) 
{
    $id_number_of_deceased = $_POST['id_number_of_deceased'];
    if($main_member->member_id_exists_for_policy_holder_funeral($id_number_of_deceased)  === false)
    {
      $errors[] = 'Sorry, That Deceased ID Number does\'nt exist';
    }

    else if(empty($_POST['province']))
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

      if($type_of_package == 'Child')
      {
        $flower_amount = $_POST['flower_amount'];
        $coffin_amount = $_POST['coffin_amount'];
        $grave_marker_amount = $_POST['grave_marker_amount'];
        $transport_amount = $_POST['transport_amount'];;
        $funeral_service_amount = $_POST['funeral_service_amount'];
        $funeral_time = $_POST['funeral_time'];
        $date_of_funeral = $_POST['date_of_funeral'];
        $street = $_POST['street'];
        $suburb = $_POST['suburb'];
        $city = $_POST['city'];
        $province = $_POST['province'];

        $member_data = $main_member->get_member_data_using_deceased_id_number($id_number_of_deceased);
        foreach($member_data as $memberrow)
        {
          $first_name = $memberrow['first_name'];
          $last_name = $memberrow['last_name'];
          $deceased_name = $first_name." ".$last_name;
          // $main_member_id = $memberrow['main_member_id'];
          $family_id = $memberrow['family_id'];
          $member_type = $memberrow['type'];
        }

        $last_balance = $main_member->get_last_balance($main_member_id);

        $new_balance = $last_balance + $funeral_row['total_package'];

        $total_package = $flower_amount + $coffin_amount + $grave_marker_amount + $transport_amount + $funeral_service_amount;
        
        $new_bal = $new_balance - $total_package;

        $member_payment_id = $payment->get_last_inserted_payment_id($main_member_id);

        $funeral->update_policy_holder_funeral_for_child($main_member_id, $informant_first_name, $informant_surname, $informant_id_number, $informant_contact_number, $informant_street, $informant_suburb, $informant_city, $informant_province, $id_number_of_deceased, $flower_amount, $coffin_amount, $grave_marker_amount, $transport_amount, $funeral_service_amount, $funeral_time, $date_of_funeral, $street, $suburb, $city, $province, $new_bal, $total_package, $deceased_name, $type_of_package, $family_id, $member_type, $policy_holder_funeral_id, $member_payment_id);
      }
      else
      if($type_of_package == 'Adult')
      {
        $transport_amount = $_POST['transport_amount'];;
        $funeral_time = $_POST['funeral_time'];
        $date_of_funeral = $_POST['date_of_funeral'];
        $street = $_POST['street'];
        $suburb = $_POST['suburb'];
        $city = $_POST['city'];
        $province = $_POST['province'];

        $member_data = $main_member->get_member_data_using_deceased_id_number($id_number_of_deceased);
        foreach($member_data as $memberrow)
        {
          $first_name = $memberrow['first_name'];
          $last_name = $memberrow['last_name'];
          $deceased_name = $first_name." ".$last_name;
          // $main_member_id = $memberrow['main_member_id'];
          $family_id = $memberrow['family_id'];
          $member_type = $memberrow['type'];
        }

        $last_balance = $main_member->get_last_balance($main_member_id);        
        $total_package = $transport_amount + $main_member_row['premium'];
        
        $new_balance = $last_balance + $funeral_row['total_package'];

        $new_bal = $new_balance - $total_package;

        $member_payment_id = $payment->get_last_inserted_payment_id($main_member_id);

        $funeral->update_policy_holder_funeral_for_adult($main_member_id, $informant_first_name, $informant_surname, $informant_id_number, $informant_contact_number, $informant_street, $informant_suburb, $informant_city, $informant_province, $id_number_of_deceased, $transport_amount, $funeral_time, $date_of_funeral, $street, $suburb, $city, $province, $new_bal, $total_package, $deceased_name, $type_of_package, $family_id, $member_type, $policy_holder_funeral_id, $member_payment_id);
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
                Plan A funeral
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

                      <h3 class="card-title">Informant Details</h3>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="form-label">First Name(s)</label>
                          <input type="text" name="informant_first_name" class="form-control" placeholder="Enter First Name(s)" value="<?php echo $funeral_row['informant_first_name'] ?>">
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="form-label">Surname</label>
                          <input type="text" name="informant_surname" class="form-control" required="required" placeholder="Enter Surname" value="<?php echo $funeral_row['informant_surname'] ?>">
                        </div>
                      </div> 

                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="form-label">ID Number</label>
                          <input type="number" name="informant_id_number" class="form-control" required="required" placeholder="Enter ID Number" value="<?php echo $funeral_row['informant_id_number'] ?>">
                        </div>
                      </div> 

                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="form-label">Contact Number</label>
                          <input type="number" name="informant_contact_number" class="form-control" required="required" placeholder="Enter Contact Number" value="<?php echo $funeral_row['informant_contact_number'] ?>">
                        </div>
                      </div> 
                    </div>

                    <br>
                    <h3 class="card-title">Address</h3>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="form-label">Street</label>
                          <input type="text" name="informant_street" class="form-control" required="required" placeholder="Enter Street" value="<?php echo $funeral_row['informant_street'] ?>">
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="form-label">Suburb</label>
                          <input type="text" name="informant_suburb" class="form-control" required="required" required="required" placeholder="Enter Suburb" value="<?php echo $funeral_row['informant_suburb'] ?>">
                        </div>
                      </div> 

                      <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                          <label class="form-label">City</label>
                          <input list="informant_city" name="informant_city" class="form-control" required="required" placeholder="Enter City" required="true" size="" value="<?php echo $funeral_row['informant_city'] ?>" >
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
                          <select name="informant_province" class="form-control custom-select" required="true">
                            <option value="<?php echo $funeral_row['informant_province'] ?>"><?php echo $funeral_row['informant_province'] ?></option>
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
                      
                      <?php
                        //if($funeral->member_id_exists_for_policy_holder_funeral($id_number_of_deceased) === false)
                        //{?>
                          <div class="col-sm-6 col-md-12">
                            <div class="form-group">
                              <label class="form-label">ID Number Of The Main Member</label>
                              <input type="number" name="id_number_of_deceased" class="form-control" required="required" placeholder="Enter ID Number" value="<?php echo $funeral_row['id_number_of_deceased'] ?>" >
                            </div>
                          </div>
                        <?php
                        //}?>

                      <?php 
                      if($funeral_row['type_of_package'] == 'Child')
                      {?>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="form-label">Flower</label>
                            <input type="number" name="flower_amount" class="form-control" required="required" placeholder="Enter Flower Amount" value="<?php echo $funeral_row['flower_amount'] ?>">
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="form-label">Coffin</label>
                            <input type="number" name="coffin_amount" class="form-control" required="required" placeholder="Enter Coffin Amount" value="<?php echo $funeral_row['coffin_amount'] ?>">
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="form-label">Grave Marker</label>
                            <input type="number" name="grave_marker_amount" class="form-control" required="required" placeholder="Enter Grave Marker Amount" value="<?php echo $funeral_row['grave_marker_amount'] ?>">
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="form-label">Transport</label>
                            <input type="number" name="transport_amount" class="form-control" required="required" placeholder="Enter Transport Amount" value="<?php echo $funeral_row['transport_amount'] ?>">
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="form-label">Funeral Service</label>
                            <input type="number" name="funeral_service_amount" class="form-control" required="required" placeholder="Enter Funeral Service Amount" value="<?php echo $funeral_row['funeral_service_amount'] ?>">
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="form-label">Programmes</label>
                            <input type="number" class="form-control" disabled="true" placeholder="No Amount" >
                          </div>
                        </div>
                      <?php
                      }
                      else
                      if($funeral_row['type_of_package'] == 'Adult')
                      {?>
                        <div class="col-md-12">
                            <div class="form-group">
                              <label class="form-label">Transport</label>
                              <input type="number" name="transport_amount" class="form-control" required="required" placeholder="Enter Transport Amount" value="<?php echo $funeral_row['transport_amount'] ?>">
                            </div>
                          </div>
                      <?php
                      }?>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="form-label">Funeral Time</label>
                          <input type="time" name="funeral_time" class="form-control" value="<?php echo $funeral_row['funeral_time'] ?>">
                        </div>
                      </div>  

                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="form-label">Date of Funeral</label>
                          <input type="date" name="date_of_funeral" class="form-control" value="<?php echo $funeral_row['date_of_funeral'] ?>">
                        </div>
                      </div>

                    </div>

                    <hr>
    
                    <h3 class="card-title">Burial Place</h3>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="form-label">Street</label>
                          <input type="text" name="street" class="form-control" placeholder="Street" value="<?php echo $funeral_row['street'] ?>">
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="form-label">Suburb</label>
                          <input type="text" name="suburb" class="form-control" required="required" placeholder="Suburb" value="<?php echo $funeral_row['suburb'] ?>">
                        </div>
                      </div> 

                      <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                          <label class="form-label">City</label>
                          <input list="city" name="city" class="form-control" placeholder="Enter City" required="true" size="" value="<?php echo $funeral_row['city'] ?>" >
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
                          <select name="province" class="form-control custom-select" required="required">
                            <option value="<?php echo $funeral_row['province'] ?>"><?php echo $funeral_row['province'] ?></option>
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
                  <button onclick ="return confirm('Are you sure you want to make this Funeral Arrangement?')" type="submit" name="submit" class="btn btn-primary">Next</button>

                  <a href="./delete_policy_holder_funeral_arrangement.php?policy_holder_funeral_id=<?php echo $policy_holder_funeral_id ?>" class="btn btn-primary" role="button">Cancel Funeral Arrangement</a>
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