<?php

namespace Model;

use Zero\Model;

class CommonModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getHello()
    {
        return ['author' => 'Anke Wang'];
    }
}
