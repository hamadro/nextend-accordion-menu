<?php

require_once(NEXTEND_ACCORDION_MENU . 'library' . DIRECTORY_SEPARATOR . 'accordionmenu'. DIRECTORY_SEPARATOR . 'wordpress' . DIRECTORY_SEPARATOR . 'treebase.php' );

class NextendTreeWordpress extends NextendTreebaseWordpress {

    var $alias;
    var $parentName;
    var $name;

    function NextendTreeWordpress(&$menu, &$module, &$data) {

        parent::NextendTreebase($menu, $module, $data);
        $this->initConfig();
    }

    function initConfig() {

        parent::initConfig();

        $expl = explode('|*|', $this->_data->get('wordpressmenu', 'mainmenu|*|0'));
        $this->_config['menu'] = $expl[0];
        $this->_config['root'] = explode('||', $expl[1]);

        $this->initMenuicon();
    }

    function getAllItems() {
        $allItems = array();
        $items = wp_get_nav_menu_items($this->_config['menu'], array());
        if (!in_array('0', $this->_config['root'])) {
            if (count($this->_config['root']) === 1) {
                if ($this->_config['rootasitem']) {
                    for ($i = 0; $i < count($items); $i++) {
                        if ($items[$i]->ID == $this->_config['root'][0]) {
                            $items[$i]->menu_item_parent = 0;
                        } elseif ($items[$i]->menu_item_parent == 0) {
                            $items[$i]->menu_item_parent = -1;
                        }
                    }
                } else {
                    for ($i = 0; $i < count($items); $i++) {
                        if ($items[$i]->menu_item_parent == $this->_config['root'][0]) {
                            $items[$i]->menu_item_parent = 0;
                        } elseif ($items[$i]->menu_item_parent == 0) {
                            $items[$i]->menu_item_parent = -1;
                        }
                    }
                }
            } else {
                for ($i = 0; $i < count($items); $i++) {
                    if (in_array($items[$i]->ID, $this->_config['root'])) {
                        $items[$i]->menu_item_parent = 0;
                    } elseif ($items[$i]->menu_item_parent == 0) {
                        $items[$i]->menu_item_parent = -1;
                    }
                }
            }
        }

        for ($i = 0; $i < count($items); $i++) {
            $items[$i]->id = $items[$i]->ID;
            $items[$i]->parent = $items[$i]->menu_item_parent;
            $allItems[$items[$i]->id] = $items[$i];
        }
        return $allItems;
    }

    function getActiveItem() {
        global $post;
        $current = wp_get_nav_menu_items($this->_config['menu'], array(
            'posts_per_page' => -1,
            'meta_key' => '_menu_item_object_id',
            'meta_value' => $post->ID // the currently displayed post
        ));
        if (is_array($current) && count($current) > 0) {
            $active = new stdClass();
            $active->id = $current[0]->ID;
            return $active;
        }
        return null;
    }

    function getItemsTree() {

        $items = $this->getItems();

        if ($this->_config['displaynum']) {
            for ($i = count($items) - 1; $i >= 0; $i--) {
                if (!property_exists($items[$i]->parent, 'productnum')) {
                    $items[$i]->parent->productnum = 0;
                }
                if (!property_exists($items[$i], 'productnum')) {
                    $items[$i]->productnum = 0;
                    $items[$i]->parent->productnum++;
                } else {
                    $items[$i]->parent->productnum+= $items[$i]->productnum;
                }
            }
        }
        return $items;
    }

    function filterItem($item) {
        
        $item->classes = implode(' ', $item->classes);
        
        $item->nname = '<span>' . $item->title . '</span>';
        
        if ($this->_config['displaynum'] && $item->productnum != 0) {
            $item->nname = $this->renderProductnum($item->productnum) . $item->nname;
        }
        
        if (!$this->_config['parentlink'] && $item->p) {
            $item->nname = '<a>' . $item->nname . '</a>';
        } else {
            $item->nname = '<a href="' . $item->url . '">' . $item->nname . '</a>';
        }
    }

}

?>