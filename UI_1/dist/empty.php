<?php
require 'core/init.php';
$general->logged_out_protect();
$username = htmlentities($user['username']);



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
                    <a href="./index.php" class="nav-link"><i class="fe fe-home"></i> Home</a>
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
                <a href="./view_statements.php?society_id=<?php echo $society_id ?>.php" style="text-decoration: none;"> <i class="fe fe-arrow-left"></i>Empty Page</a> | Empty Page
              </h1>
            </div>
        </div>
      </div>
    </div>
      

      <?php include 'incl/footer.php' ;?>
    </div>
  </body>
</html>