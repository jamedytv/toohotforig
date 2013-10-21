<?php

class Application_Model_Account{
	public $auth;

	public function __construct(){
		$this->auth = new Instagram_Auth();
	}
	
	public function updateAccount($user_id){
		
	}
	
	public function removeAccount($user_id){
		
	}
	
	public function createAccount(){
		
	}
	
	public function accountExists(){
		return $bool;
	}
	
	public function authenticate($code){
		$json = $this->auth->getAccessToken($code);
		return $json;
	}
	
	public function login(){
		$this->auth->getCode();
	}
}