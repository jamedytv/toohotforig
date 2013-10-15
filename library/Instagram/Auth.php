<?php 
namespace Instagram;

require_once 'Media.php';
require_once 'Users.php';
 
class Auth{
	
	private $client_id;
	private $client_secret;
	private $grant_type;
	
	public function __construct($client_id, $client_secret, $grant_type='authorization_code'){
		$this->client_id = $client_id;
		$this->client_secret = $client_secret;
		$this->grant_type = $grant_type;
	}
	
	
	public function getCode($redirect_uri){
		header('Location: https://api.instagram.com/oauth/authorize/?client_id='.$this->client_id.'&redirect_uri='.$redirect_uri.'&response_type=code');
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
			$response = $curl_client->request();
		}
		catch(Exception $e){
			error_log('Caught exception: '.  $e->getMessage(), 0);
			return "error";
			exit(0);	
		}

		$response_decoded = json_decode($response->getBody(), true);
		
		if(array_key_exists('error_type', $response_decoded)){
			return "error";
			exit(0);
		}
		else{
		//if 200 OK return user object else return false
		return $response_decoded;
		}
	}
	
	
}