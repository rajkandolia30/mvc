<?php 
namespace Block\Admin\Config\Group;
class Grid extends \Block\Core\Template{
    protected $configGroups = [];
    
	public function __construct(){
        parent::__construct();
        $this->setTemplate('./View/admin/config/group/grid.php');
	}

	public function setConfigGroups($configGroups = null){
		if(!$configGroups){
			$configGroupsModel = \Mage::getModel('Model\Config\Group');
			$configGroups = $configGroupsModel->fetchAll();
		}
		$this->configGroups = $configGroups;
		return $this;
	}

	public function getConfigGroups(){
		if(!$this->configGroups){
			$this->setConfigGroups();
		}
		return $this->configGroups;
	}
}
 ?>