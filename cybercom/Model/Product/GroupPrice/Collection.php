<?php 
namespace Model\Product\GroupPrice;
class Collection extends \Model\Core\Table\Collection{
	public $data = [];

	public function setData($data = []){
		$this->data = $data;
		return $this;
	}

	public function getData(){
		$this->data;
	}
}
