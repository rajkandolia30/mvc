<?php
namespace Block\Admin\Admin;
\Mage::loadFileByClassName('Block\Core\Template');
class Edit extends \Block\Core\Template{
	protected $configGroup = null;

	public function __construct(){
		$this->setTemplate('./View/admin/config/group/edit.php');
	}

    public function setConfigGroup($configGroup = null){
        if($configGroup){
            $this->configGroup;
            return $this;
        }
        $model =\Mage::getModel('Model\Config\Group');
        if($id = $this->getRequest()->getGet('id')){
            $model->load($id);
        }
        $this->configGroup = $model;
        return $this;
    }

    public function getConfigGroup(){
        if(!$this->configGroup){
            $this->setconfigGroup();
        }
        return $this->configGroup;
    }
}
?>