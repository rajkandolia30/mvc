<?php 
namespace Block\Admin\Cart;
class PlaceOrder extends \Block\Core\Template{
	public function __construct(){
		$this->setTemplate('./View/admin/cart/placeOrder.php');
	}

	public function getCustomer(){
		$customerId = $this->getRequest()->getGet('customerId');
		$customer =  \Mage::getModel('Model\Customer');
		$query = "SELECT * FROM `{$customer->getTableName()}` WHERE `customerId` = '{$customerId}'";
		$row = $customer->fetchRow($query);
		return $row;
	}

	public function getPlaceOrder(){
		$customerId = $this->getRequest()->getGet('customerId');
		$placeOrder = \Mage::getModel('Model\PlaceOrder');
		$query = "SELECT * FROM `{$placeOrder->getTableName()}` WHERE `customerId` = '{$customerId}'";
		$row = $placeOrder->fetchAll($query);
		return $row;
	}

	public function getPlaceOrderItems(){
		return \Mage::getModel('Model\PlaceOrder\Item')->fetchAll();
	}

	public function getPlaceOrderAddress(){
		return \Mage::getModel('Model\PlaceOrder\Address')->fetchAll();
	}
}?>