<?php

global $nextend_head;

$nextend_head = '';

if (!defined('NEXTENDLIBRARY')) {
    require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'library.php');

    nextendimport('nextend.wordpress.settings');
    
    add_action('print_footer_scripts', 'nextend_generate');
    function nextend_generate() {
        global $nextend_head;
        ob_start();
        if (class_exists('NextendCss', false) || class_exists('NextendJavascript', false)) {
            $css = NextendCss::getInstance();
            $css->generateCSS();
            $js = NextendJavascript::getInstance();
            $js->generateJs();
        }
        $nextend_head = ob_get_clean();
        if(getNextend('safemode', 0)) echo $nextend_head;
        return true;
    }
    
    function nextend_render_end($buffer){
        global $nextend_head;
        if($nextend_head != ''){
            return preg_replace('/<\/head>/', $nextend_head.'</head>', $buffer, 1);
        }
        return $buffer;
    }
    
    if(is_admin()){
        add_action('admin_init', 'nextend_wp_loaded', 3000);
    }else{
        add_action('wp', 'nextend_wp_loaded', 3000);
    }
    function nextend_wp_loaded() {
        setNextend('safemode', 0);
        if(!getNextend('safemode', 0)) ob_start("nextend_render_end");
    }
}
?>
