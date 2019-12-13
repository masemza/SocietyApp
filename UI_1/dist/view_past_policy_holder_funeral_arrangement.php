<?php
require 'core/init.php';
$general->logged_out_protect();
$username = htmlentities($user['username']);
$type = htmlentities($user['type']);

$main_member_id = $_GET['main_member_id'];

$num = 0;

$view_funeral_arrangement = $funeral->past_policy_holder_funeral_arrangement_for_each_society($main_member_id);

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
              <div class="col-lg-3 ml-auto">

                <form class="input-icon my-3 my-lg-0" action="" method="post" >
                  <br>
                  <div class="form-group">
                    <div class="row gutters-xs">
                      <div class="col">
                        <input type="text" name="search" id="myInput" onkeyup="myFunction()" class="form-control" placeholder="Enter Child's Name" required="required">
                      </div>
                      <span class="col-auto">
                        <!-- <button class="btn btn-secondary" type="submit" name="submit" ><i class="fe fe-search"></i></button> --> 
                      </span>
                    </div>
                  </div>      
                </form>
          
              </div>

              <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">

                  <li class="nav-item">
                    <?php
                    if($type == 'admin' || $type == 'manager')
                    {?>
                      <a href="./manage_members.php" class="nav-link active"><i class="fe fe-home"></i> Home</a>
                    <?php
                    }
                    else 
                    if($type == 'user')
                    {?>
                      <a href="./index.php" class="nav-link active"><i class="fe fe-home"></i> Home</a>
                    <?php
                    }?>
                  </li>

                  <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-users"></i>Manage Spouse</a>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="./view_spouse.php?main_member_id=<?php echo $main_member_id ?>" class="dropdown-item "><i class="fe fe-users"></i>View Spouse</a>
                      <a href="./spouse.php?main_member_id=<?php echo $main_member_id ?>" class="dropdown-item "><i class="fe fe-user-plus"></i>Add Spouse</a>
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
                      <a href="./view_extended_family.php?main_member_id=<?php echo $main_member_id ?>" class="dropdown-item"><i class="fe fe-users"></i>View Extended Family</a>
                      <a href="./extended_family.php?main_member_id=<?php echo $main_member_id ?>" class="dropdown-item "><i class="fe fe-user-plus"></i>Add Extended Family</a>
                    </div>
                  </li>

                  <li class="nav-item">
                     
                  </li>

                  <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-menu"></i>More</a>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="./member_details.php?main_member_id=<?php echo $main_member_id ?>" class="dropdown-item"><i class="fe fe-users"></i>View All Members </a>
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
                <a href="index.php" style="text-decoration: none;"> <i class="fe fe-arrow-left"></i>Home</a> | Past Funeral Arrangement Details
              </h1>
            </div>

              <div class="row row-cards">
                <div class="col-sm-6 col-lg-6">
                  <div class="card p-1 align-items-center">
                    <div class="d-flex align-items-center">
                      <div class="col-lg order-lg-first">
                        <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                          <li class="nav-item">
                            <a href="view_policy_holder_funeral_arrangement.php?main_member_id=<?php echo $main_member_id ?>" class="nav-link"><i class="fe fe-users"></i>Future Funeral Arrangement</a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-sm-6 col-lg-6">
                  <div class="card p-1 align-items-center">
                    <div class="d-flex align-items-center">
                        <div class="col-lg order-lg-first">
                          <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                            <li class="nav-item">
                              <a href="javascript:void(0)" class="nav-link active"><i class="fe fe-users"></i>Past Funeral Arrangement</a>
                            </li>
                          </ul>
                        </div>
                    </div>
                  </div>
                </div>

              </div>
      
              <div class="col-lg-12">
                <div class="card">
                  <div class="card-body">
                    <form action="" method="post" class="text-center">
                      <?php 
                      if(empty($errors) === false)
                      {	
                      ?>
                        <form action="" method="post" class="text-center">
                          <h3>
                            <div class="form-group">
                              Sorry!!! <br>
                              Member name: "<?php echo ucfirst($search) ?>" does'nt exist
                            </div>
                            
                            <div class="form-group">
                              <button class="btn btn-secondary" type="submit" name="submit1" >Click here to view all members</button>
                            </div>
                          </h3>
                        </form>

                      <?php 
                      }?>

                      <div class="table-responsive push">
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
                                 
                            <?php 
                            if($view_funeral_arrangement)
                            {?>
                              <table id="myTable" class="table table-bordered table-hover">
                                <tr>
                                  <th class="text-center" style="width: 0.5%"></th>
                                  <th class="text-center" style="width: 2%">First Name(s)</th>
                                  <th class="text-center" style="width: 2%">Surname</th>
                                  <th class="text-center" style="width: 1%">Funeral Time</th>
                                  <th class="text-center" style="width: 4%">Location of the funeral</th>
                                  <th class="text-center" style="width: 1%">Total Package</th>
                                  <th class="text-center" style="width: 2%">Action</th>                  
                                </tr>
                                    
                                <?php foreach ($view_funeral_arrangement as $funeral_arrangement_row) 
                                {?>
                                  <tr>
                                    <td class="text-center">
                                        <?php echo $num += 1 ?>
                                    </td>       

                                    <td class="text-center">
                                      <?php echo $funeral_arrangement_row['first_name']; ?>
                                    </td>

                                    <td class="text-center">
                                      <?php echo $funeral_arrangement_row['last_name']; ?>
                                    </td>

                                    <td>
                                      <p class="font-w600 mb-1 text-center">
                                        <?php echo $funeral_arrangement_row['funeral_time']; ?>
                                      </p>
                                    </td>

                                    <td>
                                      <p class="font-w600 mb-1 text-center">
                                        <?php echo $funeral_arrangement_row['street']; ?> <br>
                                        <?php echo $funeral_arrangement_row['suburb']; ?> <br>
                                        <?php echo $funeral_arrangement_row['city']; ?> <br>
                                        <?php echo $funeral_arrangement_row['province']; ?> 
                                      </p>
                                    </td>

                                    <td>
                                      <p class="font-w600 mb-1 text-center">
                                        <?php echo $funeral_arrangement_row['total_package']; ?>
                                      </p>
                                    </td>

                                    <td class="button-center">
                                      <div class="btn-list text-center" class="input-group button-center">
                                        <div class="btn-list text-center" class="input-group-prepend">
                                          <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                          <div class="dropdown-menu">
                                            <a href="./policy_holder_funeral_receipt.php?policy_holder_funeral_id=<?php echo $funeral_arrangement_row['policy_holder_funeral_id']?>" class="dropdown-item"><i class="dropdown-icon fe fe-edit"></i> View Funeral Arrangement </a>
                                            <!-- <a onclick ="return confirm('Are you sure you want to delete <?php //echo $children_row['first_name'] ?> <?php //echo $children_row['last_name'] ?>?')" href="./delete_children.php?children_id=<?php //echo $children_row['children_id']?>" class="dropdown-item" class="dropdown-item"><i class="dropdown-icon fe fe-trash-2"></i> Delete Child</a> -->
                                          </div>
                                        </div>
                                      </div>
                                    </td>
                                  </tr>
                                <?php 
                                }?>

                              </table>
                            <?php
                            }
                            else
                            {?>
                              <h1 class="page-title">
                                There is no funeral arrangement happening soon for this Society
                              </h1>
                            <?php
                            }?>

                          </div> 
                                                                                           
                          </form>
                    
                        <?php
                        }?>

                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>

      <?php include 'incl/footer.php' ;?>
    </div>

<script type="text/javascript">
    $(document).ready(function(){
        $("#search_text").keyup(function(){
            var search = $(this).val();
            $.ajax({
                url:'viewMemberAction.php',
                method:'post',
                data:{query:search},
                success:function(response){
                    $("#table-data").html(response)
                }
            });
        });
    });
</script>

<!-- Table filter -->
<script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 1; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>


  </body>
</html>