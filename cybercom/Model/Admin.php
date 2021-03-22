<?php
namespace Model;
\Mage::loadFileByClassName('Model\Core\Table');
class Admin extends \Model\Core\Table{
    public function __construct(){
        $this->setTableName('admin');
        $this->setPrimaryKey('adminId');
    }

    public function getStatusOption(){
        return [
            "Female" => "Female",
            "Male" => "Male"
        ];
    }
}
?>