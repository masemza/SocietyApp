<?php
require 'core/init.php';
$general->logged_out_protect();
$username = htmlentities($user['username']);

//$society_id = $_REQUEST['society_id'];

if (isset($_POST['submit1'])) 
{
	header('Location: ');
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
              <!-- <div class="col-lg-3 ml-auto">
                <form class="input-icon my-3 my-lg-0">
                  <input type="search" class="form-control header-search" placeholder="Search&hellip;" tabindex="1">
                  <div class="input-icon-addon">
                    <i class="fe fe-search"></i>
                  </div>
                </form>
              </div> -->
              <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                  <li class="nav-item">
                    <a href="./index.php" class="nav-link active"><i class="fe fe-home"></i> Home</a>
                  </li>

                  <li class="nav-item dropdown">
                    <a href="./view_members.php?society_id=<?php echo $society_id ?>" class="nav-link"><i class="fe fe-users"></i>View Members</a>
                  </li>

                  <li class="nav-item dropdown">
                    <a href="./addMember.php?society_id=<?php echo $society_id; ?>" class="nav-link"><i class="fe fe-user-plus"></i>Add a new Member</a>
                  </li>

                  <li class="nav-item dropdown">
                    <a href="./view_package.php?society_id=<?php echo $society_id ?>" class="nav-link"><i class="dropdown-icon fe fe-layers"></i> View Package</a>
                  </li>
                  <!-- <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link active" data-toggle="dropdown"><i class="fe fe-box"></i>Transaction</a>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="./deposit.html" class="dropdown-item active">Deposit</a>
                      <a href="./withdraw.html" class="dropdown-item ">Withdraw</a>
                      <a href="./balance.html" class="dropdown-item ">View Balance</a>
                    </div>
                  </li> -->

                  <!-- <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-calendar"></i> Components</a>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="./maps.html" class="dropdown-item ">Maps</a>
                      <a href="./icons.html" class="dropdown-item ">Icons</a>
                      <a href="./store.html" class="dropdown-item ">Store</a>
                      <a href="./blog.html" class="dropdown-item ">Blog</a>
                      <a href="./carousel.html" class="dropdown-item ">Carousel</a>
                    </div>
                  </li> -->

                  <!-- <li class="nav-item dropdown">
                    <a href="./transactions.html" class="nav-link"><i class="fe fe-file"></i>View Statement</a>
                  </li> -->

                  <!-- <li class="nav-item dropdown">
                    <a href="./form-elements.html" class="nav-link"><i class="fe fe-check-square"></i> Forms</a>
                  </li> -->

                  <!-- <li class="nav-item">
                    <a href="./gallery.html" class="nav-link"><i class="fe fe-image"></i> Gallery</a>
                  </li> -->

                  <!-- <li class="nav-item">
                    <a href="./docs/index.html" class="nav-link"><i class="fe fe-file-text"></i> Documentation</a>
                  </li> -->

                </ul>
              </div>
            </div>
          </div>
          
        </div>

            <div class="my-3 my-md-5">
                <div class="container">
                    <div class="page-header">
                        <h1 class="page-title">
                            <a href="view_statements.php?society_id=<?php echo $society_id ?>" style="text-decoration: none;"> <i class="fe fe-arrow-left"></i>Society Details</a> |  Deposit Money
                          </h1>
                    </div>


              <!-- <div class="col-md-6 col-xl-4">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">This is a standard card</h3>
                    <div class="card-options">
                      <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                      <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                    </div>
                  </div>
                  <div class="card-body">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam deleniti fugit incidunt, iste, itaque minima neque pariatur perferendis sed suscipit velit vitae voluptatem. A consequuntur, deserunt eaque error nulla temporibus!
                  </div>
                  <div class="card-footer">
                    This is standard card footer
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-xl-4">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Built card</h3>
                    <div class="card-options">
                      <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                      <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                    </div>
                  </div>
                  <div class="card-body">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam deleniti fugit incidunt, iste, itaque minima neque pariatur perferendis sed suscipit velit vitae voluptatem. A consequuntur, deserunt eaque error nulla temporibus!
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-xl-4">
                <div class="card">
                  <div class="card-status bg-blue"></div>
                  <div class="card-header">
                    <h3 class="card-title">Card blue</h3>
                    <div class="card-options">
                      <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                      <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                    </div>
                  </div>
                  <div class="card-body">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam deleniti fugit incidunt, iste, itaque minima neque pariatur perferendis sed suscipit velit vitae voluptatem. A consequuntur, deserunt eaque error nulla temporibus!
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-xl-4">
                <div class="card">
                  <div class="card-status bg-green"></div>
                  <div class="card-header">
                    <h3 class="card-title">Card green</h3>
                    <div class="card-options">
                      <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                      <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                    </div>
                  </div>
                  <div class="card-body">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam deleniti fugit incidunt, iste, itaque minima neque pariatur perferendis sed suscipit velit vitae voluptatem. A consequuntur, deserunt eaque error nulla temporibus!
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-xl-4">
                <div class="card">
                  <div class="card-status bg-orange"></div>
                  <div class="card-header">
                    <h3 class="card-title">Card orange</h3>
                    <div class="card-options">
                      <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                      <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                    </div>
                  </div>
                  <div class="card-body">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam deleniti fugit incidunt, iste, itaque minima neque pariatur perferendis sed suscipit velit vitae voluptatem. A consequuntur, deserunt eaque error nulla temporibus!
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-xl-4">
                <div class="card">
                  <div class="card-status bg-red"></div>
                  <div class="card-header">
                    <h3 class="card-title">Card red</h3>
                    <div class="card-options">
                      <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                      <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                    </div>
                  </div>
                  <div class="card-body">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam deleniti fugit incidunt, iste, itaque minima neque pariatur perferendis sed suscipit velit vitae voluptatem. A consequuntur, deserunt eaque error nulla temporibus!
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-xl-4">
                <div class="card">
                  <div class="card-status bg-yellow"></div>
                  <div class="card-header">
                    <h3 class="card-title">Card yellow</h3>
                    <div class="card-options">
                      <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                      <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                    </div>
                  </div>
                  <div class="card-body">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam deleniti fugit incidunt, iste, itaque minima neque pariatur perferendis sed suscipit velit vitae voluptatem. A consequuntur, deserunt eaque error nulla temporibus!
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-xl-4">
                <div class="card">
                  <div class="card-status bg-teal"></div>
                  <div class="card-header">
                    <h3 class="card-title">Card teal</h3>
                    <div class="card-options">
                      <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                      <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                    </div>
                  </div>
                  <div class="card-body">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam deleniti fugit incidunt, iste, itaque minima neque pariatur perferendis sed suscipit velit vitae voluptatem. A consequuntur, deserunt eaque error nulla temporibus!
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-xl-4">
                <div class="card">
                  <div class="card-status bg-purple"></div>
                  <div class="card-header">
                    <h3 class="card-title">Card purple</h3>
                    <div class="card-options">
                      <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                      <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                    </div>
                  </div>
                  <div class="card-body">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam deleniti fugit incidunt, iste, itaque minima neque pariatur perferendis sed suscipit velit vitae voluptatem. A consequuntur, deserunt eaque error nulla temporibus!
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-xl-4">
                <div class="card">
                  <div class="card-status card-status-left bg-blue"></div>
                  <div class="card-header">
                    <h3 class="card-title">Card status on left side</h3>
                    <div class="card-options">
                      <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                      <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                    </div>
                  </div>
                  <div class="card-body">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam deleniti fugit incidunt, iste, itaque minima neque pariatur perferendis sed suscipit velit vitae voluptatem. A consequuntur, deserunt eaque error nulla temporibus!
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-xl-4">
                <div class="card card-collapsed">
                  <div class="card-header">
                    <h3 class="card-title">Initial collapsed card</h3>
                    <div class="card-options">
                      <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                      <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                    </div>
                  </div>
                  <div class="card-body">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam deleniti fugit incidunt, iste, itaque minima neque pariatur perferendis sed suscipit velit vitae voluptatem. A consequuntur, deserunt eaque error nulla temporibus!
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-xl-4">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">With additional fullscreen button</h3>
                    <div class="card-options">
                      <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                      <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
                      <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                    </div>
                  </div>
                  <div class="card-body">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam deleniti fugit incidunt, iste, itaque minima neque pariatur perferendis sed suscipit velit vitae voluptatem. A consequuntur, deserunt eaque error nulla temporibus!
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Panel with custom buttons</h3>
                    <div class="card-options">
                      <a href="#" class="btn btn-primary btn-sm">Action 1</a>
                      <a href="#" class="btn btn-secondary btn-sm ml-2">Action 2</a>
                    </div>
                  </div>
                  <div class="card-body">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam deleniti fugit incidunt, iste, itaque minima neque pariatur perferendis sed suscipit velit vitae voluptatem. A consequuntur, deserunt eaque error nulla temporibus!
                  </div>
                </div>
              </div> -->

              <div class="col-lg-12">
                <div class="card">
                  <!-- <div class="card-header">
                    <h3 class="card-title">Deposit Money</h3>
                     <div class="card-options">
                     
                        <form action="">

                        <div class="input-group">
                          <input type="text" class="form-control form-control-sm" placeholder="Search something..." name="s">
                          <span class="input-group-btn ml-2">
                            <button class="btn btn-sm btn-default" type="submit">
                              <span class="fe fe-search"></span>
                            </button>
                          </span>
                        </div>

                        </form>

                    </div>
                  </div> -->
                  <div class="card-body">

                        <form action="" method="POST">
                             
                            <div class="btn-list text-center">
                                <input onclick ="return confirm('Are you sure you want to deposit <?php echo $amount ?>?')" type="submit" name="submit" class="btn btn-primary" value="Deposit" />
                            
                                <input type="submit" name="submit1" class="btn btn-primary" value="Cancel" />
		
                            </div>
                            
                            
       
                        </form>

                        <br>
                        <?php 
                          if(empty($errors) === false)
                          {
                            echo '<p class="text-center">' . implode('</p><p class="text-center">', $errors) . '</p>';	
                          }
                        ?>

                </div>
                </div>
              </div>

              <!-- <div class="col-lg-6 col-xl-4">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Card with alert</h3>
                    <div class="card-options">
                      <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                      <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                    </div>
                  </div>
                  <div class="card-alert alert alert-success mb-0">
                    Adding action was successful
                  </div>
                  <div class="card-body">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam deleniti fugit incidunt, iste, itaque minima neque pariatur perferendis sed suscipit velit vitae voluptatem. A consequuntur, deserunt eaque error nulla temporibus!
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-xl-4">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Card with alert</h3>
                    <div class="card-options">
                      <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                      <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                    </div>
                  </div>
                  <div class="card-alert alert alert-danger mb-0">
                    Adding action failed
                  </div>
                  <div class="card-body">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam deleniti fugit incidunt, iste, itaque minima neque pariatur perferendis sed suscipit velit vitae voluptatem. A consequuntur, deserunt eaque error nulla temporibus!
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-xl-4">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Card with switch</h3>
                    <div class="card-options">
                      <label class="custom-switch m-0">
                        <input type="checkbox" value="1" class="custom-switch-input" checked>
                        <span class="custom-switch-indicator"></span>
                      </label>
                    </div>
                  </div>
                  <div class="card-body">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam deleniti fugit incidunt, iste, itaque minima neque pariatur perferendis sed suscipit velit vitae voluptatem. A consequuntur, deserunt eaque error nulla temporibus!
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-xl-4">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Card with loader</h3>
                    <div class="card-options">
                      <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                      <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="dimmer active">
                      <div class="loader"></div>
                      <div class="dimmer-content">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam deleniti fugit incidunt, iste, itaque minima neque pariatur perferendis sed suscipit velit vitae voluptatem. A consequuntur, deserunt eaque error nulla temporibus!
                      </div>
                    </div>
                  </div>
                </div>
              </div> -->

            </div>
          </div>
        </div>
   
      </div>
      


      <!-- <div class="footer">
        <div class="container">
          <div class="row">
            <div class="col-lg-8">
              <div class="row">
                <div class="col-6 col-md-3">
                  <ul class="list-unstyled mb-0">
                    <li><a href="#">First link</a></li>
                    <li><a href="#">Second link</a></li>
                  </ul>
                </div>
                <div class="col-6 col-md-3">
                  <ul class="list-unstyled mb-0">
                    <li><a href="#">Third link</a></li>
                    <li><a href="#">Fourth link</a></li>
                  </ul>
                </div>
                <div class="col-6 col-md-3">
                  <ul class="list-unstyled mb-0">
                    <li><a href="#">Fifth link</a></li>
                    <li><a href="#">Sixth link</a></li>
                  </ul>
                </div>
                <div class="col-6 col-md-3">
                  <ul class="list-unstyled mb-0">
                    <li><a href="#">Other link</a></li>
                    <li><a href="#">Last link</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-4 mt-4 mt-lg-0">
              Premium and Open Source dashboard template with responsive and high quality UI. For Free!
            </div>
          </div>
        </div>
      </div> -->


      <?php include 'incl/footer.php' ;?>
    </div>
  </body>
</html>