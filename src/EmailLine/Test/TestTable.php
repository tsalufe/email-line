<?php

namespace EmailLine\Test;

use EmailLine\Test\Test;

class TestTable
{
	protected $pdo;

	function __construct(\PDO $pdo){
		$this->pdo=$pdo;
	}

	function fetchAll(){
		$tests=array();
		foreach($this->pdo->query('select * from test') as $row){
			$test=new Test();
			$test->exchangeArray($row);
			$tests[]=$test;
		}
		return $tests;
	}

	function get($column,$value){
		$stmt=$this->pdo->prepare('select * from test where '.$column.'=?');
		$stmt->execute(array($value));
		$test=new Test();
		$test->exchangeArray($stmt->fetch());
		return $test;
	}
	function getTestById($id){
		return $this->get('P_Id',$id);
	}
	function getTestByName($name){
		return $this->get('Name',$name);
	}
	function saveTest(Test $test){
		if($test->p_id>0){
			$stmt=$this->pdo->prepare('update test set Name=?,Description=?,Value=?,Notes=? where P_Id=?');
			$stmt->execute(array($test->getName(),$test->getDescription(),$test->getValue(),$test->getNotes(),$test->getId()));
			return true;
		} else{
			$stmt=$this->pdo->prepare('insert into test set Name=?,Description=?,Value=?,Notes=?');
			$stmt->execute(array($test->getName(),$test->getDescription(),$test->getValue(),$test->getNotes()));
			return $this->pdo->lastInsertId();
		}
	}
	function deleteTest($id){
		$stmt=$this->pdo->prepare('delete from test where P_Id=?');
		$stmt->execute(array($id));
	}
}
