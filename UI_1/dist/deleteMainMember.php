<?php
  require 'core/init.php';
 
	$main_member_id = $_GET['main_member_id'];
	
	$main_member->deleteMainMember($main_member_id);
	
	Print '<script>alert("Main member Successfully Deleted");;
	window.location.assign("index.php")</script>';	
	
?>