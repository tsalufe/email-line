<?php

namespace EmailLine\User;

class User{
	public $p_id;
	public $email='';
	public $firstname;
	public $lastname;
	function exchangeArray($arr){
		if(isset($arr['P_Id'])) $this->p_id=($arr['P_Id']==null?0:$arr['P_Id']);
		if(isset($arr['Email'])) $this->email=($arr['Email']==null?'':$arr['Email']);
		if(isset($arr['FirstName'])) $this->firstname=($arr['FirstName']==null?'':$arr['FirstName']);
		if(isset($arr['LastName'])) $this->lastname=($arr['LastName']==null?'':$arr['LastName']);
	}
	function toArray(){
		return array(
			'P_Id'=>$this->p_id,
			'Email'=>$this->email,
			'FirstName'=>$this->firstname,
			'LastName'=>$this->lastname,
		);
	}
	function getId(){ return $p_id;}
	function getEmail(){return $this->email;}
	function setEmail($email){ $this->email=$email;}
	function getFirstName(){ return $this->firstname;}
	function setFirstName($firstname){ $this->firstname=$firstname;}
	function getLastName(){ return $this->lastname;}
	function setLastName($lastname){ $this->lastname=$lastname;}
}
