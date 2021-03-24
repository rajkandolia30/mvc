<?php
namespace Controller;	
class Home{
	public function indexAction(){
		$block = \Mage::getBlock('Block\Customer\home');
		echo $block->toHtml();
		/*$response = [
			'element' => [
				[
					'selector' => '#contentHtml',
					'html' => $block
				]
			]
		];
		header("Content-type: application/json; charset=utf-8");
        echo json_encode($response);*/
	}

	public function pageAction(){
		$pager = \Mage::getBlock('Controller\Core\Pager');
		$sql = "SELECT * FROM `product`";
		$product = \Mage::getModel('Model\Product');
		$productCount = $product->getAdapter()->fetchOne($sql);
		$pager->setTotalRecords($productCount);
		$pager->setRecordPerPage(2);
		$pager->calculatePage();
		echo '<pre>';
		print_r($pager);
	}
}
?>