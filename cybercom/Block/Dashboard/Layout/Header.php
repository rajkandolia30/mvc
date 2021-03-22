<?php
namespace Block\Dashboard\Layout;
\Mage::loadFileByClassName('Block\Core\Template');
class Header extends \Block\Core\Template{
	public function __construct(){
		$this->setTemplate('./View/dashboard/header.php');
	}
}
?>