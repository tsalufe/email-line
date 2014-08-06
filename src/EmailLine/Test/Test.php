<?php

namespace EmailLine\Test;

class Test
{
	public $p_id;
	public $name='';
	public $description;
	public $value;
	public $notes;

	function exchangeArray($arr){
		if(isset($arr['P_Id'])) $this->p_id=($arr['P_Id']==null?0:$arr['P_Id']);
		if(isset($arr['Name'])) $this->name=($arr['Name']==null?'':$arr['Name']);
		if(isset($arr['Description'])) $this->description=($arr['Description']==null?'':$arr['Description']);
		if(isset($arr['Value'])) $this->value=($arr['Value']==null?0:$arr['Value']);
		if(isset($arr['Notes'])) $this->notes=($arr['Notes']==null?'':$arr['Notes']);
	}

	function toArray(){
		return array(
			'P_Id'=>$this->p_id,
			'Name'=>$this->name,
			'Description'=>$this->description,
			'Value'=>$this->value,
			'Notes'=>$this->notes,
		);
	}
	function getId(){ return $this->p_id;}
	function getName(){ return $this->name;}
	function setName($name){ $this->name=$name;}
	function getDescription(){ return $this->description;}
	function setDescription($desc){ $this->description=$desc;}
	function getValue(){ return $this->value;}
	function setValue($value){ $this->value=$value;}
	function getNotes(){ return $this->notes;}
	function setNotes($notes){ $this->notes=$notes;}
}
