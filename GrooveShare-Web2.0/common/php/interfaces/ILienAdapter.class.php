<?php

require_once(realpath(dirname(__FILE__)."/../model/")."/Lien.class.php");
require_once(realpath(dirname(__FILE__)."/../model/")."/Artiste.class.php");

interface ILienAdapter 
{
    public function getLiensList($startIndex = null, $nbRecs = null);
    public function getLien($id);
    public function getLiensListForArtiste(Artiste $art, $startIndex = null, $nbRecs = null);
    public function removeLien(Lien $lien);
    public function storeLien(Lien &$lien);    
}

?>
