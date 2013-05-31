<?php
//isDebugMode() est définie dans config.php

require_once(realpath(dirname(__FILE__)."/../adapters/MySQLAdapters/")."/AdministrateurAdapter.class.php");
require_once(realpath(dirname(__FILE__)."/../model/")."/Administrateur.class.php");

class AdministrateurFactory {

    private $adapt;
    private static $uniqueInstance = null;

    public function __construct()
    {
        $this->adapt = new AdministrateurAdapter();  //instancie un adapter
    }

    public static function getInstance()  //permet d'avoir une unique instance de PersonneFactory
    {
	if(is_null(self::$uniqueInstance))
	{
            self::$uniqueInstance = new AdministrateurFactory();
	}
	return self::$uniqueInstance;
    }

    public function getAdministrateursList()
    {
	try {
            return $this->adapt->getAdministrateursList();
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }

    public function getAdministrateur($id)
    {
	try {
            return $this->adapt->getAdministrateur($id);
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }

    public function removeAdministrateur(Administrateur $rec)
    {
	try {
            return $this->adapt->removeAdministrateur($rec);
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }


    public function storeAdministrateur(Administrateur &$rec)
    {
	try {
            return $this->adapt->storeAdministrateur($rec);
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }
}
?>