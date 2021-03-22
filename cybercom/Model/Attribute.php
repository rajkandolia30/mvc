<?php 
namespace Model;
\Mage::loadFileByClassName('Model\Core\Table');
class Attribute extends \Model\Core\Table{
 	protected $attributeId = null;

 	public function __construct(){
 		$this->setPrimaryKey('attributeId');
 		$this->setTableName('attribute');
 	}

 	public function getStatusOption(){
        return [
            "Enable" => "Female",
            "Disable" => "Disable"
        ];
    }
 } ?>