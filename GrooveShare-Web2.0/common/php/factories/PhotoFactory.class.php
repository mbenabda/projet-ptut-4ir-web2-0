<?php

require_once(realpath(dirname(__FILE__)."/../adapters/MySQLAdapters/")."/PhotoAdapter.class.php");
require_once(realpath(dirname(__FILE__)."/../model/")."/Photo.class.php");
require_once(realpath(dirname(__FILE__)."/../adapters/MySQLAdapters/")."/ContenuAdapter.class.php");
require_once(realpath(dirname(__FILE__)."/../adapters/MySQLAdapters/")."/ArtisteAdapter.class.php");

class PhotoFactory
{
    private $adapt;
    private static $uniqueInstance = null;
    
    
    public function __construct() 
    {
        $this->adapt = new PhotoAdapter();  //instancie un adapter   
    }
    
    public static function getInstance()  //permet d'avoir une unique instance de CategorieFactory
    {
	if(is_null(self::$uniqueInstance))
	{
            self::$uniqueInstance = new PhotoFactory();
	}
	return self::$uniqueInstance;               
    }

    public function getPhotosList($startIndex = null, $nbRecs = null)
    {
	try {
            return $this->adapt->getPhotosList($startIndex, $nbRecs);
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }
    
    public function getPhoto($id)
    {
	try {
            return $this->adapt->getPhoto($id);
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }
    
        public function getPhotosListByArtiste(Artiste $art, $startIndex = null, $nbRecs = null)
    {
	try {
            return $this->adapt->getPhotosListByArtiste($art, $startIndex, $nbRecs);
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }
	
    public function removePhoto(Photo $photo)
    {
	try {
            return $this->adapt->removePhoto($photo);
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }

    public function storePhoto(Photo &$photo)
    {
	try {
            $oldId = $photo->getId();
            $newPhotoID = $this->adapt->storePhoto($photo);

            if(empty($newPhotoID))
                    return false;

            if(empty($oldId))
                    $photo->setId($newPhotoID);

            return true;       
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }
}

?>
