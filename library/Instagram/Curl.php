<?php

class Instagram_Curl{
	public $curl_client;
	public $access_token;
	public $curl_params;
	
	const USERS = 'https://api.instagram.com/v1/users';
	const RECENT_USER_MEDIA = 'https://api.instagram.com/v1/users/user_id/media/recent';
	const LIKE_MEDIA = 'https://api.instagram.com/v1/media/media-id/likes';
	const SEARCH_USER = 'https://api.instagram.com/v1/users/search';
	const FEED = 'https://api.instagram.com/v1/users/self/feed';
	
	public function __construct($access_token){
		$this->access_token = $access_token;
		$this->curl_client = new Zend_Http_Client();
		$this->curl_params = array('access_token'  => $this->access_token);
	}
	
	public function makeRequest($request_type, $resource, $params=array('id'=>DEFAULT_USER_ID, 'count'=>'30')){
		
		switch($resource){
			case "feed":
				$this->curl_client->setUri(self::FEED);
				unset($params['id']);
				$this->curl_params = array_merge($this->curl_params, $params);
				break;
			case "users":
				$this->curl_client->setUri(self::USERS);
				break;
			case "users":
				$this->curl_client->setUri(self::USERS.'/'.$params['id'].'/follows');
				unset($params['id']);
				unset($params['count']);
				break;
			case "recent_user_media":
				$this->curl_client->setUri(preg_replace('/user_id/', $params['id'], self::RECENT_USER_MEDIA));
				unset($params['id']);
				$this->curl_params = array_merge($this->curl_params, $params);
				break;
			case "like_media":
				$this->curl_client->setUri(self::LIKE_MEDIA);
				break;
			case "search_user":
				$this->curl_client->setUri(self::SEARCH_USER);
				break;
			default:
				return "resource not valid";
		}
		
		switch ($request_type){
			case "get":
				$this->curl_client->setMethod(Zend_Http_Client::GET);
				$this->curl_client->setParameterGet($this->curl_params);
				$response = $this->curl();
				break;
			case "post":
				$this->curl_client->setMethod(Zend_Http_Client::POST);
				$this->curl_client->setParameterPost($this->curl_params);
				$response = $this->curl();
				break;
			case "delete":
				$this->curl_client->setMethod(Zend_Http_Client::DELETE);
				$response = $this->curl();
				break;
			default:
				return "request_type not valid";
				exit(0);
				break;		
		}
		
		return $response;
	}
	
	private function curl(){
		try{
			$response = $this->curl_client->request();
		}
		catch(Exception $e){
			error_log('Caught exception: '.  $e->getMessage(), 0);
			return "request error";
			exit(0);
		}
		
		return $response->getBody();
	}	
}