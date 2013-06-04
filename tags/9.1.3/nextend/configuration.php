<?php
global $nextend;

$nextend = array(
    'cachetime' => 900,
    'cachepath' => null,
    'gzip' => 0
);

function getNextend($prop, $default = ''){
    global $nextend;
    if(isset($nextend[$prop]) && $nextend[$prop] !== null) return $nextend[$prop];
    return $default;
}

function setNextend($prop, $value){
    global $nextend;
    $nextend[$prop] = $value;
}