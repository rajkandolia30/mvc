<?php 
namespace Block\Admin\Customer\Edit;
\Mage::loadFileByClassName('Block\Admin\Edit\Tabs');
class Tabs extends \Block\Admin\Edit\Tabs{
 	protected $tabs = [];
 	protected $defaultTab = null;
 	protected $customer = null;

 	public function __construct(){
 		parent::__construct();
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
    
 	public function prepareTabs(){
        parent::prepareTabs();
		$this->addTab('customer',['label'=>'customer information','block'=>'Block\Admin\Customer\Edit\Tabs\Form']);
		$this->addTab('address',['label'=>'address','block'=>'Block\Admin\Customer\Edit\Tabs\Address']);
 		$this->setDefaultTab('customer');
 		return $this;
 	}

 	public function setDefaultTab($defaultTab){
 		$this->defaultTab = $defaultTab;
 		return $this;
 	}

 	public function getDefaultTab(){
 		return $this->defaultTab;
 	}

 	public function setTabs(array $tabs = []){
 		$this->tabs = $tabs;
 		return $this;
 	}

 	public function getTabs(){
 		return $this->tabs;
 	}

 	public function setTab($key, $tabs = []){
 		if(!array_key_exists($key, $this->tabs)){
 			return null;
 		}
 		return $this->tabs[$key];
 	}

 	public function getTab($key){
 		if(!array_key_exists($key, $this->tab)){
 			return null;
 		}
 		return $this->tab[$key];
 	}

 	public function addTab($key, $tab = []){
 		$this->tabs[$key] = $tab;
 		return $this;
 	} 	

 	public function removeTab($key){
 		if(!array_key_exists($key, $this->tabs)){
 			unset($this->tabs[$key]);
 		}
 		unset($this->tabs[$key]);
 		return $this;
 	}
 } ?>