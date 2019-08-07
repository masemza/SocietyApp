<?php
require 'core/init.php';
$general->logged_out_protect();
$username = htmlentities($user['username']);
$email = htmlentities($user['email']);

$view_users = $users->get_users();
global $num;


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
                    <a href="./index.php" class="nav-link active"><i class="fe fe-home"></i> Home</a>
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
                <a href="index.php" style="text-decoration: none;"> <i class="fe fe-arrow-left"></i>Home</a> | User Details
              </h1>
            </div>

           
            <div class="row row-cards row-deck">
              
            <div class="col-lg-5">
              <script>
                require(['input-mask']);
              </script>
              <div class="card">
                <div class="card-body">
                  <h3 class="card-title">User Details</h3>
                
                      <div class="form-group">
                          <label class="form-label">Username</label>
                          <input disabled="disabled" type="text" name="field-name" class="form-control" value="<?php echo $username; ?>">
                      </div>

                      <div class="form-group">
                        <label class="form-label">Email</label>
                        <input disabled="disabled" type="text" name="field-name" class="form-control" value="<?php echo $email; ?>" >
                      </div>

                    <div class="card-footer">
                    <?php foreach ($view_users as $row) ?>
                      <a href="./edit_user.php?id=<?php echo $row['id'] ?>" class="btn btn-primary btn-block">Edit User Details</a>
                    </div>
               
                </div>
              </div>
            </div>              
              <div class="col-lg-7 col-sm-5">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">List of Users</h3>
                  </div>
                  <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                      <thead>
                        <tr>
                          <th class="w-1">User No.</th>
                          <th>Username</th>
                          <th>Email</th>
                          <th class="text-right">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                        <?php foreach ($view_users as $row) { ?>
                          <td><span class="text-muted"><?php echo $num += 1 ?></span></td>
                          <td><?php echo $row['username'] ?></td>
                          <td><?php echo $row['email'] ?></td>

                          <td class="text-right">
                            <div class="btn-list text-right" class="input-group button-right">
                                <div class="btn-list text-right" class="input-group-prepend">
                                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="./edit_user.php?id=<?php echo $row['id']?>" class="dropdown-item"><i class="dropdown-icon fe fe-edit"></i> Edit User </a>
                                        <a onclick ="return confirm('Are you sure you want to delete this user?')" href="./delete_user.php?id=<?php echo $row['id']?>" class="dropdown-item" class="dropdown-item"><i class="dropdown-icon fe fe-trash-2"></i> Delete </a>
                                    </div>
                                </div>
                            </div>
                          </td>
                          
                        </tr>
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
  </body>
</html>