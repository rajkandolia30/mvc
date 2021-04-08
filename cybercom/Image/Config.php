<?php 
namespace Model;
class config extends \Model\Core\Table{
	public function __construct(){
		$this->setTableName('config');
		$this->setPrimaryKey('configId');
	}
} ?>