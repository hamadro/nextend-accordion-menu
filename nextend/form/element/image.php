<?php

nextendimport('nextend.form.element.text');

class NextendElementImage extends NextendElementText {

    function fetchElement() {
        $html = parent::fetchElement();
        if (nextendIsJoomla()) {
            JHtml::_('behavior.modal');
            $user = JFactory::getUser();
            $link = 'index.php?option=com_media&amp;view=images&amp;tmpl=component&amp;e_name=com_smartslider2&amp;author=' . $user->id;
            $html .= '<div class="button2-left" style="margin: 2px 0 2px 10px; float: left;">
                    <div class="image">
                        <a onclick="window.jInsertEditorText = function(tag, editor){njQuery(\'#' . $this->_id . '\').val(\'' . NextendUri::getBaseUri() . '\'+njQuery(tag).attr(\'src\')); NfireEvent(document.getElementById(\'' . $this->_id . '\'),\'change\'); };return false;" rel="{handler: \'iframe\', size: {x: 900, y: 520}}" href="' . $link . '" title="Image" class="modal btn modal-button"><i class="icon-picture"></i> Image</a>
                    </div>
                  </div>';
        }
        return $html;
    }
}
