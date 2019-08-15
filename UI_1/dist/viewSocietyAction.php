<?php
global $num;
    include 'config.php';
    $output = '';

    if(isset($_POST['query'])){
        $search = $_POST['query'];
        $stmt = $conn->prepare("SELECT * FROM society WHERE society_name LIKE CONCAT('%',?,'%') OR society_id LIKE CONCAT('%',?,'%')");
        $stmt->bind_param("ss",$search,$search);
    }
    else{
        $stmt = $conn->prepare("SELECT * FROM society");
    }
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0)
    {
        $output = "<table class='table table-hover table-outline table-vcenter text-nowrap card-table' 
                    <thead>
                        <tr>
                            <th class='text-center w-1'><i class='icon-people'></i></th>
                            <th>Society Name</th>
                            <th>Opening Balance</th>
                            <th>Date Inception</th>
                            
                            <th>Location</th>
                            <th class='text-center'><i class='icon-settings'></i></th>

                        </tr>
                    </thead>
                    
                    <tbody";
                    while($row=$result->fetch_assoc()){
                        $output .= "
                        <tr>
                            <td></td>
                            <td> ".$row['society_name']." </td>
                            <td> 
                                <div class='clearfix'>
                                    <div class='float-left'>
                                        ".$row['init_capital']." 
                                    </div>
                                </div>
                                <div class='progress progress-xs'>
                                    <div class='progress-bar bg-yellow' role='progressbar' style='width: 0%'
                                        aria-valuenow='0' aria-valuemin='0' aria-valuemax='100'>
                                    </div>
                                </div>
                            </td>

                            <td> ".$row['date_inception']." </td>
                            <td> 
                                ".$row['addr1']." <br>
                                ".$row['addr2']." <br>
                                ".$row['addr3']." <br>
                                ".$row['addr4']."
                            </td>

                            <td>
                            <div class='item-action dropdown p-1' >
                                <a href='javascript:void(0)' data-toggle='dropdown' class='icon'><i class='fe fe-more-vertical'></i></a>
                                <div class='dropdown-menu dropdown-menu-right'>
                                    <a href='./view_statements.php?society_id=".$row['society_id']." ' class='dropdown-item'><i class='dropdown-icon fe fe-file-text'></i> View Details </a>
                                    <a href='./view_members.php?society_id=".$row['society_id']."' class='dropdown-item'><i class='dropdown-icon fe fe-users'></i> View Members </a>  
                                    <a href='./view_package.php?society_id=".$row['society_id']."' class='dropdown-item'><i class='dropdown-icon fe fe-layers'></i> View Package History</a>
                                    <a href='./deposit.php?society_id=".$row['society_id']."' class='dropdown-item'><i class='dropdown-icon fa fa-plus-square-o'></i> Deposit </a>
                                    <a href='./withdraw.php?society_id=".$row['society_id']."' class='dropdown-item'><i class='dropdown-icon fa fa-minus-square-o'></i> Withdraw </a>
                                    <a href='./edit_society.php?society_id=".$row['society_id']."' class='dropdown-item'><i class='dropdown-icon fe fe-edit'></i> Edit Society </a>
                                    <a href='./addMember.php?society_id=".$row['society_id']."' class='dropdown-item'><i class='dropdown-icon fe fe-user-plus'></i> Add Member </a>
                                    <div class='dropdown-divider'></div>
                                    <a onclick ='return confirm('Are you sure you want to delete this society?')' href='./deleteSociety.php?society_id=".$row['society_id']."' class='dropdown-item'><i class='dropdown-icon fe fe-trash-2'></i> Remove Society</a>

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