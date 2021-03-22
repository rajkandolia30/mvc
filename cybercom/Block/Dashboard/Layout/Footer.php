<?php 
namespace Block\Dashboard\layout;
\Mage::loadFileByClassName('Block\Core\Template');
class Footer extends \Block\Core\Template{
 	public function __construct(){
 		$this->setTemplate('./View/dashboard/footer.php');
 	}
} 
?>