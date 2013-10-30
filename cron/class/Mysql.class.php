<?php

class Mysql {
	/**
	 * The mysql username;
	 * @var string
	 */
	private $username;
	
	/**
	 * The mysql password;
	 * @var string
	 */
	private $password;
	
	/**
	 * The mysql host;
	 * @var string
	 */
	private $host;
	
	/**
	 * The application database;
	 * @var string
	 */
	private $database;
	
	/**
	 * The mysql connection;
	 * @var string
	 */
	private $con;
	
	public function __construct(){
		$this->username = "profile_push";
		$this->password = "aBLwhe8WQ8DXr3fE";
		$this->database = "THFIGDEV";
		$this->host = "localhost";
		
		// Create connection
		$this->con = mysqli_connect($this->host, $this->username, $this->password, $this->database);
		
		// Check connection
		if (mysqli_connect_errno($this->con))
		{
			print "Failed to connect to MySQL: " . mysqli_connect_error();
		}
	}
	
	/**
	 * Update the user table only if the record does not already exist.
	 */
	public function updateUserData($profile){
		$query = "INSERT INTO user (ig_id, ig_username, ig_bio, ig_profile_picture, has_profile)".
				 "VALUES (".$profile['id'].", '".$profile['username']."', '".$profile['bio']."', '".$profile['profile_picture']."', '1')".
				 "ON DUPLICATE KEY UPDATE ig_username = '".$profile['username']."', ig_bio = '".$profile['bio']."', ig_profile_picture = '".$profile['profile_picture']."'";
		
		mysqli_query($this->con, $query);
	}
	
	public function updateProfileData($profile){
		$profile_data_exists_query = "SELECT 'is_active'".
									 "FROM profile".
									 "WHERE 'ig_id' = ".$profile['id'];
		
		$profile_data_insert_query = "INSERT INTO profile (ig_id)".
				"VALUES (".$profile['id'].")";
		
		$result = mysqli_query($this->con, $profile_data_exists_query);
		if(mysql_num_rows($result)<1){
			mysqli_query($this->con, $profile_data_insert_query);
		}
	}
	
	public function closeConnection(){
		mysqli_close($this->con);
	}
	
	
}