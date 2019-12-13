<?php
require 'core/init.php';
$general->logged_out_protect();
$username = htmlentities($user['username']);

$funeral_id   =$_GET['funeral_id'];
$view_funeral = $funeral->funeraldata($funeral_id);	
foreach ($view_funeral as $row) 
{
  $society_id = $row['society_id'];
}

$view_package = $package->last_package_inserted($society_id);
foreach($view_package as $package_row) {}

$num = 0;

$dirname = "demo/brand/S  F Logo";
$images = glob($dirname."*.jpg");

foreach($images as $image) {}

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
                  <a href="view_society_funeral_arrangement.php?society_id=<?php echo $row['society_id'] ?>"> <i class="fe fe-arrow-left"></i>View Funeral Arragement</a> | Funeral Arrangement
              </h1>
            </div>

            <br>

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Funeral Arrangement</h3>
                <div class="card-options">
                  <button type="button" class="btn btn-primary btn-sm" onclick="javascript:window.print();"><i class="fe fe-download"></i> Download Funeral Arrangement</button>
                </div>
              </div>

              <div class="card-body">
                <div class=" text-center">
                    <p class="h2"> <u>Funeral Arrangement</u> </p>
                </div>

                <div class="row my-6">
                  <div class="col-6">        
                    <?php
                      echo "<img src='$image' style='max-width:250px; max-height:250px;' /> ";
                    ?>
                    <br><p class="h5">PO Box 22
                    <br>Jane Furse 1085</p>
                  </div>  

                  <div class="col-6 text-right">
                    <p class="h2">SAMELLEN FUNERALS cc</p>
                    <p class="h4">T/A HELPMEKAAR FUNERAL PARLOUR C.C.</p>
                    <br><br><br>
                    <p class="h5">
                      Tel: (013) 265 1031 <br>
                      Fax: (015) 223 0378 <br>
                      Email: 
                    </p>
                  </div>
                </div>
                  
                <hr>
                <div class="row my-6">
                  <div class="col-6">
                    <p class="h3">Name of Deceased: <u><?php echo $row['name_of_deceased'] ?> </u> </p>
                  </div>
                  
                  <div class="col-6 text-right">
                    <p class="h4"> <?php echo "Date: "?> <u><?php echo date("d-m-Y");?> </u> </p>
                  </div>
                </div>

                <h4> <p class="text-right"> FUNERAL NO: <?php echo $row['funeral_id'] ?></p> </h4>

                <div class="table-responsive push">
                  <table class="table table-bordered table-hover">
                    <tr>
                      <th class="text-left" >Informant First Name(s)</th>
                      <td class="text-center"><?php echo $row['informant_first_name']; ?></td>
                    </tr>

                    <tr>
                      <th class="text-left" >Informant Surname</th>
                      <td class="text-center"><?php echo $row['informant_surname']; ?></td>
                    </tr>

                    <tr>
                      <th class="text-left" >informant ID Number</th>
                      <td class="text-center"><?php echo $row['informant_id_number']; ?></td>
                    </tr>

                    <tr>
                      <th class="text-left" >Informant Contact Number</th>
                      <td class="text-center"><?php echo $row['informant_contact_number']; ?></td>
                    </tr>

                    <tr>
                      <th class="text-left" >Informant Address</th>
                      <td class="text-center" >
                        <?php echo $row['informant_street']; ?> <br>
                        <?php echo $row['informant_suburb']; ?> <br>
                        <?php echo $row['informant_city']; ?> <br>
                        <?php echo $row['informant_province']; ?>
                      </td>
                    </tr>

                    <tr>
                      <th class="text-left" >Date of funeral</th>
                      <td class="text-center">
                      <?php
                          $date = date_create($row['date_of_funeral']);
                          echo date_format($date, 'd-m-Y');
                      ?>
                      </td>
                    </tr>

                    <tr>
                      <th class="text-left" >Funeral Time</th>
                      <td class="text-center"><?php echo $row['funeral_time']; ?></td>
                    </tr>

                    <?php if($row['type_of_package'] == 'Child')
                    {?>
                    	<tr>
                      <th class="text-left" >Flower amount</th>
                      <td class="text-center"><?php echo $row['flower_amount']; ?></td>
                    </tr>
                    <tr>
                      <th class="text-left" >Coffin amount</th>
                      <td class="text-center"><?php echo $row['coffin_amount']; ?></td>
                    </tr>
                    <tr>
                      <th class="text-left" >Grave-Marker amount</th>
                      <td class="text-center"><?php echo $row['grave_marker_amount']; ?></td>
                    </tr>
                    <tr>
                      <th class="text-left" >Transport amount</th>
                      <td class="text-center"><?php echo $row['transport_amount']; ?></td>
                    </tr>
                    <tr>
                      <th class="text-left" >Funeral-Service amount</th>
                      <td class="text-center"><?php echo $row['funeral_service_amount']; ?></td>
                    </tr>
                    <?php
                    }
                    else
                    if($row['type_of_package'] == 'Adult')
                    {?>
                    	<tr>
                        <th class="text-left" >Coffin amount</th>
                        <td class="text-center"><?php echo $package_row['coffin']; ?></td>
                      </tr>

                      <tr>
                        <th class="text-left" >Flower amount</th>
                        <td class="text-center"><?php echo $package_row['flower']; ?></td>
                      </tr>

                      <tr>
                        <th class="text-left" >Grave Marker amount</th>
                        <td class="text-center"><?php echo $package_row['grave_marker']; ?></td>
                      </tr>

                      <tr>
                        <th class="text-left" >Transport amount</th>
                        <td class="text-center"><?php echo $package_row['transport']; ?></td>
                      </tr>

                      <tr>
                        <th class="text-left" >Funeral Service amount</th>
                        <td class="text-center"><?php echo $package_row['funeral_service']; ?></td>
                      </tr>

                      <tr>
                        <th class="text-left" >Additional Transport amount</th>
                        <td class="text-center"><?php echo $row['transport_amount']; ?></td>
                      </tr>
                   	<?php
                    }?>

                    <tr>
                      <th class="text-left" >Location of the Funeral</th>
                      <td class="text-center" >
                        <?php echo $row['street']; ?> <br>
                        <?php echo $row['suburb']; ?> <br>
                        <?php echo $row['city']; ?> <br>
                        <?php echo $row['province']; ?>
                      </td>
                    </tr>

                    <tr>
                      <th class="text-left font-weight-bold text-uppercase text-left" >Total Amount</th>
                      <td class="text-center font-weight-bold text-uppercase text-right" >R<?php echo number_format($row['total_package'],2); ?></td>
                    </tr>

                  </table>
                </div>

                <hr>
                <p class="text-muted text-center">
                  Thank you very much for doing business with us. We look forward to working with you again!
                </p>

              </div>
            </div>
          </div>
        </div>
      </div>

      <?php include 'incl/footer.php' ;?>
    </div>
  </body>
</html>