<?php

require_once(realpath(dirname(__FILE__)."/../adapters/MySQLAdapters/")."/SampleAdapter.class.php");
require_once(realpath(dirname(__FILE__)."/../model/")."/Sample.class.php");
require_once(realpath(dirname(__FILE__)."/../adapters/MySQLAdapters/")."/ContenuAdapter.class.php");
require_once(realpath(dirname(__FILE__)."/../adapters/MySQLAdapters/")."/ArtisteAdapter.class.php");


class SampleFactory 
{
    private $adapt;
    private static $uniqueInstance = null;
    
    
    public function __construct() 
    {
        $this->adapt = new SampleAdapter();  //instancie un adapter   
    }
    
    public static function getInstance()  //permet d'avoir une unique instance de CategorieFactory
    {
	if(is_null(self::$uniqueInstance))
	{
            self::$uniqueInstance = new SampleFactory();
	}
	return self::$uniqueInstance;               
    }

    public function getSamplesList($startIndex = null, $nbRecs = null)
    {
	try {
            return $this->adapt->getSamplesList($startIndex, $nbRecs);
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
    
        public function getSamplesListForArtiste(Artiste $art, $startIndex = null, $nbRecs = null)
    {
	try {
            return $this->adapt->getSamplesListForArtiste($art, $startIndex, $nbRecs);
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
            $oldId = $sample->getId();
            $newSampleID = $this->adapt->storeSample($sample);

            if(empty($newSampleID))
                    return false;

            if(empty($oldId))
                    $sample->setId($newSampleID);

            return true;       
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }
    
}

?>
