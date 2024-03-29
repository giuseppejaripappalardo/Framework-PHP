<?php

namespace Framework;

class DatabaseTable
{
	private $pdo;
	private $primaryKey;
	private $table;
	
	public function __construct(\PDO $pdo, string $table, string $primaryKey){
		$this->pdo = $pdo;
		$this->primaryKey = $primaryKey;
		$this->table = $table;
	}
	
	private function query(string $sql, array $fields = []){
			$query = $this->pdo->prepare($sql);
			$query->execute($fields);
			return $query;
	}
	
	private function processDate($fields){
		foreach($fields as $key => $value) {
			if ($value instanceof \DateTime){
				$fields[$key] = $value->format('Y-m-d H:i:s');
			}
		}
		return $fields;
	}
	
	public function find($fields) {
		$query = 'SELECT ' . $fields . ' FROM ' . $this->table;
		$save = $this->query($query);
		return $save->fetchAll();
	}
	
	public function findById(int $value) {
		$query = 'SELECT * FROM `' . $this->table . '` WHERE `' . $this->primaryKey . '` = :value';
		$fields = ['value' => $value];
		$save = $this->query($query, $fields);
		return $save->fetch();
	}
	
	public function delete(int $id){
		$query = 'DELETE FROM ' . $this->table . ' WHERE ' . $this->primaryKey . ' = ' . $id;
		$this->query($query);
	}
	
	private function insert(array $fields){
		$query = 'INSERT INTO `' . $this->table . '` (';
		foreach($fields as $key => $value){
			$query .= '`' . $key . '`, ';
			}
			$query = rtrim($query, ', ');
			$query .= ') VALUES (';
			
			foreach($fields as $key => $valye) {
				$query .= ':' . $key . ', ';
				}
			$query = rtrim($query, ', ');
			$query .= ')';
			$fields = $this->processDate($fields);
			$this->query($query, $fields);
	}
	
			private function update(array $fields){	
			$query = ' UPDATE `' . $this->table . '` SET ';
			foreach($fields as $key => $value){
				$query .= '`'. $key .'` = :' . $key . ',';
			}
			$query =  rtrim($query, ', ');
			$query.= ' WHERE `' . $this->primaryKey . '` = :primaryKey';
			$fields['primaryKey'] = $fields['id'];
			$fields = $this->processDate($fields);
			$this->query($query, $fields);
			}
	
		public function save($fields){
			try{
			if($fields[$this->primaryKey] == ''){
				$fields[$this->primaryKey] = null;
			}
			$this->insert($fields);
		} catch (\PDOException $e){
			$this->update($fields);
		}
	}
}