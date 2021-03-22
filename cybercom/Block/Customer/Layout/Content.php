<?php
namespace Block\Customer\layout; 
\Mage::loadFileByClassName('Block\Core\Template');
class Content extends \Block\Core\Template{
 	public function __construct(){
 		$this->setTemplate('./View/customer/content.php');
 	}
} ?>