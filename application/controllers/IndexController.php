<?php
require_once dirname(dirname(__FILE__)).'/includes/Cookie.class.php';

class IndexController extends Zend_Controller_Action
{

	private $user_data;
	
    public function init()
    {
        Cookie::startSession();
    	$this->user_data = Cookie::userLoggedIn();
    	
    }

    public function indexAction()
    {
    	
    	$this->view->user_data = $this->user_data;
        
    }


}

