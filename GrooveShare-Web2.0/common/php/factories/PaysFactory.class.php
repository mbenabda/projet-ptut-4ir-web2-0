<?php
//isDebugMode() est définie dans config.php

require_once(realpath(dirname(__FILE__)."/../adapters/MySQLAdapters/")."/PaysAdapter.class.php");
require_once(realpath(dirname(__FILE__)."/../model/")."/Pays.class.php");

class PaysFactory 
{
    private $adapt;
    private static $uniqueInstance = null;
    
    
    public function __construct() 
    {
        $this->adapt = new PaysAdapter();  //instancie un adapter   
    }
    
    public static function getInstance()  //permet d'avoir une unique instance de CategorieFactory
    {
	if(is_null(self::$uniqueInstance))
	{
            self::$uniqueInstance = new PaysFactory();
	}
	return self::$uniqueInstance;               
    }

    public function getPaysList()
    {
	try {
            return $this->adapt->getPaysList();
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }
    
    public function getPays($id_pays)
    {
	try {
            return $this->adapt->getPays($id_pays);
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }
	
    public function removePays(Pays $pays)
    {
	try {
            return $this->adapt->removePays($pays);
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }

    public function storePays(Pays &$pays)
    {
	try {
            $oldId = $pays->getId();
            $newPaysID = $this->adapt->storePays($pays);

            if(empty($newPaysID))
                    return false;

            if(empty($oldId))
                    $pays->setId($newPaysID);

            return true;       
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }
    
}

?>
