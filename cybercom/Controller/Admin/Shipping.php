<?php
namespace Controller\Admin;
\Mage::loadFileByClassName('Controller\Core\Admin');
class Shipping extends \Controller\Core\Admin{
    protected $shippings = [];
    protected $shipping = null;
    protected $model = null;

    public function setModel(){
        try {
            $this->model = \Mage::getModel('Model\Shipping');
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

    public function gridAction(){
       try {
            $grid = \Mage::getBlock('Block\Admin\Shipping\Grid')->toHtml();
            $response = [
                'element' => [
                    [
                        'selector' => '#contentHtml',
                        'html' => $grid,
                    ]
                ]
            ];
            header("Content-type: application/json; charset=utf-8");
            echo json_encode($response);
        } catch (Exception $e) {
            echo $e->getMessage();
        }      
    }
    public function formAction(){
        try{
            $form = \Mage::getBlock('Block\Admin\Shipping\Edit')->toHtml();
            $response = [
                'element' => [
                    [
                        'selector' => '#contentHtml',
                        'html' => $form,
                    ]
                ]
            ];
            header("Content-type: application/json; charset=utf-8");
            echo json_encode($response);
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }
    
    public function saveAction(){
        try{
            if(!$this->getRequest()->isPost()){
                throw new Exception("Invalid request");
            }
            $id =  $this->getRequest()->getGet('id');
            $shippings =  $this->getRequest()->getPost('shipping');
            if($id){
                $this->getModel()->methodId = $id;
                $this->getMessage()->setSuccess('Record updated successfully!!!');
            } else {
                $this->getModel()->createdAt = date("Y-m-d");
                $this->getMessage()->setSuccess('Record inserted successfully!!!');
            }
            $this->getModel()->setData($shippings);
            $this->getModel()->save();

            $grid = \Mage::getBlock('Block\Admin\Shipping\Grid')->toHtml();
            $response = [
                'element' => [
                    [
                        'selector' => '#contentHtml',
                        'html' => $grid,
                    ]
                ]
            ];
            header("Content-type: application/json; charset=utf-8");
            echo json_encode($response);
        }catch(Exception $e){
            $this->getMessage()->setFailure($e->getMessage());
        }
    }

    public function deleteAction(){
        try{
            $id = $this->getRequest()->getGet('id');
            if(!$id){
                throw new Exception("ID invalid.");
            }            
            $delete = $this->getModel()->delete($id);
            if(!$delete){
                $this->getMessage()->setFailure('Enable to delete record!!');
            } else {
                
                $this->getMessage()->setSuccess('Record deleted successfully!!!');
            }

            $grid = \Mage::getBlock('Block\Admin\Shipping\Grid')->toHtml();
            $response = [
                'element' => [
                    [
                        'selector' => '#contentHtml',
                        'html' => $grid,
                    ]
                ]
            ];
            header("Content-type: application/json; charset=utf-8");
            echo json_encode($response);
        }catch(Exception $e){
            $this->getMessage()->setFailure($e->getMessage());
        }
    }
}
?>
