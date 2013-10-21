<?php
class MediaObject {
	
	/**
	 * The username of the user that posted the media to instagram
	 * @var string
	 */
	public $username;
	
	/**
	 * The url of the low resolution version of the media.
	 * @var string;
	 */
	public $low_res_url;
	
	/**
	 * The url of the standard resolution version of the media.
	 * @var string;
	 */
	public $standard_res_url;
	
	/**
	 * The url of the thumbnail version of the media.
	 * @var string;
	 */
	public $thumbnail;
	
	/**
	 * The time that the media was posted to instagram in unix time.
	 * @var string
	 */
	public $created_time;
	
	/**
	 * The type of the media: can be "image" or "video".
	 * @var string
	 */
	public $type;
	
}