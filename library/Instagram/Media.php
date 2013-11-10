<?php

class Instagram_Media extends Instagram_Curl {
	
	public function __construct($access_token){
		parent::__construct($access_token);
	}
	
	public function putLikeByMediaId($media_id){
		
	}
	
	public function removeLikeByMediaId($media_id){
		
	}
	
	public function getUserFeed($max_id){
		return $this->makeRequest("get", "feed", array('id'=>DEFAULT_USER_ID, 
													   'count'=>'50', 
													   'max_id'=>$max_id, 
													   'username' => null));
	}
	
}