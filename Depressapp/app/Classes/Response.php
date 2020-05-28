<?php namespace App\Classes;

class Response
{
    public $status;
    public $text;
    
    function __construct($status,$text) {
        $this->$status = $status;
        $this->$text = $text;
    }



}