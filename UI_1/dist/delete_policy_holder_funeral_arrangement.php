<?php
  require 'core/init.php';
 
	$policy_holder_funeral_id = $_GET['policy_holder_funeral_id'];
	
	$funeral->delete_policy_holder_funeral_arrangement($policy_holder_funeral_id);
	
	Print '<script>alert("Funeral Successfully Cancelled");;
	window.location.assign("index.php")</script>';	
	
?>