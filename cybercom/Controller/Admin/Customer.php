<?php
namespace Controller\Admin;
\Mage::loadFileByClassName('Controller\Core\Admin');
class Customer extends \Controller\Core\Admin{
    protected $model = null;

    public function setModel(){
        try{
            $this->model = \Mage::getModel('Model\Customer');
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
            $grid = \Mage::getBlock('Block\Admin\Customer\Grid')->toHtml();
            $response = [
                'element'=>[
                    [
                        'selector'=>'#contentHtml',
                        'html'=> $grid
                    ],
                    [
                        'selector'=>null,
                        'html'=> null,
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
            $customer = \Mage::getModel('Model\Customer');
            $id = $this->getRequest()->getGet('id');
            $customer->load($id);
            $edit = \Mage::getBlock('Block\Admin\Customer\Edit');
            $edit->setTableRow($customer);
            $tabs = \Mage::getBlock('Block\Admin\Customer\Edit\Tabs');
            $edit = $edit->toHtml();
            $response = [
                'element'=>[
                    [
                        'selector'=>'#contentHtml',
                        'html'=> $edit
                    ],
                    [
                        'selector'=>'#tab',
                        'html'=> $tabs
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
            $customers =  $this->getRequest()->getPost('customer');
            if($id){
                $this->getModel()->updatedDate = date("Y-m-d");
                $this->getModel()->customerId = $id;
                $this->getMessage()->setSuccess('Record updated successfully!!!');
            } else {
                $this->getModel()->createdDate = date("Y-m-d");
                $this->getMessage()->setSuccess('Record inserted successfully!!!');
            }
            $this->getModel()->setData($customers);
            $this->getModel()->save();
            $grid = \Mage::getBlock('Block\Admin\Customer\Grid')->toHtml();
            $response = [
                'element'=>[
                    [
                        'selector'=>'#contentHtml',
                        'html'=> $grid
                    ],
                    [
                        'selector'=>null,
                        'html'=> null,
                    ]
                ]
            ];
            header("Content-type: application/json; charset=utf-8");
            echo json_encode($response);
        }catch(Exception $e){
            $this->getMessage()->setFailure($e->getMessage());
        }
    }

    public function saveAddressAction(){
        try{
            $customerId =  $this->getRequest()->getGet('id');
            
            if(!$this->getRequest()->isPost()){
                throw new Exception("Invalid request");
            }
            
            $customerShipping =  $this->getRequest()->getPost('customerShipping');
            $customerBilling =  $this->getRequest()->getPost('customerBilling');

            $addressShipping = \Mage::getModel('Model\CustomerAddress');
            $addressShippingAvailable = $addressShipping->load($customerId);
            $addressBilling = \Mage::getModel('Model\CustomerAddress');
            $addressBillingAvailable = $addressBilling->load($customerId);

            if($customerBilling[0]){
                    $addressBilling->addressType = 'billing';
                    $addressBilling->customerId = $customerId;
                    $addressBilling->setData($customerBilling[0]);                
                    print_r($addressBilling);            
                    $addressBilling->save();                    
                //$addressBilling->saveAddress('update', $customerId);
            }

            if($customerShipping[1]){
                    $addressShipping->addressType = 'shipping';
                    $addressShipping->customerId = $customerId;
                    $addressShipping->setData($customerShipping[1]);
                    print_r($addressShipping);
                    $addressShipping->save();                    
                   // $addressShipping->saveAddress('update', $customerId);
            }  
            $grid = \Mage::getBlock('Block\Admin\Customer\Grid')->toHtml();
            $response = [
                'element'=>[
                    [
                        'selector'=>'#contentHtml',
                        'html'=> $grid,
                    ],
                    [
                        'selector'=>null,
                        'html'=> null,
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
            
            $grid = \Mage::getBlock('Block\Admin\Customer\Grid')->toHtml();
            $response = [
                'element'=>[
                    [
                        'selector'=>'#contentHtml',
                        'html'=> $grid,
                    ],
                    [
                        'selector'=>null,
                        'html'=> null,
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
