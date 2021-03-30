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
				$cartItem = \Mage::getModel('Model\Cart\Item')->load($cartItemId);
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
		$cart = $this->getCart($customerId);

		$grid = \Mage::getBlock('Block\Admin\Cart\Grid');
        $grid = $grid->setCart($cart)->toHtml();
        $response = [
            'element' => [
                [
                    'selector' => '#contentHtml',
                    'html' => $grid
                ]
            ]                
        ];
        header("Content-type: application/json; charset=utf-8");
        echo json_encode($response); 
	}
} ?>