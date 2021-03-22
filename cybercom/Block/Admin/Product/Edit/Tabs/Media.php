<?php 
namespace Block\Admin\Product\Edit\Tabs;
\Mage::loadFileByClassName('Block\Core\Template');
class Media extends \Block\Core\Template{
	protected $images = null;
	
	public function __construct(){
		parent::__construct();
		$this->setTemplate('./View/admin/product/form/tabs/media.php');
	}

    public function setImages($images = null){
        if($images){
            $this->images;
            return $this;
        }
        $model = \Mage::getModel('Model\ProductMedia');
        if($id = $this->getRequest()->getGet('id')){
            $images = $model->fetchImage($id);
        }
        $this->images = $images;
        return $this;
    }

    public function getImages(){
        if(!$this->images){
            $this->setImages();
        }
        return $this->images;
    }
} ?>