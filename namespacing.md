# Organising classes, namespacing and autoloading

## Including classes
So far when writing OOP PHP code we have placed the class definition and code that uses the class (client code) in the same file. Here's an example from the first OOP practical:
```php
//class
class Student{
    public $studentNum;
    public $firstName;
    public $lastName;
    
    public function getFullName()
    {
        return "{$this->firstName} {$this->lastName}";
    }
}
//client code
$exampleStudent = new Student();
$exampleStudent->studentNum="u0123456";
$exampleStudent->firstName="John";
$exampleStudent->lastName="Smith";
var_dump($exampleStudent);

```
In real world PHP applications most developers use a separate file for each PHP class they create. We could then use ```require()``` to load the files. Here's a simple example

```php
//Film.php
class Film{
    public $title;
    public $year;
}

```

```php
//index.php
require("Film.php"); //loads film.php

$film = new Film(); 
$film->title = "The Revenant";
$film->year = 2015;
var_dump($film);

```

## Namespacing 
Namespacing allows us to group classes together, a bit like organising files into different directories. There are two main reason for namespacing classes:

1. It may not seem like it, but when programming complex applications, it is often possible to end up declaring two classes with the same name. By namespacing them we can re-use the same name without conflicts.

2. It helps us to organise and structure more complex web applications. 

Namespacing is a common feature in many programming languages. It is also used extensively in most PHP MVC frameworks, including Laravel. So it is good to have an understanding of what it is and how it works. 

When we declare a class, by default it is placed in the *global* namespace.  

In the above example my Film class is in the *global* namespace. Once we have included the file, we can simply refer to it directly from *index.php*.

Now let's see what happens when we place Film in a namespace. In the following example *film.php* has been placed into the Models namespace.

```php
//Film.php
namespace Models; //this line specifies Film is in the Models namespace

class Film{
	public $title;
	public $year;
}

```

> Note, the namespace declaration should be the first line of code in a file. 

Now to use the Film class *index.php* has to change or we'll get an error. When we refer to the Film class we need to prefix it with the namespace e.g.
 
```php
require("Film.php");

$film = new Models\Film(); //this is the line that has changed. It now references the Models namespace
$film->title = "The Revenant";
$film->year = 2015;
var_dump($film);
```

We use a backslash (\\) to separate namespaces from class names. It is also possible to structure namespaces hierarchically, like folders and sub-folders. For example *Helpers\Validators\DateValidator.php*.

## The *Use* Statement
If we need to refer to classes from the same namespace repeatedly, it can be tedious to constantly have to prefix class names with the namespace. 

```php
require("Film.php");

$film = new Models\Film(); //using the Models prefix
$film->title ="The Revenant";
$film->year = 2015;

$anotherFilm = new Models\Film(); //using the Models prefix
$anotherFilm->title ="The Room";
$anotherFilm->year = 2015;
```

We can use the *use* statement to specify that we want to import the Film class from Models and use it in the current namespace. Then we no longer have to use the namespace when instantiating new objects.

```php
use Models\Film; //use statement to import the Film class
require("Film.php");

$film = new Film(); //no longer need the Models prefix
$film->title="The Revenant";
$film->year=2015;
var_dump($film);

$anotherFilm = new Film(); //no longer need the Model prefix
$anotherFilm->title="The Room";
$anotherFilm->year=2015;

```

### Using Namespaces
Once we place a class in a namespace, it can only see code in the same namespace as itself. It doesn't automatically have access to classes from the global namespace. To show this here's a slightly more complex version of the Film class.

```php
namespace Models;
use DateTime; //I have to import the DateTime class from the global namespace

class Film {
    public $id;
    public $title;
    public $year;
    public $duration;
    
    function __construct($title, $year, $duration){
        $this->title=$title;
        $this->year=$year;
        $this->duration=$duration;
    }
    function getAge(){
        $todaysDate   = new DateTime('today'); //This uses the DateTime class
        $currentYear = $todaysDate->format("Y");
        return $currentYear-$this->year;
    }
}
```

## Autoloading
As we build more complex applications we end up creating more and more classes. Writing *include* statements for all these classes can be tedious. 

```php
require("Models/Film.php");
require("Models/Certificate.php");
require("Models/Genre.php");
require("DbConnect.php");
require("Mappers/FilmMapper.php");
require("Mappers/CertMapper.php");
require("Mappers/GenreMapper.php");
//etc.
```
PHP allows us to define an *autoload* function. When we use the *new* keyword, this function will be called to automatically load the class. Here's an example:

```php
//index.php
spl_autoload_register(function ($class_name) {
    $class_name = str_replace("\\", DIRECTORY_SEPARATOR, $class_name);
    require($class_name.'.php');
});

use Models\Film;
$film = new Film("Leave No Trace", 2018, 109); //no need for an include statement
echo "<p>{$film->getAge()}</p>";

```
*spl_autoload_register* is a built-in function. We pass an autoload function (that we define) to *spl_autoload_register*. In this example it is the function:
```php
function ($class_name) {
    $class_name = str_replace("\\",DIRECTORY_SEPARATOR,$class_name);
    require($class_name.'.php');
};
```
This function will then be called whenever we try and instantiate an object. In this example the ```$class_name``` variable contains the namespace for the class we are trying to load (e.g. Models\Film). We want to convert this namespace into a file path we can use to load the class. For this reason we replace the backslash (\\) with a forward slash (DIRECTORY_SEPERATOR) i.e. *Models\Film* will become *Models/Film*.   

## Learning More
* http://php.net/manual/en/language.namespaces.php
* https://www.thoughtfulcode.com/a-complete-guide-to-php-namespaces/
