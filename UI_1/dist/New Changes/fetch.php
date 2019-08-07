<?php
$connect = mysqli_connect("localhost", "root", "", "society");
$output = '';
$sql = "SELECT * FROM member WHERE first_name LIKE '%".$_POST["search"]."%'";
$result = mysqli_query($connect, $sql);

if(mysqli_num_rows($result) > 0)
{
    $output .= '<h4 align="center"> Search Result </h4> ';
    $output .= '<div class="table-responsive"> 
                    <table class="table table bordered">
                        <tr>
                            <th> First name </th>
                            <th> Last name </th>
                        </tr>';
    while($row = mysqli_fetch_array($result))
    {
        $output .= '
            <tr>
                <td>'.$row["first_name"].' </td>
                <td>'.$row["last_name"].' </td>
            </tr>
            ';
    }
    echo $output;

}
else
{
    echo 'Data not found';
}

?>