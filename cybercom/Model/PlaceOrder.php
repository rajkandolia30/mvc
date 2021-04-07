<?php 
namespace Model;
class PlaceOrder extends \Model\Core\Table{
	public function __construct(){
		$this->setTableName('placeOrder');
		$this->setPrimaryKey('orderId');
	}
} ?>