<?php 
namespace Model\PlaceOrder;
class Item extends \Model\Core\Table{
	public function __construct(){
		$this->setTableName('placeOrderItem');
		$this->setPrimaryKey('orderItemId');	
	}
} ?>