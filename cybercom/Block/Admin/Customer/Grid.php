<?php
namespace Block\Admin\Customer;
\Mage::loadFileByClassName('Block\Admin\Grid');
class Grid extends \Block\Admin\Grid{

    public function __construct(){
        parent::__construct();
    }

    public function setCollection($collection = null) {
        if(!$collection){
            $collectionModel = \Mage::getModel('Model\Customer');
            $collection = $collectionModel->fetchAll();
        }
        $this->collection = $collection;
        return $this;
    }
    
    public function getCollection() {
        if(!$this->collection){
            $this->setCollection();
        }
        return $this->collection;
    }
    
    public function prepareColumns(){
        $this->addColumn('customerId',[
            'field' => 'customerId',
            'label' => 'Customer Id',
            'type' => 'number'
        ]);
        $this->addColumn('groupId',[
            'field' => 'groupId',
            'label' => 'Group Id',
            'type' => 'varchar'
        ]);        
        $this->addColumn('firstName',[
            'field' => 'firstName',
            'label' => 'First Name',
            'type' => 'varchar'
        ]);        
        $this->addColumn('lastName',[
            'field' => 'lastName',
            'label' => 'Last Name',
            'type' => 'varchar'
        ]);     
        $this->addColumn('email',[
            'field' => 'email',
            'label' => 'Email',
            'type' => 'varchar'
        ]);
        $this->addColumn('mobile',[
            'field' => 'mobile',
            'label' => 'Mobile',
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
        $url = $this->getUrl()->getUrl('form',null,['id' => $row->customerId]);
        return "object.setUrl('{$url}').resetParams().load()";
    }

    public function getDeleteUrl($row){
        $url = $this->getUrl()->getUrl('delete',null,['id' => $row->customerId]);
        return "object.setUrl('{$url}').resetParams().load()";
    }
    
    public function getTitle(){
        return 'Customer';
    }

    public function prepareButtons(){
        $this->addButton('addNew',[
            'label' => 'Add Customer',
            'method' => 'getAddNewUrl'
        ]);
        return $this;
    }
}

?>