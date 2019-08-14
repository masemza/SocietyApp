<?php
global $num;
require 'core/init.php';

$view_members = $member->memberInformation();

$output = '';

    if(isset($_POST['query']))
    {
        $search = $_POST['query'];
        $stmt = $member->searching_member($search);
    }
    else
    {
        $stmt = $member->memberInformation();
    }




// foreach ($stmt as $row)
// {
//   echo $row['first_name'];
// }

// foreach ($view_members as $row1)
// {
//   echo $row1['first_name'];
// }

?>

<?php foreach ($stmt as $row) 
{?>
    <?php if(!empty($row['member_id']))
    {
        $output = "<thead>
                        <tr>
                            <th>#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Gender</th>
                        </tr>
                    </thead>
                    
                    <tbody";
                    while($row=$stmt){
                        $output .= "
                        <tr>
                            <td> ".$row['member_id']."</td>
                            <td> ".$row['first_name']."</td>
                            <td> ".$row['last_name']."</td>
                            <td> ".$row['gender']."</td>
                        </tr>";
                    }
                    $output .= "</tbody>";
                    echo $output;
    }
      else
      {
        echo "No record found";
      }
}
      
?>