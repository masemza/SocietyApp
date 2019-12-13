<?php
  require 'core/init.php';
 
	$expenses_id = $_GET['expenses_id'];
	
	$expenses->delete_expense($expenses_id);
	
	Print '<script>alert("Expense Successfully Cancelled");;
	window.location.assign("view_expense.php")</script>';	
	
?>