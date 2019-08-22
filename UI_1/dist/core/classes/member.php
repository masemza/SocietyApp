<?php 
class Member{
 	
	private $db;

	public function __construct($database) {
	    $this->db = $database;
	}

	public function register_member($society_id, $society_name, $first_name, $last_name, $gender, $contact_num, $id_number)
	{
		global $db;
		
		$query 	= $this->db->prepare("INSERT INTO `member` (`society_id`, `society_name`, `first_name`, `last_name`, `gender`, `contact_num`, `id_number` ) VALUES (?, ?, ?, ?, ?, ?, ?) ");
		
		$query->bindValue(1, $society_id);
		$query->bindValue(2, $society_name);
		$query->bindValue(3, $first_name);
		$query->bindValue(4, $last_name);
		$query->bindValue(5, $gender);
		$query->bindValue(6, $contact_num);
		$query->bindValue(7, $id_number);
		

		try{
			$query->execute();
			
		}catch(PDOException $e){
			die($e->getMessage());
		}	
	}

	public function updateMember($first_name, $last_name, $gender, $contact_num, $member_id)
	{
		$query = $this->db->prepare("UPDATE `member` SET
								`first_name`		= ?,
								`last_name`			= ?,
								`gender`			= ?,
								`contact_num`		=? 
								
								WHERE `member_id` 	= ? 
								");

		$query->bindValue(1, $first_name);
		$query->bindValue(2, $last_name);
		$query->bindValue(3, $gender);
		$query->bindValue(4, $contact_num);
		$query->bindValue(5, $member_id);

		try{
			$query->execute();
		}catch(PDOException $e){
			die($e->getMessage());
		}	
	}
	
	public function get_society_name($society_id) {

		$query = $this->db->prepare("SELECT `society_name` FROM `society` WHERE `society_id` = ? AND `society_id` = 
		(SELECT max(`society_id`) FROM `society` WHERE `society_id` = ?)");
		$query->bindValue(1, $society_id);
		$query->bindValue(2, $society_id);
	
		try{
			
			$query->execute();
			return $query->fetchColumn();
			
			
		}catch(PDOException $e){
			die($e->getMessage());
		}

	}
	
	public function member_id_exists($id_number) {
	
		$query = $this->db->prepare("SELECT COUNT(`id_number`) FROM `member` WHERE `id_number`= ?");
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

	public function member_exists($search) 
	{
		$query = $this->db->prepare("SELECT COUNT(`member_id`) FROM `member` WHERE `first_name` = ? OR `last_name` = ?");
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
	
	public function memberInformation() 
	{
		$query = $this->db->prepare("SELECT * FROM `member`");

		try{

			$query->execute();

			return $query->fetchAll();

		} catch(PDOException $e){

			die($e->getMessage());
		}
	}

	public function search_member($search, $society_id) 
	{
		$query = $this->db->prepare("SELECT * FROM `member` WHERE `society_id` = ? AND `first_name` = ? OR `last_name` = ? ");
		$query->bindValue(1, $society_id);
		$query->bindValue(2, $search);
		$query->bindValue(3, $search);

		try{

			$query->execute();

			return $query->fetchAll();

		} catch(PDOException $e){

			die($e->getMessage());
		}
	}

	public function memberdata($member_id) {

		$query = $this->db->prepare("SELECT * FROM member WHERE `member_id` = ?");
		$query->bindValue(1, $member_id);
		try{

			$query->execute();

		} catch(PDOException $e){

			die($e->getMessage());
		}
		return $query->fetchAll();
	}
	
	public function get_All_Members($society_id) {

		$query = $this->db->prepare("SELECT * FROM member WHERE `society_id` = ?");
		$query->bindValue(1, $society_id);
		try{

			$query->execute();

		} catch(PDOException $e){

			die($e->getMessage());
		}
		return $query->fetchAll();
	}
	
	public function deleteMember($member_id) {

		$query = $this->db->prepare("DELETE  FROM `member` WHERE `member_id` = ?");
		
		$query->bindValue(1, $member_id);
		
		try{

			$query->execute();

		} catch(PDOException $e){

			die($e->getMessage());
		}
		
	}



	public function searching_member($search) {

		$query = $this->db->prepare("SELECT * FROM member WHERE first_name LIKE CONCAT('%',?,'%') OR last_name LIKE CONCAT('%',?,'%')");
		$query->bindValue(1, $search);
		$query->bindValue(2, $search);
		try{

			$query->execute();

		} catch(PDOException $e){

			die($e->getMessage());
		}
		return $query->fetchAll();
	}

}

?>