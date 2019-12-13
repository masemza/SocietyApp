<?php
  require 'core/init.php';
 
	$package_id = $_GET['package_id'];
	
	$package->delete_package($package_id);
	
	Print '<script>alert("Package Successfully Deleted");;
	window.location.assign("index.php")</script>';	
	
?>