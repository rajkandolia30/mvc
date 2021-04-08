<?php 
namespace Controller\Admin\Config;
class Group extends \Controller\Core\Admin{
	protected $model = null;

	public function setModel(){
        try{
    		$this->model = \Mage::getModel('Model\Config\Group');
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
            $grid = \Mage::getBlock('Block\Admin\Config\Group\Grid')->toHtml();
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
            $group = \Mage::getModel('Model\Config\Group');
            $id = $this->getRequest()->getGet('id');
            $group->load($id);
            $edit = \Mage::getBlock('Block\Admin\Config\Group\Edit');
            $edit->setTableRow($group);
            $tabs = \Mage::getBlock('Block\Admin\Config\Group\Edit\Tabs');
            $edit = $edit->toHtml();

            $response = [
                'element' =>
                    [
                        [
                            'selector' => '#contentHtml',
                            'html' => $edit,                    
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
            $configGroup =  $this->getRequest()->getPost('group');
            $id =  $this->getRequest()->getGet('id');
            if($id){
                $this->getModel()->groupId = $id;
                $this->getMessage()->setSuccess('Record updated successfully');
            } else {
                $this->getModel()->createdDate = date('Y-m-d');
                $this->getMessage()->setSuccess('Record inserted successfully');
            }
            $this->getModel()->setData($configGroup); 
            $this->getModel()->save();
        }catch(Exception $e){
            $this->getMessage()->setFailure($e->getMessage());
        }

        $grid = \Mage::getBlock('Block\Admin\Config\Group\Grid')->toHtml();
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
            
            $grid = \Mage::getBlock('Block\Admin\Config\Group\Grid')->toHtml();
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
} ?>