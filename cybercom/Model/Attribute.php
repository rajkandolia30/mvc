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

    public function getOptions(){
    	echo 1;
    	$this->setTableName('attributeOption');
    	if(!$this->attributeId){
    		return false;
    	}
		$model = \Mage::getModel($this->backendModel)->setAttribute($this)->getOptions();
    	return $model;
    }
 } ?>