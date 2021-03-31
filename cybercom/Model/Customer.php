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

    public function getBillingAddress(){
        $query = "SELECT * 
        FROM `customerAddress` 
        WHERE `addressType` = 'billing'
            AND `customerId` = '{$this->customerId}'";
        $address = \Mage::getModel('Model\Customer')->fetchRow($query);
        return $address;
    }

    public function getShippingAddress(){
        $query = "SELECT * 
        FROM `customerAddress` 
        WHERE `addressType` = 'shipping'
            AND `customerId` = '{$this->customerId}'";
        $address = \Mage::getModel('Model\Customer')->fetchRow($query);
        return $address;
    }
}
?>