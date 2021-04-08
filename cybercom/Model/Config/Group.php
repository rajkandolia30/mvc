<?php 
namespace Model\Config;
class Group extends \Model\Core\Table{
	public function __construct(){
		$this->setTableName('configGroup');
		$this->setPrimaryKey('groupId');
	}
} ?>