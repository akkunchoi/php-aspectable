<?php
ini_set('error_reporting', E_ALL | E_STRICT);
ini_set('display_errors', 1);

require_once 'Aspectable.php';

$obj = new Aspectable;
$obj->includes = array('calc');

var_dump($obj->sum(1,2,3)); // int(6)

$obj->before = array(
  'sum' => 'double'
);
$obj->after = array(
  'sum' => 'humanize'
);
var_dump($obj->sum(1,2,3)); // "result = 12"

