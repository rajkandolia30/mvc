<?php
namespace Block\Admin\Category;
\Mage::loadFileByClassName('Block\Admin\Edit');
class Edit extends \Block\Admin\Edit{    
    public function __construct(){
        parent::__construct();
        $this->setTabClass(\Mage::getBlock('Block\Admin\Category\Edit\Tabs'));
    }
}

?>