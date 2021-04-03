<?php 
namespace Model;
class Cart extends \Model\Core\Table{
	protected $customer = null;
	protected $items = null;
	protected $billingAddress = null;
	protected $shippingAddress = null;
	protected $payment = null;
	protected $shipping = null;

	public function __construct(){
		$this->setTableName('cart');
		$this->setPrimaryKey('cartId');
	}

	public function setCustomer(\Model\Customer $customer){
		$this->customer = $customer;
		return $this;
	}

	public function getCustomer(){
		if($this->customer){
			return $this->customer;
		}
		if(!$this->customerId){
			return false;
		}
		$customer = \Mage::getModel('Model\Customer')->load($this->customerId);
		if($customer){
			$this->setCustomer($customer);
		}
		return $this->customer;
	}

	public function setItems(\Model\Cart\Item\Collection $items = null){
		$this->items = $items;
		return $this;
	}

	public function getItems(){
		if(!$this->cartId) {
            return false;
        }
        $query = "SELECT * FROM `cartItem` WHERE `cartId` = '{$this->cartId}'";
        $items = \Mage::getModel('Model\Cart\Item')->fetchAll($query);
        $this->setItems($items);
        return $this->items;
	}

	public function setBillingAddress(\Model\Cart\Address $address){
		$this->billingAddress = $address;
		return $this;
	}

	public function getBillingAddress(){
		if(!$this->cartId){
			return false;
		}
		$query = "SELECT * FROM `cartAddress` WHERE cartId = '{$this->cartId}' AND addressType = 'billing'";
		$billingAddress = \Mage::getModel('Model\Cart\Address')->fetchRow($query);
		if($billingAddress){
			$this->setBillingAddress($billingAddress);
		}
		return $this->billingAddress;
	}

	public function setShippingAddress(\Model\Cart\Address $address){
		$this->shippingAddress = $address;
		return $this;
	}

	public function getShippingAddress(){
		if(!$this->cartId){
			return false;
		}
		$query = "SELECT * FROM `cartAddress` WHERE cartId = '{$this->cartId}' AND addressType = 'shipping'";
		$shippingAddress = \Mage::getModel('Model\Cart\Address')->fetchRow($query);
		if($shippingAddress){
			$this->setShippingAddress($shippingAddress);
		}
		return $this->shippingAddress;
	}

	public function setPayment(\Model\Cart $payment){
		$this->payment = $payment;
		return $this;
	}

	public function getPayment(){
		if($this->payment){
			return $this->payment;
		}
		if(!$this->cartId){
			return false;
		}
		$payment = \Mage::getModel('Model\Cart')->load($this->cartId);
		$this->setPayment($payment);
		return $this->payment;
	}

	public function setShipping(\Model\Cart $shipping){
		$this->shipping = $shipping;
		return $this;
	}

	public function getShipping(){
		if($this->shipping){
			return $this->shipping;
		}
		if(!$this->cartId){
			return false;
		}
		$shipping = \Mage::getModel('Model\Cart')->load($this->cartId);
		$this->setShipping($shipping);
		return $this->shipping;
	}

	public function addItemToCart($product , $quantity = 1, $addMode = false){
		$query = "SELECT *
		FROM `cartItem` 
		WHERE `cartId` = '{$this->cartId}'
			AND `productId` = '{$product->productId}'";
		$cartItem = \Mage::getModel('Model\Cart\Item');
		$cartItem = $cartItem->fetchRow($query);
		if($cartItem){
			$cartItem->quantity += $quantity;
			$cartItem->save();
			return true;
		}
		$cartItem = \Mage::getModel('Model\Cart\Item');
		$cartItem->cartId = $this->cartId;
		$cartItem->productId = $product->productId;
		$cartItem->price = $product->price;
		$cartItem->quantity = $quantity;
		$cartItem->discount = $product->discount;
		$cartItem->save();
		return true;
	}
} ?>