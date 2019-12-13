<?php 
class Spouse{
 	
	private $db;

	public function __construct($database) {
	    $this->db = $database;
	}	
	
public function add_spouse($main_member_id, $first_name, $last_name, $gender, $id_number, $contact_number, $relation)
	{
		$date_inception = time(); 
		$type = "Spouse";
		$query 	= $this->db->prepare("INSERT INTO `family` (`main_member_id`, `first_name`, `last_name`, `gender`, `id_number`, `contact_number`, `relation`, `date_inception`, `type`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?) ");
		$query->bindValue(1, $main_member_id);
		$query->bindValue(2, $first_name);
		$query->bindValue(3, $last_name);
		$query->bindValue(4, $gender);
		$query->bindValue(5, $id_number);
		$query->bindValue(6, $contact_number);
		$query->bindValue(7, $relation);
		$query->bindValue(8, $date_inception);
		$query->bindValue(9, $type);

		try{
			$query->execute();
			// $main_member_id = $this->db->lastInsertId();

		}catch(PDOException $e){
			die($e->getMessage());
		}
		header('Location:children.php?main_member_id='.$main_member_id);

	}

	public function update_spouse($first_name, $last_name, $gender, $contact_number, $relation, $family_id, $main_member_id)
	{
		$query = $this->db->prepare("UPDATE `family` SET
								`first_name`		= ?,
								`last_name`			= ?,
								`gender`			= ?,
								`contact_number`	=?,
								`relation`	=?
								
								WHERE `family_id` 	= ? 
								");

		$query->bindValue(1, $first_name);
		$query->bindValue(2, $last_name);
		$query->bindValue(3, $gender);
		$query->bindValue(4, $contact_number);
		$query->bindValue(5, $relation);
		$query->bindValue(6, $family_id);

		try{
			$query->execute();
		}catch(PDOException $e){
			die($e->getMessage());
		}
		header('Location: view_spouse.php?main_member_id='.$main_member_id);
	}

	public function spouse_id_exists($id_number) 
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

	public function allSpouseInformation() 
	{
		$type = "Spouse";
		$query = $this->db->prepare("SELECT * FROM `family` WHERE type = ? ");
		$query->bindValue(1, $type);

		try{

			$query->execute();

			return $query->fetchAll();

		} catch(PDOException $e){

			die($e->getMessage());
		}
	}

	public function allSpouseInformationAbove18() 
	{
		$type = "Spouse";
		$query = $this->db->prepare("SELECT * FROM `family` WHERE type = ? ");
		$query->bindValue(1, $type);

		try{

			$query->execute();

			return $query->fetchAll();

		} catch(PDOException $e){

			die($e->getMessage());
		}
	}

	public function allSpouseInformationBelow18() 
	{
		$type = "Spouse";
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

	public function spouse_data($family_id) 
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

	public function all_spouse_data($main_member_id) 
	{
		$type = "Spouse";
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

	public function deleteSpouseMember($family_id) 
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