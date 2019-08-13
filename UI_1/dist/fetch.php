<?php
global $num;
require 'core/init.php';

$view_members = $member->memberInformation();

    if(isset($_POST['query'])){
        $search = $_POST['query'];

        $stmt = $member->searching_member($search);
    else{
        $stmt = $member->memberInformation();
    }
foreach ($stmt as $row)
{
echo $row['member_id'];
}
?>
      <?php if(!empty($_row['first_name']))
      {?>
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

      <?php foreach ($view_members as $row) ?>
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
              <!-- <a href="./edit_member.html">Edit</a> | | <a href="#">Delete</a>   -->

              <!-- <div class="dropdown">
                  <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">Actions</button>

                </div> -->

                <div class="btn-list text-center" class="input-group button-center">
                    <div class="btn-list text-center" class="input-group-prepend">
                      <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                      </button>
                      <div class="dropdown-menu">
                        <a href="./edit_member.php?member_id=<?php echo $row['member_id']?>" class="dropdown-item"><i class="dropdown-icon fe fe-edit"></i> Edit Member </a>
                        <a onclick ="return confirm('Are you sure you want to delete this society?')" href="./delete_member.php?member_id=<?php echo $row['member_id']?>" class="dropdown-item" class="dropdown-item"><i class="dropdown-icon fe fe-trash-2"></i> Delete Member</a>
                      </div>
                    </div>
                    </div>
                    
          </td>
      </tr>

      <?php
      }
      else
      {
        echo "No record found";
      }
      

?>