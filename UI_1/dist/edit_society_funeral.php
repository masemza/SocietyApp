<?php
require 'core/init.php';
$general->logged_out_protect();
$username = htmlentities($user['username']);

$funeral_id = $_GET['funeral_id'];

$view_funeral = $funeral->funeraldata($funeral_id);
foreach($view_funeral as $funeral_row)
{
  $member_id = $funeral_row['member_id'];
  $society_id = $funeral_row['society_id'];
  $type_of_package = $funeral_row['type_of_package'];
} 

$view_member = $member->memberdata($member_id);
foreach($view_member as $view_member_row)
{
  $id_number_of_deceased = $view_member_row['id_number'];
}

$provinceData = $main_member->allProvinceInformation();
$cityData = $main_member->allCityInformation();
$societyData = $society->societyInformation();

if (isset($_POST['submit'])) 
{
  $informant_first_name = $_POST['informant_first_name'];
  $informant_surname = $_POST['informant_surname'];
  $informant_id_number = $_POST['informant_id_number'];
  $informant_contact_number = $_POST['informant_contact_number'];
  $informant_street = $_POST['informant_street'];
  $informant_suburb = $_POST['informant_suburb'];
  $informant_city = $_POST['informant_city'];
  $informant_province = $_POST['informant_province'];

  if($errors == false)
  {

    if(empty($errors) === true)
    {  
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

        $last_balance = $payment->get_last_balance($society_id);    

        $new_balance = $last_balance + $funeral_row['total_package'];    
        $total_package = $flower_amount + $coffin_amount + $grave_marker_amount + $transport_amount + $funeral_service_amount;
        
        $new_bal = $new_balance - $total_package;

        $payment_id = $payment->get_last_inserted_payment_id($society_id);

        $funeral->update_society_funeral_for_child($informant_first_name, $informant_surname, $informant_id_number, $informant_contact_number, $informant_street, $informant_suburb, $informant_city, $informant_province, $flower_amount, $coffin_amount, $grave_marker_amount, $transport_amount, $funeral_service_amount, $funeral_time, $date_of_funeral, $street, $suburb, $city, $province, $new_bal, $total_package, $funeral_id, $payment_id);
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

        $last_balance = $payment->get_last_balance($society_id);

        $packageData = $package->last_package_inserted($society_id);    
        foreach($packageData as $packagerow)
        {
          $tot_package = $packagerow['total'];
        }    

        $new_balance = $last_balance + $funeral_row['total_package'];
        $total_package = $transport_amount + $tot_package;
        
        $new_bal = $new_balance - $total_package;

        $payment_id = $payment->get_last_inserted_payment_id($society_id);

        $funeral->update_society_funeral_for_adult($informant_first_name, $informant_surname, $informant_id_number, $informant_contact_number, $informant_street, $informant_suburb, $informant_city, $informant_province, $transport_amount, $funeral_time, $date_of_funeral, $street, $suburb, $city, $province, $new_bal, $total_package, $funeral_id, $payment_id);
      }


       // Print '<script>alert("Member successfully added");
       // </script>';
                          
       // header('Location:view_members.php?society_id='.$society_id);

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
                      <div class="col-sm-6 col-md-12">
                        <div class="form-group">
                          <label class="form-label">ID Number of the Deceased</label>
                          <input list="first_name" type="text" class="form-control" required="required" disabled="disabled" placeholder="Enter ID Number" value="<?php echo $id_number_of_deceased ?>" >
                        </div>
                      </div>

                      <?php 
                      if($type_of_package == 'Child')
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
                      if($type_of_package == 'Adult')
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

                  <a href="./delete_funeral_arrangement.php?funeral_id=<?php echo $funeral_id ?> &member_id=<?php echo $member_id ?>" class="btn btn-primary" role="button">Cancel Funeral Arrangement</a>
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