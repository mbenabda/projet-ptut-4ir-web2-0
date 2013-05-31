<?php
require_once(realpath(dirname(__FILE__)."/../model/")."/Artiste.class.php");

interface IArtisteAdapter
{
    public function getArtistesList($startIndex = null, $nbRecs = null);
    public function getArtiste($id);
    public function removeArtiste(Artiste $rec);
    public function storeArtiste(Artiste &$rec);
    public function getArtisteCount();
}
?>
