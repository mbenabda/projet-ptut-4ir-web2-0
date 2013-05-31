<?php

require_once(realpath(dirname(__FILE__)."/../adapters/MySQLAdapters/")."/LienAdapter.class.php");
require_once(realpath(dirname(__FILE__)."/../model/")."/Lien.class.php");
require_once(realpath(dirname(__FILE__)."/../adapters/MySQLAdapters/")."/ArtisteAdapter.class.php");

class LienFactory 
{
    private $adapt;
    private static $uniqueInstance = null;
    
    
    public function __construct() 
    {
        $this->adapt = new LienAdapter();  //instancie un adapter   
    }
    
    public static function getInstance()  //permet d'avoir une unique instance de CategorieFactory
    {
	if(is_null(self::$uniqueInstance))
	{
            self::$uniqueInstance = new LienFactory();
	}
	return self::$uniqueInstance;               
    }

    public function getLiensList($startIndex = null, $nbRecs = null)
    {
	try {
            return $this->adapt->getLiensList($startIndex, $nbRecs);
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }
    
    public function getLien($id)
    {
	try {
            return $this->adapt->getLien($id);
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }
    
        public function getLiensListForArtiste(Artiste $art, $startIndex = null, $nbRecs = null)
    {
	try {
            return $this->adapt->getLiensListForArtiste($art, $startIndex, $nbRecs);
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }
	
    public function removeLien(Lien $lien)
    {
	try {
            return $this->adapt->removeLien($lien);
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }

    public function storeLien(Lien &$lien)
    {
	try {
            $oldId = $lien->getId();
            $newLienID = $this->adapt->storeLien($lien);

            if(empty($newLienID))
                    return false;

            if(empty($oldId))
                    $lien->setId($newLienID);

            return true;       
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }
}

?>
