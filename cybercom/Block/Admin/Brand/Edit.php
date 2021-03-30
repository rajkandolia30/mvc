<?php
namespace Block\Admin\Brand;
\Mage::loadFileByClassName('Block\Core\Template');
class Edit extends \Block\Core\Template{
	protected $brand = null;

	public function __construct(){
		$this->setTemplate('./View/admin/brand/edit.php');
	}

    public function setBrand($brand = null){
        if($brand){
            $this->brand;
            return $this;
        }
        $model =\Mage::getModel('Model\Brand');
        if($id = $this->getRequest()->getGet('id')){
            $model->load($id);
        }
        $this->brand = $model;
        return $this;
    }

    public function getBrand(){
        if(!$this->brand){
            $this->setBrand();
        }
        return $this->brand;
    }
    
    public function getStatusOption(){
        $model = \Mage::getModel('Model\Brand');
        return $model->getStatusOption();      
    }
}
?>