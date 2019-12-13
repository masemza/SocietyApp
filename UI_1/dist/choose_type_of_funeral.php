<?php
require 'core/init.php';
$general->logged_out_protect();
$username = htmlentities($user['username']);

$societyData = $society->societyInformation();
$memberData = $main_member->allMembersInformation();

if(isset($_POST['society']))
{
  if(empty($_POST['type']))
  {
    $errors[] = 'Please select a package';
  }

  else if(empty($_POST['society_name']))
  {
    $errors[] = 'Please Enter Society name';
  }

  else if($society->society_name_exists($_POST['society_name']) === false)
  {
    $errors[] = 'Sorry, That Society name does\'nt exist';
  }

  if(empty($errors) === true)
  {
    $type = $_POST['type'];
    $society_name = $_POST['society_name'];

    header('location: society_funeral.php?type='.$type.'&society_name='.$society_name);
  }

}

if(isset($_POST['policy_holder']))
{
  if(empty($_POST['type']))
  {
    $errors[] = 'Please select a package';
  }

  else if(empty($_POST['main_member_id_number']))
  {
    $errors[] = 'Please Enter Main member id number';
  }

  if(empty($errors) === true)
  {
    $type = $_POST['type'];
    $main_member_id_number = $_POST['main_member_id_number'];

    header('Location: policy_holder_funeral.php?type='.$type.'&main_member_id_number='.$main_member_id_number);
  }
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
              <div class="nav-item d-md-flex">
              </div>       
             
              <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                  
                  <li class="nav-item">
                    <a href="./index.php" class="nav-link"><i class="fe fe-home"></i> Home</a>
                  </li>
                  
                  <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link active" data-toggle="dropdown"><i class="fe fe-users"></i>Manage Members</a>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="./view_members.php?society_id=<?php echo $society_id ?>" class="dropdown-item "><i class="fe fe-users"></i>View Members</a>
                      <a href="./addMember.php?society_id=<?php echo $society_id; ?>" class="dropdown-item active"><i class="fe fe-user-plus"></i>Add A New Member</a>
                    </div>
                  </li>

                  <li class="nav-item dropdown">
                    <a href="./view_package.php?society_id=<?php echo $society_id ?>" class="nav-link"><i class="dropdown-icon fe fe-layers"></i> View Package</a>
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
                Plan A funeral
              </h1>
            </div>

            <form class="card" action="" method="POST">
              
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-12">
                    <?php 
                    if(empty($errors) === false)
                    {
                      echo '<p class="text-center">' . implode('</p><p>', $errors) . '</p>';  
                    }
                    ?>

                    <div class="card">
                      <div class="card-body">
                        <div class="col-sm-6 col-md-12">
                          <div class="form-group">
                            <label class="form-label">Package</label>
                              <select name="type" class="form-control custom-select" required="true">
                                <option value="<?php if(isset($_POST['type'])) echo htmlentities($_POST['type']); ?>" disabled selected>Select Package</option>
                                <option value="Child">Child</option>
                                <option value="Adult">Adult</option>
                              </select>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>    
          </div>

          <div class="container">
            <div class="row row-cards">
              <div class="col-sm-6 col-lg-6">
                <div class="card p-6 align-items-center">
                  <div class="d-flex">
                        <!-- <span class="stamp stamp-md bg-green mr-3">
                          <i class="fe fe-plus-circle"></i> -->
                        <!-- </span> -->
                    <div>
                      <label class="form-label text-center">Society Name</label>
                      <input list="society_name" type="text" name="society_name" class="form-control" placeholder="Enter Society Name" value="<?php if(isset($_POST['society_name'])) echo htmlentities($_POST['society_name']); ?>" >
                      <datalist id="society_name">
                        <?php  
                        foreach($societyData as $societyrow)
                        {?>
                          <option value="<?php echo $societyrow['society_name'] ?> "></option>
                        <?php 
                        }?>   
                      </datalist>
                    </div>
                  </div>
                  <br>
                  <button type="submit" name="society" class="btn btn-primary">Next</button>
                </div>
              </div> 

              <div class="col-sm-6 col-lg-6">
                <div class="card p-6 align-items-center">
                  <div class="d-flex">
                          <!-- <span class="stamp stamp-md bg-green mr-3">
                            <i class="fe fe-minus-circle"></i> -->
                          <!-- </span> -->
                    <div>
                      <label class="form-label text-center">Main Member ID Number</label>
                        <input list="main_member_id_number" type="text" name="main_member_id_number" class="form-control" placeholder="Enter Main Member ID Number" value="<?php if(isset($_POST['main_member_id_number'])) echo htmlentities($_POST['main_member_id_number']); ?>" >
                        <datalist id="main_member_id_number">
                          <?php  
                          foreach($memberData as $memberrow)
                          {?>
                            <option value="<?php echo $memberrow['id_number'] ?> "></option>
                          <?php 
                          }?>   
                        </datalist>
                    
                    </div>
                  </div>
                    <br>
                    <button type="submit" name="policy_holder" class="btn btn-primary">Policy Holder</button>
                </div>
              </div> 
            </div> 


      </form>


      </div>       
    </div>
  </div>

    <?php include 'incl/footer.php' ;?>
  </body>
</html>