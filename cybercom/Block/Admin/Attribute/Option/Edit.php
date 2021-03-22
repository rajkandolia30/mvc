<?php 
namespace Block\Admin\Attribute\Option;
\Mage::loadFileByClassName('Block\Core\Template');
class Edit extends \Block\Core\Template{
 	protected $attributeOption = null;

 	public function __construct(){
 		$this->setTemplate('./View/admin/attributes/option/edit.php');
 	}

 	public function setAttributeOption($attributeOption = null){
 		if(!$attributeOption){
 			$attributeOption = \Mage::getModel('Model\Attribute\Option');
 			$id = $this->getRequest()->getGet('id');
 			if($id){
 				$attributeOption = $attributeOption->fetchOption($id);
 			}
 		}
 		$this->attributeOption = $attributeOption;
 		return $this;
 	}

 	public function getAttributeOption(){
 		if(!$this->attributeOption){
 			$this->setAttributeOption();
 		}
 		return $this->attributeOption;
 	}
}?>
 