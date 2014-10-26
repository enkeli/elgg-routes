<?php

class TestController extends Controller
{
    protected $autoLoadEntity = true;
    
    function test() {
        echo ":)";
        var_dump($this->entity);
        return true;
    } 
} 
