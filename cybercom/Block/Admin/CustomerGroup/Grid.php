<?php
namespace Block\Admin\CustomerGroup;
\Mage::loadFileByClassName('Block\Admin\Grid');
class Grid extends \Block\Admin\Grid{

    public function __construct(){
        parent::__construct();
    }

    public function setcollection($collection = null) {
        if(!$collection){
            $collectionModel = \Mage::getModel('Model\CustomerGroup');
            $collection = $collectionModel->fetchAll();
        }
        $this->collection = $collection;
        return $this;
    }

    public function getcollection() {
        if(!$this->collection){
            $this->setcollection();
        }
        return $this->collection;
    }

    public function prepareColumns(){
        $this->addColumn('customerGroupId',[
            'field' => 'customerGroupId',
            'label' => 'Customer Group Id',
            'type' => 'number'
        ]);
        $this->addColumn('name',[
            'field' => 'name',
            'label' => 'Group Name',
            'type' => 'varchar'
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
        $url = $this->getUrl()->getUrl('form',null,['id' => $row->customerGroupId]);
        return "object.setUrl('{$url}').resetParams().load()";
    }

    public function getDeleteUrl($row){
        $url = $this->getUrl()->getUrl('delete',null,['id' => $row->customerGroupId]);
        return "object.setUrl('{$url}').resetParams().load()";
    }
    
    public function getTitle(){
        return 'Customer Group';
    }

    public function prepareButtons(){
        $this->addButton('addNew',[
            'label' => 'Add Group',
            'method' => 'getAddNewUrl'
        ]);
        return $this;
    }
}?>