<?php 
namespace Controller\Admin\Product;
\Mage::loadFileByClassName('Controller\Core\Admin');
class GroupPrice extends \Controller\Core\Admin{
	
	public function saveAction(){
		$groupData = $this->getRequest()->getPost('productGroupPrice');
		$productId =  $this->getRequest()->getGet('id');
		if($groupData['exist']){
			foreach($groupData['exist'] as $groupId => $price){
				$query = "SELECT * 
				FROM `productGroupPrice`
				WHERE `productId` = '{$productId}'
				AND `groupId` = '{$groupId}'";
				$productGroupPrice = \Mage::getModel('Model\Product\GroupPrice');
				$productGroupPrice->fetchRow($query);
				$productGroupPrice->groupPrice = $price;
				$productGroupPrice->save();
			}			
		}
		if($groupData['new']){
			foreach ($groupData['new'] as $groupId => $price){
				$productGroupPrice = \Mage::getModel('Model\Product\GroupPrice');
				$productGroupPrice->groupId = $groupId;
				$productGroupPrice->productId = $productId;
				$productGroupPrice->groupPrice = $price;
				$productGroupPrice->save();
			}			
		}
	}
 } ?>