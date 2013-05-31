<?php
require_once(realpath(dirname(__FILE__)."/../model/")."/CategorieArtiste.class.php");
require_once(realpath(dirname(__FILE__)."/../model/")."/Artiste.class.php");
require_once(realpath(dirname(__FILE__)."/../model/")."/Categorie.class.php");

interface ICategorieArtisteAdapter 
{
    public function getCategorieArtistesList();
    public function getCategoriesListByArtiste(Artiste $art);
    public function getArtistesListByCategorie(Categorie $cat);
    public function removeCategorieForArtiste(Artiste $art,Categorie $cat);
    public function storeCategorieForArtiste(Artiste $art,Categorie $cat);
    //public function resetCategoriesForArtiste(Artiste $rec);
}

?>
