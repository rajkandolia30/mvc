<?php
namespace Model;
class Brand extends \Model\Core\Table{
    public function __construct(){
        $this->setTableName('brand');
        $this->setPrimaryKey('brandId');
      }
    public function getStatusOption(){
        return [
            "Disable" => "Disable",
            "Enable" => "Enable"
        ];
    }
}
?>