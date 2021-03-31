<?php 
namespace Model\Cart;
class Address extends \Model\Core\Table{
	const ADDRESS_TYPE_SHIPPING = 'shipping';
	const ADDRESS_TYPE_BILLING = 'billing';
	protected $cart = null;
	protected $address = null;

	public function __construct(){
		$this->setTableName('cartAddress');
		$this->setPrimaryKey('cartAddressId');
	}

	public function setCart(\Model\Cart $cart){
		$this->cart = $cart;
		return $this;
	}

	public function getCart(){
		if(!$this->cartId){
			return false;
		}
		$cart = \Mage::getModel('Model\Cart')->load($this->cartId);
		$this->setCart($cart);
		return $this->cart;
	}

	/*public function setAddress(\Model\CustomerAddress $address){
		$this->address = $address;
		return $this;
	}

	public function getAddress(){
		if(!$this->addressId){
			return $this;
		}
		$address = \Mage::getModel('Model\CustomerAddress')->load($this->addressId);
		$this->setAddress($address);
		return $this->address;
	}*/
}?>