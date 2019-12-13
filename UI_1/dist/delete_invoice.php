<?php
  require 'core/init.php';
 
	$invoice_id = $_GET['invoice_id'];
	
	$invoices->delete_invoice($invoice_id);
	
	Print '<script>alert("Invoice Successfully Cancelled");;
	window.location.assign("index.php")</script>';	
	
?>