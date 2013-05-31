<?php

require_once(realpath(dirname(__FILE__)."/../adapters/MySQLAdapters/")."/NewsAdapter.class.php");
require_once(realpath(dirname(__FILE__)."/../model/")."/News.class.php");
require_once(realpath(dirname(__FILE__)."/../adapters/MySQLAdapters/")."/AdministrateurAdapter.class.php");

class NewsFactory 
{
    private $adapt;
    private static $uniqueInstance = null;
    
    
    public function __construct() 
    {
        $this->adapt = new NewsAdapter();  //instancie un adapter   
    }
    
    public static function getInstance()  //permet d'avoir une unique instance de CategorieFactory
    {
	if(is_null(self::$uniqueInstance))
	{
            self::$uniqueInstance = new NewsFactory();
	}
	return self::$uniqueInstance;               
    }

    public function getNewsList($startIndex = null, $nbRecs = null)
    {
	try {
            return $this->adapt->getNewsList($startIndex, $nbRecs);
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }
    
    public function getNews($id)
    {
	try {
            return $this->adapt->getNews($id);
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }
    
        public function getNewsListByAdministrateur(Administrateur $admin, $startIndex = null, $nbRecs = null)
    {
	try {
            return $this->adapt->getNewsListByAdministrateur($admin, $startIndex, $nbRecs);
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }
	
    public function removeNews(News $news)
    {
	try {
            return $this->adapt->removeNews($news);
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }

    public function storeNews(News &$news)
    {
	try {
            $oldId = $news->getId();
            $newNewsID = $this->adapt->storeNews($news);

            if(empty($newNewsID))
                    return false;

            if(empty($oldId))
                    $news->setId($newNewsID);

            return true;       
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
    }
}

?>
