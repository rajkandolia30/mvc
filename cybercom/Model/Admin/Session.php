<?php
namespace Model\Admin;
\Mage::loadFileByCLassName('Model\Core\Session');
class Session extends \Model\Core\Session{
	
	public function __construct(){
		parent::__construct();
		$this->setNameSpace('admin');
	}
}

