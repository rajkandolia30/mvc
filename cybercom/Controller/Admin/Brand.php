<?php 
namespace Controller\Admin;
class Brand extends \Controller\Core\Admin {
    protected $model = null;

    public function indexAction(){
        $layout = \Mage::getBlock('Block\Admin\Layout');
        $content = $layout->getChild('content');
        $dashBoard = \Mage::getBlock('Block\Admin\Brand\Grid');
        $content->addChild($dashBoard,'dashBoard');
        echo $layout->toHtml();   
    }

    public function setModel(){
        try{
            $this->model = \Mage::getModel('Model\Brand');
            return $this;
        }catch (Exception $e){
            echo $e->getMessage();
        }
    }
    
    public function getModel(){
        try{
            if(!$this->model){
                $this->setModel();
            }
            return $this->model;
        } catch (Exception $e){
            echo $e->getMessage();
        }
    }

    public function gridAction(){
        try {
            $grid = \Mage::getBlock('Block\Admin\Brand\Grid')->toHtml();
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
            $form = \Mage::getBlock('Block\Admin\Brand\Edit')->toHtml();
            $response = [
                'element' =>
                    [
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
            $brand =  $this->getRequest()->getPost('brand');
            $id =  $this->getRequest()->getGet('id');
            if($id){
                $this->getModel()->brandId = $id;
                $this->getMessage()->setSuccess('Record updated successfully');
            } else {
                $this->getModel()->createdDate = date('Y-m-d');
                $this->getMessage()->setSuccess('Record inserted successfully');
            }
            $this->getModel()->setData($brand); 
            $this->getModel()->save();

            $grid = \Mage::getBlock('Block\Admin\Brand\Grid')->toHtml();
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
            
            $grid = \Mage::getBlock('Block\Admin\Brand\Grid')->toHtml();
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