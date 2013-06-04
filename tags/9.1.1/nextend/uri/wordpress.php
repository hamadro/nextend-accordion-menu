<?php

class NextendUri extends NextendUriAbstract{
    
    function NextendUri(){
        $this->_baseuri = site_url().'/';
    }
}