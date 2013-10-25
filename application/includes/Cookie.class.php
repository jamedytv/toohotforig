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
	
	public static function setUserCookie($user){
		$time = time()+60*60*24*120;
		$path = '/';
		$security = 0;
		$host = 'www.toohotforig.com';
		
		setcookie('id', $user->id, $time, $path, $host, $security);
		setcookie('username', $user->username, $time, $path, $host, $security);
		setcookie('profile_picture', $user->profile_picture, $time, $path, $host, $security);
		setcookie('access_token', $user->access_token, $time, $path, $host, $security);
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
		}
		/* elseif(	isset ($_COOKIE['id']) &&
				isset ($_COOKIE['username']) &&
				isset ($_COOKIE['profile_picture']) &&
				isset ($_COOKIE['access_token'])){
			
			$user = new UserObject();
			$user->id = $_COOKIE['id'];
			$user->username = $_COOKIE['username'];
			$user->profile_picture = $_COOKIE['profile_picture'];
			$user->access_token = $_COOKIE['access_token'];
				
			return $user;
		} */
		else { 
			 header('Location: '.SITE_ROOT.'/login');
			 exit(0); 
		}
	}
}