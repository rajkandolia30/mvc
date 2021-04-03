<?php 
namespace Block\Admin\Cart;
class Grid extends \Block\Core\Template{
	protected $cart = null;
	protected $payment = null;
	protected $shipping = null;

	public function __construct(){
		$this->setTemplate('./View/admin/cart/grid.php');
	}

	public function setCart(\Model\Cart $cart){
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
		if($cart->getCustomer()){
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
			} else {
			$cartBillingAddress = \Mage::getModel('Model\Cart\Address');
			return $cartBillingAddress;			
			}
		} else{
			$cartBillingAddress = \Mage::getModel('Model\Cart\Address');
			return $cartBillingAddress;		
		}
	}

	public function getShippingAddress(){
		$cartShippingAddress = $this->getCart()->getShippingAddress();
		if($cartShippingAddress){
			return $cartShippingAddress;
		}

		$cart = $this->getCart();
		if($cart->getCustomer()){
			$customerShippingAddress = $cart->getCustomer()->getShippingAddress();
			if($customerShippingAddress){
				$cartShippingAddress = \Mage::getModel('Model\Cart\Address');
				$cartShippingAddress->addressId = $customerShippingAddress->addressId;
				$cartShippingAddress->addressType = $customerShippingAddress->addressType;
				$cartShippingAddress->address = $customerShippingAddress->address;
				$cartShippingAddress->city = $customerShippingAddress->city;
				$cartShippingAddress->state = $customerShippingAddress->state;
				$cartShippingAddress->zipcode = $customerShippingAddress->zipcode;
				$cartShippingAddress->country = $customerShippingAddress->country;
				$address = $cartShippingAddress;
				return $address;
			} else {
			$cartShippingAddress = \Mage::getModel('Model\Cart\Address');
			return $cartShippingAddress;			
			}
		} else {
			$cartShippingAddress = \Mage::getModel('Model\Cart\Address');
			return $cartShippingAddress;
		}
	}

	public function setPayment(\Model\Payment\Collection $payment){
		$this->payment = $payment;
		return $this;
	}

	public function getPayment(){
		if($this->payment){
			return $this->payment;
		}
		$payment = \Mage::getModel('Model\Payment')->fetchAll();
		if($payment){
			$this->setPayment($payment);
		}
		return $this->payment;
	}

	public function setShipping(\Model\Shipping\Collection $shipping){
		$this->shipping = $shipping;
		return $this;
	}

	public function getShipping(){
		if($this->shipping){
			return $this->shipping;
		}
		$shipping = \Mage::getModel('Model\Shipping')->fetchAll();
		if($shipping){
			$this->setShipping($shipping);
		}
		return $this->shipping;
	}

	public function getBasePrice(){
		$cartItem = \Mage::getModel('Model\Cart\Item')->fetchAll();
		return $basePrice = $cartItem->getData();
	}

	public function getShippingCharge(){
		return $shipping = \Mage::getModel('Model\Shipping')->fetchAll()->getData();
	}
}?>