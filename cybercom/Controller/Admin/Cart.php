<?php 
namespace Controller\Admin;
class Cart extends \Controller\Core\Admin{

	public function indexAction(){
		try {
            $grid = \Mage::getBlock('Block\Admin\Cart\Grid');
            $grid = $grid->setCart($this->getCart())->toHtml();
            $response = [
                'element' => [
                    [
                        'selector' => '#contentHtml',
                        'html' => $grid,
                    ]
                ]                
            ];
            header("Content-type: application/json; charset=utf-8");
            echo json_encode($response); 
        } catch (Exception $e) {
           $this->getMessage()->setFailure($e->getMessage());
        }  
	}

	public function addToCartAction(){
		try {
			$productId = $this->getRequest()->getGet('id');
			$product = \Mage::getModel('Model\product')->load($productId);
			if(!$product){
				throw new \Exception("No Product found");			
			}
			$cart = $this->getCart();
			print_r($cart);
			$cart->addItemToCart($product, 1, true);	
			$this->getMessage()->setSuccess('Item inserted Successfully');	

			$this->redirect('index');	
		} catch (Exception $e) {
			$this->getMessage()->setFailure($e->getMessage());
		}
		/*$grid = \Mage::getBlock('Block\Admin\Cart\Grid');
		$grid = $grid->setCart($this->getCart())->toHtml();
            $response = [
                'element' => [
                    [
                        'selector' => '#contentHtml',
                        'html' => $grid,
                    ]
                ]                
            ];
        header("Content-type: application/json; charset=utf-8");
        echo json_encode($response);*/
	}

	public function getCart($customerId = null){
		try {
			
			$session = \Mage::getModel('Model\Admin\Session');
			if($customerId){
				$session->customerId = $customerId;
			}
			$cart = \Mage::getModel('Model\Cart');
			$query = "SELECT * FROM `cart` WHERE `customerId` = '{$session->customerId}'";
			$cart = $cart->fetchRow($query);
			if($cart){
				return $cart;
			}
			$cart = \Mage::getModel('Model\Cart');
			$cart->customerId = $session->customerId;
			$cart->createdDate = date('y-m-d H:i:s');
			$cart->save();
			return $cart;


			/*$sessionId = \Mage::getModel('Model\Admin\Session')->getId();
			$cart = \Mage::getModel('Model\Cart');
			$query = "SELECT * FROM `{$cart->getTableName()}` WHERE sessionId = '{$sessionId}'";
			$cart = $cart->fetchRow($query);
			if($cart){
				return $cart;
			}
			$cart = \Mage::getModel('Model\Cart');
			$cart->sessionId = $sessionId;
			$cart->createdDate = date("y-m-d H:i:s");
			$cart->save();
			return $cart;*/
		} catch (\Exception $e) {
			$this->getMessage()->setFailure($e->getMessage());	
		}

		$grid = \Mage::getBlock('Block\Admin\Cart\Grid');
		$grid = $grid->setCart($this->getCart())->toHtml();
            $response = [
                'element' => [
                    [
                        'selector' => '#contentHtml',
                        'html' => $grid,
                    ]
                ]                

            ];
        header("Content-type: application/json; charset=utf-8");
        echo json_encode($response);
	}

	public function updateAction(){
		try {
			$quantities = $this->getRequest()->getPost('quantity');
			$cart = $this->getCart();
			foreach ($quantities as $cartItemId => $quantity) {
				if($quantity == 0){
					echo $query = "DELETE FROM `cartItem` WHERE `cartItemId` = '{$cartItemId}'";
					$delete = \Mage::getModel('Model\Cart\Item')->getAdapter()->delete($query);
					$this->redirect('index');
				}
				$cartItem = \Mage::getModel('Model\Cart\Item')->load($cartItemId);
				$basePrice = ($cartItem->price * $quantity)-($cartItem->discount * $quantity);
				$cartItem->basePrice = $basePrice;
				$cartItem->quantity = $quantity;
				$cartItem->save();
			}
			$this->getMessage()->setSuccess('Record Updated successfully!!!');			
		} catch (Exception $e) {
			$this->getMessage()->setSuccess('Record deleted successfully!!!');
		}
	}

