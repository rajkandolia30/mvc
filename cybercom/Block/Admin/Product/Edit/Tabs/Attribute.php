<?php 
namespace Block\Admin\Product\Edit\Tabs;
\Mage::loadFileByClassName('Block\Core\Template');
class Attribute extends \Block\Core\Template{
 	protected $attribute = null;
 	protected $options = null;
 	
 	public function __construct(){
		parent::__construct();
 		$this->setTemplate('./View/admin/product/form/tabs/attribute.php');
 	}

 	public function setAttribute($attribute = null){
 		if(!$attribute){
 			$attribute = \Mage::getModel('Model\Attribute\Option');
 			$query = "SELECT * FROM `{$attribute->getTableName()}` ORDER BY `sortOrder` ASC";
 			$attribute = $attribute->fetchAll($query);
 			$this->attribute = $attribute;
 		}
 	}

 	public function getAttribute(){
 		if(!$this->attribute){
 			$this->setAttribute();
 		}
 		return $this->attribute;
 	}

 	public function setOptions($options = null){
 		if(!$options){
 			$options = \Mage::getModel('Model\Attribute\Option');
 			$query = "SELECT * FROM `{$options->getTableName()}` ORDER BY `sortOrder` ASC";
 			$options = $options->fetchAll($query);
 			$this->options = $options;
 		}
 	}

 	public function getOptions(){
 		if(!$this->options){
 			$this->setOptions();
 		}
 		return $this->options;
 	}

 	/*public function setAttributeOption($attibuteOption = null){
 		if(!$this->attributeOption){
 			$attributeOption = \Mage::getModel('Model\Attribute\Option');
 			$id = $this->getRequest()->getGet('id');
 			if($id){
 				$attributeOption = $attributeOption->load($id);
 			}
 		}
 		$this->attributeOption = $attributeOption;
 		return $this;
 	}*/
 }?>