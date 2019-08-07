<?php 
class Package{
 	
	private $db;

	public function __construct($database) {
	    $this->db = $database;
	}	
    
    public function create_package($society_id, $flower, $coffin, $grave_marker, $transport, $funeral_service)
    {
		global $db;
        
        $package_created = date("Y-m-d");
		$total = $flower + $coffin + $grave_marker + $transport + $funeral_service;
		$programmes = "No Amount";

		$query 	= $this->db->prepare("INSERT INTO `package` (`society_id`, `flower`, `coffin`, `grave_marker`, `transport`, `funeral_service`, `programmes`, `total`, `package_created`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?) ");

        $query->bindValue(1, $society_id);
		$query->bindValue(2, $flower);
		$query->bindValue(3, $coffin);
		$query->bindValue(4, $grave_marker);
		$query->bindValue(5, $transport);
        $query->bindValue(6, $funeral_service);
        $query->bindValue(7, $programmes);
        $query->bindValue(8, $total);
        $query->bindValue(9, $package_created);

		try{
            $query->execute();

            header('Location:addMember.php?society_id='.$society_id);
		
		}catch(PDOException $e){
			die($e->getMessage());
		}	
	}
	
	public function insert_package($society_id, $flower, $coffin, $grave_marker, $transport, $funeral_service)
    {
		global $db;
        
        $package_created = date("Y-m-d");
		$total = $flower + $coffin + $grave_marker + $transport + $funeral_service;
		$programmes = "No Amount";

		$query 	= $this->db->prepare("INSERT INTO `package` (`society_id`, `flower`, `coffin`, `grave_marker`, `transport`, `funeral_service`, `programmes`, `total`, `package_created`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?) ");

        $query->bindValue(1, $society_id);
		$query->bindValue(2, $flower);
		$query->bindValue(3, $coffin);
		$query->bindValue(4, $grave_marker);
		$query->bindValue(5, $transport);
        $query->bindValue(6, $funeral_service);
        $query->bindValue(7, $programmes);
        $query->bindValue(8, $total);
        $query->bindValue(9, $package_created);

		try{
			$query->execute();
			
			$package_id = $db->lastInsertID();
            header('Location:package.php?package_id='.$package_id);
		
		}catch(PDOException $e){
			die($e->getMessage());
		}	
    }
    
    public function update_package($flower, $coffin, $grave_marker, $transport, $funeral_service, $package_id)
	{
		$total = $flower + $coffin + $grave_marker + $transport + $funeral_service;
		$date_of_updated_package = date("Y-m-d");

		$query = $this->db->prepare("UPDATE `package` SET
								`flower`	        = ?,
								`coffin`		    = ?,
								`grave_marker`	    = ?,
                                `transport`	        = ?,
								`funeral_service`	= ?,
                                `total`             =?
								
								WHERE `package_id` 	= ? 
                                ");

        $query->bindValue(1, $flower);
        $query->bindValue(2, $coffin);
        $query->bindValue(3, $grave_marker);
        $query->bindValue(4, $transport);
        $query->bindValue(5, $funeral_service);
        $query->bindValue(6, $total);
		$query->bindValue(7, $package_id);
		
		$query1 = $this->db->prepare("INSERT INTO `updated_package` (`package_id`, `total`, `date_of_updated_package`) VALUES (?, ?, ?) ");
        $query1->bindValue(1, $package_id);
		$query1->bindValue(2, $total);
		$query1->bindValue(3, $date_of_updated_package);
		
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
    
    public function package_data($package_id) 
    {
		$query = $this->db->prepare("SELECT * FROM package WHERE package_id = ?");
		$query->bindValue(1, $package_id);
		try{

			$query->execute();

		} catch(PDOException $e){

			die($e->getMessage());
		}
		return $query->fetchAll();
	}

	public function packageData($society_id)
    {
		$query = $this->db->prepare("SELECT * FROM package WHERE society_id = ? ORDER BY package_id desc");
		$query->bindValue(1, $society_id);
		try{

			$query->execute();

		} catch(PDOException $e){

			die($e->getMessage());
		}
		return $query->fetchAll();
	}

	public function updatedPackageData($package_id)
    {
		$query = $this->db->prepare("SELECT * FROM updated_package WHERE package_id = ?");
		$query->bindValue(1, $package_id);
		try{

			$query->execute();

		} catch(PDOException $e){

			die($e->getMessage());
		}
		return $query->fetchAll();
	}
    
    public function packageInformation() 
    {
		$query = $this->db->prepare("SELECT * FROM package ");
		try{

			$query->execute();

		} catch(PDOException $e){

			die($e->getMessage());
		}
		return $query->fetchAll();
    }

    public function get_society_name($society_id) {

		$query = $this->db->prepare("SELECT society_name FROM `society` WHERE `society_id` = ?");
		$query->bindValue(1, $society_id);
	
		try{
			
			$query->execute();
			return $query->fetchColumn();
			
			
		}catch(PDOException $e){
			die($e->getMessage());
		}

	}

	public function get_society_id($package_id) {

		$query = $this->db->prepare("SELECT society_id FROM `package` WHERE `package_id` = ?");
		$query->bindValue(1, $package_id);
	
		try{
			
			$query->execute();
			return $query->fetchColumn();
			
			
		}catch(PDOException $e){
			die($e->getMessage());
		}

	}

	public function society_exists($society_id) {
	
		$query = $this->db->prepare("SELECT COUNT(`society_id`) FROM `package` WHERE `society_id`= ?");
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

	public function delete_package($package_id) 
    {
		$query = $this->db->prepare("DELETE FROM `package` WHERE `package_id` = ?");
		
		$query->bindValue(1, $package_id);
		
		try{

			$query->execute();

		} catch(PDOException $e){

			die($e->getMessage());
		}
		
	}

	public function get_updated_date($package_id) 
	{
		$query = $this->db->prepare("SELECT `date_of_updated_package` FROM `updated_package` WHERE `package_id` = ? AND `updated_package_id` = 
		(SELECT max(`updated_package_id`) FROM `updated_package` WHERE `package_id` = ?)");
		$query->bindValue(1, $package_id);
		$query->bindValue(2, $package_id);
	
		
		try{
			
			$query->execute();
			return $query->fetchColumn();
			
			
		}catch(PDOException $e){
			die($e->getMessage());
		}

	}

}

?>