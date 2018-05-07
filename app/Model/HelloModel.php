<?php

namespace Model;

use Zero\Model;

class HelloModel extends Model
{
    public function __construct() 
    {
        parent::__construct();
    }

    public function getText()
    {
        return HELLO_TEXT;
    }

}