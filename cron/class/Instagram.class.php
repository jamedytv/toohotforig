<?php

class Instagram{
	/**
	 * Instagram access token;
	 * @var string
	 */
	private $access_token;
	
	/**
	 * The instagram user_id;
	 * @var string
	 */
	private $user_id;
	
	/**
	 * The endpoint uri for the request
	 * @var string
	 */
	private $uri;
	
	public function __construct(){
		$this->access_token = "633656976.872dd39.be0e57e65502423598441395ed4ad121";
		$this->user_id = "633656976";
	}
	
	public function setUri($cursor = ""){
		if($cursor == ""){
			$this->uri = "https://api.instagram.com/v1/users/".$this->user_id."/follows?access_token=".$this->access_token;	
		}else{
			$this->uri = "https://api.instagram.com/v1/users/".$this->user_id."/follows?access_token=".$this->access_token."&cursor=".$cursor;
		}
	}
	
	public function getInstagramUserJson(){
		//Get instagram profile data.
		$ch = curl_init($this->uri);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		try {
			$json = curl_exec($ch);
		} catch (Exception $e) {
			print("curl didn't work");
		}
		
		return $json;
	}
}