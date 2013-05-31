<?php
//isDebugMode() est définie dans config.php

require_once(realpath(dirname(__FILE__)."/../adapters/MySQLAdapters/")."/PersonneAdapter.class.php");
require_once(realpath(dirname(__FILE__)."/../model/")."/Personne.class.php");

class PersonneFactory {
    
    private $adapt;
    private static $uniqueInstance = null;
    
    public function __construct() 
    {
        $this->adapt = new PersonneAdapter();  //instancie un adapter
    }
    
    public static function getInstance()  //permet d'avoir une unique instance de PersonneFactory
    {
	if(is_null(self::$uniqueInstance))
	{
            self::$uniqueInstance = new PersonneFactory();
	}
	return self::$uniqueInstance;               
    }


    public function isRegisteredEmail($email)
    {
	try {
            return $this->adapt->isRegisteredEmail($email);
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }

    }
    
    public function isRegisteredLogin($login)
    {
	try {
            return $this->adapt->isRegisteredLogin($login);
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }


    public function getPersonnesList()
    {
	try {
            return $this->adapt->getPersonnesList();
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }
    
    public function getPersonne($id)
    {
	try {
            return $this->adapt->getPersonne($id);
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }
	
    public function removePersonne(Personne $pers)
    {
	try {
            return $this->adapt->removePersonne($pers);
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }	


    public function storePersonne(Personne &$pers)
    {
	try {
            $oldId = $pers->getId();
            $newPersonneId = $this->adapt->storePersonne($pers);

            if(empty($newPersonneId))
                    return false;

            if(empty($oldId))
                    $pers->setId($newPersonneId);

            return true;
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }
}
?>