<?php
namespace Block\Admin\Customer\Edit\Tabs; 
\Mage::loadFileByClassName('Block\Core\Template');
class Form extends \Block\Core\Template{
	protected $customer = null;
    protected $customerGroups = [];


	public function __construct(){
		parent::__construct();
		$this->setTemplate('./View/admin/customer/form/tabs/form.php');
	}

	public function setCustomer($customer = null){
        if($customer){
            $this->customer;
            return $this;
        }
        $model = \Mage::getModel('Model\Customer');
        if($id = $this->getRequest()->getGet('id')){
            $model->load($id);
        }
        $this->customer = $model;
        return $this;
    }

    public function getCustomer(){
        if(!$this->customer){
            $this->setCustomer();
        }
        return $this->customer;
    }
    
    public function getStatusOption(){
        $model = \Mage::getModel('Model\Customer');
        return $model->getStatusOption();      
    }

    public function getCustomerGroups(){
        if(!$this->customerGroups){
            $this->setCustomerGroups();
        }
        return $this->customerGroups;
    }
    public function setCustomerGroups($customerGroups = null) {
        if(!$customerGroups){
            $customerGroup = \Mage::getModel('Model\CustomerGroup');
            $customerGroups = $customerGroup->fetchAll();
        }
        $this->customerGroups = $customerGroups;
        return $this;
    }
} ?>