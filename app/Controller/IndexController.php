<?php
use Zero\Controller;
use Model\CommonModel;

class IndexController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function indexZero()
    {
        $model = new CommonModel();
        $conf = $model->getHello();
        $this->render('Index', ["val" => $conf]);
    }
}
