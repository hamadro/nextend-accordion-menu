<?php

class NextendUri extends NextendUriAbstract{
    
    function NextendUri(){
        $this->_baseuri = WP_CONTENT_URL;
        if (!empty($_SERVER['HTTPS'])) {
            $this->_baseuri = str_replace('http://', 'https://', $this->_baseuri);
        }
    }
}