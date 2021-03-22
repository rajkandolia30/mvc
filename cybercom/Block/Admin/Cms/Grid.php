<?php
namespace Block\Admin\Cms;
\Mage::loadFileByClassName('Block\Admin\Grid');
class Grid extends \Block\Admin\Grid{

    public function __construct(){
        parent::__construct();
    }

    public function setCollection($collection = null) {
        if(!$collection){
            $collectionModel = \Mage::getModel('Model\Cms');
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
        $this->addColumn('pageId',[
            'field' => 'pageId',
            'label' => 'Page Id',
            'type' => 'number'
        ]);
        $this->addColumn('title',[
            'field' => 'title',
            'label' => 'Title',
            'type' => 'varchar'
        ]);        
        $this->addColumn('identifier',[
            'field' => 'identifier',
            'label' => 'Identifier',
            'type' => 'varchar'
        ]);        
        $this->addColumn('content',[
            'field' => 'content',
            'label' => 'Content',
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
        $url = $this->getUrl()->getUrl('form',null,['id' => $row->pageId]);
        return "object.setUrl('{$url}').resetParams().load()";
    }

    public function getDeleteUrl($row){
        $url = $this->getUrl()->getUrl('delete',null,['id' => $row->pageId]);
        return "object.setUrl('{$url}').resetParams().load()";
    }
    
    public function getTitle(){
        return 'Cms';
    }

    public function prepareButtons(){
        $this->addButton('addNew',[
            'label' => 'Add Cms',
            'method' => 'getAddNewUrl'
        ]);
        return $this;
    }
}?>