<?php
namespace Block\Admin\Product;
\Mage::loadFileByClassName('Block\Admin\Edit');
class Edit extends \Block\Admin\Edit{    
    public function __construct(){
        parent::__construct();
        $this->setTabClass(\Mage::getBlock('Block\Admin\Product\Edit\Tabs'));
    }
}
?>