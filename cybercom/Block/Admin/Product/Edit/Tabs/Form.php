<?php 
namespace Block\Admin\Product\Edit\Tabs;
\Mage::loadFileByClassName('Block\Core\Template');
class Form extends \Block\Core\Template{
	protected $product = null;

	public function __construct(){
		parent::__construct();
		$this->setTemplate('./View/admin/product/form/tabs/form.php');
	}

	public function setProduct($product = null){
        if($product){
            $this->product;
            return $this;
        }
        $model = \Mage::getModel('Model\Product');
        if($id = $this->getRequest()->getGet('id')){
            $model->load($id);
        }
        $this->product = $model;
        return $this;
    }

    public function getProduct(){
        if(!$this->product){
            $this->setProduct();
        }
        return $this->product;
    }
    
    public function getStatusOption(){
        $model = \Mage::getModel('Model\Product');
        return $model->getStatusOption();      
    }
} ?>