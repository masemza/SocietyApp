<?php
require 'core/init.php';
$general->logged_out_protect();

$id = htmlentities($user['id']);
$username = htmlentities($user['username']);

$package_id =$_GET['package_id'];
$view_package = $package->package_data($package_id);

global $num;

$dirname = "demo/brand/S  F Logo";
$images = glob($dirname."*.jpg");

foreach($images as $image) 


?>

<!doctype html>
<html lang="en" dir="ltr">
<?php include 'incl/head.php' ;?>
<?php include 'incl/header.php' ;?>

<style>
  .tab 
  { 
    position:absolute;left:150px; 
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

                <?php foreach ($view_package as $row) ?>
                <a href="./view_package.php?society_id=<?php echo $row['society_id'] ?> " style="text-decoration: none;"> <i class="fe fe-arrow-left"></i>View Package History</a> | Package

              </h1>
            </div>


            <div class="card">
              <div class="card-header">
                <h3 class="card-title"> Package </h3>
                <div class="card-options">
                  <button type="button" class="btn btn-primary btn-sm" onclick="javascript:window.print();"><i class="fe fe-download"></i> Download Package</button>
              </div>
            </div>

              <div class="card-body">



                <div class=" text-center">
                    <p class="h2"> <u>PACKAGE</u> </p>
                </div>

                <div class="row my-6">
                  <div class="col-6">
                    <!-- <p class="h3">Company</p> -->
                    <?php //foreach ($view_invoice as $row) ?>
                    
                    <?php
                        echo "<img src='$image' style='max-width:250px; max-height:250px;' /> ";
                    ?>
                  <br><p class="h5">PO Box 22
                  <br>Jane Furse 1085</p>
                  </div>
                  

                    <div class="col-6 text-right">
                      <p class="h2">SAMELLEN FUNERALS cc</p>
                      <p class="h4">T/A HELPMEKAAR FUNERAL PARLOUR C.C.</p>

                      <!-- <p class="h2">SESHEGO FUNERALS </p> -->

                      <br><br><br>
                      <p class="h5">
                          Tel: (013) 265 1031 <br>
                          Fax: (015) 223 0378 <br>
                          Email: 
                      </p>
                    </div>
                </div>
                
                <hr>

                    <!-- <div class="col-12 text-center">
                        <p class="h2"> INVOICE</p>
                    </div> -->
 
                <div class="row my-6">
                  <div class="col-6">
                    <!-- <p class="h3">Company</p> -->
                    <?php //foreach ($view_invoice as $row) ?>

                    <p class="h3"> <u> <?php //echo $row['name'] ?></u> </p>
                    <!-- <p class="h3">Company: </p> -->
                  </div>
                  <div class="col-6 text-right">
                     <p class="h4"> <?php echo "Date: "?> <u><?php echo date("d-m-Y") ?> </u> </p>
                  </div>
                </div>

                <h4> <p class="text-right"> PACKAGE NO: <?php echo $package_id ?></p> </h4>

                <div class="table-responsive push">
                  <table class="table table-bordered table-hover">
                  <?php foreach ($view_package as $row)
                  {?>
                    <tr>
                      <th class="text-left" >Package was Created On</th>
                        <td class="text-center">
                        <?php
                            $date = date_create($row['package_created']);
                            echo date_format($date, 'd-m-Y');
                        ?>
                        </td>
                    </tr>

                    <tr>
                      <th class="text-left" >Flower</th>
                      <td class="text-center">R<?php echo number_format($row['flower'],2); ?></td>
                    </tr>

                    <tr>
                        <th class="text-left" >Coffin</th>
                        <td class="text-center">R<?php echo number_format($row['coffin'],2); ?></td>
                    </tr>

                    <tr>
                        <th class="text-left" >Grave Marker</th>
                        <td class="text-center">R<?php echo number_format($row['grave_marker'],2); ?></td>
                    </tr>

                    <tr>
                        <th class="text-left" >Transport</th>
                        <td class="text-center">R<?php echo number_format($row['transport'],2); ?></td>
                    </tr>

                    <tr>
                        <th class="text-left" >Funeral Service</th>
                        <td class="text-center">R<?php echo number_format($row['funeral_service'],2); ?></td>
                    </tr>

                    <!-- <tr>
                        <th class="text-left font-weight-bold text-uppercase text-left" >Total</th>
                        <td class="text-center font-weight-bold text-uppercase text-right" >R<?php //echo number_format($row['total'],2); ?></td>
                    </tr> -->

                  <?php } ?>

                  </table>  
                </div>

                  <hr>
                <div class="row my-6">
                  <div class="col-6">
                    <!-- <p class="h3">Bank Details</p>
                    <p class="h4">Account holder <span class="tab"> : </span></p>
                    <p class="h4">Bank <span class="tab"> : </span></p>
                    <p class="h4">Account number <span class="tab"> : </span></p>
                    <p class="h4">Reference <span class="tab"> : </span></p> -->
                  </div>
                  <div class="col-6 text-right">
                     <p class="h4">Total: R<?php echo number_format($row['total'],2); ?></p>
                  </div>
                </div>

                <hr>
                <p class="text-muted text-center">Thank you very much for doing business with us. We look forward to working with you again!</p>


            </div>
          </div>
        </div>
      </div>

      <?php include 'incl/footer.php' ;?>
    </div>
  </body>
</html>