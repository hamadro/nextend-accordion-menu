<?php

class NextendFilesystem extends NextendFilesystemAbstract{
    
    function NextendFilesystem(){
        $this->_basepath = ABSPATH;
        $this->_cachepath = getNextend('cachepath', ABSPATH.'wp-content'.DIRECTORY_SEPARATOR.'cache'.DIRECTORY_SEPARATOR);
        $this->_librarypath = str_replace($this->_basepath, '', NEXTENDLIBRARY);
    }
}