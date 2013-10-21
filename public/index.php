<?php

// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),
    get_include_path(),
)));

/** Zend_Application */
require_once 'Zend/Application.php';

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);

error_reporting(E_ALL);
ini_set('display_errors', '1');

define('DEFAULT_ACCESS_TOKEN', '618555772.53f91d3.d5ca6fa057e84e62ac7242e9d7d5260f');

/**Routing Info*/
$FrontController=Zend_Controller_Front::getInstance();
$Router = $FrontController->getRouter();

$Router->addRoute("browse", new Zend_Controller_Router_Route(
		'/browse',
		array(  'controller' => 'browse',
				'action' => 'index'
		)));

$Router->addRoute("browse_by_rank", new Zend_Controller_Router_Route(
		'/browse/by-rank',
		array(  'controller' => 'browse',
				'action' => 'byRank'
		)));

$Router->addRoute("view_profile", new Zend_Controller_Router_Route(
		'/view/profile/:id',
		array(  'id' => '618555772',
				'controller' => 'profile',
				'action' => 'view'
		)));

$Router->addRoute("follow_profile", new Zend_Controller_Router_Route(
		'/follow/profile/:id',
		array(  'id' => '618555772',
				'controller' => 'profile',
				'action' => 'follow'
		)));

$Router->addRoute("rate_profile", new Zend_Controller_Router_Route(
		'/rate/profile/:id',
		array(  'id' => '618555772',
				'controller' => 'profile',
				'action' => 'rate'
		)));

$Router->addRoute("create_account", new Zend_Controller_Router_Route(
		'/create/account',
		array(  'controller' => 'account',
				'action' => 'create'
		)));

$Router->addRoute("remove_account", new Zend_Controller_Router_Route(
		'/remove/account/:id',
		array(  'id' => '618555772',
				'controller' => 'account',
				'action' => 'remove'
		)));

$Router->addRoute("login", new Zend_Controller_Router_Route(
		'/login',
		array(  'controller' => 'account',
				'action' => 'login'
		)));

$Router->addRoute("authorize_account", new Zend_Controller_Router_Route(
		'/authenticate',
		array(  'controller' => 'account',
				'action' => 'authenticate'
		)));

$Router->addRoute("feed", new Zend_Controller_Router_Route(
		'/feed',
		array(  'controller' => 'media',
				'action' => 'index'
		)));

$application->bootstrap()
            ->run();