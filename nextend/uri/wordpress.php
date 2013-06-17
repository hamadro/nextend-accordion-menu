<?php

class NextendUri extends NextendUriAbstract{
    
    function NextendUri(){
        $this->_baseuri = WP_CONTENT_URL;
    }
}