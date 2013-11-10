<?php

class Instagram_Users extends Instagram_Curl{
	
	public function __construct($access_token){
		parent::__construct($access_token);
	}
	
	public function getUserByUserId($user_id, $max_id){
		return $this->makeRequest('get', 'recent_user_media', array('id' => $user_id, 
																	'count' => '50', 
																	'max_id' => $max_id,
																	'username' => null));
	}
	
	public function getRecentMediaByUserId($user_id, $max_id){
		return $this->makeRequest('get', 'users', array('id' => $user_id, 
														'count' => '50', 
														'max_id' => $max_id,
														'username' => null));
	}
	
	public function getUsersByUsername($username){
		return $this->makeRequest('get', 'users', array('q' => $username,
														'max_id' => null,	
														'count'=>'5',
														'username' => null));
	}
	
	public function getFollowedByUserId($user_id){
		return $this->makeRequest('get', 'users_followed', array('id' => $user_id));
	}
	
}