<?php

require_once(realpath(dirname(__FILE__) . "/../../../common/php/interfaces/") . "/IPresenter.class.php");

class ComboBoxPresenter implements IPresenter {

    public function __construct() {
        
    }

    public function generateHTML() {
        $html = "<div class=\"box\">
                    <select id=\"ui_element\">
                        <option value=\"A\" selected>Compiles</option>
                        <option value=\"B\">Artistes</option>
                        <option value=\"C\">Samples</option>
                    </select>
                </div>";
        return $html;
    }

    public function generateJS() {
        $html = "
        <script type='text/javascript'>
            jQuery.noConflict();
            jQuery(function() {
                jQuery('#ui_element').scrollablecombo();
            });
        </script>";
        return $html;
    }
    
    public function generateCSS() {
        $html="";
        return $html;
    }
    
    public function generateImportCSS(HTMLSkeletonGenerator &$html) {
        $html->addStylesheet("../css/skins/comboboxstyle/combo.css");
    }
    
    public function generateImportJS(HTMLSkeletonGenerator &$html) {
        $html->addScript("http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js");
        $html->addScript("../js/jquery.scrollablecombo.js");
    }
}
?> 

