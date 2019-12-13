<?php
require 'core/init.php';
$general->logged_out_protect();
$username = htmlentities($user['username']);

$society_id = $_GET['society_id'];
$view_members = $member->get_All_Nonactive_Members($society_id);
global $num;

if (isset($_POST['submit']))
{
	$search = $_POST['search'];
	
	if(empty($_POST['search']))
	{
		$errors[] = "Enter members first/last name";
	}

	else 
		if ($member-> member_exists($search) === false) 
		{
			$errors[] = 'Sorry that member does\'nt exists.';
		}

	$view_members = $member->search_member($search, $society_id);
	
}

if (isset($_POST['submit1']))
{
	$view_members = $member->get_All_Members($society_id);
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
              <div class="col-lg-3 ml-auto">

                <form class="input-icon my-3 my-lg-0" action="" method="post" >

                  <br>
                  <div class="form-group">
                    <div class="row gutters-xs">
                      <div class="col">
                        <input type="text" name="search" id="myInput" onkeyup="myFunction()" class="form-control" placeholder="Enter Member's First Name(s)" required="required">
                      </div>
                      <span class="col-auto">
                        <button class="btn btn-secondary" type="submit" name="submit"><i class="fe fe-search"></i></button>          
                      </span>
                    </div>
                  </div>      
                </form>
                
              </div>
              <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                  
                  <li class="nav-item">
                    <a href="./index.php" class="nav-link"><i class="fe fe-home"></i> Home</a>
                  </li>

                  <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link active" data-toggle="dropdown"><i class="fe fe-users"></i>Manage Members</a>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="./view_members.php?society_id=<?php echo $society_id ?>" class="dropdown-item active"><i class="fe fe-users"></i>View Members</a>
                      <a href="./addMember.php?society_id=<?php echo $society_id; ?>" class="dropdown-item"><i class="fe fe-user-plus"></i>Add A New Member</a>
                    </div>
                  </li>

                  <li class="nav-item dropdown">
                    <a href="./view_package.php?society_id=<?php echo $society_id ?>" class="nav-link"><i class="dropdown-icon fe fe-layers"></i> View Package</a>
                  </li>

                  <li class="nav-item dropdown">
                    <a href="./view_society_funeral_arrangement.php?society_id=<?php echo $society_id ?>" class="nav-link"><i class="dropdown-icon fe fe-activity"></i> View Funeral Arrangements</a>
                  </li>

                  <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-menu"></i>More</a>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="./create_invoice.php" class="dropdown-item "><i class="fe fe-file-plus"></i>Capture Invoice</a>
                      <a href="./create_expense.php" class="dropdown-item "><i class="fe fe-file-plus"></i>Capture Expense</a>
                      <a href="./view_report.php" class="dropdown-item "><i class="fe fe-file-text"></i>View Report</a>
                      <a href="./manage_members.php" class="dropdown-item "><i class="fe fe-users"></i>Main Member's Dashboard</a>
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
                <a href="view_statements.php?society_id=<?php echo $society_id ?>" style="text-decoration: none;"> <i class="fe fe-arrow-left"></i>Society Details</a> | Member Details
              </h1>
            </div>

            <div class="row row-cards">
                <div class="col-sm-6 col-lg-6">
                  <div class="card p-1 align-items-center">
                    <div class="d-flex align-items-center">
                      <div class="col-lg order-lg-first">
                        <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                          <li class="nav-item">
                            <a href="view_members.php?society_id=<?php echo $society_id ?>" class="nav-link"><i class="fe fe-users"></i>Active Members</a>
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
                              <a href="javascript:void(0)" class="nav-link active"><i class="fe fe-users"></i>Non Active Members</a>
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
                    if(empty($errors) === false )
                    {?>
                      <form action="" method="post" class="text-center">
                        <h3>
                          Sorry!!! <br>
                          Member name: "<?php echo ucfirst($search) ?>" does'nt exist
                        </h3>
                        <br>
                        <button class="btn btn-secondary" type="submit" name="submit1" >Click here to view all members</button>
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
                          }?>
                        </div>
                        </h1>

                        <?php 
                        if(empty($view_members))
                        {?>
                          <h3>
                            Sorry!!! <br>This Society does not have any members who passed away <br>
                          </h3>
                          <!-- <div class="text-center">
                            <a href="./addMember.php?society_id=<?php //echo $society_id ?>" class="btn btn-sm btn-outline-primary" role="button"> Click here to add a new member </a>
                          </div>  -->                                   
                        <?php 
                        } 
                        else 
                        {?>

                          <table id="myTable" class="table table-bordered table-hover">
                            <tr>
                              <th class="text-center" style="width: 0.5%"></th>
                              <th class="text-center" style="width: 3%">Society Name</th>
                              <th class="text-center" style="width: 5%">First Name(s)</th>
                              <th class="text-center" style="width: 4%">Last Name</th>
                              <th class="text-center" style="width: 1%">Gender</th>
                              <th class="text-center" style="width: 3%">Contact Number</th>
                              <th class="text-center" style="width: 1%">ID Number</th>
                              <th class="text-center" style="width: 3%">Action</th>
                                                            
                            </tr>
                                        
                            <?php foreach ($view_members as $row) 
                            {?>
                              <tr>
                                <td class="text-center"><?php echo $num += 1 ?></td>
                                
                                <td>
                                  <p class="font-w600 mb-1 text-center"><?php echo $row['society_name']; ?></p>
                                </td>
                                
                                <td class="text-center">
                                  <?php echo $row['first_name']; ?>
                                </td>
                                
                                <td class="text-center"><?php echo $row['last_name']; ?></td>
                                
                                <td class="text-center"><?php echo $row['gender']; ?></td>
                                
                                <td class="text-center">
                                <?php echo $row['contact_num']; ?>
                                </td>
                                
                                <td class="text-center">
                                  <?php echo $row['id_number']; ?>
                                </td>
                                
                                <td class="button-center">
                                  <div class="btn-list text-center" class="input-group button-center">
                                    <div class="btn-list text-center" class="input-group-prepend">
                                      <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action
                                      </button>
                                      <div class="dropdown-menu">
                                        <!-- <a href="./edit_member.php?member_id=<?php //echo $row['member_id']?>" class="dropdown-item"><i class="dropdown-icon fe fe-edit"></i> Edit Member </a> -->
                                        <!-- <a href="plan_funeral.php?member_id=<?php //echo $row['member_id'] ?>" class="dropdown-item"><i class="dropdown-icon fe fe-clipboard"></i>Plan a funeral</a> -->
                                        <?php if($type == 'manager')
                                        {?>
                                          <a onclick ="return confirm('Are you sure you want to delete <?php echo $row['first_name'] ?> <?php echo $row['last_name'] ?>?')" href="./delete_member.php?member_id=<?php echo $row['member_id']?>" class="dropdown-item" class="dropdown-item"><i class="dropdown-icon fe fe-trash-2"></i> Delete Member</a>
                                        <?php
                                        }
                                        else
                                        {?>
                                          <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-circle"></i> None </a>
                                        <?php
                                        }?>
                                      </div>
                                    </div>
                                  </div>                                          
                                </td>
                              </tr>
                            <?php 
                            }?>
                                        
                                                          
                        <?php 
                        }
                      }?>
                          </table>
                    </div> 
                                                                                           
                  </form>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php include 'incl/footer.php' ;?>

<script type="text/javascript">
    $(document).ready(function(){
        $("#search_text").keyup(function(){
            var search = $(this).val();
            $.ajax({
                url:"view_memberAction.php?society_id=<?php echo $society_id; ?>",
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