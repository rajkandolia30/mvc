<?php
namespace Block\Dashboard;
\Mage::loadFileByClassName('Block\Core\Template'); 
class Layout extends \Block\Core\Template{
	 public function __construct(){
    	parent::__construct();
        $this->setTemplate('./View/dashboard/Layout/oneColumn.php');
        $this->prepareChildren();
    }
    
    public function prepareChildren(){
        $this->addChild(\Mage::getBlock('Block\dashboard\Layout\Content'), 'content');
	$this->addChild(\Mage::getBlock('Block\Admin\Layout\Menu'),'menu');
        $this->addChild(\Mage::getBlock('Block\dashboard\Layout\Header'),'header');
        $this->addChild(\Mage::getBlock('Block\dashboard\Layout\Footer'),'footer');
        $this->addChild(\Mage::getBlock('Block\dashboard\Layout\Left'),'left');
    }
}?>