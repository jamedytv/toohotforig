<?php
require_once dirname(dirname(__FILE__)).'/models/objects/UserObject.php';

class Cookie{
	
	public static function startSession(){
		if (session_status() == PHP_SESSION_NONE) {
    		session_start();
		}
	}
	
	public static function destroySession(){
		if (session_status() == PHP_SESSION_ACTIVE) {
	    		session_destroy();
		}
	}
	
	public static function setUserSession($user){
		//Set the user session data
		$_SESSION['id'] = $user->id;
		$_SESSION['username'] = $user->username;
		$_SESSION['profile_picture'] = $user->profile_picture;
		$_SESSION['access_token'] = $user->access_token;	
	}
	
	public static function getUserData(){
		
	}
	
	public static function userLoggedIn(){
		
		if( isset ($_SESSION['id']) &&
			isset ($_SESSION['username']) &&
			isset ($_SESSION['profile_picture']) &&
			isset ($_SESSION['access_token'])){
			
			$user = new UserObject();
			$user->id = $_SESSION['id'];
			$user->username = $_SESSION['username'];
			$user->profile_picture = $_SESSION['profile_picture'];
			$user->access_token = $_SESSION['access_token'];
			
			return $user;
		}else { 
			header('Location: '.SITE_ROOT.'/login');
			exit(0); 
		}
	}
}