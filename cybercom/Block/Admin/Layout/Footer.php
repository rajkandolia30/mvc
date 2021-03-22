<?php 
namespace Block\Admin\layout;
\Mage::loadFileByClassName('Block\Core\Template');
class Footer extends \Block\Core\Template{
 	public function __construct(){
 		$this->setTemplate('./View/admin/footer.php');
 	}
} 
?>