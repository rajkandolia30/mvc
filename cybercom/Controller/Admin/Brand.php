<?php 
namespace Controller\Admin;
class Brand extends \Controller\Core\Admin {
    protected $model = null;

    public function indexAction(){
        $layout = \Mage::getBlock('Block\Admin\Layout');
        $content = $layout->getChild('content');
        $dashBoard = \Mage::getBlock('Block\Admin\Admin\Grid');
        $content->addChild($dashBoard,'dashBoard');
        echo $layout->toHtml();   
    }

    public function setModel(){
        try{
            $this->model = \Mage::getModel('Model\Admin');
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
            $grid = \Mage::getBlock('Block\Admin\Admin\Grid')->toHtml();
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
            $form = \Mage::getBlock('Block\Admin\Admin\Edit')->toHtml();
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
            $admins =  $this->getRequest()->getPost('admin');
            $id =  $this->getRequest()->getGet('id');
            if($id){
                $this->getModel()->adminId = $id;
                $this->getMessage()->setSuccess('Record updated successfully');
            } else {
                $this->getModel()->createdDate = date('Y-m-d');
                $this->getMessage()->setSuccess('Record inserted successfully');
            }
            $this->getModel()->setData($admins); 
            $this->getModel()->save();

            $grid = \Mage::getBlock('Block\Admin\Admin\Grid')->toHtml();
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
            
            $grid = \Mage::getBlock('Block\Admin\Admin\Grid')->toHtml();
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