<?php 
namespace Block\Admin;
\Mage::loadFileByClassName('Block\Core\Template');
class Edit extends \Block\Core\Template{
 	protected $tab = null;
 	protected $tableRow = null;
 	protected $tabClass = null;

 	public function __construct(){
 		$this->setTemplate('./View/admin/edit.php');
 	}

 	public function getTabContent(){
        /*$tabBlock = \Mage::getBlock('Block\Admin\Product\Edit\Tabs');*/
        $tabBlock = $this->getTab();
        $tabs = $tabBlock->getTabs();
        $tab = $this->getRequest()->getGet('tab');
        if(!array_key_exists($tab, $tabs)){
            $tab = $tabBlock->getDefaultTab();
        }
        $block = $tabs[$tab]['block'];
        $block = \Mage::getBlock($block);
        $this->setTableRow($this->getTableRow());
        echo $block->toHtml(); 
    }

    public function getTabHtml(){
    	return $this->getTab()->toHtml();
    }
								
    public function setTab($tab = null){
    	if(!$tab){
    		$tab = $this->getTabClass();//*\Mage::getBlock('Block\Admin\Product\Edit\tabs');*/
    	}
    	//$tab->setTableRow($this->getTableRow());
    	$this->tab = $tab;
    	return $this;
    }

    public function getTab(){
    	if(!$this->tab){
    		$this->setTab();
    	}
    	return $this->tab;
    }

    public function setTableRow(\Model\Core\Table $tableRow){
    	$this->tableRow = $tableRow;
    	return $this;
    }

    public function getTableRow(){
    	return $this->tableRow;
    }

    public function getFormUrl(){
    	return $this->getUrl()->getUrl('save',null);
    }

    public function setTabClass($tabClass){
    	$this->tabClass = $tabClass;
    	return $this;
    }

    public function getTabClass(){
    	return $this->tabClass;
    }
 }?>