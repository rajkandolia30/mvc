<?php
namespace Block\Admin\Shipping;
\Mage::loadFileByClassName('Block\Core\Template');
class Edit extends \Block\Core\Template{
    protected $shipping = null;

    public function __construct(){
        $this->setTemplate('./View/admin/shipping/edit.php');
    }

    public function setShipping($shipping = null){
        if($shipping){
            $this->shipping;
            return $this;
        }
        $model = \Mage::getModel('Model\Shipping');
        if($id = $this->getRequest()->getGet('id')){
            $model->load($id);
        }
        $this->shipping = $model;
        return $this;
    }

    public function getShipping(){
        if(!$this->shipping){
            $this->setShipping();
        }
        return $this->shipping;
    }
    
    public function getStatusOption(){
        $model = \Mage::getModel('Model\Shipping');
        return $model->getStatusOption();      
    }
    
}

?>