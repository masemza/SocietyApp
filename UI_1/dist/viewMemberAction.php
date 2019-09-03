<?php
global $num;
    include 'config.php';
    $output = '';

    if(isset($_POST['query'])){
        $search = $_POST['query'];
        $stmt = $conn->prepare("SELECT * FROM member WHERE first_name LIKE CONCAT('%',?,'%') OR last_name LIKE CONCAT('%',?,'%') ");
        $stmt->bind_param("ss",$search,$search);
    }
    else{
        $stmt = $conn->prepare("SELECT * FROM member");
    }
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0)
    {
        $output = "<table class='table table-bordered table-hover' <thead>
                        <tr>
                            <th>Society Name</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Gender</th>
                            <th>Contact Number</th>
                            <th>ID Number</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    
                    <tbody";
                    while($row=$result->fetch_assoc()){
                        $output .= "
                        <tr>
                            <td> ".$row['society_name']."</td>
                            <td> ".$row['first_name']."</td>
                            <td> ".$row['last_name']."</td>
                            <td> ".$row['gender']."</td>
                            <td> ".$row['contact_num']."</td>
                            <td> ".$row['id_number']."</td>
                            

                            <td class='button-center'>
                                                              <div class='btn-list text-center' class='input-group button-center'>
                                                                  <div class='btn-list text-center' class='input-group-prepend'>
                                                                    <button type='button' class='btn btn-secondary dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                                      Action
                                                                    </button>
                                                                    <div class='dropdown-menu'>
                                                                      <a href='./edit_member.php?member_id=".$row['member_id']." class='dropdown-item' class='dropdown-item'><i class='dropdown-icon fe fe-edit'></i> Edit Member </a>
                                                                      <a onclick ='return confirm('Are you sure you want to delete this society?')' href='./delete_member.php?member_id=".$row['member_id']." class='dropdown-item' class='dropdown-item'><i class='dropdown-icon fe fe-trash-2'></i> Delete Member</a>
                                                                    </div>
                                                                  </div>
                                                                  </div>
                                                        </td>
                            
                        </tr>";
                    }
                    $output .= "</tbody> </table>";
                    echo $output;
    }
    else 
    {
        echo "<h3> No Records found </h3>";
    }
?>