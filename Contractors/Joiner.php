<?php
namespace Contractors;

class Joiner extends Contractor{
    public function work():string
	{
		return "{$this->getFullName()} has made some stairs.";
	}
}