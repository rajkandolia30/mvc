<?php
namespace Block\Dashboard\layout; 
\Mage::loadFileByClassName('Block\Core\Template');
class Content extends \Block\Core\Template{
 	public function __construct(){
 		$this->setTemplate('./View/dashboard/content.php');
 	}
} ?>