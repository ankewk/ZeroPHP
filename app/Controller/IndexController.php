<?php
use Zero\Controller;

class IndexController extends Controller
{

    public function __construct() 
    {
       	
    }
    public function indexZero()
    {
        $conf = ['author' => 'Anke Wang'];
        $this->render('Index', ["val" => $conf]);
    }

    public function helloZero()
    {
        $conf = ['page_text' => 'Hello PHP!'];
        $this->render('Hello', ["val" => $conf]);
    }
}