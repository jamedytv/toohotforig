<?php
require_once dirname(dirname(__FILE__)).'/includes/Cookie.class.php';
require_once dirname(dirname(__FILE__)).'/models/objects/UserObject.php';

class IndexController extends Zend_Controller_Action
{

	private $user;
	private $media;

    public function init()
    {
        Cookie::startSession();
    	$this->media = new Application_Model_Media();
    }

    public function indexAction()
    {
       $json = $this->media->getUserFeed(DEFAULT_ACCESS_TOKEN);
       $data = json_decode($json, true);
       $this->view->data = $data;
       $this->view->user = $this->userLoggedIn();
    }
    
    //A hack to provide user data to index page without forcing login   
    public function userLoggedIn(){
    
    	$user = new UserObject();
    	
    	if( isset ($_SESSION['id']) &&
    		isset ($_SESSION['username']) &&
    		isset ($_SESSION['profile_picture']) &&
    		isset ($_SESSION['access_token'])){
    			
    		$user->id = $_SESSION['id'];
    		$user->username = $_SESSION['username'];
    		$user->profile_picture = $_SESSION['profile_picture'];
    		$user->access_token = $_SESSION['access_token'];
    	}
    		
    	return $user;
    }


}

