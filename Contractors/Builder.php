<?php
namespace Contractors;

class Builder extends Contractor{
    public function work():string
	{
		return "{$this->getFullName()} has built some walls.";
	}
}