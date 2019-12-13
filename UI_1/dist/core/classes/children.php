<?php 
class children{
 	
	private $db;

	public function __construct($database) {
	    $this->db = $database;
	}	

	public function add_children($main_member_id, $first_name, $last_name, $gender, $id_number, $contact_number)
	{
		$date_inception = time(); 
		$type = "Child";
		$query 	= $this->db->prepare("INSERT INTO `family` (`main_member_id`, `first_name`, `last_name`, `gender`, `id_number`, `contact_number`, `date_inception`, `type`) VALUES (?, ?, ?, ?, ?, ?, ?, ?) ");
		$query->bindValue(1, $main_member_id);
		$query->bindValue(2, $first_name);
		$query->bindValue(3, $last_name);
		$query->bindValue(4, $gender);
		$query->bindValue(5, $id_number);
		$query->bindValue(6, $contact_number);
		$query->bindValue(7, $date_inception);
		$query->bindValue(8, $type);

		try{
			$query->execute();
			// $main_member_id = $this->db->lastInsertId();

		}catch(PDOException $e){
			die($e->getMessage());
		}
		header('Location:children.php?main_member_id='.$main_member_id);

	}
	
	public function update_children($first_name, $last_name, $gender, $contact_number, $family_id, $main_member_id)
	{
		$query = $this->db->prepare("UPDATE `family` SET
								`first_name`		= ?,
								`last_name`			= ?,
								`gender`			= ?,
								`contact_number`	= ?
								
								WHERE `family_id` 	= ? 
								");

		$query->bindValue(1, $first_name);
		$query->bindValue(2, $last_name);
		$query->bindValue(3, $gender);
		$query->bindValue(4, $contact_number);
		$query->bindValue(5, $family_id);
		
		try{
			$query->execute();
		}catch(PDOException $e){
			die($e->getMessage());
		}	
		header('Location: view_children.php?main_member_id='.$main_member_id);
	}

	public function children_id_exists($id_number) 
	{
		$query = $this->db->prepare("SELECT COUNT(`id_number`) FROM `family` WHERE `id_number`= ?");
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

	public function allChildrenInformation() 
	{
		$type = "Child";
		$deceased = "No";
		$query = $this->db->prepare("SELECT * FROM `family` WHERE type = ? AND deceased = ? ");
		$query->bindValue(1, $type);
		$query->bindValue(2, $deceased);

		try{

			$query->execute();

			return $query->fetchAll();

		} catch(PDOException $e){

			die($e->getMessage());
		}
	}

	public function children_data($family_id) 
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

	public function all_children_data($main_member_id) 
	{
		$type = "Child";
		$deceased = "No";
		$query = $this->db->prepare("SELECT * FROM family WHERE `main_member_id` = ? AND type = ? AND deceased = ? ORDER BY date_inception DESC");
		$query->bindValue(1, $main_member_id);
		$query->bindValue(2, $type);
		$query->bindValue(3, $deceased);

		try{

			$query->execute();

		} catch(PDOException $e){

			die($e->getMessage());
		}
		return $query->fetchAll();
	}

	public function delete_child_details($family_id) 
	{
		$query = $this->db->prepare("DELETE FROM `family` WHERE `family_id` = ?");
		$query->bindValue(1, $family_id);
		
		try{

			$query->execute();

		} catch(PDOException $e){

			die($e->getMessage());
		}
		
	}
	




}

?>