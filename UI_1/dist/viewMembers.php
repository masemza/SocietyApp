<?php
require 'core/init.php';
$general->logged_out_protect();
$username = htmlentities($user['username']);

$view_members = $member->memberInformation();
global $num;

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

                  <!-- <input type="search" class="form-control header-search" placeholder="Enter Society Or Member's Name" tabindex="1">
                  <div class="input-icon-addon">
                    <i class="fe fe-search"></i>
                  </div> -->

                  <br>
                  <div class="form-group">
                          <!-- <label class="form-label">Separated inputs</label> -->
                          <div class="row gutters-xs">
                            <div class="col">
                              <input type="text" name="search" id="myInput" onkeyup="myFunction()" class="form-control" placeholder="Enter Member's First Name" required="required">
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
                  
                  <?php if($type == 'admin' || $type == 'manager')
                  {?>
                    <li class="nav-item">
                      <a href="./index.php" class="nav-link active"><i class="fe fe-home"></i> Home</a>
                    </li>

                    <li class="nav-item">
                      <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-file"></i>Capture Invoices</a>
                      <div class="dropdown-menu dropdown-menu-arrow">
                        <a href="./view_invoice.php" class="dropdown-item "><i class="fe fe-file-text"></i>View Invoice</a>
                        <a href="./create_invoice.php" class="dropdown-item "><i class="fe fe-file-plus"></i>Create a new Invoice</a>
                      </div>
                    </li>

                    <li class="nav-item">
                      <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-file"></i>Capture Expenses</a>
                      <div class="dropdown-menu dropdown-menu-arrow">
                        <a href="./view_expense.php" class="dropdown-item "><i class="fe fe-file-text"></i>View Expenses</a>
                        <a href="./create_expense.php" class="dropdown-item "><i class="fe fe-file-plus"></i>Create a new Expenses</a>
                      </div>
                    </li>

                    <?php if($type === "manager") 
                    {?>
                      <li class="nav-item dropdown">
                        <a href="./view_report.php" class="nav-link"><i class="fe fe-file-text"></i> View Reports </a>
                      </li>
                    <?php 
                    }?>
                       
                    <li class="nav-item">
                      <a href="./manage_members.php" class="nav-link"><i class="fe fe-users"></i>Main Member's Dashboard</a>
                    </li>
                  <?php
                  }?>

                  <!-- <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-box"></i>Transaction</a>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="./deposit.html" class="dropdown-item ">Deposit</a>
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
                    <a href="javascript:void(0)" class="nav-link"><i class="fe fe-check-square"></i> Forms</a>
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
                          <a href="index.php" style="text-decoration: none;"> <i class="fe fe-arrow-left"></i>Home</a> | Member Details
                        </h1>
                  </div>
      
                  <!-- <div class="row"> -->
      
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

                                    <?php }?>



                                              <div class="table-responsive push">

                                              <?php 
                                                  if(empty($errors) === true){   
                                                    
                                              ?>

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
                                                      <th class="text-center" style="width: 3%">Society Name</th>
                                                      <th class="text-center" style="width: 5%">First Name</th>
                                                      <th class="text-center" style="width: 4%">Last Name</th>
                                                      <th class="text-center" style="width: 1%">Gender</th>
                                                      <th class="text-center" style="width: 1%">Contact Number</th>
                                                      <th class="text-center" style="width: 1%">ID Number</th>
                                                      <th class="text-center" style="width: 3%">Action</th>
                                                     
                                                    </tr>
                                
                                                    <?php foreach ($view_members as $row) { ?>
                                                    <tr>
                                                      <td class="text-center"><?php echo $num += 1 ?></td>
                                                      <td>
                                                        <p class="font-w600 mb-1 text-center"><?php echo $row['society_name']; ?></p>
                                                        <!-- <div class="text-muted">Logo and business cards design</div> -->
                                                      </td>
                                                      <td class="text-center">
                                                      <?php echo $row['first_name']; ?>
                                                      </td>
                                                      <td class="text-center"><?php echo $row['last_name']; ?></td>
                                                      <td class="text-center"><?php echo $row['gender']; ?></td>
                                                      <td class="text-center">
                                                      <?php echo $row['contact_num']; ?>
                                                        </td>
                                                        <td class="text-center"><?php echo $row['id_number']; ?></td>
                                                        <td class="button-center">
                                                              <div class="btn-list text-center" class="input-group button-center">
                                                                  <div class="btn-list text-center" class="input-group-prepend">
                                                                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                      Action
                                                                    </button>
                                                                    <div class="dropdown-menu">
                                                                      <a href="./edit_member.php?member_id=<?php echo $row['member_id']?>" class="dropdown-item"><i class="dropdown-icon fe fe-edit"></i> Edit Member </a>
                                                                      <a href="plan_funeral.php?member_id=<?php echo $row['member_id'] ?>" class="dropdown-item"><i class="dropdown-icon fe fe-clipboard"></i>Plan a funeral</a>
                                                                      <a onclick ="return confirm('Are you sure you want to delete <?php echo $row['first_name'] ?> <?php echo $row['last_name'] ?>?')" href="./delete_member.php?member_id=<?php echo $row['member_id']?>" class="dropdown-item" class="dropdown-item"><i class="dropdown-icon fe fe-trash-2"></i> Delete Member</a>
                                                                    </div>
                                                                  </div>
                                                                  </div>
                                                        </td>
                                                    </tr>
                                                    <?php } ?>
                                
                                                   
                                                    <?php } ?>
                                                  </table>
                                                  
                                                  
                                                </div> 
                                                                                           
                                          </form>
                  
                                  </div>
                                  </div>
                                </div></div>
      
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