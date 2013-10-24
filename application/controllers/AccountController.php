<?php
require_once dirname(dirname(__FILE__)).'/models/objects/UserObject.php';
require_once dirname(dirname(__FILE__)).'/includes/Cookie.class.php';

class AccountController extends Zend_Controller_Action
{

    private $account = null;

    private $user = null;

    public function init()
    {
        $this->account = new Application_Model_Account();
 
    }

    public function indexAction()
    {
    	Cookie::startSession();
    	$this->user = Cookie::userLoggedIn();
    }

    public function createAction()
    {
        Cookie::startSession();
    	$this->user = Cookie::userLoggedIn();
    }

    public function removeAction()
    {
    	Cookie::startSession();
    	$this->user = Cookie::userLoggedIn();
    }
    
    public function logoutAction()
    {
    	Cookie::destroySession();
    	$this->redirect('http://www.instagram.com/accounts/logout/');
    	exit(0);
    }

    public function loginAction()
    {
        $this->account->login();
    }

    public function authenticateAction()
    {
        //Check for and handle error from code request.
         
        $error = $this->_request->getQuery('error');
        $error_reason = $this->_request->getQuery('error_reason');
        $error_description = $this->_request->getQuery('error_description');
        $code = $this->_request->getQuery('code');
         
        if(empty($error) && empty($error_reason) && empty($error_description) && !empty($code)){
        	
        	$json =  $this->account->authenticate($code);
        	
        	$user_data = json_decode($json, true);
        
        	if(array_key_exists('error_type', $user_data)){
        		$this->redirect('http://www.toohotforig.com/login/error');
        		exit(0);
        	}else{
        		//store user credentials in database
   
        		$user = new UserObject();
        		$user->id = $user_data['user']['id'];
        		$user->username = $user_data['user']['username'];
        		$user->profile_picture = $user_data['user']['profile_picture'];
        		$user->access_token = $user_data['access_token'];
        		
        		Cookie::startSession();
        		Cookie::setUserSession($user);
        		
        		$this->redirect('http://www.toohotforig.com');
        		exit(0);
        	}
        }else{
        	//If user has blocked the application fail gracefully.
        	//Maybe a blocked application page.
        	$this->redirect('http://www.toohotforig.com/login/error');
        
    	}
    }
}
