<?php
require_once dirname(dirname(__FILE__)).'/includes/Cookie.class.php';
require_once dirname(dirname(dirname(__FILE__))).'/library/Pagination.class.php';
require_once dirname(dirname(dirname(__FILE__))).'/library/Parser.class.php';

class ProfileController extends Zend_Controller_Action
{

	private $user;
	private $profile;
	
    public function init()
    {
        Cookie::startSession();
    	$this->user = Cookie::userLoggedIn();
    	
    	$this->profile = new Application_Model_Profile();
    	
    	
    }

    public function indexAction()
    {
        // action body
    }

    public function viewAction()
    {
       $this->view->pagename = $pagename = "profile";
       $pagination = new Pagination($pagename);
       
       $max_id = $pagination->getMaxId($this->getRequest()->getParam('max_id'));
       
       $id = $this->getRequest()->getParam('id');
       	
       $json = $this->profile->getProfileById($id, $this->user->access_token, $max_id);
       $data = json_decode($json, true);

       if(isset($data['pagination']['next_max_id'])){
       	$pagination->setPagination($data['pagination']['next_max_id'], $max_id);
       }else{
       	$pagination->setPagination(null, $max_id);
       }
       
       $this->view->data = $data;
       $this->view->user = $this->user;
       $this->view->parser = new Parser();
        
    }
    
    public function viewByUsernameAction(){
    	$username = $this->getRequest()->getParam('username');
    	
    	$json = $this->profile->getProfileByUsername($username, $this->user->access_token);
    	$data = json_decode($json, true);
    	 
    	$this->view->data = $data;
    	$this->view->user = $this->user;
   
    }

    public function followAction()
    {
        // action body
    }

    public function rateAction()
    {
        // action body
    }


}







