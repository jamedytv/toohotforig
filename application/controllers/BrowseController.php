<?php
require_once dirname(dirname(__FILE__)).'/includes/Cookie.class.php';

class BrowseController extends Zend_Controller_Action
{

	private $user_data;
	
    public function init()
    {
    	Cookie::startSession();
    	$this->user_data = Cookie::userLoggedIn();
    }

    public function indexAction()
    {
        // action body
    }

    public function byRankAction()
    {
        // action body
    }


}



