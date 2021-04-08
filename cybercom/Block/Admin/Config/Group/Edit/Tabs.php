<?php 
namespace Block\Admin\Config\Group\Edit;
\Mage::loadFileByClassName('Block\Admin\Edit\Tabs');
class Tabs extends \Block\Admin\Edit\Tabs{
 	protected $tabs = [];
 	protected $defaultTab = null;

 	public function __construct(){
 		parent::__construct();
 	}

 	public function prepareTabs(){
 		parent::prepareTabs();
		$this->addTab('Information', ['label' => 'Information', 'block' => 'Block\Admin\Config\Group\Edit\Tabs\Form']);
		$this->addTab('Config', ['label' => 'Config', 'block' => 'Block\Admin\Config\Group\Edit\Tabs\Config']);
 		$this->setDefaultTab('Information');
 		return $this;
 	}

 	public function setDefaultTab($defaultTab){
 		$this->defaultTab = $defaultTab;
 		return $this;
 	}

 	public function getDefaultTab(){
 		return $this->defaultTab;
 	}

 	public function setTabs(array $tabs = []){
 		$this->tabs = $tabs;
 		return $this;
 	}

 	public function getTabs(){
 		return $this->tabs;
 	}

 	public function setTab($key, $tabs = []){
 		if(!array_key_exists($key, $this->tabs)){
 			return null;
 		}
 		return $this->tabs[$key];
 	}

 	public function getTab($key){
 		if(!array_key_exists($key, $this->tab)){
 			return null;
 		}
 		return $this->tab[$key];
 	}

 	public function addTab($key, $tab = []){
 		$this->tabs[$key] = $tab;
 		return $this;
 	} 	

 	public function removeTab($key){
 		if(!array_key_exists($key, $this->tabs)){
 			unset($this->tabs[$key]);
 		}
 		unset($this->tabs[$key]);
 		return $this;
 	}
} ?>