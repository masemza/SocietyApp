<?php
require 'core/init.php';
$general->logged_out_protect();
$username = htmlentities($user['username']);

$package_id =$_GET['package_id'];
$view_package = $package->package_data($package_id);	

// foreach($view_receipt as $row)
// {
//     $society_id = $row['society_id'];
// }
// $last_balance = $payment->get_last_balance($society_id);

// $bal = substr($last_balance,1);

//global $num;

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

              <?php foreach ($view_package as $row) ?>
                <a href="./view_package.php?society_id=<?php echo $row['society_id'] ?>" style="text-decoration: none;"> <i class="fe fe-arrow-left"></i>View Package History</a> | Package
              <?php ?>

              </h1>
            </div>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"> View Package </h3>
                <div class="card-options">
                  <button type="button" class="btn btn-primary btn-sm" onclick="javascript:window.print();"><i class="fe fe-download"></i> Download Package</button>
                </div>
              </div>
              <div class="card-body">
              <?php //foreach ($view_statement as $row) { 
                        //$society_name = $row['society_name'];
                        //$society_id = $row['society_id'];
                    //}
                        ?>
 
                <div class="row my-6">
                  <div class="col-6">
                    <!-- <p class="h3">Company</p> -->
                    <?php foreach ($view_package as $row) ?>
                    <p class="h2">Seshego Funerals</p><?php //echo $row['society_name'] ?></p>
                    <address>
                    <?php //    foreach ($view_society as $row)?>
                        <!-- Location: <?php //echo $row['location'] ?> -->
                    </address>
                  </div>
                  <div class="col-6 text-right">
                    <!-- <p class="h3">Client</p> -->
                    <address>

                        <!-- <p class="h4"> Package no: #<?php //echo $row['package_id'] ?></p> -->
                     <p> Date: <?php echo date("d-m-Y"); ?> </p>
                    </address>
                  </div>
                </div>
                <div class="table-responsive push">
                  <table class="table table-bordered table-hover">
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

                    <tr>
                        <th class="text-left font-weight-bold text-uppercase text-left" >Total</th>
                        <td class="text-center font-weight-bold text-uppercase text-right" >R<?php echo number_format($row['total'],2); ?></td>
                    </tr>

                  </table>
                </div>
                <p class="text-muted text-center">Thank you very much for doing business with us. We look forward to working with you again!</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <?php include 'incl/footer.php' ;?>
    </div>
  </body>
</html>