<?php

class NextendPlugin{
    static $classes = array();
    
    static function addPlugin($group, $class){
        if(!isset(self::$classes[$group])) self::$classes[$group] = array();
        if(!is_object($class)) $class = new $class();
        self::$classes[$group][] = $class;
    }
    
    static function callPlugin($group, $method, &$args = null){
        if(isset(self::$classes[$group])){
            foreach(self::$classes[$group] AS $class){
                call_user_func_array(array($class, $method), array(&$args));
            }
        }
    }
    
}
?>
