<?php 

abstract class Dao 
{
	protected $sql;
	protected $criteria;
	protected $columns = array();

	/**
	* Monta um array contendo as colunas e os seus respectivos valores
	*
	* @var array $columnValues
	*/
	protected $columnValues = array();

	protected function setRowData($column, $value) {
		
		if(is_scalar($value)) {
			
			if (is_string($value) and !empty($value)) {
			
				$value = addslashes($value);
				$this->columnValues[$column] = "'$value'";
			
			} elseif (is_bool($value)) {
				$this->columnValues[$column] = $value ? 'TRUE' : 'FALSE';
			
			} elseif ($value !== '') {
				$this->columnValues[$column] = $value;
			
			} else {
				$this->columnValues[$column] = "NULL";
			}
		}
	}

	protected function setCriteria(Criteria $criteria) {
		$this->criteria = $criteria;
	}

	protected function addColumn($column) {
		$this->columns[] = $column;
	}

	abstract function insert($object);
	abstract function update($object, $id);
	abstract function delete($id);
	abstract function load($id);
	abstract function query($criteria);
	
}