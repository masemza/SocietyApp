<?php

error_reporting(E_ALL);

require 'core/init.php';
$general->logged_out_protect();

$society_id = $_GET['society_id'];

	$society_data = $society->societydata($society_id);
	
foreach($society_data as $row)
	{
		$society_id = $row['society_id'];
		$society_name = $row['society_name'];
		$credit 	= $row['init_capital'];
		$balance 	= $row['init_capital'];
	}

	$name = "Opening Balance";
	$date_transaction = date("Y-m-d");
	$debit = 0;
	
	/*print_r($row);
	echo "Society successfuly registered. "; 
	echo "Your Society ID is ",($society_id), ". Use it to make make payments";
	*/
	
	$society->make_payment($name, $society_id, $society_name, $date_transaction, $credit, $debit, $balance); 
	
	Print '<script>alert("Society successfully registered");
	</script>';
	
	header('Location:create_package.php?society_id='.$society_id);

?>

<html>
	<head>
	</head>
		<br><br>
		<body>	
			<a href="home.php"> Click here to go to home page...</a>
		</body>

</html>

