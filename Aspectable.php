<?php

class Aspectable{
  public $basepath;
  public $includes;
  public $before;
  public function __construct(){
    $this->basepath = dirname(__FILE__);
  }
  public function __call($name, $args){

    if (isset($this->before[$name])){
      $args = call_user_func_array(array($this, $this->before[$name]), $args);
    }

    $result = include $this->__find_path($name, $args);

    if (isset($this->after[$name])){
      // $argsも渡すべきか？
      $result = call_user_func_array(array($this, $this->after[$name]), array($result));
    }
    return $result;
  }
  private function __find_path($name, $args){
    foreach ($this->includes as $module){
      $path = join(DIRECTORY_SEPARATOR, array($this->basepath, $module, $name . '.php'));
      if (file_exists($path)){
        return $path;
      }
    } 
    throw new Exception("Method $name not found in " . join($this->includes));
  }
}



