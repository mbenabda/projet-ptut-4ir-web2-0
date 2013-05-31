<?php

require_once(realpath(dirname(__FILE__)."/../model/")."/Membre.class.php");

interface IMembreAdapter
{
    public function getMembresList($startIndex = null, $nbRecs = null);
    public function getMembre($id);
    public function removeMembre(Membre $rec);
    public function storeMembre(Membre &$rec);
}
?>
