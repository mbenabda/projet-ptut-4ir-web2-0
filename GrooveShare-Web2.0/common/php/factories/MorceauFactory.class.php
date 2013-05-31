<?php

require_once(realpath(dirname(__FILE__)."/../adapters/MySQLAdapters/")."/MorceauAdapter.class.php");
require_once(realpath(dirname(__FILE__)."/../model/")."/Morceau.class.php");
require_once(realpath(dirname(__FILE__)."/../adapters/MySQLAdapters/")."/ContenuAdapter.class.php");
require_once(realpath(dirname(__FILE__)."/../adapters/MySQLAdapters/")."/StyleMusicalAdapter.class.php");


class MorceauFactory 
{
    private $adapt;
    private static $uniqueInstance = null;
    
    
    public function __construct() 
    {
        $this->adapt = new MorceauAdapter();  //instancie un adapter   
    }
    
    public static function getInstance()  //permet d'avoir une unique instance de CategorieFactory
    {
	if(is_null(self::$uniqueInstance))
	{
            self::$uniqueInstance = new MorceauFactory();
	}
	return self::$uniqueInstance;               
    }

    public function getMorceauxList($startIndex = null, $nbRecs = null)
    {
	try {
            return $this->adapt->getMorceauxList($startIndex, $nbRecs);
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }
    
    public function getMorceau($id)
    {
	try {
            return $this->adapt->getMorceau($id);
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }
    
        public function getMorceauxListFromStyleMusique(StyleMusical $stm, $startIndex = null, $nbRecs = null)
    {
	try {
            return $this->adapt->getMorceauxListFromStyleMusique($stm, $startIndex, $nbRecs);
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }
	
    public function removeMorceau(Morceau $morc)
    {
	try {
            return $this->adapt->removeMorceau($morc);
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }

    public function storeMorceau(Morceau &$morc)
    {
	try {
            $oldId = $morc->getId();
            $newMorceauID = $this->adapt->storeMorceau($morc);

            if(empty($newMorceauID))
                    return false;

            if(empty($oldId))
                    $morc->setId($newMorceauID);

            return true;       
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }
}

?>
