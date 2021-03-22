<?php
namespace Block\Customer;
\Mage::loadFileByClassName('Block\Core\Template'); 
class Layout extends \Block\Core\Template{
	 public function __construct(){
    	parent::__construct();
        $this->setTemplate('./View/customer/Layout/oneColumn.php');
        $this->prepareChildren();
    }
    
    public function prepareChildren(){
        $this->addChild(\Mage::getBlock('Block\customer\Layout\Content'), 'content');
        $this->addChild(\Mage::getBlock('Block\customer\Layout\Header'),'header');
       // $this->addChild(\Mage::getBlock('Block\customer\Layout\Menu'),'menu');
        //$this->addChild(\Mage::getBlock('Block\customer\Layout\Message'),'message');
        //$this->addChild(\Mage::getBlock('Block\customer\Layout\Footer'),'footer');
        //$this->addChild(\Mage::getBlock('Block\customer\Layout\Left'),'left');
    }
}?>