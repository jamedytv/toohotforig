<?php

class ProfileObject extends UserObject{
	/**
	 * The number of instagram users the profile follows.
	 * @var int
	 */
	public $follows;
	
	/**
	 * The number of users following the profile.
	 * @var int
	 */
	public $followed_by;
	
	/**
	 * The number of media that the profile has posted to instagram.
	 * @var int
	 */
	public $media_count;
	
	/**
	 * The calculated ranking score for the profile.
	 * @var int
	 */
	public $score;
	
	/**
	 * Meta tags to enable profile feature searching;
	 * @var array
	 */
	public $tags;
	
	
	
}