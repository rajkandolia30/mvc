<?php 
namespace Model\Product\GroupPrice;
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
