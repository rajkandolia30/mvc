<?php
namespace Block\Admin\Payment;
\Mage::loadFileByClassName('Block\Core\Template');
class Edit extends \Block\Core\Template{
    protected $payment = null;
    
    public function __construct(){
        $this->setTemplate('./View/admin/payment/edit.php');
    }
    
    public function setPayment($payment = null){
        if($payment){
            $this->payment;
            return $this;
        }
        $model = \Mage::getModel('Model\Payment');
        if($id = $this->getRequest()->getGet('id')){
            $model->load($id);
        }
        $this->payment = $model;
        return $this;
    }

    public function getPayment(){
        if(!$this->payment){
            $this->setPayment();
        }
        return $this->payment;
    }
    
    public function getStatusOption(){
        $model = \Mage::getModel('Model\Payment');
        return $model->getStatusOption();      
    }
}

?>