<?php 
namespace Model;
class Filter extends \Model\Admin\Session{

	public function setFilters($filters){
		if(!$filters){
			return false;
		}
		$filters = array_filter(array_map(function($value){
			$value = array_filter($value);
			return $value;
		},$filters));
		$this->filters = $filters;
	}

	public function getFilters(){
		return $this->filters;
	}

	public function hasFilter(){
		if(!$this->filters){
			return false;
		}
		return true;
	}

	public function getFilterValue($type, $key){
		if(!$this->filters){
			return null;
		}
		if(!array_key_exists($type, $this->filters)){
			return null;
		}
		if(!array_key_exists($key, $this->filters[$type])){
			return null;
		}
		return $this->filters[$type][$key];
	}
} ?>