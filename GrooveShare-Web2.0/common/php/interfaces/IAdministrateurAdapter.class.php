<?php
require_once(realpath(dirname(__FILE__)."/../model/")."/Administrateur.class.php");

interface IAdministrateurAdapter
{
    public function getAdministrateursList($startIndex = null, $nbRecs = null);
    public function getAdministrateur($id);
    public function removeAdministrateur(Administrateur $rec);
    public function storeAdministrateur(Administrateur &$rec);
}
?>
