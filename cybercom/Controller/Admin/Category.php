<?php
namespace Controller\Admin;
\Mage::loadFileByClassName('Controller\Core\Admin');
class Category extends \Controller\Core\Admin{
    protected $model = null;

    public function setModel(){
        try {
            $this->model = \Mage::getModel('Model\Category');
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
            $grid = \Mage::getBlock('Block\Admin\Category\Grid')->toHtml();
            $response = [
                'element' => [
                    [
                        'selector' => null,
                        'html' => null
                    ],
                    [
                        'selector' => '#contentHtml',
                        'html' => $grid
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
            $category =  \Mage::getModel('Model\Category');
            $id =  $this->getRequest()->getGet('id');
            $category->load($id);
            $form = \Mage::getBlock('Block\Admin\Category\Edit');
            $form->setTableRow($category);
            $tabs =  \Mage::getBlock('Block\Admin\Category\Edit\Tabs');
            $form = $form->toHtml();
            $response = [
                'element' =>
                    [
                        [
                            'selector' => '#tab',
                            'html' => $tabs
                        ],
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
            $category = \Mage::getModel('Model\Category');
            if(!$this->getRequest()->isPost()){
                throw new \Exception ("Invalid Request");
            }

            if ($id = $this->getRequest()->getGet('id')) {
                $category = $category->load($id);
                $pathId = $category->pathId;
                if (!$category){
                    throw new \Exception ("Records not found.");
                }
                $categoryData = $this->getRequest()->getPost('category'); 
                $category->setData($categoryData);
                $pathId = $category->pathId;
                $category->updatePathId();
                $category->updateChildrenPathIds($pathId);
            }
            else {
                $categoryData = $this->getRequest()->getPost('category'); 
                $category->setData($categoryData);
                $id = $category->save();
                $category->load($id);
                $category->updatePathId();
            }
            $this->getMessage()->setSuccess('Record Inserted Successfully.');        
            
            $grid = \Mage::getBlock('Block\Admin\Category\Grid')->toHtml();
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

    public function deleteAction(){
        try{
            $category = \Mage::getModel('Model\Category');
            $categoryId = $this->getRequest()->getGet('id');
            if ($categoryId) {
                $category = $category->load($categoryId);
                if(!$category){
                    throw new Exception("Invalid id.");
                }
            }
            $pathId = $category->pathId;
            $parentId = $category->parentId;
            $category->updateChildrenPathIds($pathId, $parentId, $categoryId);
            $category->delete();

            $grid = \Mage::getBlock('Block\Admin\Category\Grid')->toHtml();
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