<?php

class NextendElementText extends NextendElement {
    
    function fetchElement() {

        $css = NextendCss::getInstance();
        $css->addCssLibraryFile('element/text.css');
        $js = NextendJavascript::getInstance();
        $js->addLibraryJsAssetsFile('dojo', 'element.js');
        $js->addLibraryJsAssetsFile('dojo', 'element/text.js');
        $js->addLibraryJs('dojo', '
            new NextendElementText({
              hidden: "' . $this->_id . '"
            });
        ');
        $html = "";
        $html.= "<div class='nextend-text' style='".NextendXmlGetAttribute($this->_xml, 'style')."'>";
        $html.= "<input id='" . $this->_id . "' name='" . $this->_inputname . "' value='" . $this->_form->get($this->_name, $this->_default) . "' type='text'  autocomplete='off' />";
        if ($this->_xml->unit) {
            $html.= "<div class='nextend-text-unit'>";
            $html.= (string)$this->_xml->unit;
            $html.= "</div>";
        }
        $html.= "</div>";
        return $html;
    }
}
