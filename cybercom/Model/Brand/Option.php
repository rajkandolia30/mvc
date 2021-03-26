<?php 
namespace Model\Brand;
\Mage::loadFileByClassName('Model\Attribute\Option');
class Option extends \Model\Attribute\Option{
	
	public function __construct(){
		$this->setPrimaryKey('brandId');
		$this->setTableName('brand');
	}

	public function getOptions(){
		if(!$this->getAttribute()->data['attributeId']){
			return false;
		}
		$query = "SELECT 
			brandId as optionId,
			name as name,
			'{$this->getAttribute()->data['attributeId']}' as attributeId,
			sortOrder
		FROM `brand`
		ORDER BY `sortOrder` ASC";
		$options = \Mage::getModel('Model\Brand')->fetchAll($query);
		if(!$options){
			return null;
		}
		return $options;
	}
} ?>