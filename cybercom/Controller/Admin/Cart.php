<?php 
namespace Controller\Admin;
class Cart extends \Controller\Core\Admin{

	public function indexAction(){
		try {
            $grid = \Mage::getBlock('Block\Admin\Cart\Grid');
            $cart = $this->getCart();
            $grid->setCart($cart)->toHtml();
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
			/*$productId = $this->getRequest()->getGet('id');
			$product = \Mage::getModel('Model\product')->load($productId);
			//print_r($productId);
			if(!$product){
				throw new \Exception("No Product found");
				
			}*/
			$cart = $this->getCart();
			//$cart->addItemToCart($product, 1, true);	
			//$this->getMessage()->setSuccess('Item inserted Successfully');		
		} catch (Exception $e) {
			$this->getMessage()->setFailure($e->getMessage());
		}

		$grid = \Mage::getBlock('Block\Admin\Cart\Grid')->toHtml();
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

	public function getCart(){
		try {
			$sessionId = \Mage::getModel('Model\Admin\Session')->getId();
			// print_r($sessionId);
			$cart = \Mage::getModel('Model\Cart');
			$query = "SELECT * FROM `{$cart->getTableName()}` WHERE sessionId = '{$sessionId}'";
			$cart = $cart->fetchRow($query);
			//print_r($cart);
			if($cart){
				//print_r($cart);
				return $cart;
			}
			$cart = \Mage::getModel('Model\Cart');
			$cart->sessionId = $sessionId;
			$cart->createdDate = date("y-m-d H:i:s");
			//print_r($cart);
			$cart->save();
			return $cart;	
		} catch (\Exception $e) {
			$this->getMessage()->setFailure($e->getMessage());	
		}

		$grid = \Mage::getBlock('Block\Admin\Cart\Grid')->toHtml();
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
} ?>