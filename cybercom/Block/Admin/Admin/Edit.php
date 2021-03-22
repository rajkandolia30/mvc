<?php
namespace Block\Admin\Admin;
\Mage::loadFileByClassName('Block\Core\Template');
class Edit extends \Block\Core\Template{
	protected $admin = null;

	public function __construct(){
		$this->setTemplate('./View/admin/admin/edit.php');
	}

    public function setAdmin($admin = null){
        if($admin){
            $this->admin;
            return $this;
        }
        $model =\Mage::getModel('Model\Admin');
        if($id = $this->getRequest()->getGet('id')){
            $model->load($id);
        }
        $this->admin = $model;
        return $this;
    }

    public function getAdmin(){
        if(!$this->admin){
            $this->setAdmin();
        }
        return $this->admin;
    }
    
    public function getStatusOption(){
        $model = \Mage::getModel('Model\Admin');
        return $model->getStatusOption();      
    }
}
?>