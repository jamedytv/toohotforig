<?php
require_once 'class/Instagram.class.php';
require_once 'class/Mysql.class.php';

$db = new Mysql();
$ig = new Instagram();
	
$ig->setUri();
$profile_data = json_decode($ig->getInstagramUserJson(), true);

$cursor = $profile_data['pagination']['next_cursor'];

foreach($profile_data['data'] as $profile){
	$db->updateUserData($profile);
	$db->updateProfileData($profile);
}

while(isset($cursor)){
	$ig->setUri($cursor);
	$profile_data = json_decode($ig->getInstagramUserJson(), true);
	
	try {
		$cursor = $profile_data['pagination']['next_cursor'];
	} catch (Exception $e) {
		unset($cursor);
	}
	
	foreach($profile_data['data'] as $profile){
		$db->updateUserData($profile);
		$db->updateProfileData($profile);
	}
	
}

$db->closeConnection();