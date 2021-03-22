<?php 
namespace Controller\Admin;
\Mage::loadFileByClassName('Controller\Core\Admin');
 class ProductMedia extends \Controller\Core\Admin{
 	protected $images = [];
    protected $image = null;
    protected $model = null;
    
    public function setModel(){
        try {
            $this->model = \Mage::getModel('Model\ProductMedia');
            return $this;  
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getModel(){
        try {
            if(!$this->model){
                $this->setModel();
            }
            return $this->model;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    } 

    public function saveAction(){
        $productId    = (int) $this->getRequest()->getGet('id');
        $randomNumber = rand(10000, 99999999);
        $file_name      = $_FILES['file']['name'];
        $newFileName    = $randomNumber . '_' . $productId . '_' . $file_name;
        $extension      = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
        $temp_file_name = $_FILES['file']['tmp_name'];
        $type           = $_FILES['file']['type'];
        $destination    = './Image//';
            if($type == 'image/jpeg' || $type == 'image/jpg' || $type == 'image/png'){
                move_uploaded_file($temp_file_name, $destination . $newFileName);
            }
        $productImageData = [
            'productId' => $productId,
            'label'     => 0,
            'small'     => 0,
            'thumb'     => 0,
            'base'      => 0,
            'gallery'   => 0,
        ];
        $this->getModel()->image = $newFileName;
        $this->getModel()->setData($productImageData);
        $this->getModel()->saveProductImage();
    }

    public function updateAction(){
        $data = $this->getRequest()->getPost('productImage');
        $label = $data['label'];
        $gallery = $data['gallery'];

        if($small = $data['small']){
            $query = "UPDATE `productimage` SET `small` = '0' WHERE `imageId` NOT IN ($small)";
            $model = \Mage::getModel('Model\ProductMedia');
            $model->getAdapter()->update($query);    

            $query = "UPDATE `productimage` SET `small` = 'on' WHERE `imageId` = '{$small}'";
            $model = \Mage::getModel('Model\ProductMedia');
            $model->getAdapter()->update($query);  

        }
        
        if($thumb = $data['thumb']){
            $query = "UPDATE `productimage` SET `thumb` = '0' WHERE `imageId` NOT IN ($thumb)";
            $model = \Mage::getModel('Model\ProductMedia');
            $model->getAdapter()->update($query); 

            $query = "UPDATE `productimage` SET `thumb` = 'on' WHERE `imageId` = '{$thumb}'";
            $model = \Mage::getModel('Model\ProductMedia');
            $model->getAdapter()->update($query);      
        }

        if($base = $data['base']){
            $query = "UPDATE `productimage` SET `base` = '0' WHERE `imageId` NOT IN ($base)";
            $model = \Mage::getModel('Model\ProductMedia');
            $model->getAdapter()->update($query); 

            $query = "UPDATE `productimage` SET `base` = 'on' WHERE `imageId` = '{$base}'";
            $model = \Mage::getModel('Model\ProductMedia');
            $model->getAdapter()->update($query);      
        }

        foreach ($label as $key => $label) {
            $query = "UPDATE `productimage` SET `label` = '{$label}' WHERE `imageId` = '{$key}'";
            $model = \Mage::getModel('Model\ProductMedia');
            $model->getAdapter()->update($query);            
        }

        foreach ($gallery as $key => $value) {
            $query = "UPDATE `productimage` SET `gallery` = 'on' WHERE `imageId` = '{$key}'";
            $model = \Mage::getModel('Model\ProductMedia');
            $model->getAdapter()->update($query);
        }
    }

    public function removeAction(){
        $data = $this->getRequest()->getPost('productImage');
        $remove = $data['remove'];
        foreach ($remove as $key => $remove) {
            print_r($key);
            $query = "DELETE FROM `productimage` WHERE `imageId` = '{$key}'";
            $model = \Mage::getModel('Model\ProductMedia');
            $model->getAdapter()->delete($query); 
        }
        $this->redirect('grid','product');        
    }
}?>