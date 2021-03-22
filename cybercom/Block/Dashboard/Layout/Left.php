<?php 
namespace Block\Dashboard\Layout;
\Mage::loadFileByClassName('Block\Core\Template');
class Left extends \Block\Core\Template{
	public function __construct(){
		$this->setTemplate('./View/dashboard/left.php');
	}
} ?>