<?php
require_once dirname(dirname(__FILE__)).'/includes/Cookie.class.php';

class MediaController extends Zend_Controller_Action
{
	private $user;
	private $media;

    public function init()
    {
        Cookie::startSession();
    	$this->user = Cookie::userLoggedIn();
    	
    	$this->media = new Application_Model_Media();
    }

    public function indexAction()
    {
       
    }


}

