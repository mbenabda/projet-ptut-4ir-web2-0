<?php

require_once(realpath(dirname(__FILE__)."/../model/")."/StyleMusical.class.php");

interface IStyleMusicalAdapter
{
    public function getStyleMusicalList();
    public function getStyleMusical($id);
    public function removeStyleMusical(StyleMusical $stm);
    public function storeStyleMusical(StyleMusical &$stm);    
}

?>
