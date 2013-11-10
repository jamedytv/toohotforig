<?php
class Pagination{
	
	private $pagename;
	
	public function __construct($pagename){
		$this->pagename = $pagename;
		
		if(empty($_SESSION['pagination'][$pagename]['previous']))
		{
			$_SESSION['pagination'][$pagename]['previous'] = array();
		}
	}
	
	public function getMaxId($max_id){
		//check if max_id is valid if not send them to the index page.
		if($max_id==end($_SESSION['pagination'][$this->pagename]['previous']) ||
		   $max_id==$_SESSION['pagination'][$this->pagename]['next']){
			return $max_id;
		}else{
			return null;
		}
	}
	
	public function setPagination($next_max_id, $max_id){
		//push old max_id unto the "previous" array
		if($max_id!=null && $max_id!=$next_max_id && end($_SESSION['pagination'][$this->pagename]['previous']) != $max_id){
			array_push($_SESSION['pagination'][$this->pagename]['previous'], $_SESSION['pagination'][$this->pagename]['next']);
		}
		elseif(end($_SESSION['pagination'][$this->pagename]['previous']) == $max_id){
			$x = array_pop($_SESSION['pagination'][$this->pagename]['previous']);
		}
		else{
			$_SESSION['pagination'][$this->pagename]['previous'] = array();
		}
		 
		//reset the "next" variable to the new max_id
		if($next_max_id!=null){
			$_SESSION['pagination'][$this->pagename]['next'] = $next_max_id;
		}else{
			$_SESSION['pagination'][$this->pagename]['next'] = null;
		}
		 
	}
}