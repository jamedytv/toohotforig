<?php

class Application_Model_Profile{
	
	public function __construct(){	
	}
	
	public function getProfileById($id, $access_token, $max_id){
		$profile = new Instagram_Users($access_token);
		return $profile->getUserByUserId($id, $max_id);
	}
	
	public function getProfileByUsername($username, $access_token){
		$profile = new Instagram_Users($access_token);
		return $profile->getUsersByUsername($username);
	}
	
	/**
	 * Get the list of users the default user follows.
	 */
	public function getProfiles(){
		$db = new Zend_Db_Adapter_Pdo_Mysql(array(
				'host'     => 'localhost',
				'username' => 'thfigapp',
				'password' => 'RT9qQPmTGN7qNyMC',
				'dbname'   => 'THFIGDEV'
		));
		
		$sql = "SELECT profile.ig_id, profile.score, user.ig_username, user.ig_bio, user.ig_profile_picture ".
			   "FROM profile ".
			   "JOIN user ".
			   "ON profile.ig_id=user.ig_id";
		
		$profiles = $db->fetchAll($sql, 2);
		return $profiles;
	}
	
	public function getProfilesByRank(){
		
	}
}