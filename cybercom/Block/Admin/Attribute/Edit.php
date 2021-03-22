<?php 
namespace Block\Admin\Attribute;
\Mage::loadFileByClassName('Block\Core\Template');
class Edit extends \Block\Core\Template{
 	protected $attribute = null;

 	public function __construct(){
 		$this->setTemplate('./View/admin/attributes/edit.php');
 	}

 	public function setAttribute($attribute = null){
 		if(!$attribute){
 			$attribute = \Mage::getModel('Model\Attribute');
 			$id = $this->getRequest()->getGet('attribute');
 			if($id){
 				$attribute = $atttibute->load($id);
 			}
 		}
 		$this->attribute = $attribute;
 		return $this;
 	}

 	public function getAttribute(){
 		if(!$this->attribute){
 			$this->setAttribute();
 		}
 		return $this->attribute;
 	}

    public function getBackendTypeOption(){
    	return [
    		'varchar'=>'Varchar',
    		'int'=>'Int',
    		'decimal'=>'Decimal',
    		'text'=>'Text'
    	];
    }

    public function getInputTypeOption(){
    	return [
    		'text'=>'Text Box',
    		'textarea'=>'Text Area',
    		'select'=>'Select',
    		'checkbox'=>'Checkbox',
    		'radio'=>'Radio'
    	];
    }

    public function getOption(){
    	if(!$this->attributeId){
    		return false;
    	}
    	$query = "SELECT * 
    	FROM `{$this->getTableName()}`
    	ORDER BY `sortOrder` ASC";
    	$options = $this->fetchAll($query);
    	return $option;
    }
 } ?>