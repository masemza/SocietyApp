<?php
require 'core/init.php';
$general->logged_out_protect();

$id = htmlentities($user['id']);
$username = htmlentities($user['username']);

$view_societies = $society->societyInformation();
$view_admin = $users->userdata($id);

if (isset($_POST['submit']))
{
	$search = $_POST['search'];
	
	if(empty($_POST['search']))
	{
		$errors[] = "Enter society name or id";
	}

	else 
		if ($society-> society_exists($search) === false) 
		{
			$errors[] = 'Sorry that society does\'nt exists.';
		}

	$view_societies = $society->search_society($search);
	
}

if (isset($_POST['submit1']))
{
	$view_societies = $society->societyInformation();
}

?>

<!doctype html>
<html lang="en" dir="ltr">

<head>
  <style type="text/css">
      table tr {
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
  
                <form class="input-icon my-3 my-lg-0" action="" method="post">
                  <br>
                  <div class="form-group">
                    <div class="row gutters-xs">
                      <div class="col">
                        <input type="text" name="search" id="myInput" onkeyup="myFunction()" class="form-control" placeholder="Enter Society Name" required="required">
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

                </ul>
              </div>
            </div>
          </div>
        </div>
        
        <div class="my-3 my-md-5">
          <div class="container">
            <div class="page-header">
              <h1 class="page-title">
                <a href="index.php" style="text-decoration: none;"> <i class="fe fe-arrow-left"></i>Home</a> | Society Details
              </h1>
            </div>
      
              <?php 
              if(empty($errors) === false)
              {?>
                <form action="" method="post" class="text-center">
                  <div class="form-group">
                    <h3>Sorry!!! <br>
                      Society name: "<?php echo ucfirst($search) ?>" does'nt exist
                      <br>
                  </div>
                    
                  <div class="form-group">
                    <button class="btn btn-secondary" type="submit" name="submit1" >Click here to view all societies</button>
                  </div>
                    </h3>
                </form>
              <?php 
              }?>
  
              <?php 
              if(empty($errors) === true)
              {?>
                <div class="row row-cards row-deck">
                  <div class="col-12">
                    <h1 class="page-title">
                      <div class="form-group">
                        <?php 
                        if(isset($_POST['submit']))
                        {
                          echo 'Results for Society Name: "'.ucfirst($search).'"'; 
                        }?>
                      </div>
                    </h1>
                    
                    <div class="card">
                      <table id="myTable" class="table table-hover table-outline table-vcenter text-nowrap card-table">
                        <thead>
                          <tr>
                            <th class="text-center w-1"><i class="icon-people"></i></th>
                            <th>Society Name</th>
                            <th>Opening Balance</th>
                            <th>Date Inception</th>
                            <th class="text-center">Location<i class="icon-settings"></i></th>
                          </tr>

                        </thead>
                      
                        <tbody>
                          <?php foreach ($view_societies as $row) 
                          {?>
                            <tr>

                              <td class="text-center" onclick="window.location='/societyapp/UI_1/dist/view_statements.php?society_id=<?php echo $row['society_id']?>'">
                              </td>
                          
                              <td onclick="window.location='/societyapp/UI_1/dist/view_statements.php?society_id=<?php echo $row['society_id']?>'">
                                <div> 
                                  <?php echo $row['society_name']; ?> 
                                  (<?php
                                    $society_id = $row['society_id']; 
                                    echo $total_number_of_society = $member->total_num_society($society_id) 
                                  ?>)
                                </div>
                              </td>
                          
                              <td onclick="window.location='/societyapp/UI_1/dist/view_statements.php?society_id=<?php echo $row['society_id']?>'">
                                <div class="clearfix">
                                  <div class="float-left">
                                    <strong><?php echo $row['init_capital']; ?></strong>
                                  </div>
                                </div>
                                
                                <div class="progress progress-xs">
                                  <div class="progress-bar bg-yellow" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                              </td>
                          
                              <td onclick="window.location='/societyapp/UI_1/dist/view_statements.php?society_id=<?php echo $row['society_id']?>'">
                                <div>
                                  <?php $date=date_create($row['date_inception']); echo date_format($date,"d-m-Y"); ?>
                                </div>
                              </td>
                                                              
                              <td class="text-center" onclick="window.location='/societyapp/UI_1/dist/view_statements.php?society_id=<?php echo $row['society_id']?>'">
                                <div>
                                  <div><?php echo $row['addr1']; ?></div>
                                  <div><?php echo $row['addr2']; ?></div>
                                  <div><?php echo $row['addr3']; ?></div>
                                  <div><?php echo $row['addr4']; ?></div>
                                </div>
                              </td>
                              
                              <td class="text-center">
                                <div class="item-action dropdown p-1">
                                  <a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i class="fe fe-more-vertical"></i></a>
                                  <div class="dropdown-menu dropdown-menu-right">
                                    <a href="./view_statements.php?society_id=<?php echo $row['society_id']?>" class="dropdown-item"><i class="dropdown-icon fe fe-file-text"></i> View Details </a> 
                                    <a href="./view_members.php?society_id=<?php echo $row['society_id']?>" class="dropdown-item"><i class="dropdown-icon fe fe-users"></i> View Members </a>  
                                    <a href="./view_package.php?society_id=<?php echo $row['society_id'] ?>" class="dropdown-item"><i class="dropdown-icon fe fe-layers"></i> View Package History</a>
                                    <a href="./deposit.php?society_id=<?php echo $row['society_id']?>" class="dropdown-item"><i class="dropdown-icon fa fa-plus-square-o"></i> Deposit </a>
                                    <a href="./withdraw.php?society_id=<?php echo $row['society_id']?>" class="dropdown-item"><i class="dropdown-icon fa fa-minus-square-o"></i> Withdraw </a>
                                    <a href="./edit_society.php?society_id=<?php echo $row['society_id']?>" class="dropdown-item"><i class="dropdown-icon fe fe-edit"></i> Edit Society </a>
                                    <a href="./addMember.php?society_id=<?php echo $row['society_id']?>" class="dropdown-item"><i class="dropdown-icon fe fe-user-plus"></i> Add Member </a>
                                    <a href="./view_society_funeral_arrangement.php?society_id=<?php echo $row['society_id']?>" class="dropdown-item"><i class="dropdown-icon fe fe-activity"></i> View Funeral Arrangement </a>
                                    <div class="dropdown-divider"></div>
                                    <a onclick ="return confirm('Are you sure you want to delete this society?')" href="./deleteSociety.php?society_id=<?php echo $row['society_id']?>" class="dropdown-item"><i class="dropdown-icon fe fe-trash-2"></i> Remove Society</a>                                
                                  </div>
                                </div>
                              </td>

                            </tr>  
                          <?php 
                          }?> 
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>                                                 
              <?php 
              }?>          
          </div>
        </div>
      </div>
    <!-- </div> -->
          


      <?php include 'incl/footer.php' ;?>
    </div>

<script type="text/javascript">
    $(document).ready(function(){
        $("#search_text").keyup(function(){
            var search = $(this).val();
            $.ajax({
                url:'viewSocietyAction.php',
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