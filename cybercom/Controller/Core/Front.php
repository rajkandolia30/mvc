<?php
namespace Controller\Core;
class Front{
    public static function init(){
        $request = \Mage::getModel('Model\Core\Request');
        $controllerName = ucfirst($request->getControllerName());
        $actionName = $request->getActionName().'Action';
        $controllerClassName = \Mage::prepareClassName('Controller', $controllerName);
        //$controllerName = "Controller\Admin\\".$controllerName;
        $controller = \Mage::getBlock($controllerClassName);
        $controller->$actionName();
    }
}?>