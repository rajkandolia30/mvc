<?php 
namespace Controller;
class Dashboard{
	public function indexAction(){
	$layout = \Mage::getBlock('Block\Dashboard\Layout');
    echo $layout->toHtml();
    /*$layout = \Mage::getBlock('Block\Dashboard\Layout')->toHtml();
    $response = [
        'element' => [
            [
                'selector' => '#contentHtml',
                'html' => $layout
            ]
        ]
    ];
    header("Content-type: application/json; charset=utf-8");
    echo json_encode($response);*/
    }

} ?>