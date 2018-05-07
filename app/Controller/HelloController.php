<?php
use Zero\Controller;
use Model\HelloModel;

class HelloController extends Controller
{

    public function __construct() 
    {
        parent::__construct();
    }

    public function helloZero()
    {
        $helloModel = new HelloModel();
        $page_text = $helloModel->getText();
        $this->render('Hello', ["page_text" => $page_text]);
    }
}