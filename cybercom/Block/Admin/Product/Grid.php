<?php
namespace Block\Admin\Product;
\Mage::loadFileByClassName('Block\Admin\Grid');
class Grid extends \Block\Admin\Grid{

    public function __construct(){
        parent::__construct();
    }

    public function setCollection($collection = null) {
        if(!$collection){
            $collectionModel = \Mage::getModel('Model\Product');
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
        $this->addColumn('productId',[
            'field' => 'productId',
            'label' => 'Product Id',
            'type' => 'number'
        ]);
        $this->addColumn('name',[
            'field' => 'name',
            'label' => 'Product Name',
            'type' => 'varchar'
        ]);
        $this->addColumn('price',[
            'field' => 'price',
            'label' => 'Product Price',
            'type' => 'number'
        ]);
        $this->addColumn('quantity',[
            'field' => 'quantity',
            'label' => 'Quantity',
            'type' => 'number'
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
        $this->addAction('addToCart',[
            'label' => 'Add to Cart',
            'method' => 'getAddToCartUrl'
        ]);
        return $this;
    }

    public function getEditUrl($row){
        $url = $this->getUrl()->getUrl('form',null,['id' => $row->productId]);
        return "object.setUrl('{$url}').resetParams().load()";
    }

    public function getDeleteUrl($row){
        $url = $this->getUrl()->getUrl('delete',null,['id' => $row->productId]);
        return "object.setUrl('{$url}').resetParams().load()";
    }

    public function getAddToCartUrl($row){
        $url = $this->getUrl()->getUrl('addToCart','Admin\Cart',['id' => $row->productId]);
        return "object.setUrl('{$url}').resetParams().load()";
    }
    
    public function getTitle(){
        return 'Manage Products';
    }

    public function prepareButtons(){
        $this->addButton('addNew',[
            'label' => 'Add Product',
            'method' => 'getAddNewUrl'
        ]);
        return $this;
    }
}?>