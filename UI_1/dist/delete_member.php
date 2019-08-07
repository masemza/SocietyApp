<?php
  require 'core/init.php';
 
	$member_id =$_REQUEST['member_id'];
	
	$member->deleteMember($member_id);
	
	Print '<script>alert("Memebr Successfully Deleted");;
	window.location.assign("index.php")</script>';	
	
?>