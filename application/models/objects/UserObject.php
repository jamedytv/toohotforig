<?php

class UserObject{
	/**
	 * The users instagram id.
	 * @var string
	 */
	public $id;
	
	/**
	 * The username of the instagram user.
	 * @var string
	 */
	public $username;
	
	/**
	 * The url to the profile picture of the instagram user.
	 * @var string
	 */
	public $profile_picture;
	
	/**
	 * The instagram users authenticated access token for us to make requests.
	 * @var string;
	 */
	public $access_token;
}