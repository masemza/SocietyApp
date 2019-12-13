<?php
  require 'core/init.php';
 $type = htmlentities($user['type']);

	$family_id = $_GET['family_id'];
	
	$extended_family->deleteextendedFamilyMember($family_id);
	
	if($type == 'admin' || $type == 'manager')
	{
		Print '<script>alert("Extended Family Member Successfully Deleted");;
		window.location.assign("manage_members.php")</script>';	
	}
	else if($type == 'user')	
	{
		Print '<script>alert("Extended Family Member Successfully Deleted");;
		window.location.assign("index.php")</script>';
	}
	
?>