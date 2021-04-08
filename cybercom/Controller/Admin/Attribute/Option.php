<?php 
namespace Controller\Admin\Attribute;
\Mage::loadFileByClassName('Controller\Core\Admin');
class Option extends \Controller\Core\Admin {
	protected $model = null;

	public function setModel(){
        try{
    		$this->model = \Mage::getModel('Model\Attribute\Option');
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
        $grid = \Mage::getBlock('Block\Admin\Attribute\Option\Edit')->toHtml();
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
            $attributeId = $this->getRequest()->getGet('id');
            $existData = $this->getRequest()->getPost('exist');
            $newData = $this->getRequest()->getPost('new');
            
            if($newData){
                foreach ($newData['name'] as $key => $value){
                    $model = \Mage::getModel('Model\Attribute\Option');
                    $model->name = $newData['name'][$key];
                    $model->sortOrder = $newData['sortOrder'][$key];
                    $model->attributeId = $attributeId;
                    $model->save();
                }     
            }

            if($existData){
                foreach ($existData as $key => $value) 
                {
                  $id[]=$key;
                }
                $model = \Mage::getModel('Model\Attribute\Option');
                $id=implode(",",$id);
                $query="DELETE FROM `{$model->getTableName()}` WHERE `{$model->getPrimaryKey()}` NOT IN ({$id}) AND `optionId`={$optionId}";
                $model->getAdapter()->delete($query);

                foreach ($existData as $key => $value){
                    $model = \Mage::getModel('Model\Attribute\Option');
                    $model->name = $value['name'];
                    $model->sortOrder = $value['sortOrder'];
                    $model->save();
                }  
            }
            $grid = \Mage::getBlock('Block\Admin\Attribute\Option\Edit')->toHtml();
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
                        
            $grid = \Mage::getBlock('Block\Admin\Attirbute\Grid')->toHtml();
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
}
 ?>