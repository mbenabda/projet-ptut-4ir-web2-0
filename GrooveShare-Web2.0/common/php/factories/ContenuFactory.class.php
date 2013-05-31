<?php
//isDebugMode() est définie dans config.php

require_once(realpath(dirname(__FILE__)."/../adapters/MySQLAdapters/")."/ContenuAdapter.class.php");
require_once(realpath(dirname(__FILE__)."/../model/")."/Contenu.class.php");

class ContenuFactory 
{
    
    private $adapt;
    private static $uniqueInstance = null;
    
    
    public function __construct() 
    {
        $this->adapt = new ContenuAdapter();  //instancie un adapter   
    }
    
    public static function getInstance()  //permet d'avoir une unique instance de CategorieFactory
    {
	if(is_null(self::$uniqueInstance))
	{
            self::$uniqueInstance = new ContenuFactory();
	}
	return self::$uniqueInstance;               
    }

    public function getContenusList()
    {
	try {
            return $this->adapt->getContenusList();
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }
    
    public function getContenu($id_contenu)
    {
	try {
            return $this->adapt->getContenu($id_contenu);
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }
	
    public function removeContenu(Contenu $cont)
    {
	try {
            return $this->adapt->removeContenu($cont);
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }

    public function storeContenu(Contenu &$cont)
    {
	try {
            $oldId = $cont->getId();
            $newContenuID = $this->adapt->storeContenu($cont);

            if(empty($newContenuID))
                    return false;

            if(empty($oldId))
                    $cont->setId($newContenuID);

            return true;       
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }
    
}

?>
