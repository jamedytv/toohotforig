<?php

class Instagram_Users extends Instagram_Curl{
	
	public function __construct($access_token){
		parent::__construct($access_token);
	}
	
	public function getUserByUserId($user_id){
		return $this->makeRequest('get', 'recent_user_media', array('id' => $user_id, 'count' => '30'));
	}
	
	public function getRecentMediaByUserId($user_id){
		
	}
	
	public function getUsersByUsername($user_id){
		
	}
	
	public function getFollowedByUserId($user_id){
		return $this->makeRequest('get', 'users_followed', array('id' => $user_id));
	}
	
}