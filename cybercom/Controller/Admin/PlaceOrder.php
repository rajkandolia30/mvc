<?php 
namespace Controller\Admin;
class PlaceOrder extends \Controller\Core\Admin{

	public function gridAction(){
		$block = \Mage::getBlock('Block\Admin\PlaceOrder\Grid')->toHtml();
		$response = [
            'element' => [
                [
                    'selector' => '#contentHtml',
                    'html' => $block,
                ]
            ]                
        ];
        header("Content-type: application/json; charset=utf-8");
        echo json_encode($response);
	}
} ?>