<?php 
namespace Model\Core;
 class Collection{
 	public $data = [];

 	public function __construct(){
 		
 	}
 	public function setData($data = []){
 		$this->data = $data;
 		return $this;
 	}

 	public function getData(){
 		return $this->data;
 	} 

 	public function count(){
 		return count($this->data);
 	}
 } ?>
