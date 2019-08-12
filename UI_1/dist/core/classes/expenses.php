<?php 
class Expenses
{
 	
	private $db;

	public function __construct($database) {
	    $this->db = $database;
	}

	public function create_expense($description, $name, $categories , $amount)
    {
		global $db;
        
        $expense_date = date('Y-m-d');
		$query 	= $this->db->prepare("INSERT INTO `expense` (`description`, `name`, `categories` , `amount`, `expense_date`) VALUES (?, ?, ?, ? , ?) ");
		
		$query->bindValue(1, $description);
		$query->bindValue(2, $name);
		$query->bindValue(3, $categories);
		$query->bindValue(4, $amount);
		$query->bindValue(5, $expense_date);

		try{
            $query->execute();
            
           // $expenses_id = $db->lastInsertID();		
			//header('Location:expense.php?expenses_id='.$expenses_id);
		
		}catch(PDOException $e){
			die($e->getMessage());
		}	
    }
    
	public function updateExpense($description, $name, $categories , $amount, $expenses_id)
	{
		$query = $this->db->prepare("UPDATE `expense` SET
								`description`	= ?,
								`name`		= ?,
								`categories`	=?,
								`amount`			= ?
								
								WHERE `expenses_id` 		= ? 
								");

		$query->bindValue(1, $description);
		$query->bindValue(2, $name);
		$query->bindValue(3, $categories);
		$query->bindValue(4, $amount);
		$query->bindValue(5, $expenses_id);
		
		try
		{
			$query->execute();
		}
			
		catch(PDOException $e)
		{
		die($e->getMessage());
		}

	}


    public function total_expenses() 
    {
		$query = $this->db->prepare("SELECT COUNT(`expenses_id`) FROM `expense` ");
	
		try{
			
			$query->execute();
			return $query->fetchColumn();
			
			
		}catch(PDOException $e){
			die($e->getMessage());
		}

	}

	public function expensedata($expenses_id) 
	{
		$query = $this->db->prepare("SELECT * FROM expense WHERE expenses_id = ?");
        $query->bindValue(1, $expenses_id);
        
		try{

			$query->execute();

		} catch(PDOException $e){

			die($e->getMessage());
		}
		return $query->fetchAll();
	}

	public function daily_expense() 
	{

		$query = $this->db->prepare("SELECT * FROM expense WHERE `expense_date` > DATE_SUB(NOW(), INTERVAL 1 DAY) ORDER BY `expense_date` DESC");
		try{

			$query->execute();

		} catch(PDOException $e){

			die($e->getMessage());
		}
		return $query->fetchAll();
	}

	public function weekly_expense() 
	{
		$query = $this->db->prepare("SELECT * FROM expense WHERE `expense_date` > DATE_SUB(NOW(), INTERVAL 1 WEEK) ORDER BY `expense_date` DESC");
		try{

			$query->execute();

		} catch(PDOException $e){

			die($e->getMessage());
		}
		return $query->fetchAll();
	}

	public function monthly_expense() 
	{

		$query = $this->db->prepare("SELECT * FROM expense WHERE `expense_date` > DATE_SUB(NOW(), INTERVAL 1 MONTH) ORDER BY `expense_date` DESC ");
		try{

			$query->execute();

		} catch(PDOException $e){

			die($e->getMessage());
		}
		return $query->fetchAll();
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

    public function delete_expense($expenses_id) 
    {
		$query = $this->db->prepare("DELETE FROM `expense` WHERE `expenses_id` = ?");
		
		$query->bindValue(1, $expenses_id);
		
		try{

			$query->execute();

		} catch(PDOException $e){

			die($e->getMessage());
		}
		
	}

	public function search_daily_category($category) 
	{
		$query = $this->db->prepare("SELECT * FROM `expense` where `categories` = ? AND `expense_date` > DATE_SUB(NOW(), INTERVAL 1 DAY) ORDER BY `expense_date` DESC");
		$query->bindValue(1, $category);

		try{

			$query->execute();

			return $query->fetchAll();

		} catch(PDOException $e){

			die($e->getMessage());
		}
	}

	public function sum_of_daily_category($category)
	{

		// $today = date("Y-m-d");
		// $newDate = date("Y-m-d",strtotime($today."-6 day"));

		$query = $this->db->prepare("SELECT SUM(`amount`) FROM `expense` WHERE `categories` = ? AND `expense_date` > DATE_SUB(NOW(), INTERVAL 1 DAY) ORDER BY `expense_date` DESC");
		$query->bindValue(1, $category);

		try{
			
			$query->execute();
			return $query->fetchColumn();
			
			
		}catch(PDOException $e){
			die($e->getMessage());
		}

	}

	public function search_weekkly_category($category) 
	{
		$query = $this->db->prepare("SELECT * FROM `expense` where `categories` = ? AND `expense_date` > DATE_SUB(NOW(), INTERVAL 1 WEEK) ORDER BY `expense_date` DESC");
		$query->bindValue(1, $category);

		try{

			$query->execute();

			return $query->fetchAll();

		} catch(PDOException $e){

			die($e->getMessage());
		}
	}

	public function sum_of_weekly_category($category)
	{

		// $today = date("Y-m-d");
		// $newDate = date("Y-m-d",strtotime($today."-6 day"));

		$query = $this->db->prepare("SELECT SUM(`amount`) FROM `expense` WHERE `categories` = ? AND `expense_date` > DATE_SUB(NOW(), INTERVAL 1 WEEK) ORDER BY `expense_date` DESC");
		$query->bindValue(1, $category);

		try{
			
			$query->execute();
			return $query->fetchColumn();
			
			
		}catch(PDOException $e){
			die($e->getMessage());
		}

	}

	public function search_monthly_category($category) 
	{
		$query = $this->db->prepare("SELECT * FROM `expense` where `categories` = ? AND `expense_date` > DATE_SUB(NOW(), INTERVAL 1 MONTH) ORDER BY `expense_date` DESC");
		$query->bindValue(1, $category);

		try{

			$query->execute();

			return $query->fetchAll();

		} catch(PDOException $e){

			die($e->getMessage());
		}
	}

	public function sum_of_monthly_category($category)
	{

		// $today = date("Y-m-d");
		// $newDate = date("Y-m-d",strtotime($today."-6 day"));

		$query = $this->db->prepare("SELECT SUM(`amount`) FROM `expense` WHERE `categories` = ? AND `expense_date` > DATE_SUB(NOW(), INTERVAL 1 MONTH) ORDER BY `expense_date` DESC");
		$query->bindValue(1, $category);

		try{
			
			$query->execute();
			return $query->fetchColumn();
			
			
		}catch(PDOException $e){
			die($e->getMessage());
		}

	}


}