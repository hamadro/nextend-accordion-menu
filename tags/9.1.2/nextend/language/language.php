<?php

class NextendText{
    static function _($text){
        return $text;
    }
    
    static function sprintf($text){
        $args = func_get_args();
        if (count($args) > 0){
            $args[0] = NextendText::_($args[0]);
            return call_user_func_array('printf', $args);
        }
        return $text;
    }
}