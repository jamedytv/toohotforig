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

define('DEFAULT_ACCESS_TOKEN', '633656976.872dd39.be0e57e65502423598441395ed4ad121');
define('DEFAULT_USER_ID', '633656976');
define('SITE_ROOT', "http://".$_SERVER['SERVER_NAME']);
define('FEED_USER_ID', '618555772');
define('FEED_ACCESS_TOKEN', '618555772.872dd39.20d1b920287c4caa8251f9cd5798c49b');

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
		array(  'id' => DEFAULT_USER_ID,
				'controller' => 'profile',
				'action' => 'view'
		)));

$Router->addRoute("view_by_username", new Zend_Controller_Router_Route(
		'/ig/:username',
		array(  'id' => DEFAULT_USER_ID,
				'controller' => 'profile',
				'action' => 'view-by-username'
		)));

$Router->addRoute("follow_profile", new Zend_Controller_Router_Route(
		'/follow/profile/:id',
		array(  'id' => DEFAULT_USER_ID,
				'controller' => 'profile',
				'action' => 'follow'
		)));

$Router->addRoute("rate_profile", new Zend_Controller_Router_Route(
		'/rate/profile/:id',
		array(  'id' => DEFAULT_USER_ID,
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
		array(  'id' => DEFAULT_USER_ID,
				'controller' => 'account',
				'action' => 'remove'
		)));

$Router->addRoute("login", new Zend_Controller_Router_Route(
		'/login',
		array(  'controller' => 'account',
				'action' => 'login'
		)));

$Router->addRoute("logout", new Zend_Controller_Router_Route(
		'/logout',
		array(  'controller' => 'account',
				'action' => 'logout'
		)));

$Router->addRoute("authorize_account", new Zend_Controller_Router_Route(
		'/authenticate',
		array(  'controller' => 'account',
				'action' => 'authenticate'
		)));

$Router->addRoute("feed", new Zend_Controller_Router_Route(
		'/feed',
		array(  'controller' => 'feed',
				'action' => 'index'
		)));

$application->bootstrap()
            ->run();