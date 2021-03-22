<?php 
namespace Block\Admin\Product\Edit\Tabs;
\Mage::loadFileByClassName('Block\Core\Template');
class GroupPrice extends \Block\Core\Template{
 	protected $price = null;
 	protected $customerGroups = null;

 	public function __construct(){
		parent::__construct();
 		$this->setTemplate('./View/admin/product/form/tabs/groupPrice.php');
 	}

 	public function setPrice($price = null){
 		if(!$this->price){
 			$groupPrice = \Mage::getModel('Model\Product\GroupPrice');
 			$product = \Mage::getModel('Model\Product');
 			$id = $this->getRequest()->getGet('id');
 			$product->load($id);
 			$row = $product->price;
 			$price = $groupPrice->fetchPrice($id, $row);
 		}
 		$this->price = $price;
 		return $this;
 	}

 	public function getPrice(){
 		if(!$this->price){
 			$this->setPrice();
 		}
 		return $this->price;
 	}
 	
 	/*public function getCustomerGroup(){
 		$query = "
 		SELECT cg.*,pgp.productId,pgp.entityId,pgp.groupPrice
 		if(p.price IS NULL, '{$this->getProduct()->price}',p.price)
 		FROM `customerGroup` as cg
 		LEFT JOIN productGroupPrice as pgp
 			ON pgp.groupId = cg.customerGroupId
 				AND pgp.productId = '{$this->getProduct()->productId}'
 		LEFT JOIN product as p
 			ON pgp.productId = p.productId
 			";

 		$customerGroups = \Mage::getModel('Model\CustomerGroup');
 		$this->customerGroups = $customerGroups->fetchAll($query);
 		return $this->customerGroups;
 	}*/
 } ?>