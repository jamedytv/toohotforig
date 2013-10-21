<?php

class Application_Model_Media{
	
	public function __construct(){
		
	}
	
	public function getUserFeed($access_token){
		$media = new Instagram_Media($access_token);
		return $media->getUserFeed();
	}
	
	public function getRecentMediaByUserId($id){
		
	}
	
	public function getLikedMedia($access_token){
		
	}
	
	public function setLikeByCurrentUser($media_id, $access_token){
		
	}
	
	public function removeLikeByCurrentUser($media_id, $access_token){
		
	}
}