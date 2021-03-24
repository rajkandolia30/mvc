<?php 
namespace Model\Brand;
\Mage::loadFileByClassName('');
class Option extends \Model\Attirbute\Option{
	
	public function __construct(){
		$this->setPrimaryKey('brandId');
		$this->setTableName('brand');
	}

	public function getOptions(){
		echo 3;
		if(!$this->getAttribute()->attributeId){
			return false;
		}
		$query = "SELECT 
			brandId as optionId,
			name as name,
			'{$this->getAttribute()->attributeId}' as attributeId,
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