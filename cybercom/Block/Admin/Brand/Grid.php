<?php 
namespace Block\Admin\Brand;
\Mage::loadFileByClassName('Block\Admin\Grid');
class Grid extends \Block\Admin\Grid{

	public function __construct(){
        parent::__construct();
	}

	public function setCollection($collection = null){
		if(!$collection){
			$collectionModel = \Mage::getModel('Model\Brand');
			$collection = $collectionModel->fetchAll();
		}
		$this->collection = $collection;
		return $this;
	}

	public function getCollection(){
		if(!$this->collection){
			$this->setCollection();
		}
		return $this->collection;
	}

	public function prepareColumns(){
        $this->addColumn('brandId',[
            'field' => 'brandId',
            'label' => 'Brand Id',
            'type' => 'number'
        ]);
        $this->addColumn('name',[
            'field' => 'name',
            'label' => 'Name',
            'type' => 'varchar'
        ]);
        $this->addColumn('image',[
            'field' => 'image',
            'label' => 'Image',
            'type' => 'varchar'
        ]);
        $this->addColumn('sortOrder',[
            'field' => 'sortOrder',
            'label' => 'Sort Order',
            'type' => 'number'
        ]);
        $this->addColumn('status',[
            'field' => 'status',
            'label' => 'Status',
            'type' => 'varchar'
        ]);
        return $this;
    }

    public function prepareActions(){
        $this->addAction('edit',[
            'label' => 'Edit',
            'method' => 'getEditUrl'
        ]);
        $this->addAction('delete',[
            'label' => 'Delete',
            'method' => 'getDeleteUrl'
        ]);
        return $this;
    }

    public function getEditUrl($row){
        $url = $this->getUrl()->getUrl('form',null,['id' => $row->brandId]);
        return "object.setUrl('{$url}').resetParams().load()";
    }

    public function getDeleteUrl($row){
        $url = $this->getUrl()->getUrl('delete',null,['id' => $row->brandId]);
        return "object.setUrl('{$url}').resetParams().load()";
    }
    
    public function getTitle(){
        return 'Brands';
    }

    public function prepareButtons(){
        $this->addButton('addNew',[
            'label' => 'New Brand',
            'method' => 'getAddNewUrl'
        ]);
        return $this;
    }
}
 ?>