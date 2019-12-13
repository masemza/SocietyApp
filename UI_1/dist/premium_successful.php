<?php
require 'core/init.php';
$general->logged_out_protect();
$username = htmlentities($user['username']);

$member_payment_id =$_GET['member_payment_id'];
$view_receipt = $main_member->receipt_data($member_payment_id);
foreach($view_receipt as $receipt_row)
{
    $main_member_id = $receipt_row['member_id'];
}

if(isset($_POST['member_details']))
{
  header('location: view_children.php?main_member_id='.$main_member_id);
}

if(isset($_POST['home_page']))
{
  header('location: manage_members.php');
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
                    <a href="./manage_members.php" class="nav-link"><i class="fe fe-home"></i> Home</a>
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
                <a href="./manage_members.php" style="text-decoration: none;"> <i class="fe fe-arrow-left"></i>Home</a> | Empty Page
              </h1>
            </div>
        </div>
      </div>
    </div>

    <div class="my-3 my-md-5">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Awesome, Payment of R<?php echo number_format($receipt_row['credit'],2) ?> was successful!</h3>
              </div>
              
              <div class="card-body">
                <div id="carousel-default" class="carousel slide" data-ride="carousel">
                  <div class="carousel-inner">
                    <div class="carousel-item active">
                      <img class="d-block w-100" alt="" src="./demo/successful/payment-success.png" data-holder-rendered="true" />
                    </div>
                    <hr>

                    <form action="" method="post">
                      <button type="submit" name="member_details" class="btn btn-primary">View Member Details</button>

                      <button type="submit" name="home_page" class="btn btn-primary">Back to home page</button>
                      <!-- <a href="./manage_members.php" class="btn btn-primary" role="button">Back to home page</a> -->
                    </form>

                  </div>
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