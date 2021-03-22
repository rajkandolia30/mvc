<?php
namespace Model;
\Mage::loadFileByClassName('Model\Core\Table');
class CustomerGroup extends \Model\Core\Table{
    public function __construct(){
        $this->setTableName('customerGroup');
        $this->setPrimaryKey('customerGroupId');
      }
    public function getStatusOption(){
        return [
            "Disable" => "Disable",
            "Enable" => "Enable"
        ];
    }
}?>