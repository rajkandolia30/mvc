<?php 
namespace Controller\Admin;
\Mage::loadFileByClassName('Controller\Core\Admin');
class Config extends \Controller\Core\Admin {
	protected $model = null;

    public function setModel(){
        try{
            $this->model = \Mage::getModel('Model\Config');
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
        $grid = \Mage::getBlock('Block\Admin\Config\Group\Edit\Tabs\Config')->toHtml();
        $response = [
            'element' =>[
                [
                    'selector' => '#contentHtml',
                    'html' => $grid,
                ]
            ]                
        ];
        header("Content-type: application/json; charset=utf-8");
        echo json_encode($response);
    }

    public function saveAction(){
        try{
            $groupId = $this->getRequest()->getGet('id');
            $existData = $this->getRequest()->getPost('exist');
            $newData = $this->getRequest()->getPost('new');
            
            if($newData){
                foreach ($newData['title'] as $key => $value){ 
                    $model = \Mage::getModel('Model\Config');
                    $model->title = $newData['title'][$key];
                    $model->code = $newData['code'][$key];
                    $model->value = $newData['value'][$key];
                    $model->groupId = $groupId;
                    $model->createdDate = date("Y-m-d H:i:s");
                    $model->save();              
                }     
            }

            if($existData){
                foreach ($existData as $key => $value) 
                {
                  $id[]=$key;
                }
                $config = \Mage::getModel('Model\Config');
                $id=implode(",",$id);
                $query="DELETE FROM `{$config->getTableName()}` WHERE `{$config->getPrimaryKey()}` NOT IN ({$id}) AND `groupId`={$groupId}";
                $config->getAdapter()->delete($query); 

                foreach ($existData as $key => $value){
                    $model = \Mage::getModel('Model\Config');
                    $model->configId = $key;
                    $model->title = $value['title'];
                    $model->code = $value['code'];
                    $model->value = $value['value'];
                    $model->save();
                }  
            }
        }catch(Exception $e){
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->redirect('grid');
    }
}
 ?>