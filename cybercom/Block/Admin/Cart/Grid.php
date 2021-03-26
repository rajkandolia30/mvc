<?php 
namespace Block\Admin\Cart;
class Grid extends \Block\Core\Template{
	protected $cart = null;

	public function __construct(){
		$this->setTemplate('./View/admin/cart/grid.php');
	}

	public function setCart(\Model\Cart $cart = null){
		$this->cart = $cart;
		return $this;
	}

	public function getCart(){
		if(!$this->cart){
			throw new \Exception("Cart not available!");
		}
		return $this->cart;
	}
	/*public function getCustomer(){
		$customer = \Mage::getModel('Model\Customer');
		$query = "SELECT * FROM `{$customer->getTableName()}`";
		$customer = $customer->fetchAll($query);
		return $customer;
	}*/
}?>