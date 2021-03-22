<?php
namespace Block\Admin\Cms;
\Mage::loadFileByClassName('Block\Core\Template');
class Edit extends \Block\Core\Template{
    protected $cms = null;
    
    public function __construct(){
        $this->setTemplate('./View/admin/cms/edit.php');
    }

    public function setCms($cms = null){
        if($cms){
            $this->cms;
            return $this;
        }
        $model = \Mage::getModel('Model\Cms');
        if($id = $this->getRequest()->getGet('id')){
            $model->load($id);
        }
        $this->cms = $model;
        return $this;
    }

    public function getCms(){
        if(!$this->cms){
            $this->setCms();
        }
        return $this->cms;
    }
    
    public function getStatusOption(){
        $model = \Mage::getModel('Model\Cms');
        return $model->getStatusOption();      
    }
}

?>