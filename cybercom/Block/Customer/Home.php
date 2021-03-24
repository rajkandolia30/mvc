<?php 
namespace Block\Customer;
\Mage::loadFileByClassName('Block\Core\Template');
class Home extends \Block\Core\Template{

	public function __construct(){
		$this->setTemplate('./View/Customer/home.php');
	}
} ?>