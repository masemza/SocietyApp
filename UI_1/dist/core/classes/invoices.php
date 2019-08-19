<?php 
class Invoices
{ 	
	private $db;

    public function __construct($database) 
    {
	    $this->db = $database;
	}	
    
    public function create_invoice($description, $name, $amount)
    {
		global $db;
        
        $invoice_date = date("Y-m-d");
		$query 	= $this->db->prepare("INSERT INTO `invoice` (`description`, `name`, `amount`, `invoice_date`) VALUES (?, ?, ?, ?) ");
		
		$query->bindValue(1, $description);
		$query->bindValue(2, $name);
		$query->bindValue(3, $amount);
		$query->bindValue(4, $invoice_date);

		try{
            $query->execute();
            
            $invoice_id = $db->lastInsertID();		
			header('Location:invoice.php?invoice_id='.$invoice_id);
		
		}catch(PDOException $e){
			die($e->getMessage());
		}	
    }
    
	public function updateInvoice($description, $name, $amount, $invoice_id)
	{
		$query = $this->db->prepare("UPDATE `invoice` SET
								`description`	= ?,
								`name`		= ?,
								`amount`			= ?
								
								WHERE `invoice_id` 		= ? 
								");

		$query->bindValue(1, $description);
		$query->bindValue(2, $name);
		$query->bindValue(3, $amount);
		$query->bindValue(4, $invoice_id);
		
		try
		{
			$query->execute();
		}
			
		catch(PDOException $e)
		{
		die($e->getMessage());
		}

	}


    public function total_invoices() 
    {
		$query = $this->db->prepare("SELECT COUNT(`invoice_id`) FROM `invoice` ");
	
		try{
			
			$query->execute();
			return $query->fetchColumn();
			
			
		}catch(PDOException $e){
			die($e->getMessage());
		}

	}

	public function invoicedata($invoice_id) 
	{
		$query = $this->db->prepare("SELECT * FROM invoice WHERE invoice_id = ?");
        $query->bindValue(1, $invoice_id);
        
		try{

			$query->execute();

		} catch(PDOException $e){

			die($e->getMessage());
		}
		return $query->fetchAll();
	}

	public function invoiceInformation() 
	{

		$query = $this->db->prepare("SELECT * FROM invoice");
		try{

			$query->execute();

		} catch(PDOException $e){

			die($e->getMessage());
		}
		return $query->fetchAll();
	}

    public function delete_invoice($invoice_id) 
    {
		$query = $this->db->prepare("DELETE FROM `invoice` WHERE `invoice_id` = ?");
		
		$query->bindValue(1, $invoice_id);
		
		try{

			$query->execute();

		} catch(PDOException $e){

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

	public function search_invoices($date1, $date2)
	{
		$query = $this->db->prepare("SELECT SUM(`amount`) FROM `invoice` WHERE `invoice_date` BETWEEN ? AND ?");
		$query->bindValue(1, $date1);
		$query->bindValue(2, $date2);

		try{
			
			$query->execute();
			return $query->fetchColumn();
			
			
		}catch(PDOException $e){
			die($e->getMessage());
		}

	}

	public function display_invoices($date1, $date2)
	{
		$query = $this->db->prepare("SELECT * FROM `invoice` WHERE `invoice_date` BETWEEN ? AND ?  ORDER BY `invoice_date` DESC");
		$query->bindValue(1, $date1);
		$query->bindValue(2, $date2);

		try{
			
			$query->execute();
			return $query->fetchAll();
			
			
		}catch(PDOException $e){
			die($e->getMessage());
		}

	}
	

}

?>