<?php 
namespace Model\Attribute;
\Mage::loadFileByClassName('Model\Core\Table');
class Option extends \Model\Core\Table{
 	
 	public function __construct(){
 		$this->setPrimaryKey('optionId');
 		$this->setTableName('attributeOption');
 	}

 	public function fetchOption($id){
 		$query = "SELECT * FROM `attributeoption` WHERE `attributeId` = {$id}";
 		$row = $this->fetchAll($query);
 		return $row;
 	}

 	public function deleteOption($ids){
 		echo $query = "DELETE FROM `attributeoption` WHERE `optionId` NOT IN ($ids) ";
 		$rows = $this->delete($query);
 		//return $rows;
 	}
}?>