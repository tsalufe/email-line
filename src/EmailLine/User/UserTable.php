<?php

namespace EmailLine\User;
use EmailLine\User\User;

class UserTable
{
	protected $pdo;

	function __construct(\PDO $pdo){
		$this->pdo=$pdo;
	}

	function fetchAll(){
		$users=array();
		foreach($this->pdo->query('select * from users') as $row){
			$user=new User();
			$user->exchangeArray($row);
			$users[]=$user;
		}
		return $users;
	}

	function get($column,$value){
		$stmt=$this->pdo->prepare('select * from users where '.$column.'=?');
		$stmt->execute(array($value));
		$row=$stmt->fetch();
		$user=new User();
		$user->exchangeArray($row);
		return $user;
	}

	function getUserById($id){
		return $this->get('P_Id',$id);
	}

	function getUserByEmail($email){
		return $this->get('Email',$email);
	}

	function saveUser(User $user){
		$data=$user->toArray();
		$p_id=(int)$user->p_id;
		if($p_id>0){
			$stmt=$this->pdo->prepare('update users set Email=?,FirstName=?,LastName=? where P_Id=?');
			$stmt->execute(array($data['Email'],$data['FirstName'],$data['LastName'],$data['P_Id']));
			return true;
		} else {
			$stmt=$this->pdo->prepare('insert into users set Email=?,FirstName=?,LastName=?');
			$stmt->execute(array($data['Email'],$data['FirstName'],$data['LastName']));
			return $this->pdo->lastInsertId();
		}
	}

	function deleteUser($id){
		$stmt=$this->pdo->prepare('delete from users where P_Id=?');
		$stmt->execute(array($id));
	}
}
