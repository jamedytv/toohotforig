<?php

class Application_Model_Profile{
	private $profile;
	
	public function __construct($access_token){
		$this->profile = new Instagram_Users($access_token);
	}
	
	public function getProfileById($id){
		return $this->profile->getUserByUserId($id);
	}
	
	/**
	 * Get the list of users the default user follows.
	 */
	public function getProfiles($access_token){
		
	}
}