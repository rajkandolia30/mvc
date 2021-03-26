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
    	$this->setTableName('attributeOption');
        $id = $this->data['attributeId'];
    	if(!$id){
    		return false;
    	}
		$model = \Mage::getModel($this->backendModel)->setAttribute($this)->getOptions();
    	return $model;
    }
 } ?>