	public function deleteAction(){
		try {
			$id = $this->getRequest()->getGet('id');
			if(!$id){
				throw new Exception("ID invalid.");
			} 
			$cartItem = \Mage::getModel('Model\Cart\Item');
			$delete = $cartItem->delete($id);
			if(!$delete){
	            $this->getMessage()->setFailure('Enable to delete record!!');
	        } else {
	            $this->getMessage()->setSuccess('Record deleted successfully!!!');
	        }			
		} catch (Exception $e) {
			$this->getMessage()->setSuccess('Record deleted successfully!!!');
		}

		$grid = \Mage::getBlock('Block\Admin\Cart\Grid');
		$grid = $grid->setCart($this->getCart())->toHtml();
            $response = [
                'element' => [
                    [
                        'selector' => '#contentHtml',
                        'html' => $grid,
                    ]
                ]                
            ];
        header("Content-type: application/json; charset=utf-8");
        echo json_encode($response);
	}

	public function selectCustomerAction(){
		$customerId = $this->getRequest()->getPost('customer');
		$this->getCart($customerId);
		$this->redirect('index');
	}

	public function saveBillingAddressAction(){
		$customerId = $this->getRequest()->getPost('customer');
		$cartId = $this->getrequest()->getGet('cartId');
		$billing = $this->getRequest()->getPost('billing');	
		$billingCartAddressId = $this->getCart()->getBillingAddress()->cartAddressId;
		$addressId = $this->getCart()->getCustomer()->getBillingAddress()->addressId;
		$customerAddress = \Mage::getModel('Model\CustomerAddress');
		$cartAddress = \Mage::getModel('Model\Cart\Address');
		
			if($billingCartAddressId){
				foreach ($billing as $key => $value) {
						if($key == 'saveInAddressBook'){						
							$query = "SELECT * 
							FROM `{$customerAddress->getTableName()}` 
							WHERE `customerId` = '{$customerId}'
							AND `addressType` = 'billing'";
							$row = $customerAddress->fetchRow($query);
								if($addressId){
									echo 'update customer address';	
									$customerAddress->addressId = $addressId;
								} else {
								echo 'insert in customer address';
								}
							$customerAddress->customerId = $customerId;
							$customerAddress->addressType = 'billing';
							unset($billing['saveInAddressBook']);
							$customerAddress->setData($billing);
							//print_r($customerAddress);
							$customerAddress->save();					
						}
					}
				echo 'updating cart address';
				$cartAddress->cartAddressId = $billingCartAddressId;
			} else {
					foreach ($billing as $key => $value) {
						if($key == 'saveInAddressBook'){						
							$query = "SELECT * 
							FROM `{$customerAddress->getTableName()}` 
							WHERE `customerId` = '{$customerId}'
							AND `addressType` = 'billing'";
							$row = $customerAddress->fetchRow($query);
								if($addressId){
									echo 'update customer address';	
									$customerAddress->addressId = $addressId;
								} else {
									echo 'insert in customer address';					
								}
							$customerAddress->customerId = $customerId;
							$customerAddress->addressType = 'billing';
							unset($billing['saveInAddressBook']);
							$customerAddress->setData($billing);
							//print_r($customerAddress);
							$customerAddress->save();
						}
					}	
			}
		echo 'inserting cart address';
		unset($billing['saveInAddressBook']);
		$cartAddress->cartId = $cartId;
		$cartAddress->addressId = $addressId;
		$cartAddress->addressType = 'billing';
		$cartAddress->setData($billing);
		// print_r($cartAddress);
		$cartAddress->save(); 		
	} 

