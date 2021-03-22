<?php 
namespace Block\Customer\layout;
\Mage::loadFileByClassName('Block\Core\Template');
class Footer extends \Block\Core\Template{
 	public function __construct(){
 		$this->setTemplate('./View/customer/footer.php');
 	}
} 
?>