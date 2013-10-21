<?php

class Instagram_Media extends Instagram_Curl {
	
	public function __construct($access_token){
		parent::__construct($access_token);
	}
	
	public function putLikeByMediaId($media_id){
		
	}
	
	public function removeLikeByMediaId($media_id){
		
	}
	
	public function getUserFeed(){
		return $this->makeRequest("get", "feed");
	}
	
}