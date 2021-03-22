<?php
namespace Model\Core;
class Table{
    protected $adapter = null;
    protected $primaryKey = null;
    protected $tableName = null;
    protected $data = [];
    
    public function setData(array $data){
        $this->data = array_merge($this->data,$data);
        return $this;
    }
    public function getData(){
        return $this->data;
    }
    public function setAdapter($adapter = null){
        if(!$adapter){
            $adapter = \Mage::getBlock('Model\Core\Adapter');
        }
        $this->adapter = $adapter;
        return $this;
    }
    public function getAdapter(){
        if(!$this->adapter){
            $this->setAdapter();
        }
        return $this->adapter;
    }
    public function setPrimaryKey($primaryKey){
        $this->primaryKey = $primaryKey;
        return $this;
    } 
    public function getPrimaryKey(){
        return $this->primaryKey;
    }
    public function setTableName($tableName){
        $this->tableName = $tableName;
        return $this;
    }
    public function getTableName(){
        return $this->tableName;
    }
    public function __set($key, $value){
        $this->data[$key] = $value;
        return $this;
    }
    public function __get($key){
        if(!array_key_exists($key, $this->data)){
            return null;
        }
        return $this->data[$key];
    }
    public function save(){
        if(!array_key_exists($this->getPrimaryKey(),$this->data)){
            $query = "INSERT INTO `{$this->getTableName()}` (`".implode('`, `', array_keys($this->data))."`)  
            VALUES ('".implode('\',\'', array_values($this->data))."');";
            $returnId = $this->getAdapter()->insert($query);
            return $returnId;
        }
        $param = null;
        foreach ($this->data as $key => $value) {
				if($key != $this->getPrimaryKey()) {
					$param.= "`{$key}` = '{$value}',";
				}
			}
        $param = rtrim($param,",");
        $query = "UPDATE `{$this->getTableName()}` SET {$param} 
        WHERE {$this->getPrimaryKey()}={$this->data[$this->getPrimaryKey()]}";
        $this->getAdapter()->update($query);
        return true;

    }

    public function fetchAll($query = null){
        if(!$query){
            $query = "SELECT * FROM `{$this->getTableName()}`";
        }
        $rows = $this->getAdapter()->fetchAll($query);
        $array = [];
        if($rows){
            foreach($rows as $key => $value){
                $table = new $this;
                $table->setData($value);
                $array[] = $table;          
            }            
        }
        $className = get_called_class().'\Collection';
        $collection = \Mage::getModel($className);
        $collection->setData($array);
        return $collection;
    }

    public function load($value){
        $value = (int)$value;
        $query = "SELECT * FROM `{$this->getTableName()}` WHERE `{$this->getPrimaryKey()}` = {$value}";
        $this->fetchRow($query);
        return $this;    
    }

    public function fetchRow($query){
        $row = $this->getAdapter()->fetchRow($query);
        if(!$row){
            return false;
        }
        $this->data = $row;
        return $this;
    }

    public function delete(){
        $id = $_GET['id'];
        $id = (int)$id;
        $query = "DELETE FROM `{$this->getTableName()}` WHERE `{$this->getPrimaryKey()}` = $id";
        return $this->getAdapter()->delete($query);
    }
}
?>