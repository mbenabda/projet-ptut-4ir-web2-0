<?php
//isDebugMode() est définie dans config.php

require_once(realpath(dirname(__FILE__)."/../adapters/MySQLAdapters/")."/CategorieAdapter.class.php");
require_once(realpath(dirname(__FILE__)."/../adapters/MySQLAdapters/")."/CategorieArtisteAdapter.class.php");
require_once(realpath(dirname(__FILE__)."/../model/")."/Categorie.class.php");

class CategorieFactory 
{
    private $adapt;
    private static $uniqueInstance = null;
    
    
    public function __construct() 
    {
        $this->adapt = new CategorieAdapter();  //instancie un adapter   
    }
    
    public static function getInstance()  //permet d'avoir une unique instance de CategorieFactory
    {
	if(is_null(self::$uniqueInstance))
	{
            self::$uniqueInstance = new CategorieFactory();
	}
	return self::$uniqueInstance;               
    }

    public function getCategoriesList()
    {
	try {
            return $this->adapt->getCategoriesList();
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }
    
    public function getCategorie($id_categorie)
    {
	try {
            return $this->adapt->getCategorie($id_categorie);
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }
	
    public function removeCategorie(Categorie $cat)
    {
	try {
            return $this->adapt->removeCategorie($cat);
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }

    public function storeCategorie(Categorie &$cat)
    {
	try {
            $oldId = $cat->getId();
            $newCategorieID = $this->adapt->storeCategorie($cat);

            if(empty($newCategorieID))
                    return false;

            if(empty($oldId))
                    $cat->setId($newCategorieID);

            return true;       
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }
    
    // TODO a mettre dans CategorieArtisteFactory
    public function resetCategoriesForArtiste(Artiste $rec)
    {
	try {
            $factory_cat_art = new CategorieArtisteAdapter();
            return $factory_cat_art->resetCategoriesForArtiste($rec);
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }
    
    // TODO a mettre dans CategorieArtisteFactory
    public function storeCategorieForArtiste(Categorie $cat, Artiste $rec)
    {
	try {
            $factory_cat_art = new CategorieArtisteAdapter();
            return $factory_cat_art->storeCategorieForArtiste($rec, $cat);
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }
}

?>
