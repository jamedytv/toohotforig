<?php 

class Instagram_Auth extends Instagram_Instagram{
	
	public function __construct(){
		parent::__construct();
	}
	
	public function getCode(){
		header('Location: https://api.instagram.com/oauth/authorize/?client_id='.$this->client_id.
				'&redirect_uri='.$this->redirect_uri.
				'&response_type=code'.
				'&scope='.implode("+", $this->scope));
		exit(0);
	}
	
	public function getAccessToken($code){
		$curl_client = new Zend_Http_Client('https://api.instagram.com/oauth/access_token', array(
				'maxredirects' => 0,
				'timeout' => 30,
		));
		
		$curl_client->setMethod(Zend_Http_Client::POST);
		
		$curl_client->setParameterPost(array(
				'client_id'     => $this->client_id,
				'client_secret' => $this->client_secret,
				'grant_type'    => $this->grant_type,
				'redirect_uri'  => $this->redirect_uri,
				'code'          => $code
		));
		try{
			$response = $curl_client->request()->getBody();
			
			//if 200 OK return user object else return false
			return $response;
		}
		catch(Exception $e){
			error_log('Caught exception: '.  $e->getMessage(), 0);
			return json_encode(array('error_type' => 'application'));	
		}
	}
}