<?php 
namespace Controller\Admin;
\Mage::loadFileByClassName('Controller\Core\Admin');
class Attribute extends \Controller\Core\Admin {
	protected $model = null;

	public function setModel(){
        try{
    		$this->model = \Mage::getModel('Model\Attribute');
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
            $grid = \Mage::getBlock('Block\Admin\Attribute\Grid')->toHtml();
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
            $form = \Mage::getBlock('Block\Admin\Attribute\Edit')->toHtml();
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
            $attribute =  $this->getRequest()->getPost('attribute');
            $id =  $this->getRequest()->getGet('id');
            if($id){
                $this->getModel()->attributeId = $id;
                $this->getMessage()->setSuccess('Record updated successfully');
            } else {
                $this->getMessage()->setSuccess('Record inserted successfully');
            }
            $this->getModel()->setData($attribute); 
/*            print_r($attribute);
            die();*/
            $this->getModel()->save();

            $grid = \Mage::getBlock('Block\Admin\Attribute\Grid')->toHtml();
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
            $id = $this->getRequest()->getGet('id');
            if(!$id){
                throw new \Exception("ID invalid.");
            }            
            $delete = $this->getModel()->delete($id);
            if(!$delete){
                $this->getMessage()->setFailure('Enable to delete record!!');
            } else {
                $this->getMessage()->setSuccess('Record deleted successfully!!!');
            }
            
            $grid = \Mage::getBlock('Block\Admin\Attribute\Grid')->toHtml();
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

    public function filterAction(){
        echo 11;
        $filter = $this->getRequest()->getPost('filter');
        print_r($filter);
        die();
        /*$filterModel = \Mage::getModel('Model\Admin\Filter');
        $filterModel->setFilter($filter);*/
        die();
        $grid = \Mage::getBlock('Block\Admin\Attribute\Grid')->toHtml();
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
    }

    public function testAction(){
        echo '<pre>';
        $query = "SELECT * FROM `attribute` WHERE `entityTypeId` = 'product'";
        $attributes = \Mage::getModel("Model\Attribute")->fetchAll($query);
        // print_r($attribute->data);
        foreach($attributes->data as $key => $attribute){
            print_r($attribute->getOptions());
        }

    }
}?>