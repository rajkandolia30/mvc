<?php
namespace Model;
\Mage::loadFileByClassName('Model\Core\Table');
class Product extends \Model\Core\Table{
    public function __construct(){
        $this->setTableName('product');
        $this->setPrimaryKey('productId');
      }
    public function getStatusOption(){
        return [
            "Disable" => "Disable",
            "Enable" => "Enable"
        ];
    }
}
?>