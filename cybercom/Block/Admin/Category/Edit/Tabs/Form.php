<?php 
namespace Block\Admin\Category\Edit\Tabs;
\Mage::loadFileByClassName('Block\Core\Template');
class Form extends \Block\Core\Template{
	  protected $category = null;
    protected $categories = [];
    protected $categoryOptions = null;
	
    public function __construct(){
  		parent::__construct();
  		$this->setTemplate('./View/admin/category/form/tabs/form.php');
  	}

  	public function setCategory($category = null){
          if($category){
              $this->category;
              return $this;
          }
          $model =  \Mage::getModel('Model\Category');
          $id = $this->getRequest()->getGet('id');
          if($id){
              $model->load($id);
          }
          $this->category = $model;
          return $this;
      }

      public function getCategory(){
          if(!$this->category){
              $this->setCategory();
          }
          return $this->category;
      }
      
      public function getCategoryOptions(){
          if(!$this->categoryOptions){
             $query="SELECT `categoryId`,`name` FROM `{$this->getCategory()->getTableName()}`;";
             $options=$this->getCategory()->getAdapter()->fetchPairs($query); 
             $pathId = " ";
                 if($this->getCategory()->pathId){
                     $pathId = $this->getCategory()->pathId.'=%';
                 }
              $query="SELECT `categoryId`,`pathId` FROM `{$this->getCategory()->getTableName()}`;";            
              $this->categoryOptions=$this->getCategory()->getAdapter()->fetchPairs($query); 
                  if (!$this->categoryOptions) {
                      $this->categoryOptions = [];
                  }
                  if ($this->categoryOptions) {
                     foreach ($this->categoryOptions as $categoryId => &$pathId) {
                         $pathIds = explode("=", $pathId);
                             foreach ($pathIds as $key => &$id) {
                                 if(array_key_exists($id, $options)){
                                      $pathIds[$key] = $options[$id];
                                 }
                             }
                         $this->categoryOptions[$categoryId] = implode("/",$pathIds);
                     }
                  }
              $this->categoryOptions=["0"=>"Root Category"] + $this->categoryOptions;
          }
          return $this->categoryOptions;
      }

      public function getStatusOption(){
          $model = \Mage::getModel('Model\Category');
          return $model->getStatusOption();      
      }
} ?>