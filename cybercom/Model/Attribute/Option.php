<?php 
namespace Model\Attribute;
\Mage::loadFileByClassName('Model\Core\Table');
class Option extends \Model\Core\Table{
	protected $attribute = null;
 	
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

 	public function getAttribute(){
 		if(!$this->attribute){
 			$this->setAttribute();
 		}
 		return $this->attribute;
 	}

 	public function setAttribute($attribute){
 		$this->attribute = $attribute;
 		return $this;
 	}

 	public function getOptions(){		
 		if(!$this->getAttribute()->data['attributeId']){
 			return null;
 		}
 		$query = "SELECT * FROM `attributeOption`
 		WHERE `attributeId` = '{$this->getAttribute()->data['attributeId']}'
 		ORDER BY `sortOrder` ASC";
 		$row = $this->fetchAll($query);
 		return $row;
 	}
 		
}?>