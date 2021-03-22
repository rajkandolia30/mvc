<?php 
namespace Model\Attribute\Option;
class Collection{
	public $data = [];

	public function setData($data = []){
		$this->data = $data;
		return $this;
	}

	public function getData(){
		$this->data;
	}
}