<?php 
class Payment
{
 	
	private $db;

	public function __construct($database) {
	    $this->db = $database;
	}

	public function make_payment($payment_id, $name, $society_id, $society_name, $amount, $balance){

		global $db;
		
		$credit = $amount;
		$debit = 0;
		$date_transaction = date("Y-m-d");
		$query 	= $this->db->prepare("INSERT INTO `statement` (`payment_id`, `name`, `society_id`, `society_name`,`date_transaction`, `credit`, `debit`, `balance`) VALUES (?, ?, ?, ?, ?, ?, ?, ?) ");
		
		$query->bindValue(1, $payment_id);
		$query->bindValue(2, $name);
		$query->bindValue(3, $society_id);
		$query->bindValue(4, $society_name);
		$query->bindValue(5, $date_transaction);
		$query->bindValue(6, $amount);
		$query->bindValue(7, $debit);
		$query->bindValue(8, $balance);

		try{
			$query->execute();

			$payment_id = $db->lastInsertID();
			header('Location:receipt.php?payment_id='.$payment_id);

		}catch(PDOException $e){
			die($e->getMessage());
		}	
	}
	
	public function withdraw_money($payment_id, $name, $deceased_name, $society_id, $society_name, $amount, $balance){

		global $db;
		
		$debit = $amount;
		$credit = 0;
		$date_transaction = date("Y-m-d");
		$query 	= $this->db->prepare("INSERT INTO `statement` (`payment_id`, `name`, `deceased_name`, `society_id`, `society_name`, `date_transaction`, `credit`, `debit`, `balance`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?) ");
		
		$query->bindValue(1, $payment_id);
		$query->bindValue(2, $name);
		$query->bindValue(3, $deceased_name);
		$query->bindValue(4, $society_id);
		$query->bindValue(5, $society_name);
		$query->bindValue(6, $date_transaction);
		$query->bindValue(7, $credit);
		$query->bindValue(8, $amount);
		$query->bindValue(9, $balance);

		try{
			$query->execute();

			$payment_id = $db->lastInsertID();
			header('Location:receipt.php?payment_id='.$payment_id);

		}catch(PDOException $e){
			die($e->getMessage());
		}	
	}

