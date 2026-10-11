<?php
namespace Projects;
use Contractors\Contractor;

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
            echo "<p>{$contractor->pay()}</p>";
        }
    }
}