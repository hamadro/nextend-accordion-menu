<?php

class NextendElementTrial extends NextendElement {
    
    function fetchElement() {

        return "<img src='".NextendXmlGetAttribute($this->_xml, 'src')."' />";
    }
}
