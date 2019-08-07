        <div class="header py-4">
          <div class="container">
            <div class="d-flex">
              <a class="header-brand" href="./index.php">
                <img src="./demo/brand/S  F Logo.jpg" class="header-brand-img" alt="logo" style="height: 4rem !important;">
              </a>
              <div class="d-flex order-lg-2 ml-auto">
                <?php /*$usertype = htmlentities($user['usertype']);
                if($usertype == "admin"){ ?>
                <div class="nav-item d-md-flex">
                  <a href="create_investor.php" class="btn btn-md btn-outline-success">Add a new investor</a>
                </div><?php }*/ ?>
                <!-- <div class="dropdown d-none d-md-flex">
                  <a class="nav-link icon" data-toggle="dropdown">
                    <i class="fe fe-bell"></i>
                    <span class="nav-unread"></span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                    <a href="#" class="dropdown-item d-flex">
                      <span class="avatar mr-3 align-self-center" style="background-image: url(demo/faces/male/41.jpg)"></span>
                      <div>
                        <strong>Nathan</strong> pushed new commit: Fix page load performance issue.
                        <div class="small text-muted">10 minutes ago</div>
                      </div>
                    </a>
                    <a href="#" class="dropdown-item d-flex">
                      <span class="avatar mr-3 align-self-center" style="background-image: url(demo/faces/female/1.jpg)"></span>
                      <div>
                        <strong>Alice</strong> started new task: Tabler UI design.
                        <div class="small text-muted">1 hour ago</div>
                      </div>
                    </a>
                    <a href="#" class="dropdown-item d-flex">
                      <span class="avatar mr-3 align-self-center" style="background-image: url(demo/faces/female/18.jpg)"></span>
                      <div>
                        <strong>Rose</strong> deployed new version of NodeJS REST Api V3
                        <div class="small text-muted">2 hours ago</div>
                      </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item text-center text-muted-dark">Mark all as read</a>
                  </div>
                </div> -->

                
                <li class="nav-item dropdown">
                    <a href="./create_society.php" class="btn btn-sm btn-outline-primary" ><i class="fe fe-user"></i>Add a new Society</a>
                  </li>
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
                  
                    <!-- <a class="dropdown-item" href="#">
                      <i class="dropdown-icon fe fe-user"></i> Profile
                    </a>
                    <a class="dropdown-item" href="#">
                      <i class="dropdown-icon fe fe-settings"></i> Settings
                    </a> -->
                    <!-- <a class="dropdown-item" href="#">
                      <span class="float-right"><span class="badge badge-primary">6</span></span>
                      <i class="dropdown-icon fe fe-mail"></i> Inbox
                    </a> -->
                    <!-- <a class="dropdown-item" href="#">
                      <i class="dropdown-icon fe fe-send"></i> Message
                    </a> -->
                    <!-- <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">
                      <i class="dropdown-icon fe fe-help-circle"></i> Need help?
                    </a> -->












                    <a class="dropdown-item" href="./view_user.php">
                      <i class="dropdown-icon fa fa-user-circle"></i> Profile
                    </a>


                    
                    <a class="dropdown-item" onclick ="return confirm('Are you sure you want sign out?')" href="logout.php">
                      <i class="dropdown-icon fe fe-log-out"></i> Sign out
                    </a>

                  </div>
                </div>
              </div>
              <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
                <span class="header-toggler-icon"></span>
              </a>
              
            </div>
          </div>
        </div>