<?php
namespace Block\Admin\CustomerGroup;
\Mage::loadFileByClassName('Block\Core\Template');
class Edit extends \Block\Core\Template{
    protected $customerGroup = null;
    
    public function __construct(){
        $this->setTemplate('./View/admin/customerGroup/edit.php');
    }

    public function setCustomerGroup($customerGroup = null){
        if($customerGroup){
            $this->customerGroup;
            return $this;
        }
        $model = \Mage::getModel('Model\CustomerGroup');
        if($id = $this->getRequest()->getGet('id')){
            $model->load($id);
        }
        $this->customerGroup = $model;
        return $this;
    }

    public function getCustomerGroup(){
        if(!$this->customerGroup){
            $this->setCustomerGroup();
        }
        return $this->customerGroup;
    }
    
    public function getStatusOption(){
        $model = \Mage::getModel('Model\CustomerGroup');
        return $model->getStatusOption();      
    }
}

?>