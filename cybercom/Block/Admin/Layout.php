<?php
namespace Block\Admin;
\Mage::loadFileByClassName('Block\Core\Template'); 
class Layout extends \Block\Core\Template{
	 public function __construct(){
    	parent::__construct();
        $this->setTemplate('./View/Admin/Layout/oneColumn.php');
        $this->prepareChildren();
    }
    
    public function prepareChildren(){
        $this->addChild(\Mage::getBlock('Block\Admin\Layout\Content'), 'content');
        $this->addChild(\Mage::getBlock('Block\Admin\Layout\Header'),'header');
        $this->addChild(\Mage::getBlock('Block\Admin\Layout\Menu'),'menu');
        $this->addChild(\Mage::getBlock('Block\Admin\Layout\Message'),'message');
        $this->addChild(\Mage::getBlock('Block\Admin\Layout\Footer'),'footer');
        $this->addChild(\Mage::getBlock('Block\Admin\Layout\Left'),'left');
    }
}?>