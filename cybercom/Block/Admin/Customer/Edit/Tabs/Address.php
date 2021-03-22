<?php 
namespace Block\Admin\Customer\Edit\Tabs;
\Mage::loadFileByClassName('Block\Core\Template');
class Address extends \Block\Core\Template{
	protected $customerAddress = null;

	public function __construct(){
		parent::__construct();
		$this->setTemplate('./View/admin/customer/form/tabs/address.php');
	}

	public function getCustomerAddress() {
        if(!$this->customerAddress){
            $this->setCustomerAddress();
        }
        return $this->customerAddress;
    }

    public function setCustomerAddress($customerAddress = null) {
        if(!$customerAddress){
            $customerAddress = \Mage::getModel('Model\CustomerAddress');
            $customerId = $this->getRequest()->getGet('id');
            $query = "SELECT * FROM `customerAddress` WHERE `customerId` = '{$customerId}'";
            $customerAddress = $customerAddress->fetchAll($query);
        }
        $this->customerAddress = $customerAddress;
        return $this;
    }
}?>

