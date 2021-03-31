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

	public function getCustomer(){
		return $customer = \Mage::getModel('Model\Customer')->fetchAll();
	}

	public function getBillingAddress(){
		$cartBillingAddress = $this->getCart()->getBillingAddress();
		if($cartBillingAddress){
			return $cartBillingAddress;
		}
		
		$cart = $this->getCart();
		$customerBillingAddress = $cart->getCustomer()->getBillingAddress();
		if($customerBillingAddress){
			$cartBillingAddress = \Mage::getModel('Model\Cart\Address');
			$cartBillingAddress->addressId = $customerBillingAddress->addressId;
			$cartBillingAddress->addressType = $customerBillingAddress->addressType;
			$cartBillingAddress->address = $customerBillingAddress->address;
			$cartBillingAddress->city = $customerBillingAddress->city;
			$cartBillingAddress->state = $customerBillingAddress->state;
			$cartBillingAddress->zipcode = $customerBillingAddress->zipcode;
			$cartBillingAddress->country = $customerBillingAddress->country;
			$address = $cartBillingAddress;
			return $address;
		}
	}

	public function getShippingAddress(){
		$cartBillingAddress = $this->getCart()->getBillingAddress();
		if($cartBillingAddress){
			return $cartBillingAddress;
		}

		$cart = $this->getCart();
		$customerShippingAddress = $cart->getCustomer()->getShippingAddress();
		if($customerShippingAddress){
			$cartBillingAddress = \Mage::getModel('Model\Cart\Address');
			$cartBillingAddress->addressId = $customerShippingAddress->addressId;
			$cartBillingAddress->addressType = $customerShippingAddress->addressType;
			$cartBillingAddress->address = $customerShippingAddress->address;
			$cartBillingAddress->city = $customerShippingAddress->city;
			$cartBillingAddress->state = $customerShippingAddress->state;
			$cartBillingAddress->zipcode = $customerShippingAddress->zipcode;
			$cartBillingAddress->country = $customerShippingAddress->country;
			$address = $cartBillingAddress;
			return $address;
		}
	}
}?>