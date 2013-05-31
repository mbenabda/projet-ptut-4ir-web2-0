<?php
//isDebugMode() est définie dans config.php

require_once(realpath(dirname(__FILE__)."/../adapters/MySQLAdapters/")."/NoteArtisteAdapter.class.php");
require_once(realpath(dirname(__FILE__)."/../model/")."/NoteArtiste.class.php");

class MorceauFactory {

    private $adapt;
    private static $uniqueInstance = null;

    public function __construct()
    {
        $this->adapt = new SampleAdapter();  //instancie un adapter
    }

    public static function getInstance()  //permet d'avoir une unique instance
    {
	if(is_null(self::$uniqueInstance))
	{
            self::$uniqueInstance = new SampleFactory();
	}
	return self::$uniqueInstance;
    }

    public function getSamplesList()
    {
	try {
            return $this->adapt->getSamplesList();
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }

    public function getSamplesListForArtiste(Artiste $art)
    {
	try {
            return $this->adapt->getSamplesListForArtiste($art);
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }

    public function getSample($id)
    {
	try {
            return $this->adapt->getSample($id);
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }
    public function removeSample(Sample $sample)
    {
	try {
            return $this->adapt->removeSample($sample);
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }
    public function storeSample(Sample &$sample)
    {
	try {
            return $this->adapt->storeSample($sample);
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }
    
}
?>