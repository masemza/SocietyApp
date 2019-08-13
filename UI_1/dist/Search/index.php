<!DOCTYPE html>

<head>
    <title>
        Live Search
    </title>

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

</head>

<body>
         <h1>Live Search</h1>
         <hr>
            
            <label for="search">Search Record</label>&nbsp;&nbsp;
            <input type="text" name="search" id="search_text" placeholder="Search...">
         
         <hr>
         <?php 
            include 'config.php';
            $stmt=$conn->prepare("SELECT * FROM member");
            $stmt->execute();
            $result=$stmt->get_result();
         ?>

         <table class="table table-hover table-light table-striped" id="table-data">
            <thead>
                <tr>
                    <th>#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Gender</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row=$result->fetch_assoc()) {?>
                    <tr>
                        <td><?php echo $row['member_id']; ?></td>
                        <td><?php echo $row['first_name']; ?></td>
                        <td><?php echo $row['last_name']; ?></td>
                        <td><?php echo $row['gender']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
         </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $("#search_text").keyup(function(){
            var search = $(this).val();
            $.ajax({
                url:'action.php',
                method:'post',
                data:{query:search},
                success:function(response){
                    $("#table-data").html(response)
                }
            });
        });
    });
</script>
</body>
</html>