<?php
namespace Block\Admin\Config\Group\Edit\Tabs;
class Config extends \Block\Core\Template{
	public $configGroup = null;

  	public function __construct(){
    	$this->setTemplate('./View/admin/config/group/form/tabs/config.php');
  	}

	public function setConfigGroup($configGroup = null){
        if($configGroup){
            $this->configGroup;
            return $this;
        }            
        $configGroup = \Mage::getModel('Model\Config\Group');
            if($id = $this->getRequest()->getGet('id')){
                $configGroup = $configGroup->load($id);               
            }
            $this->configGroup = $configGroup;              
        return $this;
    }

    public function getConfigGroup(){
        if(!$this->configGroup){
            $this->setConfigGroup();
        }
        return $this->configGroup;
    }

	
}?>