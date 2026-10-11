<?php
namespace Models;

class Film {
    public string $title;
    public string $year;
    
    function __construct($title, $year){
        $this->title=$title;
        $this->year=$year;
    }
    function getAge():int{
        return date("Y") - $this->year;
    }

}