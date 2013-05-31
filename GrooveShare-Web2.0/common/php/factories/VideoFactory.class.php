<?php

require_once(realpath(dirname(__FILE__)."/../adapters/MySQLAdapters/")."/VideoAdapter.class.php");
require_once(realpath(dirname(__FILE__)."/../model/")."/Video.class.php");
require_once(realpath(dirname(__FILE__)."/../adapters/MySQLAdapters/")."/ContenuAdapter.class.php");
require_once(realpath(dirname(__FILE__)."/../adapters/MySQLAdapters/")."/ArtisteAdapter.class.php");

class VideoFactory 
{
    private $adapt;
    private static $uniqueInstance = null;
    
    
    public function __construct() 
    {
        $this->adapt = new VideoAdapter();  //instancie un adapter   
    }
    
    public static function getInstance()  //permet d'avoir une unique instance de CategorieFactory
    {
	if(is_null(self::$uniqueInstance))
	{
            self::$uniqueInstance = new VideoFactory();
	}
	return self::$uniqueInstance;               
    }

    public function getVideosList($startIndex = null, $nbRecs = null)
    {
	try {
            return $this->adapt->getVideosList($startIndex, $nbRecs);
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }
    
    public function getVideo($id)
    {
	try {
            return $this->adapt->getVideo($id);
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }
    
        public function getVideosListByArtiste(Artiste $art, $startIndex = null, $nbRecs = null)
    {
	try {
            return $this->adapt->getVideosListByArtiste($art, $startIndex, $nbRecs);
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }
	
    public function removeVideo(Video $video)
    {
	try {
            return $this->adapt->removeVideo($video);
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }

    public function storeVideo(Video &$video)
    {
	try {
            $oldId = $video->getId();
            $newVideoID= $this->adapt->storeVideo($video);

            if(empty($newVideoID))
                    return false;

            if(empty($oldId))
                    $video->setId($newVideoID);

            return true;       
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }
}

?>
