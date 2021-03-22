<?php
namespace Block\Admin\layout; 
\Mage::loadFileByClassName('Block\Core\Template');
class Content extends \Block\Core\Template{
 	public function __construct(){
 		$this->setTemplate('./View/admin/content.php');
 	}
} ?>