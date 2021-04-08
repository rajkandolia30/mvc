<?php 
namespace Model\Config;
class Group extends \Model\Core\Table{
	public function __construct(){
		$this->setTableName('configGroup');
		$this->setPrimaryKey('groupId');
	}

	public function getConfig(){
		if(!$this->groupId){
			return false;
		}
		$query = "SELECT * FROM `config`
		WHERE `groupId` = '{$this->groupId}'";
		$configs = \Mage::getModel('Model\Config')->fetchAll($query);		
		if(!$configs){
			return false;
		}
		return $configs;
	}
} ?>