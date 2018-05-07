<?php
use Zero\Controller;

class IndexController extends Controller
{

    public function __construct() 
    {
        parent::__construct();
    }
    
    public function indexZero()
    {
        $conf = ['author' => 'Anke Wang'];
        $this->render('Index', ["val" => $conf]);
    }
}