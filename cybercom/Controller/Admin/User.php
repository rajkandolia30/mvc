<?php 
namespace Controller\Admin;
class User extends \Controller\Core\Admin{
	public function testAction(){ 	
		echo '<pre>'; 	
		$query = "SELECT * FROM `product` ORDER BY `productId` ASC";
		$product = \Mage::getModel('Model\Product')->fetchAll();
		$product->name = 'ohk';
		$product->discount = 12;
		print_r($product);			
	}
} ?>