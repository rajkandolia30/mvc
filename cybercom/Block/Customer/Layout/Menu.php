<?php 
namespace Block\Customer\Layout;
\Mage::loadFileByClassName('Block\Core\Template');
class Menu extends \Block\Core\Template{
	public function __construct(){
		$this->setTemplate('./View/customer/menu.php');
	}
} ?>