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
			$cart->addItemToCart($product, 1, true);	
			$this->getMessage()->setSuccess('Item inserted Successfully');		
		} catch (Exception $e) {
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
					print_r($cartItemId);
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
			die();
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
		$cart = $this->getCart($customerId);
		$this->redirect('index');
	}

	public function saveBillingAddressAction(){
		$customerId = $this->getRequest()->getPost('customer');
		$addressId = $this->getrequest()->getGet('addressId');
		$cartId = $this->getrequest()->getGet('cartId');
		$billing = $this->getRequest()->getPost('billing');	
		$billingCartAddressId = $this->getRequest()->getGet('billingCartAddressId');
		$cartAddress = \Mage::getModel('Model\Cart\Address');
		if($billingCartAddressId){
			if($billing['saveInAddressBook']){
				//insert customer address
				echo 'insert in customer address';
				$customerAddress = \Mage::getModel('Model\CustomerAddress');
				$customerAddress->customerId = $customerId;
				$customerAddress->addressType = 'billing';
				unset($billing['saveInAddressBook']);
				$customerAddress->setData($billing);
				$customerAddress->save();

				//update customer address
				echo 'update customer address';	
				$query = "SELECT * 
				FROM `{$customerAddress->getTableName()}` 
				WHERE `customerId` = '{$customerId}'
				AND `addressType` = 'billing'";
				$row = $customerAddress->fetchRow($query);
				if($addressId){
					$customerAddress->addressId = $addressId;
					$customerAddress->customerId = $customerId;
					$customerAddress->addressType = 'billing';
					unset($billing['saveInAddressBook']);
					$customerAddress->setData($billing);
					print_r($customerAddress);
					$customerAddress->save();
				}
			}
			//update cart address
			echo 'updating cart address';
			unset($billing['saveInAddressBook']);
			$cartAddress->cartAddressId = $billingCartAddressId;
			$cartAddress->cartId = $cartId;
			$cartAddress->addressId = $addressId;
			$cartAddress->addressType = 'billing';
			$cartAddress->setData($billing);
			$cartAddress->save();
		} else {
			//insert Cart address
			echo 'inserting cart address';
			print_r($addressId);
			$cartAddress->cartId = $cartId;
			$cartAddress->addressId = $addressId;
			$cartAddress->addressType = 'billing';
			$cartAddress->setData($billing);
			$cartAddress->save();
		}		
	}

	public function saveShippingAddressAction(){
		$customerId = $this->getRequest()->getPost('customer');
		$addressId = $this->getrequest()->getGet('addressId');
		print_r($addressId);
		$cartId = $this->getrequest()->getGet('cartId');
		$shipping = $this->getRequest()->getPost('shipping');
		$shippingCartAddressId = $this->getRequest()->getGet('shippingCartAddressId');

		$sameAsBilling = $this->getRequest()->getPost('sameAsBilling');
		
		if($sameAsBilling){
			$cartAddress = $this->getCart()->getShippingAddress();
			$cartId = $this->getCart()->cartId;
			$billing = $this->getRequest()->getPost('billing');
				if($cartAddress){
					$cartAddressId = $cartAddress->cartAddressId;
					$cartAddress = \Mage::getModel('Model\Cart\Address');
					if($cartAddressId){
						$cartAddress = $cartAddress->load($cartAddressId);
						if(!$cartAddress){
							throw new Exception("invalid");
						}
						$cartAddress->cartAddressId = $cartAddressId;
					} else {
						$cartAddress->cartId = $cartId;
						$cartAddress->addressType = 'shipping';
					}
					$cartAddress->setData($billing);
					$cartAddress->save();
				}
		}
		if($shippingCartAddressId){
			//update cart address
			if($shipping['saveInAddressBook']){
				//insert customer address	
				echo 'insert in customer address';
				$customerAddress = \Mage::getModel('Model\CustomerAddress');
				$customerAddress->customerId = $customerId;
				$customerAddress->addressType = 'shipping';
				unset($shipping['sameAsBilling']);
				unset($shipping['saveInAddressBook']);
				$customerAddress->setData($shipping);
				//print_r($customerAddress);
				$customerAddress->save();

				//update customer address
				$query = "SELECT * 
				FROM `{$customerAddress->getTableName()}` 
				WHERE `customerId` = '{$customerId}'
				AND `addressType` = 'shipping'";
				$row = $customerAddress->fetchRow($query);
				$addressId = $row->addressId;
				if($addressId){
					echo 'update in customer address';
					$customerAddress->addressId = $addressId;
					$customerAddress->customerId = $customerId;
					$customerAddress->addressType = 'shipping';
					unset($shipping['sameAsBilling']);
					unset($shipping['saveInAddressBook']);
					$customerAddress->setData($shipping);
					//print_r($customerAddress);
					$customerAddress->save();	
				}

			}
			//insert cart address
			echo 'update cart address';
			unset($shipping['saveInAddressBook']);
			$cartAddress->cartAddressId = $shippingCartAddressId;
			$cartAddress->cartId = $cartId;
			$cartAddress->addressId = $addressId;
			$cartAddress->addressType = 'shipping';
			$cartAddress->setData($shipping);
			print_r($cartAddress);	
			$cartAddress->save();
		} else {
			//insert in cart address
			echo 'insert cart address';
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
			print_r($cart);
			$cart->save();
		}
	}
} ?>