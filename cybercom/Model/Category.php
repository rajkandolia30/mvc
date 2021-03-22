<?php
namespace Model;
\Mage::loadFileByClassName('Model\Core\Table');
class Category extends \Model\Core\Table{
    public function __construct(){
        $this->setTableName('category');
        $this->setPrimaryKey('categoryId'); 
    }
    public function getStatusOption(){
        return [
            "Disable" => "Disable",
            "Enable" => "Enable"
        ];
    }

    public function updatePathId(){
        if (!$this->parentId) {
            $pathId = $this->categoryId;
        }
        else {
            $parent = \Mage::getModel('Model\Category')->load($this->parentId);
            if(!$parent){
                throw new Exception("Unable to load parent");
            }
            $pathId = $parent->pathId.'='.$this->categoryId;
        }
        $this->pathId = $pathId;
        return $this->save();
    }

    public function updateChildrenPathIds($categoryPathId, $parentId = null, $categoryId = null){
        $category=\Mage::getModel("Model\Category");
        $categoryPathId = $categoryPathId."=";
        $query = "SELECT * FROM `category` WHERE `pathId` LIKE '{$categoryPathId}%' ORDER BY `pathId` ASC";
        $categories = $category->getAdapter()->fetchAll($query);
        if ($categories) {
            foreach ($categories as $key => $row) {
                $row = \Mage::getModel("Model\Category")->load($row['categoryId']);
                    if ($parentId != null) {
                        if($row->parentId == $categoryId) {
                            $row->parentId = $parentId;
                        }
                    }
                $row->updatePathId();
            }
        }
    }
}?>