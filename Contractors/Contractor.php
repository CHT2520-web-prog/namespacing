<?php
namespace Contractors;

abstract class Contractor{
 protected string $firstName;
	protected string $lastName;
	function __construct(string $firstName, string $lastName)
	{
		$this->firstName = $firstName;
		$this->lastName = $lastName;
	}
	public function getFullName():string
	{
		return "{$this->firstName} {$this->lastName}";
	}
	abstract public function work():string;
	
	public function pay():string
	{
		return "{$this->getFullName()} just got paid.";
	}
}

