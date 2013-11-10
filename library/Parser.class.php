<?php

class Parser{
	
	private $ig_link;
	private $fb_link;
	private $tw_link; 
	
	public function __construct(){
		$this->ig_link = SITE_ROOT."/ig/";
		$this->fb_link = SITE_ROOT."/fb/";
		$this->tw_link = SITE_ROOT."/tw/";
	}

	/**
     *Takes a string input and a social media context.
     *@return string
	 */
	public function handleToLinkConverter($input, $context=""){
		switch ($context){
			case "instagram":
				$link = $this->ig_link;
				break;
			case "facebook":
				$link = $this->fb_link;
				break;
			case "twitter":
				$link = $this->tw_link;
				break;
			default:
				$link = $this->ig_link;
		}
		
    	$output = preg_replace('/(^|\s)@([a-z0-9_]+)/i','$1<a href="'.$link.'$2">@$2</a>', $input);
    	return $output;
  	}

}
