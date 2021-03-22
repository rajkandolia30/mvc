<?php
namespace Model\Core;
class Adapter{
    public $config = [
        'host'=>'localhost',
        'user'=>'root',
        'passwordCon'=>'',
        'database'=>'cybercom'
    ];
    private $connect = null;

    public function connection(){
        $connect = new \mysqli($this->config['host'], 
        $this->config['user'], 
        $this->config['passwordCon'], 
        $this->config['database']);
        $this->setConnect($connect);
    }

    public function setConnect(\mysqli $connect){
        $this->connect = $connect;
        return $this;
    }

    public function getConnect(){
        return $this->connect;
    }

    public function isConnect(){
        if(!$this->connect){
            return false;
        }
        return true;
    }

    public function insert($query){
        if(!$this->isconnect()){
            $this->connection();
        }
        $result = $this->getConnect()->query($query);
        if (!$result){
            return false;
        }
        return $this->getConnect()->insert_id;
    }

    public function update($query){
        if(!$this->isconnect()){
            $this->connection();
        }
        if(!$this->getConnect()->query($query)){
            return false;
        }
        return true;
    }

    public function delete($query){
        if(!$this->isconnect()){
            $this->connection();
        }
        if(!$this->getConnect()->query($query)){
            return false;
        }
        return true;
    }

    public function fetchAll($query){
        if(!$this->isconnect()){
            $this->connection();
        }
        $result = $this->getConnect()->query($query);
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        if(!$rows){
            return false;
        }
        return $rows;
    }
    
    public function fetchRow($query){
        if(!$this->isconnect()){
            $this->connection();
        }
        $result = $this->getConnect()->query($query);
        $row = $result->fetch_assoc();
        if(!$row){
            return false;
        }
        return $row;
    }

    public function fetchPairs($query){
        if(!$this->isconnect()){
            $this->connection();
        }
        $result = $this->getConnect()->query($query);
        $rows = $result->fetch_All();
        if(!$rows){
            return $rows;
        }
        $columns = array_column($rows, '0');
        $values = array_column($rows, '1');
        return array_combine($columns, $values);
    }

    public function fetchOne($query){
        if(!$this->isconnect()){
            $this->connection();
        }
        $result = $this->getConnect()->query($query);
        return $result->num_rows;
    }
}