<?php

nextendimportaccordionmenu('nextend.accordionmenu.menu');
nextendimportaccordionmenu('nextend.accordionmenu.magento.tree');
nextendimport('nextend.data.data');
nextendimport('nextend.parse.parse');

class NextendMenuMagento extends NextendMenu {

    var $_data;
    
    var $_module;
    
    var $_magethis;

    function NextendMenuMagento($magethis, $instance, &$params, $path) {
        parent::NextendMenu($path);
        $this->_magethis = $magethis;
        $this->_data = new NextendData();
        $this->_data->loadArray($params);
        $module = new stdClass();
        $module->id = $instance;
        $this->_module = $module;
        $this->setThemePath();
        $this->setInstance();
    }

    function setInstance() {
        $this->_instance = $this->_module->id;
    }

    function getTreeInstance() {
        return new NextendTreeMagento($this, $this->_module, $this->_data);
    }

    function setThemePath() {
        $theme = $this->_data->get('theme', 'default');
        $class = 'plgNextendMenutheme' . $theme;
        if (!class_exists($class)) {
            echo 'Error in menu theme!';
            return false;
        }
        $class = new $class();
        $this->_themePath = $class->getPath();
    }

    function getTitle() {
        return $this->_magethis->__('Categories');
    }

}