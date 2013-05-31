<?php
require_once(realpath(dirname(__FILE__)."/../model/")."/Categorie.class.php");
require_once(realpath(dirname(__FILE__)."/../model/")."/Personne.class.php");

interface ICategorieAdapter 
{
    public function getCategoriesList();
    public function getCategorie($id);
    public function removeCategorie(Categorie $cat);
    public function storeCategorie(Categorie $cat);
}
