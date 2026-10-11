# Namespacing

- Open your Codespace
- Clone this repository into your codespace. In the terminal enter:
```
git clone https://github.com/CHT2520-web-prog/namespacing
```
- In terminal, navigate to the _front-controller_ folder

```
cd namespacing

```

- Start the web server
```
php -S 0.0.0.0:8000
```

_index.php_ is a working solution to the last practical we did on inheritance. 

This file contains lots of different classes. We want to:-

1. Place each class in a separate file.
2. Organise our classes using namespaces.

First create separate files for each class. Name the files exactly the same as the class name e.g. **Builder.php**. 

Create two namespaces (folders). `Projects` and `Contractors`. 

Put the `ProjectManage` class in `Projects` 
Put all the other classes in `Contractors`

Add `namespace` and `use` statements in these files. 

In _index.php_ add `use` and `require` statements to load in the classes e.g. 

```php
use Projects\ProjectManager;
use Contractors\Builder;
use Contractors\Joiner;

require("Contractors/Contractor.php");
require("Contractors/Builder.php");
require("Contractors/Joiner.php");
require("Projects/ProjectManager.php");

$builder = new Builder("Jane","Smith");
$joiner = new Joiner("Imran","Iqbal");

 
$projectManager = new ProjectManager();
$projectManager->hireContractor($builder);
$projectManager->hireContractor($joiner);
$projectManager->buildHouse();
$projectManager->payContractors();
```

Check this works. 

## Using `spl_autoload_register`

Instead of using lots of `require` statements, we can auto load the classes. 

Add an `spl_autoload_register` function at the top of _index.php_ that will load the class files.

You should then be able to delete the require statements. 
