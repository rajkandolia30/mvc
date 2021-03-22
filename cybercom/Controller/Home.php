<?php
namespace Controller;	
class Home{
	public function indexAction(){
		$layout = \Mage::getBlock('Block\Customer\Layout')->toHtml();
		$response = [
			'element' => [
				[
					'selector' => '#contentHtml',
					'html' => $layout
				]
			]
		];
		header("Content-type: application/json; charset=utf-8");
        echo json_encode($response);
	}
}
?>