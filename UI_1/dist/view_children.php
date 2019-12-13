<?php
require 'core/init.php';
$general->logged_out_protect();
$username = htmlentities($user['username']);
$type = htmlentities($user['type']);

$main_member_id = $_GET['main_member_id'];
$num = 0;

$view_children = $children->all_children_data($main_member_id);

$view_main_member = $main_member->memberdata($main_member_id);
foreach($view_main_member as $main_member_row) {}

if (isset($_POST['submit']))
{
	$search = $_POST['search'];
	
	if(empty($_POST['search']))
	{
		$errors[] = "Enter members first/last name";
	}

	else 
		if ($member->member_exists($search) === false) 
		{
			$errors[] = 'Sorry that member does\'nt exists.';
		}

	$view_members = $member->search_member($search);
	
}

if (isset($_POST['submit1']))
{
	$view_members = $member->memberInformation();
}

?>

<!doctype html>
<html lang="en" dir="ltr">
<head>
  <style type="text/css">
      details {
        cursor: pointer;
    }
  </style>
</head>
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
                        <input type="text" name="search" id="myInput" onkeyup="myFunction()" class="form-control" placeholder="Enter Member's Name" required="required">
                      </div>
                      <span class="col-auto">
                        <button class="btn btn-secondary" type="submit" name="submit" ><i class="fe fe-search"></i></button>
                      </span>
                    </div>
                  </div>      
                </form>
          
              </div>

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
                      <a href="./spouse.php?main_member_id=<?php echo $main_member_id ?>" class="dropdown-item "><i class="fe fe-user-plus"></i>Add Spouse</a>
                    </div>
                  </li>

                  <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link active" data-toggle="dropdown"><i class="fe fe-users"></i>Manage Children Details</a>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="./view_children.php?main_member_id=<?php echo $main_member_id ?>" class="dropdown-item active"><i class="fe fe-users"></i>View Children</a>
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
                    <a href="./member_details.php?main_member_id=<?php echo $main_member_id ?>" class="nav-link"><i class="fe fe-users"></i>View All Members </a> 
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
                <?php if($type == 'user')
                {?>
                  <a href="./index.php" style="text-decoration: none;"> <i class="fe fe-arrow-left"></i>Home</a> | Children's Details
                <?php
                }
                else if($type == 'admin' || $type == 'manager')
                {?>
                  <a href="./view_main_member.php?main_member_id=<?php echo $main_member_id ?>" style="text-decoration: none;"> <i class="fe fe-arrow-left"></i>Member Details</a> | Children's Details
                <?php
                }?>

              </h1>
            </div>

                          <div class="row row-cards">
                <div class="col-sm-6 col-lg-4">
                  <div class="card p-1 align-items-center">
                    <div class="d-flex align-items-center">
                      

                      <div class="col-lg order-lg-first">
                        <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                          <li class="nav-item">
                            <a href="./view_spouse.php?main_member_id=<?php echo $main_member_id ?>" class="nav-link"><i class="fe fe-users"></i>View Spouse</a>
                          </li>
                        </ul>
                      </div>


                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                  <div class="card p-1 align-items-center">
                    <div class="d-flex align-items-center">


                        <div class="col-lg order-lg-first">
                          <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                            <li class="nav-item">
                              <a href="./view_children.php?main_member_id=<?php echo $main_member_id ?>" class="nav-link active"><i class="fe fe-users"></i>View Children</a>
                            </li>
                          </ul>
                        </div>


                    </div>
                  </div>
                </div>

                <div class="col-sm-6 col-lg-4">
                  <div class="card p-1 align-items-center">
                    <div class="d-flex">


                          <div class="col-lg order-lg-first">
                            <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                              <li class="nav-item">
                                <a href="./view_extended_family.php?main_member_id=<?php echo $main_member_id ?>" class="nav-link"><i class="fe fe-users"></i> View Extended Family</a>
                              </li>
                            </ul>
                          </div>

                          <!-- <button class="btn btn-secondary" type="submit" name="submit1" >View Immediate Family</button> -->


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

                      <?php
                      if($view_children)
                      {?>
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
                                                    
                            <table id="myTable" class="table table-bordered table-hover">
                              <tr>
                                <th class="text-center" style="width: 0.5%"></th>
                                <th class="text-center" style="width: 5%">First Name(s)</th>
                                <th class="text-center" style="width: 5%">Surname</th>
                                <th class="text-center" style="width: 1%">Gender</th>
                                <th class="text-center" style="width: 2%">Contact Number</th>
                                <th class="text-center" style="width: 2%">ID Number</th>
                                <!-- <th class="text-center" style="width: 1%">Relation</th> -->
                                <th class="text-center" style="width: 1%">Action</th>                  
                              </tr>
                                  
                              <?php foreach ($view_children as $children_row) 
                              {?>
                                <tr>
                                  <td class="text-center">
                                      <?php echo $num += 1 ?>
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

                                  <!-- <td>
                                    <p class="font-w600 mb-1 text-center">
                                      <?php //echo $children_row['relation']; ?>
                                    </p>
                                  </td> -->

                                  <td class="button-center">
                                    <div class="btn-list text-center" class="input-group button-center">
                                      <div class="btn-list text-center" class="input-group-prepend">
                                        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                        <div class="dropdown-menu">
                                          <a href="./edit_children.php?family_id=<?php echo $children_row['family_id']?>" class="dropdown-item"><i class="dropdown-icon fe fe-edit"></i> Edit Child </a>
                                          <a href="plan_policy_holder_funeral.php?family_id=<?php echo $children_row['family_id'] ?>" class="dropdown-item"><i class="dropdown-icon fe fe-clipboard"></i>Plan a funeral</a>
                                          <a onclick ="return confirm('Are you sure you want to delete <?php echo $children_row['first_name'] ?> <?php echo $children_row['last_name'] ?>?')" href="./delete_children.php?family_id=<?php echo $children_row['family_id']?>" class="dropdown-item" class="dropdown-item"><i class="dropdown-icon fe fe-trash-2"></i> Delete Child</a>
                                        </div>
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                              <?php 
                              }?>
                          <?php
                          }?>

                            </table>
                                  
                          </div> 
                      
                      <?php
                      }
                      else
                      {?>
                        <h3>
                          Sorry!!! <br>
                          <?php echo $main_member_row['first_name']?> <?php echo $main_member_row['last_name']?> does'nt have Children <br>
                        </h3>
                        <div class="text-center">
                          <a href="./children.php?main_member_id=<?php echo $main_member_id ?>" class="btn btn-sm btn-outline-primary" role="button"> Click here to add Children </a>
                        </div>
                      <?php
                      }?>

                    </form>
                  
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
    td = tr[i].getElementsByTagName("td")[2];
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