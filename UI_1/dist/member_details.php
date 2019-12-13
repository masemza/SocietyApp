<?php
require 'core/init.php';
$general->logged_out_protect();
$username = htmlentities($user['username']);
$type = htmlentities($user['type']);

$main_member_id =$_GET['main_member_id'];

$view_member = $main_member->memberdata($main_member_id);
foreach($view_member as $main_member_row)
{

}

$view_children = $children->all_children_data($main_member_id);
$view_spouse = $spouse->all_spouse_data($main_member_id);
$view_extended_family = $extended_family->all_extended_family_data($main_member_id);

$num_spouse = 0;
$num_childrean = 0;
$num_extended_family = 0;

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
                    <?php if($type == 'user')
                    {?>
                      <a href="./index.php" class="nav-link"><i class="fe fe-home"></i> Home</a>
                    <?php
                    }
                    else if($type == 'admin' || $type == 'manager')
                    {?>
                      <a href="./manage_members.php" class="nav-link"><i class="fe fe-home"></i> Home</a>
                    <?php
                    }?>
                  </li>

                  <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-users"></i>Manage Spouse</a>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="./view_spouse.php?main_member_id=<?php echo $main_member_id ?>" class="dropdown-item "><i class="fe fe-users"></i>View Spouse</a>
                      <a href="./spouse.php?main_member_id=<?php echo $main_member_id ?>" class="dropdown-item"><i class="fe fe-user-plus"></i>Add Spouse</a>
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
                      <a href="./view_extended_family.php?main_member_id=<?php echo $main_member_id ?>" class="dropdown-item "><i class="fe fe-users"></i>View Extended Family</a>
                      <a href="./extended_family.php?main_member_id=<?php echo $main_member_id ?>" class="dropdown-item "><i class="fe fe-user-plus"></i>Add Extended Family</a>
                    </div>
                  </li>

                  <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link active" data-toggle="dropdown"><i class="fe fe-menu"></i>More</a>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="./member_details.php?main_member_id=<?php echo $main_member_id ?>" class="dropdown-item active"><i class="fe fe-users"></i>View All Members </a>
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
                <a href="./view_main_member.php?main_member_id=<?php echo $main_member_id ?>" style="text-decoration: none;"> <i class="fe fe-arrow-left"></i>Member Details</a> | Member Details
              </h1>
            </div>

            <div class="card">
              <div class="card-header">
                <h3 class="card-title"> Member Details</h3>
                <div class="card-options">
                  <button type="button" class="btn btn-primary btn-sm" onclick="javascript:window.print();"><i class="fe fe-download"></i> Download Member Details</button>
                </div>
              </div>

              <div class="card-body">
                <div class=" text-center">
                  <p class="h2"> <u>Member Details</u></p>
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
                      <h3> Member ID: <u><?php echo $main_member_id ?></u> </h3>
                  </div>
                  
                  <div class="col-6 text-right">
                    <address>
                      <h4><p> Date: <u><?php echo date("d-m-Y"); ?></u> </p></h4>
                    </address>
                  </div>
                </div>

                <div class="table-responsive push">
                  <?php
                    if($view_spouse)
                    {?>
                      <h1 class="page-title">
                        Spouse Details
                      </h1>
                      <?php 
                      if(empty($errors) === true)
                      {?>
                        <h1 class="page-title">
                          <div class="form-group">
                            <?php if(isset($_POST['submit']))
                            {
                              echo 'Results for Member Name: "'.ucfirst($search).'"'; 
                            }?>
                          </div>
                        </h1>
                                                    
                        <table id="myTable" class="table table-bordered table-hover">
                          <tr>
                            <th class="text-center" style="width: 0.5%"></th>
                            <th class="text-center" style="width: 5%">First Name(s)</th>
                            <th class="text-center" style="width: 5%">Surname</th>
                            <th class="text-center" style="width: 1%">Gender</th>
                            <th class="text-center" style="width: 2%">Contact Number</th>
                            <th class="text-center" style="width: 2%">ID Number</th>
                            <th class="text-center" style="width: 1%">Relation</th>             
                          </tr>
                                  
                          <?php foreach ($view_spouse as $spouse_row) 
                          {?>
                            <tr>
                              <td class="text-center">
                                <?php echo $num_spouse += 1 ?>
                              </td>       

                              <td class="text-center">
                                <?php echo $spouse_row['first_name']; ?>
                              </td>

                              <td class="text-center">
                                <?php echo $spouse_row['last_name']; ?>
                              </td>

                              <td class="text-center">
                                <?php echo $spouse_row['gender']; ?>
                              </td>

                              <td class="text-center">
                                <?php echo $spouse_row['contact_number']; ?>
                              </td>

                              <td class="text-center">
                                <?php echo $spouse_row['id_number']; ?>
                              </td>

                              <td>
                                <p class="font-w600 mb-1 text-center">
                                  <?php echo $spouse_row['relation']; ?>
                                </p>
                              </td>

                            </tr>
                          <?php 
                          }?>
                        </table>
                      <?php
                      }?>

                    <?php
                    }
                    else
                    {?>
                      <h3>
                        <?php echo $main_member_row['first_name']?> <?php echo $main_member_row['last_name']?> does'nt have a Spouse Member <br>
                      </h3>
                      <!-- <div class="text-left">
                        <a href="./spouse.php?main_member_id=<?php //echo $main_member_id ?>" class="btn btn-sm btn-outline-primary" role="button"> Click here to add a Spouse Member </a>
                        <br>
                        <br>
                      </div> -->
                    <?php
                    }?>

                  <?php
                      if($view_children)
                      {?>
                        <h1 class="page-title">
                          Childrean Details
                        </h1>
                        <?php 
                        if(empty($errors) === true)
                        {?>
                          <h1 class="page-title">
                            <div class="form-group">
                              <?php if(isset($_POST['submit']))
                              {
                                echo 'Results for Member Name: "'.ucfirst($search).'"'; 
                              } 
                              ?>
                            </div>
                          </h1>
                                                    
                          <table id="myTable" class="table table-bordered table-hover">
                            <tr>
                              <th class="text-center" style="width: 0.35%"></th>
                              <th class="text-center" style="width: 5%">First Name(s)</th>
                              <th class="text-center" style="width: 5%">Surname</th>
                              <th class="text-center" style="width: 1%">Gender</th>
                              <th class="text-center" style="width: 2%">Contact Number</th>
                              <th class="text-center" style="width: 2%">ID Number</th>

                            </tr>
                                  
                            <?php foreach ($view_children as $children_row) 
                            {?>
                              <tr>
                                <td class="text-center">
                                  <?php echo $num_childrean += 1 ?>
                                </td>       

                                <td class="text-center">
                                  <?php echo $children_row['first_name']; ?>
                                </td>

                                <td class="text-center">
                                  <?php echo $children_row['last_name']; ?>
                                </td>

                                <td class="text-center">
                                  <?php echo $children_row['gender']; ?>
                                </td>

                                <td class="text-center">
                                  <?php echo $children_row['contact_number']; ?>
                                </td>

                                <td class="text-center">
                                  <?php echo $children_row['id_number']; ?>
                                </td>

                              </tr>
                            <?php 
                            }?>
                          </table>
                        <?php
                        }?> 
                  <?php
                  }
                  else
                  {?>
                    <h3>
                      Sorry!!! <br>
                      <?php echo $main_member_row['first_name']?> <?php echo $main_member_row['last_name']?> does'nt have Children <br>
                    </h3>
                    <!-- <div class="text-center">
                      <a href="./children.php?main_member_id=<?php //echo $main_member_id ?>" class="btn btn-sm btn-outline-primary" role="button"> Click here to add Children </a>
                    </div> -->
                  <?php
                  }?>

                  <?php
                    if($view_extended_family)
                    {?>
                      <h1 class="page-title">
                        Extended Family Details
                      </h1>
                      <?php 
                      if(empty($errors) === true)
                      {?>
                        <h1 class="page-title">
                          <div class="form-group">
                            <?php if(isset($_POST['submit']))
                            {
                              echo 'Results for Member Name: "'.ucfirst($search).'"'; 
                            } 
                      ?>
                          </div>
                        </h1>
                                                    
                        <table id="myTable" class="table table-bordered table-hover">
                          <tr>
                            <th class="text-center" style="width: 0.5%"></th>
                            <th class="text-center" style="width: 5%">First Name(s)</th>
                            <th class="text-center" style="width: 5%">Surname</th>
                            <th class="text-center" style="width: 1%">Gender</th>
                            <th class="text-center" style="width: 2%">Contact Number</th>
                            <th class="text-center" style="width: 2%">ID Number</th>
                            <th class="text-center" style="width: 1%">Relation</th>                
                          </tr>
                                  
                          <?php foreach ($view_extended_family as $extended_family_row) 
                          {?>
                            <tr>
                              <td class="text-center">
                                <?php echo $num_extended_family += 1 ?>
                              </td>       

                              <td class="text-center">
                                <?php echo $extended_family_row['first_name']; ?>
                              </td>

                              <td class="text-center">
                                <?php echo $extended_family_row['last_name']; ?>
                              </td>

                              <td class="text-center">
                                <?php echo $extended_family_row['gender']; ?>
                              </td>

                              <td class="text-center">
                                <?php echo $extended_family_row['contact_number']; ?>
                              </td>

                              <td class="text-center">
                                <?php echo $extended_family_row['id_number']; ?>
                              </td>

                              <td>
                                <p class="font-w600 mb-1 text-center">
                                  <?php echo $extended_family_row['relation']; ?>
                                </p>
                              </td>

                            </tr>
                          <?php 
                          }?>
                      <?php
                      }?>
                        </table>         
                    <?php
                    }
                    else
                    {?>
                      <h3>
                        <?php echo $main_member_row['first_name']?> <?php echo $main_member_row['last_name']?> does'nt have Extended Family <br>
                      </h3>
                      <!-- <div class="text-center">
                        <a href="./extended_family.php?main_member_id=<?php //echo $main_member_id ?>" class="btn btn-sm btn-outline-primary" role="button"> Click here to add Extended Member </a>
                      </div> -->
                    <?php
                    }?>

                </div>

                <hr>
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