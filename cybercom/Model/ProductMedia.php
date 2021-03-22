<?php
namespace Model;
\Mage::loadFileByClassName('Model\Core\Table'); 
class ProductMedia extends \Model\Core\Table{
 	public function __construct(){
 		$this->setPrimaryKey('imageId');
 		$this->setTableName('productimage');
 	}

    public function saveProductImage(){
        $sql = "INSERT INTO `{$this->getTableName()}` (`".implode('`, `', array_keys($this->data))."`)  VALUES ('".implode('\',\'', array_values($this->data))."');";
        $returnId = $this->getAdapter()->insert($sql);
        $this->load($returnId);
        return true;
    }

 	public function getSmall(){
        return [
        	'small' => 'small'
        ];
    }

    public function getThumb(){
    	return [
    		'thumb' => 'thumb'
    	];
    }

    public function getBase(){
    	return [
    		'base' => 'base'
    	];
    }

    public function getGallary(){
    	return [
    		'gallary' => 'gallary'
    	];
    }

    public function getRemove(){
	   	return [
	   		'remove' => 'remove'
	   	];
    }

    public function getPath($subPath = null){
        return Mage::getBaseDir($subPath);
    }

    public function fetchImage($id){
        $query = "SELECT * FROM `productImage` WHERE `productId` = '{$id}'";
        $data = $this->getAdapter()->fetchAll($query);
        return $data;
    }
 } ?>