<?php
namespace Block\Admin\Config\Group;
\Mage::loadFileByClassName('Block\Admin\Edit');
class Edit extends \Block\Admin\Edit{
    public function __construct(){
        parent::__construct();
        $this->setTabClass(\Mage::getBlock('Block\Admin\Config\group\Edit\Tabs'));
    }
}

?>