<?php 
class Main_member{
 	
	private $db;

	public function __construct($database) {
	    $this->db = $database;
	}	

	public function register_user($password, $email, $username)
	{
		global $bcrypt; // making the $bcrypt variable global so we can use here

		$time 		= time();
		$ip 		= $_SERVER['REMOTE_ADDR']; // getting the users IP address
		$email_code = $email_code = uniqid('code_',true); // Creating a unique string.
		
		$password   = $bcrypt->genHash($password);
		$type = "user";
		
		$query 	= $this->db->prepare("INSERT INTO `users` (`password`, `email`, `username`, `ip`, `time`, `email_code`, `type`) VALUES (?, ?, ?, ?, ?, ?, ?) ");
		$query->bindValue(1, $password);
		$query->bindValue(2, $email);
		$query->bindValue(3, $username);
		$query->bindValue(4, $ip);
		$query->bindValue(5, $time);
		$query->bindValue(6, $email_code);
		$query->bindValue(7, $type);

		try{
			$query->execute();
			$user_id = $this->db->lastInsertId();
			header('Location: create_main_member.php?user_id='.$user_id);

			//mail($email, 'Welcome to Tello', "Hello " . $username. ",\r\nThank you for registering with us. \r\n\r\n-- Tello Team");
		}catch(PDOException $e){
			die($e->getMessage());
		}	
	}

	public function create_member($user_id, $first_name, $last_name, $gender, $id_number, $contact_number, $province, $city, $suburb, $street, $plan_type, $premium, $cover, $policy_number)
	{
		$date_inception = time(); 
		$query 	= $this->db->prepare("INSERT INTO `main_member` (`user_id`, `first_name`, `last_name`, `gender`, `id_number`, `contact_number`, `province`, `city`, `suburb`, `street`, `plan_type`, `premium`, `cover`, `policy_number`, `inception_date`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ");
		$query->bindValue(1, $user_id);
		$query->bindValue(2, $first_name);
		$query->bindValue(3, $last_name);
		$query->bindValue(4, $gender);
		$query->bindValue(5, $id_number);
		$query->bindValue(6, $contact_number);
		$query->bindValue(7, $province);
		$query->bindValue(8, $city);
		$query->bindValue(9, $suburb);
		$query->bindValue(10, $street);
		$query->bindValue(11, $plan_type);
		$query->bindValue(12, $premium);
		$query->bindValue(13, $cover);
		$query->bindValue(14, $policy_number);
		$query->bindValue(15, $date_inception);

		try{
			$query->execute();
			$main_member_id = $this->db->lastInsertId();

		}catch(PDOException $e){
			die($e->getMessage());
		}
		header('Location:spouse.php?main_member_id='.$main_member_id);

	}

