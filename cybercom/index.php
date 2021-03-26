<?php
spl_autoload_register(__NAMESPACE__.'\Mage::loadFileByClassName');
\Mage::loadFileByClassName('Controller\Core\Front');
class Mage{
    public static function init(){
        Controller\Core\Front::init();
    }
    
    public static function loadFileByClassName($className){
     	$className = ucwords(str_replace('\\', ' ', $className));
        $className = str_replace(' ', '\\', $className);
     	$className = $className.'.php';
     	require_once $className;
	}

	public static function getBlock($className){
        //self::loadFileByClassName($className);
		return new $className();
	}

    public static function getModel($className){
        //self::loadFileByClassName($className);
        return new $className();
    }

    public static function prepareClassName($key, $nameSpace){
        $className = $key.' '.$nameSpace;
        $className = str_replace('_', ' ', $className);
        $className = ucwords($className);
        $className = str_replace(' ', '\\', $className);
        return $className;
    }

    public static function getBaseDir($subPath = null){
        if($subPath){
        return getcwd().DIRECTORY_SEPARATOR.$subPath;
        }
        return getcwd();    
    }
}
Mage::init();
?>