	public function saveShippingAddressAction(){
		$customerId = $this->getRequest()->getPost('customer');
		$cartId = $this->getrequest()->getGet('cartId');
		$shipping = $this->getRequest()->getPost('shipping');
		$shippingCartAddressId = $this->getCart()->getShippingAddress()->cartAddressId;
		$addressId = $this->getCart()->getCustomer()->getShippingAddress()->addressId;
		$customerAddress = \Mage::getModel('Model\CustomerAddress');
		$cartAddress = \Mage::getModel('Model\Cart\Address');

			if($shippingCartAddressId){				
				foreach ($shipping as $key => $value) {
						if($key == 'saveInAddressBook'){						
							$query = "SELECT * 
							FROM `{$customerAddress->getTableName()}` 
							WHERE `customerId` = '{$customerId}'
							AND `addressType` = 'shipping'";
							$row = $customerAddress->fetchRow($query);
								if($addressId){
									echo 'update customer address';	
									$customerAddress->addressId = $addressId;
								} else {
								echo 'insert in customer address';
								}
							$customerAddress->customerId = $customerId;
							$customerAddress->addressType = 'shipping';
							unset($shipping['saveInAddressBook']);
							$customerAddress->setData($shipping);
							//print_r($customerAddress);
							$customerAddress->save();					
						}
						if($key == 'sameAsBilling'){
							$cartAddress = $this->getCart()->getShippingAddress();
							$cartId = $this->getCart()->cartId;
							$billing = $this->getRequest()->getPost('billing');
								if($cartAddress){
									$cartAddressId = $cartAddress->cartAddressId;
									$cartAddress = \Mage::getModel('Model\Cart\Address');
									if($cartAddressId){
										echo 'Update customer address';
										$cartAddress = $cartAddress->load($cartAddressId);
										if(!$cartAddress){
											throw new Exception("invalid");
										}
										$cartAddress->cartAddressId = $cartAddressId;
										$cartAddress->setData($billing);
										//print_r($cartAddress);
										$cartAddress->save();
									} else {
										echo 'insert customer Address';
										$cartAddress->cartId = $cartId;
										$cartAddress->addressType = 'shipping';
										$cartAddress->setData($billing);
										//print_r($cartAddress);
										$cartAddress->save();
									}					
								}
						}
					}
			echo 'updating cart address';
			$cartAddress->cartAddressId = $shippingCartAddressId;
			unset($shipping['saveInAddressBook']);
			$cartAddress->cartId = $cartId;
			$cartAddress->addressId = $addressId;
			$cartAddress->addressType = 'shipping';
			$cartAddress->setData($shipping);
			//print_r($cartAddress);
			$cartAddress->save();
			} else {
					foreach ($shipping as $key => $value) {
						if($key == 'saveInAddressBook'){						
							$query = "SELECT * 
							FROM `{$customerAddress->getTableName()}` 
							WHERE `customerId` = '{$customerId}'
							AND `addressType` = 'shipping'";
							$row = $customerAddress->fetchRow($query);
								if($addressId){
									echo 'update customer address';	
									$customerAddress->addressId = $addressId;
								} else {
									echo 'insert in customer address';					
								}
							$customerAddress->customerId = $customerId;
							$customerAddress->addressType = 'shipping';
							unset($shipping['saveInAddressBook']);
							$customerAddress->setData($shipping);
							//print_r($customerAddress);
							$customerAddress->save();
						} 
						if($key == 'sameAsBilling'){
							$cartAddress = $this->getCart()->getShippingAddress();
							$cartId = $this->getCart()->cartId;
							$billing = $this->getRequest()->getPost('billing');
								if($cartAddress){
									$cartAddressId = $cartAddress->cartAddressId;
									$cartAddress = \Mage::getModel('Model\Cart\Address');
									if($cartAddressId){
										echo 'Update customer address';
										$cartAddress = $cartAddress->load($cartAddressId);
										if(!$cartAddress){
											throw new Exception("invalid");
										}
										$cartAddress->cartAddressId = $cartAddressId;
										$cartAddress->setData($billing);
										//print_r($cartAddress);
										$cartAddress->save();
									} else {
										echo 'insert customer Address';
										$cartAddress->cartId = $cartId;
										$cartAddress->addressType = 'shipping';
										$cartAddress->setData($billing);
										//print_r($cartAddress);
										$cartAddress->save();
									}					
								}
						}
					}	
		echo 'inserting cart address';
		unset($shipping['saveInAddressBook']);
		$cartAddress->cartId = $cartId;
		$cartAddress->addressId = $addressId;
		$cartAddress->addressType = 'shipping';
		$cartAddress->setData($shipping);
		//print_r($cartAddress);
		$cartAddress->save();
		}
				
	}

	public function paymentMethodAction(){
		$methodId = $this->getRequest()->getPost('paymentMethod');
		$customerId = $this->getRequest()->getPost('customer');
		$cartId = $this->getCart()->cartId;
		if($cartId){
			$cart = \Mage::getModel('Model\Cart');
			$cart->cartId = $cartId;
			$cart->customerId = $customerId;
			$cart->paymentMethodId = $methodId;
			$cart->save();
		}
	}

