<?php
namespace Controller\Admin;
\Mage::loadFileByClassName('Controller\Core\Admin');
class CustomerGroup extends \Controller\Core\Admin{
    protected $model = null;

    public function setModel(){
        try{
            $this->model = \Mage::getModel('Model\CustomerGroup');
            return $this;
        } catch (Exception $e) {
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
        try{
            $grid = \Mage::getBlock('Block\Admin\CustomerGroup\Grid')->toHtml();
            $response = [
                'element' => [
                    [
                        'selector'=>'#contentHtml',
                        'html'=>$grid,
                    ]
                ]
            ];
            header("Content-type: application/json; charset=utf-8");
            echo json_encode($response);
        } catch (Exception $e){
            echo $e->getMessage();
        }
    }


    public function formAction(){
        try{    
            $edit =  \Mage::getBlock('Block\Admin\CustomerGroup\Edit')->toHtml();
            $response = [
                'element' => [
                    [
                        'selector'=>'#contentHtml',
                        'html'=>$edit
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
            $customerGroups =  $this->getRequest()->getPost('customerGroup');
            if($id){
                $this->getModel()->customerGroupId = $id;
                $this->getMessage()->setSuccess('Record updated successfully!!!');
            } else {
                $this->getModel()->createdDate = date("Y-m-d");
                $this->getMessage()->setSuccess('Record inserted successfully!!!');
            }
            $this->getModel()->setData($customerGroups);
            $this->getModel()->save();
            $grid = \Mage::getBlock('Block\Admin\CustomerGroup\Grid')->toHtml();
            $response = [
                'element' => [
                    [
                        'selector'=>'#contentHtml',
                        'html'=>$grid
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
            $grid = \Mage::getBlock('Block\Admin\CustomerGroup\Grid')->toHtml();
            $response = [
                'element' => [
                    [
                        'selector'=>'#contentHtml',
                        'html'=>$grid
                    ]
                ]
            ];
            header("Content-type: application/json; charset=utf-8");
            echo json_encode($response);
        }catch(Exception $e){
            $this->getMessage()->setFailure($e->getMessage());
        }
    }
}?>
