<?php

require_once 'Media.php';
require_once 'Users.php';
require_once 'Auth.php';

class Instagram_Instagram {
	
	protected $client_id;
	protected $client_secret;
	protected $grant_type;
	protected $redirect_uri;
	protected $scope;
	
	public function __construct(){
		try {
			$config = json_decode(file_get_contents(dirname(__FILE__)."/config"));
		} catch (Exception $e) {
			error_log("Instagram library config file error.");
		}
		$this->client_id = $config->client_id;
		$this->client_secret = $config->client_secret;
		$this->grant_type = $config->grant_type;
		$this->redirect_uri = $config->redirect_uri;
		$this->scope = $config->scope;
	}
	
	
}