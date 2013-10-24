<?php
require_once dirname(dirname(__FILE__)).'/includes/Cookie.class.php';

class ProfileController extends Zend_Controller_Action
{

	private $user;
	private $profile;
	private $id;
	
    public function init()
    {
        Cookie::startSession();
    	$this->user = Cookie::userLoggedIn();
    	
    	$this->profile = new Application_Model_Profile($this->user->access_token);
    	
    	$this->id = $this->getRequest()->getParam('id');
    }

    public function indexAction()
    {
        // action body
    }

    public function viewAction()
    {
       $json = $this->profile->getProfileById($this->id);
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







