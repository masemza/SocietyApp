<?php 
class Funeral{
 	
	private $db;

	public function __construct($database) {
	    $this->db = $database;
	}	
	
	public function plan_a_funeral_for_adult($society_id, $society_name, $informant_first_name, $informant_surname, $informant_id_number, $informant_contact_number, $informant_street, $informant_suburb, $informant_city, $informant_province, $name_of_deceased, $transport_amount, $funeral_time, $date_of_funeral, $street, $suburb, $city, $province, $new_bal, $total_package, $type_of_package, $member_id)
	{

		$date_transaction = date("Y-m-d");
		$credit = 0;
		$debit = $total_package;
		$name = "Funeral arrangement";

		$query1 = $this->db->prepare("INSERT INTO `statement` (`name`, `deceased_name`, `society_id`, `society_name`, `date_transaction`, `credit`, `debit`, `balance`) VALUES (?, ?, ?, ?, ?, ?, ?, ?) ");
		$query1->bindValue(1, $name);
		$query1->bindValue(2, $name_of_deceased);
		$query1->bindValue(3, $society_id);
		$query1->bindValue(4, $society_name);
		$query1->bindValue(5, $date_transaction);
		$query1->bindValue(6, $credit);
		$query1->bindValue(7, $debit);
		$query1->bindValue(8, $new_bal);

		$deceased = "Yes";
		$query2 = $this->db->prepare("UPDATE `member` SET
								`deceased`		=? 
								
								WHERE `member_id` 	= ? 
								");
		$query2->bindValue(1, $deceased);
		$query2->bindValue(2, $member_id);

		$query = $this->db->prepare("INSERT INTO `funeral` (`member_id`, `society_id`, `informant_first_name`, `informant_surname`, `informant_id_number`, `informant_contact_number`, `informant_street`, `informant_suburb`, `informant_city`, `informant_province`, `name_of_deceased`, `transport_amount`, `funeral_time`, `date_of_funeral`, `street`, `suburb`, `city`, `province`, `new_balance`, `total_package`, `type_of_package`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ");
		$query->bindValue(1, $member_id);
		$query->bindValue(2, $society_id);
		$query->bindValue(3, $informant_first_name);
		$query->bindValue(4, $informant_surname);
		$query->bindValue(5, $informant_id_number);
		$query->bindValue(6, $informant_contact_number);
		$query->bindValue(7, $informant_street);
		$query->bindValue(8, $informant_suburb);
		$query->bindValue(9, $informant_city);
		$query->bindValue(10, $informant_province);
		$query->bindValue(11, $name_of_deceased);
		$query->bindValue(12, $transport_amount);
		$query->bindValue(13, $funeral_time);
		$query->bindValue(14, $date_of_funeral);
		$query->bindValue(15, $street);
		$query->bindValue(16, $suburb);
		$query->bindValue(17, $city);
		$query->bindValue(18, $province);
		$query->bindValue(19, $new_bal);
		$query->bindValue(20, $total_package);
		$query->bindValue(21, $type_of_package);

		try{
			$query1->execute();
			$query2->execute();
			$query->execute();

			// header('Location:index.php');

			$funeral_id = $this->db->lastInsertId();
			header('Location:confirm_society_funeral.php?funeral_id='.$funeral_id);

		}catch(PDOException $e){
			die($e->getMessage());
		}

	}

	public function plan_a_policy_holder_funeral_for_adult($main_member_id, $informant_first_name, $informant_surname, $informant_id_number, $informant_contact_number, $informant_street, $informant_suburb, $informant_city, $informant_province, $id_number_of_deceased, $transport_amount, $funeral_time, $date_of_funeral, $street, $suburb, $city, $province, $new_bal, $total_package, $deceased_name, $type_of_package, $family_id, $member_type)
	{

		$date_transaction = date("Y-m-d");
		$credit = 0;
		$debit = $total_package;
		$name = "admin";

		$query1 = $this->db->prepare("INSERT INTO `member_statement` (`member_id`, `deceased_name`, `date_transaction`, `name`, `credit`, `debit`, `balance`, `paid_for`) VALUES (?, ?, ?, ?, ?, ?, ?, ?) ");
		$query1->bindValue(1, $main_member_id);
		$query1->bindValue(2, $deceased_name);
		$query1->bindValue(3, $date_transaction);
		$query1->bindValue(4, $name);
		$query1->bindValue(5, $credit);
		$query1->bindValue(6, $debit);
		$query1->bindValue(7, $new_bal);
		$query1->bindValue(8, $date_of_funeral);

		$deceased = "Yes";
		$query2 = $this->db->prepare("UPDATE `family` SET
								`deceased`		=? 
								
								WHERE `family_id` 	= ? 
								");
		$query2->bindValue(1, $deceased);
		$query2->bindValue(2, $family_id);

		$query = $this->db->prepare("INSERT INTO `policy_holder_funeral` (`main_member_id`, `informant_first_name`, `informant_surname`, `informant_id_number`, `informant_contact_number`, `informant_street`, `informant_suburb`, `informant_city`, `informant_province`, `id_number_of_deceased`, `transport_amount`, `funeral_time`, `date_of_funeral`, `street`, `suburb`, `city`, `province`, `new_balance`, `total_package`, `type_of_package`, `member_id`, `member_type`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ");
		$query->bindValue(1, $main_member_id);
		$query->bindValue(2, $informant_first_name);
		$query->bindValue(3, $informant_surname);
		$query->bindValue(4, $informant_id_number);
		$query->bindValue(5, $informant_contact_number);
		$query->bindValue(6, $informant_street);
		$query->bindValue(7, $informant_suburb);
		$query->bindValue(8, $informant_city);
		$query->bindValue(9, $informant_province);
		$query->bindValue(10, $id_number_of_deceased);
		$query->bindValue(11, $transport_amount);
		$query->bindValue(12, $funeral_time);
		$query->bindValue(13, $date_of_funeral);
		$query->bindValue(14, $street);
		$query->bindValue(15, $suburb);
		$query->bindValue(16, $city);
		$query->bindValue(17, $province);
		$query->bindValue(18, $new_bal);
		$query->bindValue(19, $total_package);
		$query->bindValue(20, $type_of_package);
		$query->bindValue(21, $family_id);
		$query->bindValue(22, $member_type);

		try{
			$query1->execute();
			$query2->execute();
			$query->execute();

			$policy_holder_funeral_id = $this->db->lastInsertId();
			header('Location:confirm_policy_holder_funeral.php?policy_holder_funeral_id='.$policy_holder_funeral_id);

		}catch(PDOException $e){
			die($e->getMessage());
		}

	}

	public function plan_a_funeral_for_child($society_id, $society_name, $informant_first_name, $informant_surname, $informant_id_number, $informant_contact_number, $informant_street, $informant_suburb, $informant_city, $informant_province, $name_of_deceased, $flower_amount, $coffin_amount, $grave_marker_amount, $transport_amount, $funeral_service_amount, $funeral_time, $date_of_funeral, $street, $suburb, $city, $province, $new_bal, $total_package, $type_of_package, $member_id)
	{
		$date_transaction = date("Y-m-d");
		$credit = 0;
		$debit = $total_package;
		$name = "Funeral arrangement";

		$query1 = $this->db->prepare("INSERT INTO `statement` (`name`, `deceased_name`, `society_id`, `society_name`, `date_transaction`, `credit`, `debit`, `balance`) VALUES (?, ?, ?, ?, ?, ?, ?, ?) ");
		$query1->bindValue(1, $name);
		$query1->bindValue(2, $name_of_deceased);
		$query1->bindValue(3, $society_id);
		$query1->bindValue(4, $society_name);
		$query1->bindValue(5, $date_transaction);
		$query1->bindValue(6, $credit);
		$query1->bindValue(7, $debit);
		$query1->bindValue(8, $new_bal);

		$deceased = "Yes";
		$query2 = $this->db->prepare("UPDATE `member` SET
								`deceased`		=? 
								
								WHERE `member_id` 	= ? 
								");
		$query2->bindValue(1, $deceased);
		$query2->bindValue(2, $member_id);

		$query 	= $this->db->prepare("INSERT INTO `funeral` (`member_id`, `society_id`, `informant_first_name`, `informant_surname`, `informant_id_number`, `informant_contact_number`, `informant_street`, `informant_suburb`, `informant_city`, `informant_province`, `name_of_deceased`, `flower_amount`, `coffin_amount`, `grave_marker_amount`, `transport_amount`, `funeral_service_amount`, `funeral_time`, `date_of_funeral`, `street`, `suburb`, `city`, `province`, `new_balance`, `total_package`, `type_of_package`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ");
		$query->bindValue(1, $member_id);
		$query->bindValue(2, $society_id);
		$query->bindValue(3, $informant_first_name);
		$query->bindValue(4, $informant_surname);
		$query->bindValue(5, $informant_id_number);
		$query->bindValue(6, $informant_contact_number);
		$query->bindValue(7, $informant_street);
		$query->bindValue(8, $informant_suburb);
		$query->bindValue(9, $informant_city);
		$query->bindValue(10, $informant_province);
		$query->bindValue(11, $name_of_deceased);
		$query->bindValue(12, $flower_amount);
		$query->bindValue(13, $coffin_amount);
		$query->bindValue(14, $grave_marker_amount);
		$query->bindValue(15, $transport_amount);
		$query->bindValue(16, $funeral_service_amount);
		$query->bindValue(17, $funeral_time);
		$query->bindValue(18, $date_of_funeral);
		$query->bindValue(19, $street);
		$query->bindValue(20, $suburb);
		$query->bindValue(21, $city);
		$query->bindValue(22, $province);
		$query->bindValue(23, $new_bal);
		$query->bindValue(24, $total_package);
		$query->bindValue(25, $type_of_package);

		try{
			$query1->execute();
			$query2->execute();
			$query->execute();

			$funeral_id = $this->db->lastInsertId();
			header('Location:confirm_society_funeral.php?funeral_id='.$funeral_id);

		}catch(PDOException $e){
			die($e->getMessage());
		}

	}

	public function plan_a_policy_holder_funeral_for_child($main_member_id, $informant_first_name, $informant_surname, $informant_id_number, $informant_contact_number, $informant_street, $informant_suburb, $informant_city, $informant_province, $id_number_of_deceased, $flower_amount, $coffin_amount, $grave_marker_amount, $transport_amount, $funeral_service_amount, $funeral_time, $date_of_funeral, $street, $suburb, $city, $province, $new_bal, $total_package, $deceased_name, $type_of_package, $family_id, $member_type)
	{
		$date_transaction = date("Y-m-d");
		$credit = 0;
		$debit = $total_package;
		$name = "Funeral arrangement";

		$query1 = $this->db->prepare("INSERT INTO `member_statement` (`member_id`, `deceased_name`, `date_transaction`, `name`, `credit`, `debit`, `balance`, `paid_for`) VALUES (?, ?, ?, ?, ?, ?, ?, ?) ");
		$query1->bindValue(1, $main_member_id);
		$query1->bindValue(2, $deceased_name);
		$query1->bindValue(3, $date_transaction);
		$query1->bindValue(4, $name);
		$query1->bindValue(5, $credit);
		$query1->bindValue(6, $debit);
		$query1->bindValue(7, $new_bal);
		$query1->bindValue(8, $date_of_funeral);

		$deceased = "Yes";
		$query2 = $this->db->prepare("UPDATE `family` SET
								`deceased` = ? 
								
								WHERE `family_id` 	= ? 
								");
		$query2->bindValue(1, $deceased);
		$query2->bindValue(2, $family_id);

		$query 	= $this->db->prepare("INSERT INTO `policy_holder_funeral` (`main_member_id`, `informant_first_name`, `informant_surname`, `informant_id_number`, `informant_contact_number`, `informant_street`, `informant_suburb`, `informant_city`, `informant_province`, `id_number_of_deceased`, `flower_amount`, `coffin_amount`, `grave_marker_amount`, `transport_amount`, `funeral_service_amount`, `funeral_time`, `date_of_funeral`, `street`, `suburb`, `city`, `province`, `new_balance`, `total_package`, `type_of_package`, `member_id`, `member_type`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ");
		$query->bindValue(1, $main_member_id);
		$query->bindValue(2, $informant_first_name);
		$query->bindValue(3, $informant_surname);
		$query->bindValue(4, $informant_id_number);
		$query->bindValue(5, $informant_contact_number);
		$query->bindValue(6, $informant_street);
		$query->bindValue(7, $informant_suburb);
		$query->bindValue(8, $informant_city);
		$query->bindValue(9, $informant_province);
		$query->bindValue(10, $id_number_of_deceased);
		$query->bindValue(11, $flower_amount);
		$query->bindValue(12, $coffin_amount);
		$query->bindValue(13, $grave_marker_amount);
		$query->bindValue(14, $transport_amount);
		$query->bindValue(15, $funeral_service_amount);
		$query->bindValue(16, $funeral_time);
		$query->bindValue(17, $date_of_funeral);
		$query->bindValue(18, $street);
		$query->bindValue(19, $suburb);
		$query->bindValue(20, $city);
		$query->bindValue(21, $province);
		$query->bindValue(22, $new_bal);
		$query->bindValue(23, $total_package);
		$query->bindValue(24, $type_of_package);
		$query->bindValue(25, $family_id);
		$query->bindValue(26, $member_type);

		try{
			$query1->execute();
			$query2->execute();
			$query->execute();

			$policy_holder_funeral_id = $this->db->lastInsertId();
			header('Location:confirm_policy_holder_funeral.php?policy_holder_funeral_id='.$policy_holder_funeral_id);

		}catch(PDOException $e){
			die($e->getMessage());
		}

	}


	public function update_society_funeral_for_adult($informant_first_name, $informant_surname, $informant_id_number, $informant_contact_number, $informant_street, $informant_suburb, $informant_city, $informant_province, $transport_amount, $funeral_time, $date_of_funeral, $street, $suburb, $city, $province, $new_bal, $total_package, $funeral_id, $payment_id)
	{
		$query = $this->db->prepare("UPDATE `funeral` SET
								`informant_first_name`	= ?,
								`informant_surname`		= ?,
								`informant_id_number`	= ?,
								`informant_contact_number`	= ?,
								`informant_street`		= ?,
								`informant_suburb`		= ?,
								`informant_city`		= ?,
								`informant_province`	= ?,
								`transport_amount`	= ?,
								`funeral_time`		= ?,
								`date_of_funeral`	= ?,
								`street`			= ?,
								`suburb`			= ?,
								`city`				= ?,
								`province`			= ?,
								`new_balance`		= ?,
								`total_package`		= ?
								
								WHERE `funeral_id` 	= ? 
								");

		$query->bindValue(1, $informant_first_name);
		$query->bindValue(2, $informant_surname);
		$query->bindValue(3, $informant_id_number);
		$query->bindValue(4, $informant_contact_number);
		$query->bindValue(5, $informant_street);
		$query->bindValue(6, $informant_suburb);
		$query->bindValue(7, $informant_city);
		$query->bindValue(8, $informant_province);
		$query->bindValue(9, $transport_amount);
		$query->bindValue(10, $funeral_time);
		$query->bindValue(11, $date_of_funeral);
		$query->bindValue(12, $street);
		$query->bindValue(13, $suburb);
		$query->bindValue(14, $city);
		$query->bindValue(15, $province);
		$query->bindValue(16, $new_bal);
		$query->bindValue(17, $total_package);
		$query->bindValue(18, $funeral_id);

		$debit = $total_package;

		$query1 = $this->db->prepare("UPDATE `statement` SET
								`debit`				= ?,
								`balance`			= ?
								
								WHERE payment_id = ?
								");

		$query1->bindValue(1, $debit);
		$query1->bindValue(2, $new_bal);
		$query1->bindValue(3, $payment_id);
		
		try{
			$query->execute();
			$query1->execute();

			header('Location:confirm_society_funeral.php?funeral_id='.$funeral_id);
		}catch(PDOException $e){
			die($e->getMessage());
		}	
	}

	public function update_policy_holder_funeral_for_adult($main_member_id, $informant_first_name, $informant_surname, $informant_id_number, $informant_contact_number, $informant_street, $informant_suburb, $informant_city, $informant_province, $id_number_of_deceased, $transport_amount, $funeral_time, $date_of_funeral, $street, $suburb, $city, $province, $new_bal, $total_package, $deceased_name, $type_of_package, $family_id, $member_type, $policy_holder_funeral_id, $member_payment_id)
	{
		$query = $this->db->prepare("UPDATE `policy_holder_funeral` SET
								`main_member_id`		= ?,
								`informant_first_name`	= ?,
								`informant_surname`		= ?,
								`informant_id_number`	= ?,
								`informant_contact_number` = ?,
								`informant_street`		= ?,
								`informant_suburb`		= ?,
								`informant_city`		= ?,
								`informant_province`	= ?,
								`id_number_of_deceased`	= ?,
								`transport_amount`		= ?,
								`funeral_time`			= ?,
								`date_of_funeral`		= ?,
								`street`				= ?,
								`suburb`				= ?,
								`city`					= ?,
								`province`				= ?,
								`new_balance`			= ?,
								`total_package`			= ?,
								`member_id`				= ?,
								`member_type`			= ?
								
								WHERE `policy_holder_funeral_id` 	= ? 
								");

		$query->bindValue(1, $main_member_id);
		$query->bindValue(2, $informant_first_name);
		$query->bindValue(3, $informant_surname);
		$query->bindValue(4, $informant_id_number);
		$query->bindValue(5, $informant_contact_number);
		$query->bindValue(6, $informant_street);
		$query->bindValue(7, $informant_suburb);
		$query->bindValue(8, $informant_city);
		$query->bindValue(9, $informant_province);
		$query->bindValue(10, $id_number_of_deceased);
		$query->bindValue(11, $transport_amount);
		$query->bindValue(12, $funeral_time);
		$query->bindValue(13, $date_of_funeral);
		$query->bindValue(14, $street);
		$query->bindValue(15, $suburb);
		$query->bindValue(16, $city);
		$query->bindValue(17, $province);
		$query->bindValue(18, $new_bal);
		$query->bindValue(19, $total_package);
		$query->bindValue(20, $family_id);
		$query->bindValue(21, $member_type);
		$query->bindValue(22, $policy_holder_funeral_id);

		$credit = 0;
		$debit = $total_package;
		$name = "Funeral arrangement";

		$query1 = $this->db->prepare("UPDATE `member_statement` SET
								`member_id`			= ?,
								`deceased_name`		= ?,
								`name`				= ?,
								`credit`			= ?,
								`debit`				= ?,
								`balance`			= ?,
								`paid_for` 			= ?
								
								WHERE member_payment_id = ?
								");

		$query1->bindValue(1, $main_member_id);
		$query1->bindValue(2, $deceased_name);
		$query1->bindValue(3, $name);
		$query1->bindValue(4, $credit);
		$query1->bindValue(5, $debit);
		$query1->bindValue(6, $new_bal);
		$query1->bindValue(7, $date_of_funeral);
		$query1->bindValue(8, $member_payment_id);
		
		$deceased = "Yes";
		$query2 = $this->db->prepare("UPDATE `family` SET
								`deceased` = ? 
								
								WHERE `family_id` 	= ? 
								");
		$query2->bindValue(1, $deceased);
		$query2->bindValue(2, $family_id);

		try{
			$query->execute();
			$query1->execute();

			header('Location:confirm_policy_holder_funeral.php?policy_holder_funeral_id='.$policy_holder_funeral_id);
		}catch(PDOException $e){
			die($e->getMessage());
		}	
	}

		public function update_society_funeral_for_child($informant_first_name, $informant_surname, $informant_id_number, $informant_contact_number, $informant_street, $informant_suburb, $informant_city, $informant_province, $flower_amount, $coffin_amount, $grave_marker_amount, $transport_amount, $funeral_service_amount, $funeral_time, $date_of_funeral, $street, $suburb, $city, $province, $new_bal, $total_package, $funeral_id, $payment_id)
	{
		$query = $this->db->prepare("UPDATE `funeral` SET
								`informant_first_name` 		= ?, 
								`informant_surname`			= ?,
								`informant_id_number`		= ?,
								`informant_contact_number`	= ?,
								`informant_street`			= ?,
								`informant_suburb`			= ?,
								`informant_city`			= ?,
								`informant_province`		= ?,			
								`flower_amount`				= ?,
								`coffin_amount`				= ?,
								`grave_marker_amount` 		= ?,
								`transport_amount`			= ?,
								`funeral_service_amount` 	= ?,
								`funeral_time`				= ?,
								`date_of_funeral`			= ?,
								`street`					= ?,
								`suburb`					= ?,
								`city`						= ?,
								`province`					= ?,
								`new_balance`				= ?,
								`total_package`				= ?
								
								WHERE `funeral_id` 	= ? 
								");
		$query->bindValue(1, $informant_first_name);
		$query->bindValue(2, $informant_surname);
		$query->bindValue(3, $informant_id_number);
		$query->bindValue(4, $informant_contact_number);
		$query->bindValue(5, $informant_street);
		$query->bindValue(6, $informant_suburb);
		$query->bindValue(7, $informant_city);
		$query->bindValue(8, $informant_province);
		$query->bindValue(9, $flower_amount);
		$query->bindValue(10, $coffin_amount);
		$query->bindValue(11, $grave_marker_amount);
		$query->bindValue(12, $transport_amount);
		$query->bindValue(13, $funeral_service_amount);
		$query->bindValue(14, $funeral_time);
		$query->bindValue(15, $date_of_funeral);
		$query->bindValue(16, $street);
		$query->bindValue(17, $suburb);
		$query->bindValue(18, $city);
		$query->bindValue(19, $province);
		$query->bindValue(20, $new_bal);
		$query->bindValue(21, $total_package);
		$query->bindValue(22, $funeral_id);

		$debit = $total_package;

		$query1 = $this->db->prepare("UPDATE `statement` SET
								`debit`				= ?,
								`balance`			= ?
								
								WHERE payment_id = ?
								");

		$query1->bindValue(1, $debit);
		$query1->bindValue(2, $new_bal);
		$query1->bindValue(3, $payment_id);
		
		try{
			$query->execute();
			$query1->execute();

			header('Location:confirm_society_funeral.php?funeral_id='.$funeral_id);
		}catch(PDOException $e){
			die($e->getMessage());
		}	
	}

	public function update_policy_holder_funeral_for_child($main_member_id, $informant_first_name, $informant_surname, $informant_id_number, $informant_contact_number, $informant_street, $informant_suburb, $informant_city, $informant_province, $id_number_of_deceased, $flower_amount, $coffin_amount, $grave_marker_amount, $transport_amount, $funeral_service_amount, $funeral_time, $date_of_funeral, $street, $suburb, $city, $province, $new_bal, $total_package, $deceased_name, $type_of_package, $family_id, $member_type, $policy_holder_funeral_id, $member_payment_id)
	{
		$query = $this->db->prepare("UPDATE `policy_holder_funeral` SET
								`main_member_id`			= ?,
								`id_number_of_deceased`		= ?,
								`flower_amount`				= ?,
								`coffin_amount`				= ?,
								`grave_marker_amount` 		= ?,
								`transport_amount`			= ?,
								`funeral_service_amount` 	= ?,
								`funeral_time`				= ?,
								`date_of_funeral`			= ?,
								`street`					= ?,
								`suburb`					= ?,
								`city`						= ?,
								`province`					= ?,
								`new_balance`				= ?,
								`total_package`				= ?,
								`member_id`					= ?,
								`member_type`				= ?
								
								WHERE `policy_holder_funeral_id` 	= ? 
								");

		$query->bindValue(1, $main_member_id);
		$query->bindValue(2, $id_number_of_deceased);
		$query->bindValue(3, $flower_amount);
		$query->bindValue(4, $coffin_amount);
		$query->bindValue(5, $grave_marker_amount);
		$query->bindValue(6, $transport_amount);
		$query->bindValue(7, $funeral_service_amount);
		$query->bindValue(8, $funeral_time);
		$query->bindValue(9, $date_of_funeral);
		$query->bindValue(10, $street);
		$query->bindValue(11, $suburb);
		$query->bindValue(12, $city);
		$query->bindValue(13, $province);
		$query->bindValue(14, $new_bal);
		$query->bindValue(15, $total_package);
		$query->bindValue(16, $family_id);
		$query->bindValue(17, $member_type);
		$query->bindValue(18, $policy_holder_funeral_id);

		$credit = 0;
		$debit = $total_package;
		$name = "Funeral arrangement";

		$query1 = $this->db->prepare("UPDATE `member_statement` SET
								`member_id`			= ?,
								`deceased_name`		= ?,
								`name`				= ?,
								`credit`			= ?,
								`debit`				= ?,
								`balance`			= ?,
								`paid_for` 			= ?
								
								WHERE member_payment_id = ?
								");

		$query1->bindValue(1, $main_member_id);
		$query1->bindValue(2, $deceased_name);
		$query1->bindValue(3, $name);
		$query1->bindValue(4, $credit);
		$query1->bindValue(5, $debit);
		$query1->bindValue(6, $new_bal);
		$query1->bindValue(7, $date_of_funeral);
		$query1->bindValue(8, $member_payment_id);
		
		try{
			$query->execute();
			$query1->execute();

			header('Location:confirm_policy_holder_funeral.php?policy_holder_funeral_id='.$policy_holder_funeral_id);
		}catch(PDOException $e){
			die($e->getMessage());
		}	
	}

	public function funeraldata($funeral_id) 
	{
		$query = $this->db->prepare("SELECT * FROM funeral WHERE funeral_id = ?");
        $query->bindValue(1, $funeral_id);
        
		try{

			$query->execute();

		} catch(PDOException $e){

			die($e->getMessage());
		}
		return $query->fetchAll();
	}

		public function policy_holder_funeral_data($policy_holder_funeral_id) 
	{
		$query = $this->db->prepare("SELECT * FROM policy_holder_funeral WHERE policy_holder_funeral_id = ?");
        $query->bindValue(1, $policy_holder_funeral_id);
        
		try{

			$query->execute();

		} catch(PDOException $e){

			die($e->getMessage());
		}
		return $query->fetchAll();
	}

	public function check_member_name_exists($name1, $name2) 
    {
		$query = $this->db->prepare("SELECT COUNT(`funeral_id`) FROM `funeral` WHERE `first_name`= ? AND `last_name` = ? ");
		$query->bindValue(1, $name1);
		$query->bindValue(2, $name2);
	
		try{

			$query->execute();
			$rows = $query->fetchColumn();

			if($rows == 1){
				return true;
			}else{
				return false;
			}

		} catch (PDOException $e){
			die($e->getMessage());
		}

	}

	public function check_member_name_exists_for_policy_holder($name1, $name2) 
    {
		$query = $this->db->prepare("SELECT COUNT(`policy_holder_funeral_id`) FROM `policy_holder_funeral` WHERE `first_name`= ? AND `last_name` = ? ");
		$query->bindValue(1, $name1);
		$query->bindValue(2, $name2);
	
		try{

			$query->execute();
			$rows = $query->fetchColumn();

			if($rows == 1){
				return true;
			}else{
				return false;
			}

		} catch (PDOException $e){
			die($e->getMessage());
		}

	}

	public function get_all_society_funeral_arrangement($society_id) 
	{
		$today = date("Y-m-d");
		$query = $this->db->prepare("SELECT * FROM funeral WHERE society_id = ? ");
        $query->bindValue(1, $society_id);
        
		try{

			$query->execute();

		} catch(PDOException $e){

			die($e->getMessage());
		}
		return $query->fetchAll();
	}

	public function society_funeral_arrangement_for_each_society($society_id) 
	{
		$today = date("Y-m-d");
		$query = $this->db->prepare("SELECT * FROM funeral WHERE society_id = ? AND date_of_funeral >= ?");
        $query->bindValue(1, $society_id);
        $query->bindValue(2, $today);
        
		try{

			$query->execute();

		} catch(PDOException $e){

			die($e->getMessage());
		}
		return $query->fetchAll();
	}

	public function past_society_funeral_arrangement_for_each_society($society_id) 
	{
		$today = date("Y-m-d");
		$query = $this->db->prepare("SELECT * FROM funeral WHERE society_id = ? AND date_of_funeral < ?");
        $query->bindValue(1, $society_id);
        $query->bindValue(2, $today);
        
		try{

			$query->execute();

		} catch(PDOException $e){

			die($e->getMessage());
		}
		return $query->fetchAll();
	}

	public function policy_holder_funeral_arrangement_for_each_society($main_member_id) 
	{
		$today = date("Y-m-d");
		$query = $this->db->prepare("SELECT * FROM policy_holder_funeral WHERE main_member_id = ? AND date_of_funeral >= ?");
        $query->bindValue(1, $main_member_id);
        $query->bindValue(2, $today);
        
		try{

			$query->execute();

		} catch(PDOException $e){

			die($e->getMessage());
		}
		return $query->fetchAll();
	}

	public function past_policy_holder_funeral_arrangement_for_each_society($main_member_id) 
	{
		$today = date("Y-m-d");
		$query = $this->db->prepare("SELECT * FROM policy_holder_funeral WHERE main_member_id = ? AND date_of_funeral < ?");
        $query->bindValue(1, $main_member_id);
        $query->bindValue(2, $today);
        
		try{

			$query->execute();

		} catch(PDOException $e){

			die($e->getMessage());
		}
		return $query->fetchAll();
	}

	public function delete_funeral_arrangement($funeral_id, $member_id) 
    {
    	$deceased = "No";
		$query2 = $this->db->prepare("UPDATE `member` SET
								`deceased`		=? 
								
								WHERE `member_id` 	= ? 
								");
		$query2->bindValue(1, $deceased);
		$query2->bindValue(2, $member_id);

		$query = $this->db->prepare("DELETE FROM `funeral` WHERE `funeral_id` = ?");
		
		$query->bindValue(1, $funeral_id);
		
		try{
			$query2->execute();
			$query->execute();

		} catch(PDOException $e){

			die($e->getMessage());
		}
		
	}

	public function delete_policy_holder_funeral_arrangement($policy_holder_funeral_id) 
    {
		$query = $this->db->prepare("DELETE FROM `policy_holder_funeral` WHERE `policy_holder_funeral_id` = ?");
		
		$query->bindValue(1, $policy_holder_funeral_id);
		
		try{

			$query->execute();

		} catch(PDOException $e){

			die($e->getMessage());
		}
		
	}

		
}

?>