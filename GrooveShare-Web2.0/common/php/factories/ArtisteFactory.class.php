<?php
//isDebugMode() est définie dans config.php

require_once(realpath(dirname(__FILE__)."/../adapters/MySQLAdapters/")."/ArtisteAdapter.class.php");
require_once(realpath(dirname(__FILE__)."/../factories/")."/CategorieArtisteFactory.class.php");
require_once(realpath(dirname(__FILE__)."/../factories/")."/CategorieFactory.class.php");
require_once(realpath(dirname(__FILE__)."/../model/")."/Artiste.class.php");
require_once(realpath(dirname(__FILE__)."/")."/CategorieFactory.class.php");
require_once(realpath(dirname(__FILE__)."/../")."/globalFunctions.php");

class ArtisteFactory {
   
    private $adapt;
    private static $uniqueInstance = null;
    
    
    public function __construct() 
    {
        $this->adapt = new ArtisteAdapter();  //instancie un adapter   
    }
    
    public static function getInstance()  //permet d'avoir une unique instance de PersonneFactory
    {
	if(is_null(self::$uniqueInstance))
	{
            self::$uniqueInstance = new ArtisteFactory();
	}
	return self::$uniqueInstance;               
    }

    public function getArtistesList($startIndex = null, $nbRecs = null)
    {
	try {
            return $this->adapt->getArtistesList($startIndex, $nbRecs);
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }
    
    public function getArtiste($id_artiste)
    {
	try {
            return $this->adapt->getArtiste($id_artiste);
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }
	
    public function removeArtiste(Artiste $art)
    {
	try {
            $factory_categorie_artiste = CategorieArtisteFactory::getInstance();
            $result = $factory_categorie_artiste->resetCategoriesForArtiste($art);
            if($result)
            {
                 return $this->adapt->removeArtiste($art);
            }
            return false;
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }

    public function storeArtiste(Artiste &$art, $categoriesIdsArray = null)
    {
	try {
            if(!is_array($categoriesIdsArray))
                $categoriesIdsArray = null;

            $result = $this->adapt->storeArtiste($art);
            if($result && $categoriesIdsArray != null)
            {
                $factory_categorie = CategorieFactory::getInstance();
                $factory_categorie_artiste = CategorieArtisteFactory::getInstance();
                // pour un artiste, on enregistre ses catégories
                $factory_categorie_artiste->resetCategoriesForArtiste($art);
                foreach($categoriesIdsArray as $currId)
                {
                    $curr_categorie = $factory_categorie->getCategorie($currId);
                    $factory_categorie_artiste->storeCategorieForArtiste($curr_categorie, $art);
                }
                return true;
            }
            return false;
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }
}
?>