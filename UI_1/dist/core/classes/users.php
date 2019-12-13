<?php 
class Users{
 	
	private $db;

	public function __construct($database) {
	    $this->db = $database;
	}	
	
	public function update_user($first_name, $last_name, $gender, $bio, $image_location, $id){

		$query = $this->db->prepare("UPDATE `users` SET
								`first_name`	= ?,
								`last_name`		= ?,
								`gender`		= ?,
								`bio`			= ?,
								`image_location`= ?
								
								WHERE `id` 		= ? 
								");

		$query->bindValue(1, $first_name);
		$query->bindValue(2, $last_name);
		$query->bindValue(3, $gender);
		$query->bindValue(4, $bio);
		$query->bindValue(5, $image_location);
		$query->bindValue(6, $id);
		
		try{
			$query->execute();
		}catch(PDOException $e){
			die($e->getMessage());
		}	
	}

	public function updateUser($email, $username, $id)
	{
		$query = $this->db->prepare("UPDATE `users` SET
								`email`			= ?,
								`username`		= ?
								
								WHERE `id` 	= ? 
								");

		$query->bindValue(1, $email);
		$query->bindValue(2, $username);
		$query->bindValue(3, $id);

		try{
			$query->execute();

		}catch(PDOException $e){
			die($e->getMessage());
		}	
	}

	public function updateUser2($email, $username, $type, $id)
	{
		$query = $this->db->prepare("UPDATE `users` SET
								`email`			= ?,
								`username`		= ?,
								`type`			= ?
								
								WHERE `id` 	= ? 
								");

		$query->bindValue(1, $email);
		$query->bindValue(2, $username);
		$query->bindValue(3, $type);
		$query->bindValue(4, $id);

		try{
			$query->execute();

		}catch(PDOException $e){
			die($e->getMessage());
		}	
	}

	public function change_password($user_id, $password) {

		global $bcrypt;

		/* Two create a Hash you do */
		$password_hash = $bcrypt->genHash($password);

		$query = $this->db->prepare("UPDATE `users` SET `password` = ? WHERE `id` = ?");

		$query->bindValue(1, $password_hash);
		$query->bindValue(2, $user_id);				

		try{
			$query->execute();
			return true;
		} catch(PDOException $e){
			die($e->getMessage());
		}

	}

	public function change_email($user_id, $email) {


		$query = $this->db->prepare("UPDATE `users` SET `email` = ? WHERE `id` = ?");

		$query->bindValue(1, $email);
		$query->bindValue(2, $user_id);				

		try{
			$query->execute();
			return true;
		} catch(PDOException $e){
			die($e->getMessage());
		}

	}	
	
	public function recover($email, $generated_string) {

		if($generated_string == 0){
			return false;
		}else{
	
			$query = $this->db->prepare("SELECT COUNT(`id`) FROM `users` WHERE `email` = ? AND `generated_string` = ?");

			$query->bindValue(1, $email);
			$query->bindValue(2, $generated_string);

			try{

				$query->execute();
				$rows = $query->fetchColumn();

				if($rows == 1){
					
					global $bcrypt;

					$username = $this->fetch_info('username', 'email', $email); // getting username for the use in the email.
					$user_id  = $this->fetch_info('id', 'email', $email);// We want to keep things standard and use the user's id for most of the operations. Therefore, we use id instead of email.
			
					$charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
					$generated_password = substr(str_shuffle($charset),0, 10);

					$this->change_password($user_id, $generated_password);

					$query = $this->db->prepare("UPDATE `users` SET `generated_string` = 0 WHERE `id` = ?");

					$query->bindValue(1, $user_id);
	
					$query->execute();

					mail($email, 'Your New Tello Password', "Hello " . $username . ",\n\nYour your new password is: " . $generated_password . "\n\nPlease change your password once you have logged in using this password.\nPassword is case sensitive. \n\n--Tello Team");

				}else{
					return false;
				}

			} catch(PDOException $e){
				die($e->getMessage());
			}
		}
	}

    public function fetch_info($what, $field, $value){

		$allowed = array('id', 'username', 'first_name', 'last_name', 'gender', 'bio', 'email'); // I have only added few, but you can add more. However do not add 'password' eventhough the parameters will only be given by you and not the user, in our system.
		if (!in_array($what, $allowed, true) || !in_array($field, $allowed, true)) {
		    throw new InvalidArgumentException;
		}else{
		
			$query = $this->db->prepare("SELECT $what FROM `users` WHERE $field = ?");

			$query->bindValue(1, $value);

			try{

				$query->execute();
				
			} catch(PDOException $e){

				die($e->getMessage());
			}

			return $query->fetchColumn();
		}
	}

	public function confirm_recover($email){

		$username = $this->fetch_info('username', 'email', $email);// We want the 'id' WHERE 'email' = user's email ($email)

		$unique = uniqid('',true);
		$random = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'),0, 10);
		
		$generated_string = $unique . $random; // a random and unique string

		$query = $this->db->prepare("UPDATE `users` SET `generated_string` = ? WHERE `email` = ?");

		$query->bindValue(1, $generated_string);
		$query->bindValue(2, $email);

		try{
			
			$query->execute();
			mail($email,'Recover Your Zerah Password', "Hello " . $username. ",\r\nPlease click the link below or copy it into your browser :\r\n\r\nhttp://www.vescor.co.za/recover.php?email=" . $email . "&generated_string=" . $generated_string . "\r\n\r\n We will generate a new password for you and send it back to your email.\r\n\r\n-- Zerah team");			
			
		} catch(PDOException $e){
			die($e->getMessage());
		}
	}

	public function user_exists($email) {
	
		$query = $this->db->prepare("SELECT COUNT(`id`) FROM `users` WHERE `email`= ?");
		$query->bindValue(1, $email);
	
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

	public function user_exists_for_report($email) {
	
		$query = $this->db->prepare("SELECT COUNT(`id`) FROM `users` WHERE `type` = 'manager' AND `email`= ?");
		$query->bindValue(1, $email);
	
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

	public function username_exists($username) {
	
		$query = $this->db->prepare("SELECT COUNT(`id`) FROM `users` WHERE `username`= ?");
		$query->bindValue(1, $username);
	
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
	 
	public function email_exists($email) {

		$query = $this->db->prepare("SELECT COUNT(`id`) FROM `users` WHERE `email`= ?");
		$query->bindValue(1, $email);
	
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

	public function register($password, $email, $username){

		global $bcrypt; // making the $bcrypt variable global so we can use here

		$time 		= time();
		$ip 		= $_SERVER['REMOTE_ADDR']; // getting the users IP address
		$email_code = $email_code = uniqid('code_',true); // Creating a unique string.
		
		$password   = $bcrypt->genHash($password);
		$type = "admin";
		
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

			mail($email, 'Welcome to Tello', "Hello " . $username. ",\r\nThank you for registering with us. \r\n\r\n-- Tello Team");
		}catch(PDOException $e){
			die($e->getMessage());
		}	
	}

	public function activate($email, $email_code) {
		
		$query = $this->db->prepare("SELECT COUNT(`id`) FROM `users` WHERE `email` = ? AND `email_code` = ? AND `confirmed` = ?");

		$query->bindValue(1, $email);
		$query->bindValue(2, $email_code);
		$query->bindValue(3, 0);

		try{

			$query->execute();
			$rows = $query->fetchColumn();

			if($rows == 1){
				
				$query_2 = $this->db->prepare("UPDATE `users` SET `confirmed` = ? WHERE `email` = ?");

				$query_2->bindValue(1, 1);
				$query_2->bindValue(2, $email);				

				$query_2->execute();
				return true;

			}else{
				return false;
			}

		} catch(PDOException $e){
			die($e->getMessage());
		}

	}


	public function email_confirmed($email) {

		$query = $this->db->prepare("SELECT COUNT(`id`) FROM `users` WHERE `email`= ? AND `confirmed` = ?");
		$query->bindValue(1, $email);
		$query->bindValue(2, 1);
		
		try{
			
			$query->execute();
			$rows = $query->fetchColumn();

			if($rows == 1){
				return true;
			}else{
				return false;
			}

		} catch(PDOException $e){
			die($e->getMessage());
		}

	}

	public function login($email, $password) {

		global $bcrypt;  // Again make get the bcrypt variable, which is defined in init.php, which is included in login.php where this function is called

		$query = $this->db->prepare("SELECT `password`, `id` FROM `users` WHERE `email` = ?");
		$query->bindValue(1, $email);

		try{
			
			$query->execute();
			$data 				= $query->fetch();
			$stored_password 	= $data['password']; // stored hashed password
			$id   				= $data['id']; // id of the user to be returned if the password is verified, below.
			
			if($bcrypt->verify($password, $stored_password) === true){ // using the verify method to compare the password with the stored hashed password.
				return $id;	// returning the user's id.
			}else{
				return false;	
			}

		}catch(PDOException $e){
			die($e->getMessage());
		}
	
	}

	public function login_for_report($email, $password) {

		global $bcrypt;  // Again make get the bcrypt variable, which is defined in init.php, which is included in login.php where this function is called

		$query = $this->db->prepare("SELECT `password`, `id` FROM `users` WHERE `email` = ?");
		$query->bindValue(1, $email);

		try{
			
			$query->execute();
			$data 				= $query->fetch();
			$stored_password 	= $data['password']; // stored hashed password
			$id   				= $data['id']; // id of the user to be returned if the password is verified, below.
			
			if($bcrypt->verify($password, $stored_password) === true){ // using the verify method to compare the password with the stored hashed password.
				return $id;	// returning the user's id.
			}else{
				return false;	
			}

		}catch(PDOException $e){
			die($e->getMessage());
		}
	
	}

	public function userdata($id) {

		$query = $this->db->prepare("SELECT * FROM `users` WHERE `id`= ?");
		$query->bindValue(1, $id);

		try{

			$query->execute();

			return $query->fetch();

		} catch(PDOException $e){

			die($e->getMessage());
		}

	}
	  	  	 
	public function get_users() {

		$query = $this->db->prepare("SELECT * FROM `users` ORDER BY `username` ");
		
		try{
			$query->execute();
		}catch(PDOException $e){
			die($e->getMessage());
		}

		return $query->fetchAll();

	}	

	public function user_information($id) {

		$query = $this->db->prepare("SELECT * FROM `users` WHERE `id` = ? ");
		$query->bindValue(1, $id);
		
		try{
			$query->execute();
		}catch(PDOException $e){
			die($e->getMessage());
		}

		return $query->fetchAll();

	}

	public function deleteUser($id) {

		$query = $this->db->prepare("DELETE  FROM `users` WHERE `id` = ?");
		
		$query->bindValue(1, $id);
		
		try{

			$query->execute();

		} catch(PDOException $e){

			die($e->getMessage());
		}
		
	}

	public function get_user_id($email) 
    {
        global $db;
        $query = $this->db->prepare("SELECT `id` FROM `users` WHERE email = ?");
        $query->bindValue(1, $email);
        
        try{
            $query->execute();
        }catch(PDOException $e){
            die($e->getMessage());
        }

        return $query->fetchColumn();

    }

    public function check_if_logo_has_values($user_id) 
    {
        global $db;
        $query = $this->db->prepare("SELECT * FROM `logo` WHERE user_id = ?");
        $query->bindValue(1, $user_id);
        
        try{
            $query->execute();
        }catch(PDOException $e){
            die($e->getMessage());
        }

        return $query->fetchAll();

    } 

    public function create_logo($user_id, $file_name)
	{
		if(isset($_FILES['files']))
		{
            $errors= array();
			foreach($_FILES['files']['tmp_name'] as $key => $tmp_name )
			{
                $file_name = $key.$_FILES['files']['name'][$key];
                $file_size =$_FILES['files']['size'][$key];
                $file_tmp =$_FILES['files']['tmp_name'][$key];
                $file_type=$_FILES['files']['type'][$key];  
				if($file_size > 2097152)
				{
                    $errors[]='File size must be less than 2 MB';
                }       
                $query  = $this->db->prepare("INSERT INTO `logo` (`user_id`,`logo_img`) VALUES (?,?)");
                $query->bindValue(1, $user_id);        
                $query->bindValue(2, $file_name);
                
                try {
                    $query->execute();
                } catch (PDOException $e) {

                    die($e->getMessage());
                }
				$desired_dir="logo";
				
				if(empty($errors)==true)
				{
					if(is_dir($desired_dir)==false)
					{
                        mkdir("$desired_dir", 0700);        // Create directory if it does not exist
                    }
					if(is_dir("demo/brand/$desired_dir/".$file_name)==false)
					{
                        move_uploaded_file($file_tmp,"demo/brand/$desired_dir/".$file_name);
					}
						else
						{                                  // rename the file if another one exist
							$new_dir="demo/brand/$desired_dir/".$file_name.time();
							rename($file_tmp,$new_dir) ;               
						}
                            
				}
					else
					{
						print_r($errors);
					}
            }
            
        }
            
	}

	public function edit_logo($user_id, $file_name)
	{
		if(isset($_FILES['files']))
		{
            $errors= array();
			foreach($_FILES['files']['tmp_name'] as $key => $tmp_name )
			{
                $file_name = $key.$_FILES['files']['name'][$key];
                $file_size =$_FILES['files']['size'][$key];
                $file_tmp =$_FILES['files']['tmp_name'][$key];
                $file_type=$_FILES['files']['type'][$key];  
				if($file_size > 2097152)
				{
                    $errors[]='File size must be less than 2 MB';
                }

                $query = $this->db->prepare("UPDATE `logo` SET `logo_img` = ?  WHERE `user_id` = ?");
                $query->bindValue(1, $file_name);        
                $query->bindValue(2, $user_id);

                // $query  = $this->db->prepare("INSERT INTO `logo` (`user_id`,`logo_img`) VALUES (?,?)");
                // $query->bindValue(1, $user_id);        
                // $query->bindValue(2, $file_name);

                try {
                    $query->execute();
                } catch (PDOException $e) {

                    die($e->getMessage());
                }
				$desired_dir="logo";
				
				if(empty($errors)==true)
				{
					if(is_dir($desired_dir)==false)
					{
                        mkdir("$desired_dir", 0700);        // Create directory if it does not exist
                    }
					if(is_dir("demo/brand/$desired_dir/".$file_name)==false)
					{
                        move_uploaded_file($file_tmp,"demo/brand/$desired_dir/".$file_name);
					}
						else
						{                                  // rename the file if another one exist
							$new_dir="demo/brand/$desired_dir/".$file_name.time();
							rename($file_tmp,$new_dir) ;               
						}
                            
				}
					else
					{
						print_r($errors);
					}
            }
            
        }
            
	}



}

?>