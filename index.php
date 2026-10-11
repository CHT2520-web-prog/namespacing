<?php
spl_autoload_register(function ($class_name) {
    echo "<p>spl_autoload_register was called loading {$class_name}</p>";
    $class_name = str_replace("\\", DIRECTORY_SEPARATOR, $class_name);
    require("{$class_name}.php");
});

use Projects\ProjectManager;
use Contractors\Builder;
use Contractors\Joiner;

// require("Contractors/Contractor.php");
// require("Contractors/Builder.php");
// require("Contractors/Joiner.php");
// require("Projects/ProjectManager.php");

$builder = new Builder("Jane","Smith");
$joiner = new Joiner("Imran","Iqbal");

 
$projectManager = new ProjectManager();
$projectManager->hireContractor($builder);
$projectManager->hireContractor($joiner);
$projectManager->buildHouse();
$projectManager->payContractors();

?>
