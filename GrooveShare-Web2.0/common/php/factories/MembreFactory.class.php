<?php
//isDebugMode() est définie dans config.php

require_once(realpath(dirname(__FILE__)."/../adapters/MySQLAdapters/")."/MembreAdapter.class.php");
require_once(realpath(dirname(__FILE__)."/../model/")."/Membre.class.php");

class MembreFactory {
    
    private $adapt;
    private static $uniqueInstance = null;
    
    public function __construct()
    {
        $this->adapt = new MembreAdapter();  //instancie un adapter    
    }
    
    public static function getInstance()  //permet d'avoir une unique instance de PersonneFactory
    {
	if(is_null(self::$uniqueInstance))
	{
            self::$uniqueInstance = new MembreFactory();
	}
	return self::$uniqueInstance;               
    }

    public function getMembresList()
    {
	try {
            return $this->adapt->getMembresList();
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }
    
    public function getMembre($id_membre)
    {
	try {
            return $this->adapt->getMembre($id_membre);
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }
	
    public function removeMembre(Membre $rec)
    {
	try {
            return $this->adapt->removeMembre($rec);
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }	


    public function storeMembre(Membre &$rec)
    {
	try {
            return $this->adapt->storeMembre($rec);
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }   
}
?>