	public function shippingMethodAction(){
		$methodId = $this->getRequest()->getPost('shippingMethod');
		$customerId = $this->getRequest()->getPost('customer');
		$cartId = $this->getCart()->cartId;
		$shipping = \Mage::getModel('Model\Shipping');
		$query = "SELECT * FROM `{$shipping->getTableName()}` WHERE `methodId` = '{$methodId}'";
		$shipping = $shipping->fetchRow($query);
		$amount = $shipping->amount;
		if($cartId){
			$cart = \Mage::getModel('Model\Cart');
			$cart->cartId = $cartId;
			$cart->customerId = $customerId;
			$cart->shippingMethodId = $methodId;
			$cart->shippingAmount = $amount;
			$cart->save();
		}
	}

	public function saveBillAction(){
		$bill = $this->getRequest()->getPost('bill');
		$cart = \Mage::getModel('Model\Cart');
		$cartId = $this->getCart()->cartId;
		if($bill){
			$cart->cartId = $cartId;
			$cart->total = $bill['grandTotal'];
			$cart->save();
		}
	}

	public function placeOrderIndexAction(){		
		$placeOrder = \Mage::getBlock('Block\Admin\Cart\PlaceOrder')->toHtml();
        $response = [
            'element' => [
                [
                    'selector' => '#contentHtml',
                    'html' => $placeOrder,
                ]
            ]                
        ];
        header("Content-type: application/json; charset=utf-8");
        echo json_encode($response);
	}

	public function placeOrderAction(){
		$customerId = $this->getRequest()->getPost('customer');
		$cart = $this->getCart($customerId);
		$cartId = $cart->cartId;

		$placeOrder = \Mage::getModel('Model\PlaceOrder');
		$placeOrder->customerId = $cart->customerId;
		$placeOrder->total = $cart->total;
		$placeOrder->discount = $cart->discount;
		$placeOrder->paymentMethodId = $cart->paymentMethodId;
		$placeOrder->shippingMethodId = $cart->shippingMethodId;
		$placeOrder->shippingAmount = $cart->shippingAmount;
		$placeOrder->createdDate = date("y-m-d H:i:s");
		//print_r($cart);
		//print_r($placeOrder);
		//$placeOrder->save();

		$placeOrderItem = \Mage::getModel('Model\PlaceOrder\Item');
		$cartItem = \Mage::getModel('Model\Cart\Item');
		$query = "SELECT * FROM `{$cartItem->getTableName()}` WHERE `cartId` = '{$cartId}' ";
		$cartItem = $cartItem->fetchAll($query);
		foreach ($cartItem as $key => $value) {
			foreach ($value as $key => $value) {
					$placeOrderItem->orderId = $value->cartId;
					$placeOrderItem->productId = $value->productId;
					$placeOrderItem->quantity = $value->quantity;
					$placeOrderItem->basePrice = $value->basePrice;
					$placeOrderItem->price = $value->price;
					$placeOrderItem->discount = $value->discount;
					$placeOrderItem->createdDate = date("y-m-d H:i:s");
					echo '<pre>';
					//print_r($value);
					//print_r($placeOrderItem);
					//$placeOrderItem->save();
			}
		}

		$placeOrderAddress = \Mage::getModel('Model\PlaceOrder\Address');
		$cartAddress = \Mage::getModel('Model\Cart\Address');
		$query = "SELECT * FROM `{$cartItem->getTableName()}` WHERE `cartId` = '{$cartId}' ";
		$cartAddress = $cartAddress->fetchAll($query);
		foreach ($cartAddress as $key => $value) {
			foreach ($value as $key => $value) {
					$placeOrderAddress->orderId = $value->cartId;
					$placeOrderAddress->addressId = $value->addressId;
					$placeOrderAddress->addressType = $value->addressType;
					$placeOrderAddress->address = $value->address;
					$placeOrderAddress->city = $value->city;
					$placeOrderAddress->state = $value->state;
					$placeOrderAddress->country = $value->country;
					$placeOrderAddress->zipcode = $value->zipcode;
					// print_r($value);
					// print_r($placeOrderAddress);
					//$placeOrderAddress->save();
			}
		}
		die();
		$this->redirect('placeOrderIndex');
	}
} ?> 