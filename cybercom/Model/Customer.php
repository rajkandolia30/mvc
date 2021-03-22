<?php
namespace Model;
\Mage::loadFileByClassName('Model\Core\Table');
class Customer extends \Model\Core\Table{
    public function __construct(){
        $this->setTableName('customer');
        $this->setPrimaryKey('customerId');
    }

    public function getStatusOption(){
        return [
            "Disable" => "Disable",
            "Enable" => "Enable"
        ];
    }
}
?>