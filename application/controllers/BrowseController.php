<?php
require_once dirname(dirname(__FILE__)).'/includes/Cookie.class.php';
require_once dirname(dirname(__FILE__)).'/models/Profile.php';

class BrowseController extends Zend_Controller_Action
{

	private $user_data;
	private $profile;
	
    public function init()
    {
    	Cookie::startSession();
    	$this->user_data = Cookie::userLoggedIn();
    	
    	$this->profile = new Application_Model_Profile();
    }

    public function indexAction()
    {
        $this->view->profiles = $this->profile->getProfiles();
    }

    public function byrankAction()
    {
       require_once dirname(dirname(dirname(__FILE__))).'/library/Parser.class.php';
       $string = "this is a post by @me and im tagging @myfriend in it.";
       $parser = new Parser();
       print_r($parser->handleToLinkConverter($string));die();
    }


}



