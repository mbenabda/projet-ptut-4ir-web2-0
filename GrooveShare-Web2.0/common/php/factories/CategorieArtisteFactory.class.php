<?php

//isDebugMode() est définie dans config.php

require_once(realpath(dirname(__FILE__)."/../adapters/MySQLAdapters/")."/CategorieAdapter.class.php");
require_once(realpath(dirname(__FILE__)."/../adapters/MySQLAdapters/")."/CategorieArtisteAdapter.class.php");
require_once(realpath(dirname(__FILE__)."/../model/")."/Categorie.class.php");


class CategorieArtisteFactory 
{
    private $adapt;
    private static $uniqueInstance = null;
    
    
    public function __construct() 
    {
        $this->adapt = new CategorieArtisteAdapter();  //instancie un adapter   
    }
    
    public static function getInstance()  //permet d'avoir une unique instance de CategorieFactory
    {
	if(is_null(self::$uniqueInstance))
	{
            self::$uniqueInstance = new CategorieArtisteFactory();
	}
	return self::$uniqueInstance;               
    }

    public function getCategorieArtistesList()
    {
	try {
            return $this->adapt->getCategorieArtistesList();
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }
    
    public function getCategoriesListByArtiste(Artiste $art)
    {
	try {
            return $this->adapt->getCategoriesListByArtiste($art);
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }
    
    public function getArtistesListByCategorie(Categorie $cat)
    {
	try {
            return $this->adapt->getArtistesListByCategorie($cat);
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }
	
    public function removeCategorieForArtiste(Artiste $art,Categorie $cat)
    {
	try {
            return $this->adapt->removeCategorieForArtiste($art, $cat);
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }

    
    public function storeCategorieForArtiste(Categorie $cat, Artiste $rec)
    {
	try {
            $this->adapt->storeCategorieForArtiste($rec, $cat);
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }
    
    public function resetCategoriesForArtiste(Artiste $art)
    {
	try {
            $list_cat = $this->adapt->getCategoriesListByArtiste($art);
            $result = true;
            foreach($list_cat as $currCat)
            {
                $result = $result && $this->adapt->removeCategorieForArtiste($art, $currCat);
            }
            return $result;
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }

    
}

?>
