<?php
require_once dirname(dirname(__FILE__)).'/includes/Cookie.class.php';
require_once dirname(dirname(__FILE__)).'/models/objects/UserObject.php';
require_once dirname(dirname(dirname(__FILE__))).'/library/Parser.class.php';
require_once dirname(dirname(dirname(__FILE__))).'/library/Pagination.class.php';

class IndexController extends Zend_Controller_Action
{

	private $user;
	private $profile;

    public function init()
    {
        Cookie::startSession();
    	
    	$this->profile = new Application_Model_Profile();
    }

    public function indexAction()
    {
    	$this->view->pagename = $pagename = "index";
    	$pagination = new Pagination($pagename);
    	
    	$max_id = $pagination->getMaxId($this->getRequest()->getParam('max_id'));
    	
    	$json = $this->profile->getProfileById(FEED_USER_ID, FEED_ACCESS_TOKEN, $max_id);
    	$data = json_decode($json, true);
    	
    	if(isset($data['pagination']['next_max_id'])){
    		$pagination->setPagination($data['pagination']['next_max_id'], $max_id);
    	}else{
    		$pagination->setPagination(null, $max_id);
    	}
    	
    	$this->view->data = $data;
       	$this->view->user = $this->userLoggedIn();
       	$this->view->parser = new Parser();
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

