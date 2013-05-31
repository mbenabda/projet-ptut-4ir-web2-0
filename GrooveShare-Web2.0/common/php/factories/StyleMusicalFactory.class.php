<?php

require_once(realpath(dirname(__FILE__)."/../adapters/MySQLAdapters/")."/StyleMusicalAdapter.class.php");
require_once(realpath(dirname(__FILE__)."/../model/")."/StyleMusical.class.php");


class StyleMusicalFactory 
{
    private $adapt;
    private static $uniqueInstance = null;
    
    
    public function __construct() 
    {
        $this->adapt = new StyleMusicalAdapter();  //instancie un adapter   
    }
    
    public static function getInstance()  //permet d'avoir une unique instance de CategorieFactory
    {
	if(is_null(self::$uniqueInstance))
	{
            self::$uniqueInstance = new StyleMusicalFactory();
	}
	return self::$uniqueInstance;               
    }

    public function getStyleMusicalList()
    {
	try {
            return $this->adapt->getStyleMusicalList();
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }
    
    public function getStyleMusical($id)
    {
	try {
            return $this->adapt->getStyleMusical($id);
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }
    
        public function removeStyleMusical(StyleMusical $stm)
    {
	try {
            return $this->adapt->removeStyleMusical($stm);
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }

    public function storeStyleMusical(StyleMusical &$stm)
    {
	try {
            $oldId = $stm->getId();
            $newStyleMusicalID = $this->adapt->storeStyleMusical($stm);

            if(empty($newStyleMusicalID))
                    return false;

            if(empty($oldId))
                    $stm->setId($newStyleMusicalID);

            return true;       
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }
}

?>
