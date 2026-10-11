<?php
class ProjectManager
{
    private array $contractors;
    function __construct()
    {
        $this->contractors = [];
    }
    public function hireContractor(Contractor $contractor):void{
        $this->contractors[] = $contractor; 
    }

    public function buildHouse():void
    {
        foreach($this->contractors as $contractor){
            echo "<p>{$contractor->work()}</p>";
        }
    }
    public function payContractors():void
    {
        foreach($this->contractors as $contractor){
            echo "<p>{$contractor->work()}</p>";
        }
    }
}

//Abstract Contractor class
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

// Child classes
class Builder extends Contractor{
    public function work():string
	{
		return "{$this->getFullName()} has built some walls.";
	}
}
class Joiner extends Contractor{
    public function work():string
	{
		return "{$this->getFullName()} has made some stairs.";
	}
}

$builder = new Builder("Jane","Smith");
$joiner = new Joiner("Imran","Iqbal");

 
$projectManager = new ProjectManager();
$projectManager->hireContractor($builder);
$projectManager->hireContractor($joiner);
$projectManager->buildHouse();
$projectManager->payContractors();



?>
