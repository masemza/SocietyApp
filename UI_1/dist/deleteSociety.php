<?php
  require 'core/init.php';
 
	$society_id =$_GET['society_id'];
	
	$society->deleteSociety($society_id);
	
	Print '<script>alert("Society Successfully Deleted");;
	window.location.assign("index.php")</script>'; 	
	
?>