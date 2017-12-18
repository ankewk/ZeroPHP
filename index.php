<?php
use Zero\Zero;
use Zero\Request;

require_once __DIR__ . "/vendor/autoload.php";

$zero = new Zero();
$request = new Request();
$response = $zero->inlet($request);