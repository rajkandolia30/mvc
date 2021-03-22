<?php
namespace Block\Admin\Category;
\Mage::loadFileByClassName('Block\Core\Template');
class Grid extends \Block\Core\Template{
    protected $categoriesOptions = [];
    protected $categories = [];
    public function __construct(){
        parent::__construct();
        $this->setTemplate('./View/admin/category/grid.php');
    }

    public function setCategories($categories = null) {
        if(!$categories){
            $categoriesModel= \Mage::getModel('Model\category');
            $categories = $categoriesModel->fetchAll();
        }
        $this->categories = $categories;
        return $this;
    }

    public function getCategories() {
        if(!$this->categories){
            $this->setCategories();
        }
        return $this->categories;
    }
    
    public function getName($category){
        $categoryModel = \Mage::getModel('Model\Category');
        if (!$this->categoriesOptions){
            $query = "SELECT `categoryId`,`name` FROM `{$categoryModel->getTableName()}`;";
            $this->categoriesOptions = $categoryModel->getAdapter()->fetchPairs($query);
        }
        $pathIds = explode('=', $category->pathId);
        foreach($pathIds as $key => &$id){
            if(array_key_exists($id, $this->categoriesOptions)){
                $pathIds[$key] = $this->categoriesOptions[$id];
            }
        }
        $name = implode("/", $pathIds);
        return $name;
    }
    
    /*public function setCollection($collection = null) {
        if(!$collection){
            $collectionModel= \Mage::getModel('Model\Category');
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
        $this->addColumn('categoryId',[
            'field' => 'categoryId',
            'label' => 'Category Id',
            'type' => 'number'
        ]);
        $this->addColumn('parentId',[
            'field' => 'parentId',
            'label' => 'Parent Id',
            'type' => 'number'
        ]);
        $this->addColumn('pathId',[
            'field' => 'pathId',
            'label' => 'Path Id',
            'type' => 'number'
        ]);
        $this->addColumn('name',[
            'field' => 'name',
            'label' => 'Name',
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
        $url = $this->getUrl()->getUrl('form',null,['id' => $row->categoryId]);
        return "object.setUrl('{$url}').resetParams().load()";
    }

    public function getDeleteUrl($row){
        $url = $this->getUrl()->getUrl('delete',null,['id' => $row->categoryId]);
        return "object.setUrl('{$url}').resetParams().load()";
    }
    
    public function getTitle(){
        return 'Category';
    }

    public function prepareButtons(){
        $this->addButton('addNew',[
            'label' => 'Add category',
            'method' => 'getAddNewUrl'
        ]);
        return $this;
    }*/
}?>