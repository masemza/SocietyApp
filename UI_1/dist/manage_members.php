<?php
require 'core/init.php';
$general->logged_out_protect();
$username = htmlentities($user['username']);
$type = htmlentities($user['type']);

$view_members = $main_member->allMembersInformation();

// $total_societies = $main_member->total_societies();
// $total_members = $main_member->total_members();

$total_spouse = $main_member->total_spouse();
$total_children = $main_member->total_children();
$total_extended_family = $main_member->total_extended_family();
$total_premiums = $main_member->total_premiums();

if (isset($_POST['submit']))
{
	$search = $_POST['search'];
	
	if(empty($_POST['search']))
	{
		$errors[] = "Enter member name";
	}

	else 
		if ($society-> society_exists($search) === false) 
		{
			$errors[] = 'Sorry that member name does\'nt exists.';
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
                        <input type="text" name="search" id="myInput" onkeyup="myFunction()" class="form-control" required="required" placeholder="Enter Member's First Name">
                      </div>
                      <span class="col-auto">
                      <button class="btn btn-secondary" type="submit" name="submit"><i class="fe fe-search"></i></button><br>                      
                      </span>
                    </div>
                  </div>

                </form>
              </div>

                <div class="col-lg order-lg-first">
                  <ul class="nav nav-tabs border-0 flex-column flex-lg-row">

                    <li class="nav-item">
                      <a href="./manage_members.php" class="nav-link active"><i class="fe fe-home"></i> Home</a>
                    </li>

                    <li class="nav-item">
                      <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-users"></i>View Members</a>
                      <div class="dropdown-menu dropdown-menu-arrow">
                        <a href="./view_all_spouse.php" class="dropdown-item "><i class="fe fe-users"></i>View Spouse</a>
                        <a href="./view_all_children.php" class="dropdown-item "><i class="fe fe-users"></i>View Children </a>
                        <a href="./view_all_extended_family.php" class="dropdown-item "><i class="fe fe-users"></i>View Extended Family</a>
                      </div>
                    </li>

                    <?php if($type === "manager") 
                    {?>
                      <li class="nav-item dropdown">
                        <a href="./view_member_report.php" class="nav-link"><i class="fe fe-file-text"></i> View Reports </a>
                      </li>
                    <?php 
                    }?>

                  </ul>
                </div>

            </div>
          </div>
        </div>
        <div class="my-3 my-md-5 ">
          <div class="container ">
            <div class="page-header">

              <?php 
              if(empty($errors) === false)
              {	
              ?>
                <div class="col-sm-6 col-lg-12 ">
                  <div class="card p-3 align-items-center">
                    <div class="d-flex align-items-center">
                      <form class="text-center" action="" method="post">                    
                        <div class="form-group">
                          <h3>
                          Sorry!!! <br>
                          Member name: "<?php echo ucfirst($search) ?>" does'nt exist
                        </div>
                        <div class="form-group">
                          <button class="btn btn-secondary" type="submit" name="submit1" >Click here to view all members</button>
                        </div>
                          </h3>
                      </form>
                    </div>
                  </div>
                </div>
              <?php 
              }?>     

              <?php 
              if(empty($errors) === true){   
                        
              ?>
                  
              <h1 class="page-title">
                Dashboard
              </h1>
            </div>

            <div class="row row-cards">

              <div class="col-sm-4 col-lg-4">
                <div class="card p-3">
                  <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-lime mr-3">
                      <i class="fe fe-users"></i>
                    </span>
                    <div>
                      <h4 class="m-0"><a href="./view_all_spouse.php"><small>Total Spouse</small></a></h4>
                      <small class="text-muted"><?php echo $total_spouse ?> registered spouse</small>
                    </div>
                  </div>
                </div>
              </div>
  
              <div class="col-sm-4 col-lg-4">
                <div class="card p-3">
                  <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-lime mr-3">
                      <i class="fe fe-users"></i>
                    </span>
                    <div>
                      <h4 class="m-0"><a href="./view_all_children.php"><small>Total Children</small></a></h4>
                        <small class="text-muted"><?php echo $total_children ?> registered children</small>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-sm-4 col-lg-4">
                <div class="card p-3">
                  <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-lime mr-3">
                      <i class="fe fe-users"></i>
                    </span>
                    <div>
                      <h4 class="m-0"><a href="./view_all_extended_family.php"><small>Total Extended Family</small></a></h4>
                        <small class="text-muted"><?php echo $total_extended_family ?> registered extended family</small>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-sm-4 col-lg-4">
                <div class="card p-3">
                  <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-teal mr-3">
                      <i class="fe fe-plus-square"></i>
                    </span>
                    <div>
                      <h4 class="m-0"><a href="javascript:void(0)"><small>Total Premiums</small></a></h4>
                      <small class="text-muted"><?php echo $total_premiums ?> </small>
                    </div>
                  </div>
                </div>
              </div>


              <div class="col-12">

                  <div class="card">
                  <div class="table-responsive">

                    <table id="myTable" class="table table-hover table-outline table-vcenter text-nowrap card-table">
                      <thead>
                        <tr>
                          <th class="text-center w-1"><i class="icon-people"></i></th>
                          <th style="width: 25%">First Name(s)</th>
                          <th style="width: 25%">Surname</th>
                          <th style="width: 5%">ID Number</th>
                          <th class="text-center" style="width: 25%">Location</th>
                          <th class="text-center" ><i class="icon-settings"></i></th>
                          
                        </tr>
                        
                      </thead>
                      <tbody>
                      <?php foreach ($view_members as $member_row) { ?>
                        <tr>
                          <td class="text-center" onclick="window.location='/societyapp/UI_1/dist/view_main_member.php?main_member_id=<?php echo $member_row['main_member_id']?>'">
                          </td>

                          <td onclick="window.location='/societyapp/UI_1/dist/view_main_member.php?main_member_id=<?php echo $member_row['main_member_id']?>'">
                            <div><?php echo $member_row['first_name']; ?></div>
                          </td>

                          <td onclick="window.location='/societyapp/UI_1/dist/view_main_member.php?main_member_id=<?php echo $member_row['main_member_id']?>'">
                            <div><?php echo $member_row['last_name']; ?></div>
                          </td>

                          <td onclick="window.location='/societyapp/UI_1/dist/view_main_member.php?main_member_id=<?php echo $member_row['main_member_id']?>'">
                            <div>
                                <?php echo $member_row['id_number']; ?> 

                                <?php
                                  // $id_number = 0006195497089;
                                  // $member_row['id_number'];
                                  //9706195497089
                                  // echo $old_year = substr($id_number,2); 
                                  // $month = substr($id_number,2,2); 
                                  // $day = substr($id_number,4,2); 

                                  //$origDate = $day.'-'.$month.'-'.$new_year;
                                  // if($old_year > 25)
                                  // {
                                  //   $Y = 19;
                                  //   $new_year = $Y.$old_year;
                                  // }
                                  // else
                                  // {
                                  //   $Y = 20;
                                  //   $new_year = $Y.$old_year;
                                  // }

                                  // echo $new_year;

                                  // switch ($old_year) 
                                  // {
                                  //     case "97": $new_year = 1997;
                                  //         break;
                                  //     case "98": $new_year = 1998;
                                  //         break;
                                  //     case "99": $new_year = 1999;
                                  //         break;
                                  //     case "00": $new_year = 2000;
                                  //         break;
                                  //     case "01": $new_year = 2001;
                                  //         break;
                                  //     case "02": $new_year = 2002;
                                  //         break;
                                  //     case "03": $new_year = 2003;
                                  //         break;
                                  //     case "04": $new_year = 2004;
                                  //         break;
                                  //     case "05": $new_year = 2005;
                                  //         break;
                                  //     case "06": $new_year = 2006;
                                  //         break;
                                  //     case "07": $new_year = 2007;
                                  //         break;
                                  //     case "08": $new_year = 2008;
                                  //         break;
                                  //     case "09": $new_year = 2009;
                                  //         break;
                                  //     case "10": $new_year = 2010;
                                  //         break;
                                  //     case "11": $new_year = 2011;
                                  //         break;
                                  //     case "12": $new_year = 2012;
                                  //         break;
                                  //     case "13": $new_year = 2013;
                                  //         break;
                                  //     case "14": $new_year = 2014;
                                  //         break;
                                  //     case "15": $new_year = 2015;
                                  //         break;
                                  //     case "16": $new_year = 2016;
                                  //         break;
                                  //     case "17": $new_year = 2017;
                                  //         break;
                                  //     case "18": $new_year = 2018;
                                  //         break;
                                  //     default: $new_year = $resentYears.$year;
                                  // }

                                  // echo $year;

                                  // echo $newDate = date("d-m-Y", strtotime($origDate));
                                  
                                  // $dateOfBirth = $day.'-'.$month.'-'.$new_year; 
                                  // $today = date("d-m-Y");
                                  // $diff = date_diff(date_create($dateOfBirth), date_create($today));
                                  // echo 'Age is '.$diff->format('%y');
                                ?>
                            </div>
                          </td>
                          
                          <td class="text-center" onclick="window.location='/societyapp/UI_1/dist/view_main_member.php?main_member_id=<?php echo $member_row['main_member_id']?>'">
                            <div>
                              <div>
                                  <?php echo $member_row['street']; ?> <br>
                                  <?php echo $member_row['suburb']; ?> <br> 
                                  <?php echo $member_row['city']; ?> <br> 
                                  <?php echo $member_row['province']; ?> <br>
                              </div>
                          
                            </div> 
                          </td> 
                          <td class="text-center">
                            <div class="item-action dropdown p-1" >
                              <a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i class="fe fe-more-vertical"></i></a>
                              <div class="dropdown-menu dropdown-menu-right">
                                <a href="./view_main_member.php?main_member_id=<?php echo $member_row['main_member_id'] ?>" class="dropdown-item"><i class="dropdown-icon fe fe-file-text"></i> View Details </a>
                                <a href="./view_children.php?main_member_id=<?php echo $member_row['main_member_id']?>" class="dropdown-item"><i class="dropdown-icon fe fe-users"></i> View Members </a>
                                <a href="./pay_premium.php?main_member_id=<?php echo $member_row['main_member_id']?>" class="dropdown-item"><i class="dropdown-icon fa fa-plus-square-o"></i> Pay Premium </a>
                                <a href="./edit_society.php?main_member_id=<?php echo $member_row['main_member_id']?>" class="dropdown-item"><i class="dropdown-icon fe fe-edit"></i> Edit Member </a>
                                <a href="./view_policy_holder_funeral_arrangement.php?main_member_id=<?php echo $member_row['main_member_id']?>" class="dropdown-item"><i class="dropdown-icon fe fe-activity"></i> View Funeral Arrangement </a>
                                <a onclick ="return confirm('Are you sure you want to delete this society?')" href="./deleteMainMember.php?main_member_id=<?php echo $member_row['main_member_id']?>" class="dropdown-item"><i class="dropdown-icon fe fe-trash-2"></i> Remove Member</a>

                              </div>
                            </div>
                          </td>
                        </tr>  
                        <?php } ?>   
                        
                        <?php } ?>
                      </tbody>
                    </table>

                    

                  </div>
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
                url:'indexAction.php',
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