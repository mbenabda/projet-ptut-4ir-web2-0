<?php
//isDebugMode() est définie dans config.php

require_once(realpath(dirname(__FILE__)."/../adapters/MySQLAdapters/")."/LangueAdapter.class.php");
require_once(realpath(dirname(__FILE__)."/../model/")."/Langue.class.php");

class LangueFactory 
{
    private $adapt;
    private static $uniqueInstance = null;
    
    
    public function __construct() 
    {
        $this->adapt = new LangueAdapter();  //instancie un adapter   
    }
    
    public static function getInstance()  //permet d'avoir une unique instance de CategorieFactory
    {
	if(is_null(self::$uniqueInstance))
	{
            self::$uniqueInstance = new LangueFactory();
	}
	return self::$uniqueInstance;               
    }

    public function getLanguesList()
    {
	try {
            return $this->adapt->getLanguesList();
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }
    
    public function getLangue($id_langue)
    {
	try {
            return $this->adapt->getLangue($id_langue);
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }
	
    public function removeLangue(Langue $lang)
    {
	try {
            return $this->adapt->removeLangue($lang);
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }

    public function storeLangue(Langue &$lang)
    {
	try {
            $oldId = $lang->getId();
            $newLangueID = $this->adapt->storeLangue($lang);

            if(empty($newLangueID))
                    return false;

            if(empty($oldId))
                    $lang->setId($newLangueID);

            return true;       
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }
    
}

?>
