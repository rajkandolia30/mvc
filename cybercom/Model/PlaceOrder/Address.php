<?php 
namespace Model\PlaceOrder;
class Address extends \Model\Core\Table{
	public function __construct(){
		$this->setTableName('placeOrderAddress');
		$this->setPrimaryKey('orderAddressId');
	}
} ?>