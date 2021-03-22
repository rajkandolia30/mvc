<?php
namespace Model;
\Mage::loadFileByClassName('Model\Core\Table');
class CustomerAddress extends \Model\Core\Table{
    public function __construct(){
        $this->setTableName('customerAddress');
        $this->setPrimaryKey('addressId');
      }
    public function getStatusOption(){
        return [
            "Disable" => "Disable",
            "Enable" => "Enable"
        ];
    }

    public function saveAddress($action, $id = null){
        if($action == 'update'){
            $param = null;
            foreach ($this->data as $key => $value) {
                    if($key != $this->getPrimaryKey() && $key != 'customerId') {
                        $param.= "`{$key}` = '{$value}',";
                    }
                }
            $param = rtrim($param,",");
            $query = "UPDATE `{$this->getTableName()}` SET {$param} 
            WHERE `customerId` = {$id}";
            $this->getAdapter()->update($query);
            return true;            
        }
    }
}?>