	public function member_id_exists($id_number) 
	{
		$query = $this->db->prepare("SELECT COUNT(`id_number`) FROM `main_member` WHERE `id_number`= ?");
		$query->bindValue(1, $id_number);
	
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

		public function member_id_exists_for_policy_holder_funeral($id_number_of_deceased) 
	{
		$query = $this->db->prepare("SELECT COUNT(`id_number`) FROM `family` WHERE `id_number`= ?");
		$query->bindValue(1, $id_number_of_deceased);
	
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

	public function get_member_data_using_deceased_id_number($id_number_of_deceased) 
	{
		$query = $this->db->prepare("SELECT * FROM family WHERE `id_number` = ?");
		$query->bindValue(1, $id_number_of_deceased);
		try{

			$query->execute();

		} catch(PDOException $e){

			die($e->getMessage());
		}
		return $query->fetchAll();
	}

	public function get_member_data_using_family_id($family_id) 
	{
		$query = $this->db->prepare("SELECT * FROM family WHERE `family_id` = ?");
		$query->bindValue(1, $family_id);
		try{

			$query->execute();

		} catch(PDOException $e){

			die($e->getMessage());
		}
		return $query->fetchAll();
	}

	public function get_main_member_data_using_id_number($id_number) 
	{
		$query = $this->db->prepare("SELECT * FROM main_member WHERE `id_number` = ?");
		$query->bindValue(1, $id_number);
		try{

			$query->execute();

		} catch(PDOException $e){

			die($e->getMessage());
		}
		return $query->fetchAll();
	}


	public function allMembersInformation() 
	{
		$query = $this->db->prepare("SELECT * FROM `main_member`");

		try{

			$query->execute();

			return $query->fetchAll();

		} catch(PDOException $e){

			die($e->getMessage());
		}
	}

	public function getiingAllMembersInformation($main_member_id) 
	{
		$deceased = "No";
		$query = $this->db->prepare("SELECT * FROM family WHERE main_member_id = ? AND deceased = ? ");
		$query->bindValue(1, $main_member_id);
		$query->bindValue(2, $deceased);

		try{

			$query->execute();

			return $query->fetchAll();

		} catch(PDOException $e){

			die($e->getMessage());
		}
	}

	public function allProvinceInformation() 
	{
		$query = $this->db->prepare("SELECT * FROM `province` ORDER BY province_name ");

		try{

			$query->execute();

			return $query->fetchAll();

		} catch(PDOException $e){

			die($e->getMessage());
		}
	}

	public function allCityInformation() 
	{
		$query = $this->db->prepare("SELECT * FROM `city` ORDER BY city_name ");

		try{

			$query->execute();

			return $query->fetchAll();

		} catch(PDOException $e){

			die($e->getMessage());
		}
	}

	public function memberdata($main_member_id) 
	{
		$query = $this->db->prepare("SELECT * FROM main_member WHERE `main_member_id` = ?");
		$query->bindValue(1, $main_member_id);
		try{

			$query->execute();

		} catch(PDOException $e){

			die($e->getMessage());
		}
		return $query->fetchAll();
	}

	public function memberdata2($id) 
	{
		$query = $this->db->prepare("SELECT * FROM main_member WHERE `user_id` = ?");
		$query->bindValue(1, $id);
		try{

			$query->execute();

		} catch(PDOException $e){

			die($e->getMessage());
		}
		return $query->fetchAll();
	}

	public function get_main_member_id($user_id) 
	{
		$query = $this->db->prepare("SELECT main_member_id FROM main_member WHERE `user_id` = ?");
		$query->bindValue(1, $user_id);
		try{

			$query->execute();

		} catch(PDOException $e){

			die($e->getMessage());
		}
		return $query->fetchColumn();
	}

	public function update_member($first_name, $last_name, $gender, $contact_number, $province, $city, $suburb, $street, $plan_type, $premium, $cover, $policy_number, $main_member_id)
	{

		$query = $this->db->prepare("UPDATE `main_member` SET
								`first_name`		= ?,
								`last_name`			= ?,
								`gender`			= ?,
								`contact_number`	= ?,
								`province`			= ?,
								`city`				= ?,
								`suburb`			= ?,
								`street`			= ?,
								`plan_type`			= ?,
								`premium`			= ?,
								`cover`				= ?,
								`policy_number`		= ?
								
								WHERE `main_member_id` 	= ? 
								");

		$query->bindValue(1, $first_name);
		$query->bindValue(2, $last_name);
		$query->bindValue(3, $gender);
		$query->bindValue(4, $contact_number);
		$query->bindValue(5, $province);
		$query->bindValue(6, $city);
		$query->bindValue(7, $suburb);
		$query->bindValue(8, $street);
		$query->bindValue(9, $plan_type);
		$query->bindValue(10, $premium);
		$query->bindValue(11, $cover);
		$query->bindValue(12, $policy_number);
		$query->bindValue(13, $main_member_id);
		
		try{
			$query->execute();
		}catch(PDOException $e){
			die($e->getMessage());
		}	
	}

	public function get_last_balance($main_member_id) 
	{
		$query = $this->db->prepare("SELECT `balance` FROM `member_statement` WHERE `member_id` = ? AND `member_payment_id` = 
		(SELECT max(`member_payment_id`) FROM `member_statement` WHERE `member_id` = ?)");
		$query->bindValue(1, $main_member_id);
		$query->bindValue(2, $main_member_id);
		
		try{
			
			$query->execute();
			return $query->fetchColumn();
			
		}catch(PDOException $e){
			die($e->getMessage());
		}

	}

	public function member_statement_data($member_payment_id) 
	{
		$query = $this->db->prepare("SELECT * FROM member_statement WHERE `member_payment_id` = ?");
		$query->bindValue(1, $member_payment_id);
		try{

			$query->execute();

		} catch(PDOException $e){

			die($e->getMessage());
		}
		return $query->fetchAll();
	}

	public function pay_premium($name, $amount, $date_of_premium, $balance, $main_member_id)
	{
		global $db;
		
		$credit = $amount;
		$debit = 0;

		$date_transaction = time();
		
		$query 	= $this->db->prepare("INSERT INTO `member_statement` (`member_id`, `date_transaction`, `name`, `credit`, `debit`, `balance`, `paid_for`) VALUES (?, ?, ?, ?, ?, ?, ?) ");
		$query->bindValue(1, $main_member_id);
		$query->bindValue(2, $date_transaction);
		$query->bindValue(3, $name);
		$query->bindValue(4, $credit);
		$query->bindValue(5, $debit);
		$query->bindValue(6, $balance);
		$query->bindValue(7, $date_of_premium);

		try{
			$query->execute();

			$member_payment_id = $db->lastInsertID();
			header('Location:confirm_premium.php?member_payment_id='.$member_payment_id);

		}catch(PDOException $e){
			die($e->getMessage());
		}	
	}

	public function update_premium($name, $amount, $date_of_premium, $balance, $member_payment_id)
	{
		$query = $this->db->prepare("UPDATE `member_statement` SET
								`credit`			= ?,
								`balance`			= ?,
								`paid_for`			= ?
								
								WHERE `member_payment_id` 		= ? 
								");

		$query->bindValue(1, $amount);
		$query->bindValue(2, $balance);
		$query->bindValue(3, $date_of_premium);
		$query->bindValue(4, $member_payment_id);
		
		try
		{
			$query->execute();
			header('Location: confirm_premium.php?member_payment_id='.$member_payment_id);
		}
			
		catch(PDOException $e)
		{
		die($e->getMessage());
		}

	}

	public function withdraw_money($member_payment_id, $name, $deceased_name, $main_member_id, $amount, $balance)
	{
		global $db;
		
		$debit = $amount;
		$credit = 0;
		$date_transaction = time();
		$query 	= $this->db->prepare("INSERT INTO `member_statement` (`member_payment_id`, `name`, `deceased_name`, `member_id`, `date_transaction`, `credit`, `debit`, `balance`) VALUES (?, ?, ?, ?, ?, ?, ?, ?) ");
		
		$query->bindValue(1, $member_payment_id);
		$query->bindValue(2, $name);
		$query->bindValue(3, $deceased_name);
		$query->bindValue(4, $main_member_id);
		$query->bindValue(5, $date_transaction);
		$query->bindValue(6, $credit);
		$query->bindValue(7, $amount);
		$query->bindValue(8, $balance);

		try{
			$query->execute();

			$member_payment_id = $db->lastInsertID();
			header('Location:member_receipt.php?member_payment_id='.$member_payment_id);

		}catch(PDOException $e){
			die($e->getMessage());
		}	
	}

	public function payment_data($main_member_id) 
	{
		$query = $this->db->prepare("SELECT * FROM `member_statement` WHERE `member_id` = ?");
		$query->bindValue(1, $main_member_id);

		try{

			$query->execute();

			return $query->fetchAll();

		} catch(PDOException $e){

			die($e->getMessage());
		}

	}

	public function receipt_data($member_payment_id) 
	{
		$query = $this->db->prepare("SELECT * FROM `member_statement` WHERE `member_payment_id` = ?");
		$query->bindValue(1, $member_payment_id);

		try{

			$query->execute();

			return $query->fetchAll();

		} catch(PDOException $e){

			die($e->getMessage());
		}

	}

	public function member_deposits($main_member_id)
	{

		$query = $this->db->prepare("SELECT COUNT(`credit`) FROM `member_statement` WHERE member_id = ? AND `credit` <> 0 ");
		$query->bindValue(1, $main_member_id);
	
		try{
			
			$query->execute();
			return $query->fetchColumn();
			
			
		}catch(PDOException $e){
			die($e->getMessage());
		}

	}

	public function member_withdrawals($main_member_id)
	{

		$query = $this->db->prepare("SELECT COUNT(`credit`) FROM `member_statement` WHERE member_id = ? AND `debit` <> 0 ");
		$query->bindValue(1, $main_member_id);
	
		try{
			
			$query->execute();
			return $query->fetchColumn();
			
			
		}catch(PDOException $e){
			die($e->getMessage());
		}

	}

	public function total_premiums() 
	{

		$query = $this->db->prepare("SELECT COUNT(`member_payment_id`) FROM `member_statement` ");
	
		try{
			
			$query->execute();
			return $query->fetchColumn();
			
			
		}catch(PDOException $e){
			die($e->getMessage());
		}

	}

	public function total_spouse() 
	{
		$type = "Spouse";
		$query = $this->db->prepare("SELECT COUNT(`family_id`) FROM `family` WHERE type = ?");
		$query->bindValue(1, $type);
	
		try{
			
			$query->execute();
			return $query->fetchColumn();
			
			
		}catch(PDOException $e){
			die($e->getMessage());
		}

	}

	public function total_children() 
	{
		$type = "Child";
		$query = $this->db->prepare("SELECT COUNT(`family_id`) FROM `family` WHERE type = ?");
		$query->bindValue(1, $type);

		try{
			
			$query->execute();
			return $query->fetchColumn();
			
			
		}catch(PDOException $e){
			die($e->getMessage());
		}

	}

	public function total_extended_family() 
	{
		$type = "extended family";
		$query = $this->db->prepare("SELECT COUNT(`family_id`) FROM `family` WHERE type = ?");
		$query->bindValue(1, $type);

		try{
			
			$query->execute();
			return $query->fetchColumn();
			
			
		}catch(PDOException $e){
			die($e->getMessage());
		}

	}

	public function deleteMainMember($main_member_id) 
	{
		$query = $this->db->prepare("DELETE FROM `main_member` WHERE `main_member_id` = ?");
		$query->bindValue(1, $main_member_id);
		
		try{

			$query->execute();

		} catch(PDOException $e){

			die($e->getMessage());
		}
		
	}

	public function total_of_search_deposits($date1, $date2)
	{
		$query = $this->db->prepare("SELECT SUM(`credit`) FROM `statement` WHERE credit <> 0 AND `date_transaction` BETWEEN ? AND ?");
		$query->bindValue(1, $date1);
		$query->bindValue(2, $date2);

		try{
			$query->execute();
			
		}catch(PDOException $e){
			die($e->getMessage());
		}
		return $query->fetchColumn();

	}

	public function total_of_search_withdrawals($date1, $date2)
	{
		$query = $this->db->prepare("SELECT SUM(`debit`) FROM `statement` WHERE debit <> 0 AND `date_transaction` BETWEEN ? AND ?");
		$query->bindValue(1, $date1);
		$query->bindValue(2, $date2);

		try{
			$query->execute();
			
		}catch(PDOException $e){
			die($e->getMessage());
		}
		return $query->fetchColumn();

	}

	public function display_search_deposits($date1, $date2)
	{
		$query = $this->db->prepare("SELECT * FROM statement WHERE credit <> 0 AND `date_transaction` BETWEEN ? AND ? ORDER BY `date_transaction` DESC");
		$query->bindValue(1, $date1);
		$query->bindValue(2, $date2);

		try{
			$query->execute();

		}catch(PDOException $e){
			die($e->getMessage());
		}
		return $query->fetchAll();
	}

	public function display_search_withdrawals($date1, $date2)
	{
		$query = $this->db->prepare("SELECT * FROM statement WHERE debit <> 0 AND `date_transaction` BETWEEN ? AND ? ORDER BY `date_transaction` DESC");
		$query->bindValue(1, $date1);
		$query->bindValue(2, $date2);

		try{
			$query->execute();

		}catch(PDOException $e){
			die($e->getMessage());
		}
		return $query->fetchAll();
	}


}

?>