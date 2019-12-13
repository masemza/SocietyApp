<?php
$type = htmlentities($user['type']);
$user_id = htmlentities($user['id']);

$logoDetails = $users->check_if_logo_has_values($user_id);
foreach($logoDetails as $logoData){}

?>

<div class="header py-4">
    <div class="container">
        <div class="d-flex">
            <a class="header-brand" href="./index.php">
            	<img src="./demo/brand/S  F Logo.jpg" class="header-brand-img" alt="logo" style="height: 4rem !important;">
            	<!-- <?php //if($logoDetails)
              {?>
                  <img src="demo/brand/logo/<?php //echo $logoData['logo_img'];?>" height="65" width="110">
              <?php            
              }?> -->
            </a>
        
        	<div class="d-flex order-lg-2 ml-auto">
            
            <?php
            if($type == 'manager' || $type == 'admin')
            {?>

              <li class="nav-item dropdown">
                <a href="./choose_type_of_funeral.php" class="btn btn-sm btn-outline-primary" ><i class="fe fe-clipboard"></i>Plan A Funeral</a>
              </li>

              <li class="nav-item dropdown">
                <a href="./create_user.php" class="btn btn-sm btn-outline-primary" ><i class="fe fe-user"></i>Add a new Main Member</a>
              </li>

            	<li class="nav-item dropdown">
                <a href="./create_society.php" class="btn btn-sm btn-outline-primary" ><i class="fe fe-user"></i>Add a new Society</a>
              </li>
            <?php
            }?>
                	
            <div class="dropdown">
           		<a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                <span class="avatar" style="background-image: url(./demo/faces/avator/avatar-001.jpg)"></span>
              	<span class="ml-2 d-none d-lg-block">
             		  <span class="text-default">
                 		<?php echo $username; ?>
              		</span>
                  <small class="text-muted d-block mt-1">Logged in</small>
              	</span>
            	</a>
                  
	            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
		            
                <?php
                if($type == 'manager' || $type == 'admin')
                {?>
                  <a class="dropdown-item" href="./view_user.php">
	              	  <i class="dropdown-icon fa fa-user-circle"></i> Profile
              	 </a>
                <?php
                }?>
                
	              <a class="dropdown-item" onclick ="return confirm('Are you sure you want sign out?')" href="logout.php">
	            		<i class="dropdown-icon fe fe-log-out"></i> Sign out
	             	</a>

	                   	<!-- <?php 
	                   	//if($type === "manager")
	                   	{?>
	                   		<?php
	                   		//if(empty($logoDetails))
	                   		{?>
			                   	<a class="dropdown-item" href="create_logo.php">
			                   		<i class="dropdown-icon fe fe-arrow-up"></i> Add Logo
			                   	</a>
			                <?php 
			            	}
			            	//else
			            	{?>
			            		<a class="dropdown-item" href="edit_logo.php">
			                   		<i class="dropdown-icon fe fe-shuffle"></i> Change Logo
			                   	</a>
			            	<?php
			            	}
		            	}?> -->


	            </div>
            </div>
          </div>
              
            <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
               	<span class="header-toggler-icon"></span>
            </a>
              
        </div>
    </div>
</div>