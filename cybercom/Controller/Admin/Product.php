<?php
namespace Controller\Admin;
\Mage::loadFileByClassName('Controller\Core\Admin');
class Product extends \Controller\Core\Admin{
    protected $products = [];
    protected $product = null;
    protected $model = null;
    
    public function setModel(){
        try {
            $this->model = \Mage::getModel('Model\product');
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
            $grid = \Mage::getBlock('Block\Admin\Product\Grid')->toHtml();
            $response =  [
                'element' => [
                    [
                        'selector' => '#tab',
                        'html' => null,
                    ],
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
            $product = \Mage::getModel('Model\Product');
            $id = $this->getRequest()->getGet('id');
            $product->load($id);
            $form = \Mage::getBlock('Block\Admin\Product\Edit');
            $form->setTableRow($product);
            $tabs =  \Mage::getBlock('Block\Admin\Product\Edit\Tabs');
            $form = $form->toHtml();
            $response = [
                'element' =>
                    [
                        [
                            'selector' => '#contentHtml',
                            'html' => $form,                    
                        ],
                        [
                            'selector' => '#tab',
                            'html' => $tabs
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
            $products =  $this->getRequest()->getPost('product');
            $id =  $this->getRequest()->getGet('id');
            if($id){
                $this->getModel()->updatedAt = date("Y-m-d");
                $this->getModel()->productId = $id;
                $this->getMessage()->setSuccess('Record updated successfully');
            } else {
                $this->getModel()->createdAt = date("Y-m-d");
                $this->getMessage()->setSuccess('Record inserted successfully');
            }
            $this->getModel()->setData($products); 
            $this->getModel()->save();            

            $grid = \Mage::getBlock('Block\Admin\Product\Grid')->toHtml();
            $response = [
                'element' => [
                        [
                            'selector' => '#contentHtml',
                            'html' => $grid,                    
                        ],
                        [
                            'selector' => null,
                            'html' => null
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

            $grid = \Mage::getBlock('Block\Admin\Product\Grid')->toHtml();
            $response = [
                'element' => [
                    [
                        'selector' => '#tab',
                        'html' => null,
                    ],
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
}?>