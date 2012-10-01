<?php
foreach ($args as &$value){
  $value = $value * 2;
}
return $args;
