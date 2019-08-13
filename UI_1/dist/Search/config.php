<?php
    $conn = new mysqli("localhost","root","","society");
    if($conn->connect_error)
    {
        die("connect failed".$conn->connect_error);
    }
?>