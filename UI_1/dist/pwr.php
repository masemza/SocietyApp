<?php
require 'core/init.php';

$user_id = $_GET['id'];
$password = '123456';

$users->change_password($user_id, $password);
header('Location:edit_user.php?id='.$user_id);
?>