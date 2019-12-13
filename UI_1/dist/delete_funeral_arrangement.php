<?php
  require 'core/init.php';
 
	$funeral_id = $_GET['funeral_id'];
	$member_id = $_GET['member_id'];
	
	$funeral->delete_funeral_arrangement($funeral_id, $member_id);
	
	Print '<script>alert("Funeral Successfully Cancelled");;
	window.location.assign("index.php")</script>';	
	
?>