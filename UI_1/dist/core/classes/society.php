<?php 
class Society
{
 	
	private $db;

    public function __construct($database) 
    {
	    $this->db = $database;
	}	
	
	public function updateSociety($society_name, $addr1, $addr2, $addr3, $addr4, $date_inception, $society_id)
	{
		$query = $this->db->prepare("UPDATE `society` SET
								`society_name`	= ?,
								`addr1`		= ?,
								`addr2`		= ?,
								`addr3`		= ?,
								`addr4`		= ?,
								`date_inception`			= ?
								
								WHERE `society_id` 		= ? 
								");

		$query->bindValue(1, $society_name);
		$query->bindValue(2, $addr1);
		$query->bindValue(3, $addr2);
		$query->bindValue(4, $addr3);
		$query->bindValue(5, $addr4);
		$query->bindValue(6, $date_inception);
		$query->bindValue(7, $society_id);

		$query1 = $this->db->prepare("UPDATE `member` SET
								`society_name`	= ?

								WHERE `society_id` 		= ? 
								");

		$query1->bindValue(1, $society_name);
		$query1->bindValue(2, $society_id);
		
		try
		{
			$query->execute();
			$query1->execute();
		}
			
		catch(PDOException $e)
		{
		die($e->getMessage());
		}

	}

    public function society_id_exists($society_id) 
    {
		$query = $this->db->prepare("SELECT COUNT(`society_id`) FROM `society` WHERE `society_id`= ?");
		$query->bindValue(1, $society_id);
	
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
	
    public function society_name_exists($society_name) 
    {
		$query = $this->db->prepare("SELECT COUNT(`society_name`) FROM `society` WHERE `society_name`= ?");
		$query->bindValue(1, $society_name);
	
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

    public function get_society_id($society_name) 
    {
		$query = $this->db->prepare("SELECT `society_id` FROM `society` WHERE `society_name` = ?");
		$query->bindValue(1, $society_name);
	
		try{
			
			$query->execute();
			return $query->fetchColumn();
			
			
		}catch(PDOException $e){
			die($e->getMessage());
		}

	}

    public function total_societies() 
    {
		$query = $this->db->prepare("SELECT COUNT(`society_id`) FROM `society` ");
	
		try{
			
			$query->execute();
			return $query->fetchColumn();
			
			
		}catch(PDOException $e){
			die($e->getMessage());
		}

	}

    public function total_members() 
    {
		$query = $this->db->prepare("SELECT COUNT(`member_id`) FROM `member` ");
	
		try{
			
			$query->execute();
			return $query->fetchColumn();
			
			
		}catch(PDOException $e){
			die($e->getMessage());
		}

	}

    public function get_society_name($society_id) 
    {
		$query = $this->db->prepare("SELECT `society_name` FROM `society` WHERE `society_id` = ?");
		$query->bindValue(1, $society_id);
	
		try{
			
			$query->execute();
			return $query->fetchColumn();
			
			
		}catch(PDOException $e){
			die($e->getMessage());
		}

	}

    public function register_society($society_id, $society_name, $addr1 , $addr2 , $addr3, $addr4, $init_capital, $date_inception)
    {
		global $db;
		
		$query 	= $this->db->prepare("INSERT INTO `society` (`society_id`, `society_name`, `addr1`, `addr2`, `addr3`, `addr4`, `init_capital`, `date_inception`) VALUES (?, ?, ?, ?, ?, ?, ?, ?) ");
		
		$query->bindValue(1, $society_id);
		$query->bindValue(2, $society_name);
		$query->bindValue(3, $addr1);
		$query->bindValue(4, $addr2);
		$query->bindValue(5, $addr3);
		$query->bindValue(6, $addr4);
		$query->bindValue(7, $init_capital);
		$query->bindValue(8, $date_inception);

		try{
			$query->execute();
			$society_id = $db->lastInsertID();
			
			header('Location:generateInitialStatement.php?society_id='.$society_id);
		
		}catch(PDOException $e){
			die($e->getMessage());
		}	
	}
    public function make_payment($name, $society_id, $society_name, $date_transaction, $credit, $debit, $balance)
    {
	global $db;
		$query 	= $this->db->prepare("INSERT INTO `statement` (`name`, `society_id`, `society_name`, `date_transaction`, `credit`, `debit`, `balance`) VALUES (?, ?, ?, ?, ?, ?, ?) ");
		
		$query->bindValue(1, $name);
		$query->bindValue(2, $society_id);
		$query->bindValue(3, $society_name);
		$query->bindValue(4, $date_transaction);
		$query->bindValue(5, $credit);
		$query->bindValue(6, $debit);
		$query->bindValue(7, $balance);

		try{
			$query->execute();

		}catch(PDOException $e){
			die($e->getMessage());
		}	
	}

	public function societydata($society_id) 
	{
		$query = $this->db->prepare("SELECT * FROM society WHERE society_id = ?");
		$query->bindValue(1, $society_id);
		try{

			$query->execute();

		} catch(PDOException $e){

			die($e->getMessage());
		}
		return $query->fetchAll();
	}

	public function societyInformation() 
	{

		$query = $this->db->prepare("SELECT * FROM society");
		try{

			$query->execute();

		} catch(PDOException $e){

			die($e->getMessage());
		}
		return $query->fetchAll();
	}

	public function society_exists($search) 
	{
		$query = $this->db->prepare("SELECT COUNT(`society_id`) FROM `society` WHERE `society_id`= ? OR `society_name` = ?");
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

	public function search_society($search) 
	{
		$query = $this->db->prepare("SELECT * FROM `society` where `society_id` = ? OR `society_name` = ?");
		$query->bindValue(1, $search);
		$query->bindValue(2, $search);

		try{

			$query->execute();

			return $query->fetchAll();

		} catch(PDOException $e){

			die($e->getMessage());
		}
	}
	 	  	 
    public function get_society() 
    {

		$query = $this->db->prepare("SELECT * FROM `society` ORDER BY `date_inception`");
		
		try{
			$query->execute();
		}catch(PDOException $e){
			die($e->getMessage());
		}

		return $query->fetchAll();

	}

    public function deleteSociety($society_id) 
    {
		$query = $this->db->prepare("DELETE FROM `society` WHERE `society_id` = ?");
		$query2 = $this->db->prepare("DELETE FROM `member` WHERE `society_id` = ?");
		$query3 = $this->db->prepare("DELETE FROM `statement` WHERE `society_id` = ?");
		
		$query->bindValue(1, $society_id);
		$query2->bindValue(1, $society_id);
		$query3->bindValue(1, $society_id);
		
		try{

			$query->execute();
			$query2->execute();
			$query3->execute();

		} catch(PDOException $e){

			die($e->getMessage());
		}
		
	}
}

?>