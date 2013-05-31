<?php
//TODO: Vérifier
require_once(realpath(dirname(__FILE__)."/../model/")."/TraductionCategorie.class.php");
require_once(realpath(dirname(__FILE__)."/../model/")."/Categorie.class.php");
require_once(realpath(dirname(__FILE__)."/../model/")."/Langue.class.php");


interface ITraductionCategorieAdapter 
{
    public function getTraductionCategorie($idCat,$idLan);
    public function removeTraductionCategorie(TraductionCategorie $tra);
    public function storeTraductionCategorie(TraductionCategorie &$tra);  
}

?>