	public function update_payment($payment_id, $name, $society_name, $amount, $date_transaction){
		
		$amount = (-$withdraw);
		
		$query = $this->db->prepare("UPDATE `statement` SET
								`amount`				= ?
							
								WHERE `payment_id` 		= ? 
								");

		$query->bindValue(1, $payment_id);
		$query->bindValue(2, $name);
		$query->bindValue(3, $society_name);
		$query->bindValue(4, $amount);
		$query->bindValue(5, $date_transaction);

		try{
			$query->execute();			
		}catch(PDOException $e){
			die($e->getMessage());
		}	
	}

	public function payment_data($society_id) 
	{
		$query = $this->db->prepare("SELECT * FROM `statement` WHERE `society_id` = ?");
		$query->bindValue(1, $society_id);

		try{

			$query->execute();

			return $query->fetchAll();

		} catch(PDOException $e){

			die($e->getMessage());
		}

	}

	public function receipt_data($payment_id) 
	{
		$query = $this->db->prepare("SELECT * FROM `statement` WHERE `payment_id` = ?");
		$query->bindValue(1, $payment_id);

		try{

			$query->execute();

			return $query->fetchAll();

		} catch(PDOException $e){

			die($e->getMessage());
		}

	}
	  	  	 
	public function get_payment($date_transaction) {

		$query = $this->db->prepare("SELECT * FROM `statement` ORDER BY `date_transaction` ");
			
		try{
			$query->execute();
		}catch(PDOException $e){
			die($e->getMessage());
		}

		return $query->fetchAll();

	}

	public function total_transaction() 
	{

		$query = $this->db->prepare("SELECT COUNT(`payment_id`) FROM `statement` ");
	
		try{
			
			$query->execute();
			return $query->fetchColumn();
			
			
		}catch(PDOException $e){
			die($e->getMessage());
		}

	}

	public function total_deposit() 
	{

		$query = $this->db->prepare("SELECT COUNT(`credit`) FROM `statement` WHERE `credit` <> 0 ");
	
		try{
			
			$query->execute();
			return $query->fetchColumn();
			
			
		}catch(PDOException $e){
			die($e->getMessage());
		}

	}

	public function total_withdrawals() 
	{

		$query = $this->db->prepare("SELECT COUNT(`debit`) FROM `statement` WHERE `debit` <> 0 ");
	
		try{
			
			$query->execute();
			return $query->fetchColumn();
			
			
		}catch(PDOException $e){
			die($e->getMessage());
		}

	}

	public function society_deposit($society_id)
	{

		$query = $this->db->prepare("SELECT COUNT(`credit`) FROM `statement` WHERE society_id = ? AND `credit` <> 0 ");
		$query->bindValue(1, $society_id);
	
		try{
			
			$query->execute();
			return $query->fetchColumn();
			
			
		}catch(PDOException $e){
			die($e->getMessage());
		}

	}

	public function society_withdrawal($society_id)
	{

		$query = $this->db->prepare("SELECT COUNT(`credit`) FROM `statement` WHERE society_id = ? AND `debit` <> 0 ");
		$query->bindValue(1, $society_id);
	
		try{
			
			$query->execute();
			return $query->fetchColumn();
			
			
		}catch(PDOException $e){
			die($e->getMessage());
		}

	}

	public function society_withdrawals() 
	{

		$query = $this->db->prepare("SELECT COUNT(`debit`) FROM `statement` WHERE `debit` <> 0 ");
	
		try{
			
			$query->execute();
			return $query->fetchColumn();
			
			
		}catch(PDOException $e){
			die($e->getMessage());
		}

	}

	public function society_id_exists($society_id) {
	
		$query = $this->db->prepare("SELECT COUNT(`society_id`) FROM `statement` WHERE `society_id`= ?");
		$query->bindValue(1, $society_id);
	
		try{

			$query->execute();
			$rows = $query->fetchColumn();

			if($rows >= 1){
				return true;
			}else{
				return false;
			}

		} catch (PDOException $e){
			die($e->getMessage());
		}

	}

	public function society_name_exists($society_name) {
	
		$query = $this->db->prepare("SELECT COUNT(`society_name`) FROM `statement` WHERE `society_name`= ?");
		$query->bindValue(1, $society_name);
	
		try{

			$query->execute();
			$rows = $query->fetchColumn();

			if($rows >= 1){
				return true;
			}else{
				return false;
			}

		} catch (PDOException $e){
			die($e->getMessage());
		}

	}

	
	public function member_name_exists($name) 
	{
		$query = $this->db->prepare("SELECT COUNT(`first_name`) FROM `member` WHERE `first_name`= ?");
		$query->bindValue(1, $name);

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

	public function statement_exists($search) 
	{
		$query = $this->db->prepare("SELECT COUNT(`society_id`) FROM `statement` WHERE `society_id` = ? OR `society_name` = ?");
		$query->bindValue(1, $search);
		$query->bindValue(2, $search);

		try{

			$query->execute();
			$rows = $query->fetchColumn();

			if($rows >= 1){
				return true;
			}else{
				return false;
			}

		} catch (PDOException $e){
			die($e->getMessage());
		}

	}

	public function view_search($search) 
	{
		$query = $this->db->prepare("SELECT * FROM `statement` where `society_id` = ? OR `society_name` = ?");
		$query->bindValue(1, $search);
		$query->bindValue(2, $search);

		try{

			$query->execute();

			return $query->fetchAll();

		} catch(PDOException $e){

			die($e->getMessage());
		}
	}

	public function get_members_name($society_id) {

		$query = $this->db->prepare("SELECT `first_name` FROM member WHERE `society_id` = ?");
		$query->bindValue(1, $society_id);
		try{

			$query->execute();

		} catch(PDOException $e){

			die($e->getMessage());
		}
		return $query->fetchAll();
	}	

	
	public function get_last_balance($society_id) {

		$query = $this->db->prepare("SELECT `balance` FROM `statement` WHERE `society_id` = ? AND `payment_id` = 
		(SELECT max(`payment_id`) FROM `statement` WHERE `society_id` = ?)");
		$query->bindValue(1, $society_id);
		$query->bindValue(2, $society_id);
	
		
		try{
			
			$query->execute();
			return $query->fetchColumn();
			
			
		}catch(PDOException $e){
			die($e->getMessage());
		}

	}	

	public function get_last_transaction($society_id) {

		$query = $this->db->prepare("SELECT `date_transaction` FROM `statement` WHERE `society_id` = ? AND `payment_id` = 
		(SELECT max(`payment_id`) FROM `statement` WHERE `society_id` = ?)");
		$query->bindValue(1, $society_id);
		$query->bindValue(2, $society_id);
	
		
		try{
			
			$query->execute();
			return $query->fetchColumn();
			
			
		}catch(PDOException $e){
			die($e->getMessage());
		}

	}

	public function daily_deposits()
	{
		$today = date("Y-m-d");
		$query = $this->db->prepare("SELECT * FROM `statement` WHERE `credit` <> 0 AND `date_transaction` > DATE_SUB(NOW(), INTERVAL 1 DAY) ORDER BY `date_transaction` DESC");

		try{
			
			$query->execute();
			return $query->fetchAll();
			
			
		}catch(PDOException $e){
			die($e->getMessage());
		}

	}

	public function weekly_deposits()
	{
		// $date = new DateTime('7 days ago');
		// $date->format('Y-m-d'); 

		// $date = strtotime("-6 day");
		   // date("Y-m-d", $date);
		   
		$today = date("Y-m-d");
		$newDate = date("Y-m-d",strtotime($today."-6 day"));
		
		//`date_transaction` BETWEEN '$newDate' AND '$today'
		//OR
		//`date_transaction` > DATE_SUB(NOW(), INTERVAL 1 WEEK)	
		
		$query = $this->db->prepare("SELECT * FROM `statement` WHERE `credit` <> 0 AND `date_transaction` > DATE_SUB(NOW(), INTERVAL 1 WEEK) ORDER BY `date_transaction` DESC");

		try{
			
			$query->execute();
			return $query->fetchAll();
			
			
		}catch(PDOException $e){
			die($e->getMessage());
		}

	}

	public function monthly_deposits()
	{  
		$today = date("Y-m-d");
		$newDate = date("Y-m-d",strtotime($today."-31 day"));
		
		$query = $this->db->prepare("SELECT * FROM `statement` WHERE `credit` <> 0 AND `date_transaction` > DATE_SUB(NOW(), INTERVAL 1 MONTH) ORDER BY `date_transaction` DESC");

		try{
			
			$query->execute();
			return $query->fetchAll();
			
			
		}catch(PDOException $e){
			die($e->getMessage());
		}

	}

	public function sum_of_daily_deposits()
	{
		$today = date("Y-m-d");
		$query = $this->db->prepare("SELECT SUM(`credit`) FROM `statement` WHERE `date_transaction` > DATE_SUB(NOW(), INTERVAL 1 DAY) ");

		try{
			
			$query->execute();
			return $query->fetchColumn();
			
			
		}catch(PDOException $e){
			die($e->getMessage());
		}

	}

	public function sum_of_weekly_deposits()
	{
		$today = date("Y-m-d");
		$newDate = date("Y-m-d",strtotime($today."-6 day"));

		$query = $this->db->prepare("SELECT SUM(`credit`) FROM `statement` WHERE `date_transaction` > DATE_SUB(NOW(), INTERVAL 1 WEEK) ");

		try{
			
			$query->execute();
			return $query->fetchColumn();
			
			
		}catch(PDOException $e){
			die($e->getMessage());
		}

	}

	public function sum_of_monthly_deposits()
	{
		$today = date("Y-m-d");
		$newDate = date("Y-m-d",strtotime($today."-31 day"));

		$query = $this->db->prepare("SELECT SUM(`credit`) FROM `statement` WHERE `date_transaction` > DATE_SUB(NOW(), INTERVAL 1 MONTH) ");

		try{
			
			$query->execute();
			return $query->fetchColumn();
			
			
		}catch(PDOException $e){
			die($e->getMessage());
		}

	}

	public function daily_withdrawals()
	{
		$today = date("Y-m-d");
		$query = $this->db->prepare("SELECT * FROM `statement` WHERE `debit` <> 0 AND `date_transaction` > DATE_SUB(NOW(), INTERVAL 1 DAY) ORDER BY `date_transaction` DESC");

		try{
			
			$query->execute();
			return $query->fetchAll();
			
			
		}catch(PDOException $e){
			die($e->getMessage());
		}

	}

	public function weekly_withdrawals()
	{
		// $date = new DateTime('7 days ago');
		// $date->format('Y-m-d'); 

		// $date = strtotime("-6 day");
		   // date("Y-m-d", $date);
		   
		$today = date("Y-m-d");
		$newDate = date("Y-m-d",strtotime($today."-6 day"));
		
		//`date_transaction` BETWEEN '$newDate' AND '$today'
		//OR
		//`date_transaction` > DATE_SUB(NOW(), INTERVAL 1 WEEK)	
		
		$query = $this->db->prepare("SELECT * FROM `statement` WHERE `debit` <> 0 AND `date_transaction` > DATE_SUB(NOW(), INTERVAL 1 WEEK) ORDER BY `date_transaction` DESC");

		try{
			
			$query->execute();
			return $query->fetchAll();
			
			
		}catch(PDOException $e){
			die($e->getMessage());
		}

	}

	public function monthly_withdrawals()
	{  
		$today = date("Y-m-d");
		$newDate = date("Y-m-d",strtotime($today."-31 day"));
		
		$query = $this->db->prepare("SELECT * FROM `statement` WHERE `debit` <> 0 AND `date_transaction` > DATE_SUB(NOW(), INTERVAL 1 MONTH) ORDER BY `date_transaction` DESC");

		try{
			
			$query->execute();
			return $query->fetchAll();
			
			
		}catch(PDOException $e){
			die($e->getMessage());
		}

	}

	public function sum_of_daily_withdrawals()
	{
		$today = date("Y-m-d");
		$query = $this->db->prepare("SELECT SUM(`debit`) FROM `statement` WHERE `date_transaction` > DATE_SUB(NOW(), INTERVAL 1 DAY) ");

		try{
			
			$query->execute();
			return $query->fetchColumn();
			
			
		}catch(PDOException $e){
			die($e->getMessage());
		}

	}

	public function sum_of_weekly_withdrawals()
	{
		$today = date("Y-m-d");
		$newDate = date("Y-m-d",strtotime($today."-6 day"));

		$query = $this->db->prepare("SELECT SUM(`debit`) FROM `statement` WHERE `date_transaction` > DATE_SUB(NOW(), INTERVAL 1 WEEK) ");

		try{
			
			$query->execute();
			return $query->fetchColumn();
			
			
		}catch(PDOException $e){
			die($e->getMessage());
		}

	}

	public function sum_of_monthly_withdrawals()
	{
		$today = date("Y-m-d");
		$newDate = date("Y-m-d",strtotime($today."-31 day"));

		$query = $this->db->prepare("SELECT SUM(`debit`) FROM `statement` WHERE `date_transaction` > DATE_SUB(NOW(), INTERVAL 1 MONTH) ");

		try{
			
			$query->execute();
			return $query->fetchColumn();
			
			
		}catch(PDOException $e){
			die($e->getMessage());
		}

	}



	
	public function sum_of_daily_expense()
	{
		$today = date("Y-m-d");
		$query = $this->db->prepare("SELECT SUM(`amount`) FROM `expense` WHERE `expense_date` > DATE_SUB(NOW(), INTERVAL 1 DAY) ");

		try{
			
			$query->execute();
			return $query->fetchColumn();
			
			
		}catch(PDOException $e){
			die($e->getMessage());
		}

	}

	public function sum_of_weekly_expense()
	{

		// $today = date("Y-m-d");
		// $newDate = date("Y-m-d",strtotime($today."-6 day"));

		$query = $this->db->prepare("SELECT SUM(`amount`) FROM `expense` ");

		try{
			
			$query->execute();
			return $query->fetchColumn();
			
			
		}catch(PDOException $e){
			die($e->getMessage());
		}

	}

	public function sum_of_monthly_expense()
	{
		$query = $this->db->prepare("SELECT SUM(`amount`) FROM `expense` WHERE `expense_date` > DATE_SUB(NOW(), INTERVAL 1 MONTH) ");

		try{
			
			$query->execute();
			return $query->fetchColumn();
			
			
		}catch(PDOException $e){
			die($e->getMessage());
		}

	}

	public function daily_invoices()
	{
		$query = $this->db->prepare("SELECT * FROM `invoice` WHERE `invoice_date` > DATE_SUB(NOW(), INTERVAL 1 DAY) ORDER BY `invoice_date` DESC");

		try{
			
			$query->execute();
			return $query->fetchAll();
			
			
		}catch(PDOException $e){
			die($e->getMessage());
		}

	}

	public function sum_of_daily_invoices()
	{
		$query = $this->db->prepare("SELECT SUM(`amount`) FROM `invoice` WHERE `invoice_date` > DATE_SUB(NOW(), INTERVAL 1 DAY) ");

		try{
			
			$query->execute();
			return $query->fetchColumn();
			
			
		}catch(PDOException $e){
			die($e->getMessage());
		}

	}

	public function weekly_invoices()
	{	
		$query = $this->db->prepare("SELECT * FROM `invoice` WHERE `invoice_date` > DATE_SUB(NOW(), INTERVAL 1 WEEK) ORDER BY `invoice_date` DESC");

		try{
			
			$query->execute();
			return $query->fetchAll();
			
			
		}catch(PDOException $e){
			die($e->getMessage());
		}

	}

	public function sum_of_weekly_invoices()
	{
		$query = $this->db->prepare("SELECT SUM(`amount`) FROM `invoice` WHERE `invoice_date` > DATE_SUB(NOW(), INTERVAL 1 WEEK) ");

		try{
			
			$query->execute();
			return $query->fetchColumn();
			
			
		}catch(PDOException $e){
			die($e->getMessage());
		}

	}

	public function monthly_invoices()
	{	
		$query = $this->db->prepare("SELECT * FROM `invoice` WHERE `invoice_date` > DATE_SUB(NOW(), INTERVAL 1 MONTH) ORDER BY `invoice_date` DESC");

		try{
			
			$query->execute();
			return $query->fetchAll();
			
			
		}catch(PDOException $e){
			die($e->getMessage());
		}

	}

	public function sum_of_monthly_invoices()
	{
		$query = $this->db->prepare("SELECT SUM(`amount`) FROM `invoice` WHERE `invoice_date` > DATE_SUB(NOW(), INTERVAL 1 MONTH) ");

		try{
			
			$query->execute();
			return $query->fetchColumn();
			
			
		}catch(PDOException $e){
			die($e->getMessage());
		}

	}

	public function search_deposits($date1, $date2)
	{
		$query = $this->db->prepare("SELECT SUM(`credit`) FROM `statement` WHERE `date_transaction` BETWEEN ? AND ?");
		$query->bindValue(1, $date1);
		$query->bindValue(2, $date2);

		try{
			
			$query->execute();
			return $query->fetchColumn();
			
			
		}catch(PDOException $e){
			die($e->getMessage());
		}

	}

	public function display_deposits($date1, $date2)
	{
		$query = $this->db->prepare("SELECT * FROM `statement` WHERE `credit` <> 0 AND`date_transaction` BETWEEN ? AND ?  ORDER BY `date_transaction` DESC");
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