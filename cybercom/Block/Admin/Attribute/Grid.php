<?php 
namespace Block\Admin\Attribute;
\Mage::loadFileByClassName('Block\Admin\Grid');
class Grid extends \Block\Admin\Grid{
 	protected $attribute = [];
    protected $filter = null;
 	public function __construct(){
 		parent::__construct();
 		//$this->setTemplate('./View/admin/attributes/grid.php');	
 	}

 	/*public function setAttributes($attributes = null){
 		if(!$attributes){
 			$attribute = \Mage::getModel('Model\Attribute');
 			$attributes = $attribute->fetchAll();
 		}
 		$this->attributes = $attributes;
 		return $this;
 	}

 	public function getAttributes(){
 		if(!$this->attributes){
 			$this->setAttributes();
 		}
 		return $this->attributes;
 	}*/

 	/*public function setCollection($collection = null){
 		if(!$collection){
 			$collection = \Mage::getModel('Model\Attribute');
 			$collection = $collection->fetchAll();
 		}
 		$this->collection = $collection;
 		return $this;
 	}*/

    public function prepareFilter(){
        $attribute = \Mage::getModel('Model\Attribute');
        $query = "SELECT * FROM `{$attribute->getTableName()}`";
        if($this->getFilter()->hasFilter()){
            $query.= "WHERE 1 = 1";
            foreach ($this->getFilter()->getFilters() as $type => $filters) {
                if($type == 'varchar'){
                    foreach ($filters as $key => $value) {
                        $query.=" AND (`{$key}` LIKE '%{$value}%')";
                    }
                }
                if($type == 'number'){
                    foreach ($filters as $key => $value) {
                        $query.=" AND (`{$key}` LIKE '%{$value}%')";
                    }
                }
            }
        }   
        $attribute = $attribute->fetchAll($query);
        $this->setCollection($attribute);
        return $this;
    }

 	/*public function getCollection(){
 		if(!$this->collection){
 			$this->setCollection();
 		}
 		return $this->collection;        
 	}*/

    public function getFilter(){
        if(!$this->filter){
            $this->filter = \Mage::getModel('Model\Filter');
        }
        return $this->filter;
    }

 	public function prepareColumns(){
        $this->addColumn('attributeId',[
            'field' => 'attributeId',
            'label' => 'Attribute Id',
            'type' => 'number'
        ]);
        $this->addColumn('entityTypeId',[
            'field' => 'entityTypeId',
            'label' => 'Entity Type',
            'type' => 'varchar'
        ]);
         $this->addColumn('name',[
            'field' => 'name',
            'label' => 'Name',
            'type' => 'varchar'
        ]);
          $this->addColumn('code',[
            'field' => 'code',
            'label' => 'Code',
            'type' => 'varchar'
        ]);
           $this->addColumn('inputType',[
            'field' => 'inputType',
            'label' => 'Input Type',
            'type' => 'varchar'
        ]);
            $this->addColumn('backendType',[
            'field' => 'backendType',
            'label' => 'Backend Type',
            'type' => 'varchar'
        ]);
             $this->addColumn('sortOrder',[
            'field' => 'sortOrder',
            'label' => 'Sort Order',
            'type' => 'number'
        ]);
        return $this;
    }

    public function prepareActions(){
        $this->addAction('edit',[
            'label' => 'Show Option',
            'method' => 'getEditUrl'
        ]);
        $this->addAction('delete',[
            'label' => 'Delete',
            'method' => 'getDeleteUrl'
        ]);
        return $this;
    }

    public function getEditUrl($row){
        $url = $this->getUrl()->getUrl('form',null,['id' => $row->attributeId]);
        return "object.setUrl('{$url}').resetParams().load()";
    }

    public function getDeleteUrl($row){
        $url = $this->getUrl()->getUrl('delete',null,['id' => $row->attributeId]);
        return "object.setUrl('{$url}').resetParams().load()";
    }
    
    public function getTitle(){
        return 'Attributes';
    }

    public function prepareButtons(){
        $this->addButton('addNew',[
            'label' => 'Attribute',
            'method' => 'getAddNewUrl'
        ]);
        $this->addButton('filter',[
            'label' => 'filter',
            'method' => 'getFilterUrl'
        ]);
        return $this;
    }

    public function getFilterUrl(){
      return "object.setForm('#gridForm').load()";
    }
 } ?>