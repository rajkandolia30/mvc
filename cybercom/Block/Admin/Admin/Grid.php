<?php 
namespace Block\Admin\Admin;
\Mage::loadFileByClassName('Block\Admin\Grid');
class Grid extends \Block\Admin\Grid{

	public function __construct(){
        parent::__construct();
	}

	public function setCollection($collection = null){
		if(!$collection){
			$collectionModel = \Mage::getModel('Model\Admin');
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
        $this->addColumn('adminId',[
            'field' => 'adminId',
            'label' => 'Admin Id',
            'type' => 'number'
        ]);
        $this->addColumn('userName',[
            'field' => 'userName',
            'label' => 'Name',
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
        $url = $this->getUrl()->getUrl('form',null,['id' => $row->adminId]);
        return "object.setUrl('{$url}').resetParams().load()";
    }

    public function getDeleteUrl($row){
        $url = $this->getUrl()->getUrl('delete',null,['id' => $row->adminId]);
        return "object.setUrl('{$url}').resetParams().load()";
    }
    
    public function getTitle(){
        return 'Admins';
    }

    public function prepareButtons(){
        $this->addButton('addNew',[
            'label' => 'New Admin',
            'method' => 'getAddNewUrl'
        ]);
        return $this;
    }
}
 ?>