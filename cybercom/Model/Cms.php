<?php
namespace Model;
\Mage::loadFileByClassName('Model\Core\Table');
class Cms extends \Model\Core\Table{
    public function __construct(){
        $this->setTableName('cms');
        $this->setPrimaryKey('pageId');
      }
    public function getStatusOption(){
        return [
            "Disable" => "Disable",
            "Enable" => "Enable"
        ];
    }
}
?>