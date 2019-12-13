<?php
require 'core/init.php';
$general->logged_out_protect();
$username = htmlentities($user['username']);

$type_of_package = $_GET['type'];
$society_name = $_GET['society_name'];

$provinceData = $main_member->allProvinceInformation();
$cityData = $main_member->allCityInformation();
$memberData = $member->memberInformationForEachSociety($society_name);

$society_id = $society->get_society_id($society_name);
$last_balance = $payment->get_last_balance($society_id);

if (isset($_POST['submit'])) 
{
  //informant details
  $informant_first_name = $_POST['informant_first_name'];
  $informant_surname = $_POST['informant_surname'];
  $informant_id_number = $_POST['informant_id_number'];
  $informant_contact_number = $_POST['informant_contact_number'];
  $informant_street = $_POST['informant_street'];
  $informant_suburb = $_POST['informant_suburb'];
  $informant_city = $_POST['informant_city'];
  $informant_province = $_POST['informant_province'];

  //deceased person details
  $id_number_of_deceased = $_POST['id_number_of_deceased'];

  if($member->member_id_number_exists_for_each_society($id_number_of_deceased, $society_name) === false)
  {
    $errors[] = 'Sorry, that id number does\'nt exists';
  }

    if(empty($errors) === true)
    {  
      $memberInformation = $member->get_member_id_using_ID_Number($id_number_of_deceased);
      foreach($memberInformation as $member_information_row)
      {
        $member_id = $member_information_row['member_id'];
        $name_of_deceased = $member_information_row['first_name']." ".$member_information_row['last_name'];
      }

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

        //substr($name_of_deceased, 0, strpos($name_of_deceased, " "));

        
              
        $total_package = $flower_amount + $coffin_amount + $grave_marker_amount + $transport_amount + $funeral_service_amount;
        
        $new_bal = $last_balance - $total_package;

        $funeral->plan_a_funeral_for_child($society_id, $society_name, $informant_first_name, $informant_surname, $informant_id_number, $informant_contact_number, $informant_street, $informant_suburb, $informant_city, $informant_province, $name_of_deceased, $flower_amount, $coffin_amount, $grave_marker_amount, $transport_amount, $funeral_service_amount, $funeral_time, $date_of_funeral, $street, $suburb, $city, $province, $new_bal, $total_package, $type_of_package, $member_id);
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

        $packageData = $package->last_package_inserted($society_id);    
        foreach($packageData as $packagerow)
        {
          $tot_package = $packagerow['total'];
        }    

        $total_package = $transport_amount + $tot_package;
        
        $new_bal = $last_balance - $total_package;

        $funeral->plan_a_funeral_for_adult($society_id, $society_name, $informant_first_name, $informant_surname, $informant_id_number, $informant_contact_number, $informant_street, $informant_suburb, $informant_city, $informant_province, $name_of_deceased, $transport_amount, $funeral_time, $date_of_funeral, $street, $suburb, $city, $province, $new_bal, $total_package, $type_of_package, $member_id);
      }


       // Print '<script>alert("Member successfully added");
       // </script>';
                          
       // header('Location:view_members.php?society_id='.$society_id);

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
                <a href="./choose_type_of_funeral.php" style="text-decoration: none;"> <i class="fe fe-arrow-left"></i>Choose type of funeral</a> | Plan A funeral for <u><?php echo $society_name ?></u>
                <br> 
                <?php
                  if($last_balance < 0)
                  {?>
                    Due to us: R<?php echo substr(number_format($last_balance, 2),1);
                  }
                  else
                  {?>
                    Available balance: R<?php echo number_format($last_balance, 2);
                  }
                ?>
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
                
                <?php if($memberData)
                {?>
                  <form class="card" action="" method="POST">
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
                            <select name="informant_province" class="form-control custom-select" required="true">
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

                        <div class="col-sm-6 col-md-12">
                          <div class="form-group">
                            <label class="form-label">ID Number of the Deceased</label>
                            <input list="id_number_of_deceased" type="text" name="id_number_of_deceased" class="form-control" required="required" placeholder="Enter ID Number" value="<?php if(isset($_POST['id_number_of_deceased'])) echo htmlentities($_POST['id_number_of_deceased']); ?>" >
                            <datalist id="id_number_of_deceased">
                              <?php 
                              foreach($memberData as $member_row)
                              {?>
                                <option value="<?php echo $member_row['id_number'] ?>"></option>
                              <?php
                              }?>
                            </datalist>
                          </div>
                        </div>

                        <?php 
                        if($type_of_package == 'Child')
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
                        }
                        else
                        if($type_of_package == 'Adult')
                        {?>
                          <div class="col-md-12">
                            <div class="form-group">
                              <label class="form-label">Transport</label>
                              <input type="number" name="transport_amount" class="form-control" required="required" placeholder="Enter Transport Amount" value="<?php if(isset($_POST['transport_amount'])) echo htmlentities($_POST['transport_amount']); ?>">
                            </div>
                          </div>
                        <?php
                        }?>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="form-label">Funeral Time</label>
                            <input type="time" name="funeral_time" class="form-control" value="<?php if(isset($_POST['funeral_time'])) echo htmlentities($_POST['funeral_time']); ?>">
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
                      <button onclick ="return confirm('Are you sure you want to make this Funeral Arrangement?')" type="submit" name="submit" class="btn btn-primary">Next</button>

                      <input type="reset" class="btn btn-primary" value="Reset" />
                    </div>

                  </form>
                <?php
                }
                else
                {?>
                  <h1 class="page-title text-center">
                    Sorry, this society does'nt have any member
                  </h1>
                <?php
                }?>

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