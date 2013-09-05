<?php
nextendimport('nextend.form.tab');

class NextendTabSlide extends NextendTab {

    function decorateTitle() {
        echo "<div class='nextend-tab'>";
        if ($this->_hidetitle != 1)
            echo "<h3>" . NextendXmlGetAttribute($this->_xml, 'label') . "</h3>";
        ?>
        <div class="smartslider-advanced-layers smartslider-greybar">
            <div class="smartslider-toolbar-simple smartslider-toolbar-options smartslider-button-grey first">
                <div>Simple</div>
            </div>
            <div class="smartslider-toolbar-advanced smartslider-toolbar-options smartslider-button-grey last">
                <div>Advanced</div>
            </div>
        </div>
        <div class="smartslider-toolbar-play">PLAY</div>
        <div class="smartslider-slide-console"></div>
    <?php
    }

    function decorateGroupStart() {

    }

    function decorateGroupEnd() {

        echo "</div>";
        ?>
        <div class="smartslider-slide-advanced-layers"></div>
        <?php
    }

    function decorateElement(&$el, $out, $i) {

        echo $out[1];
    }
}