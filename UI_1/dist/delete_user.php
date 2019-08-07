<?php
  require 'core/init.php';
 
	$id =$_GET['id'];
	
	$users->deleteUser($id);
	
	Print '<script>alert("User Successfully Deleted");;
	window.location.assign("view_user.php")</script>';	
	
?>