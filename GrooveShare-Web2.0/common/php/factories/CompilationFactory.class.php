<?php

require_once(realpath(dirname(__FILE__) . "/../adapters/MySQLAdapters/") . "/CompilationAdapter.class.php");
require_once(realpath(dirname(__FILE__) . "/../model/") . "/Compilation.class.php");

class CompilationFactory {

    private $adapt;
    private static $uniqueInstance = null;

    public function __construct()
    {
        $this->adapt = new CompilationAdapter();  //instancie un adapter   
    }

    //permet d'avoir une unique instance de Compilation Factory
    public static function getInstance()
    {
        if (is_null(self::$uniqueInstance))
        {
            self::$uniqueInstance = new CompilationFactory();
        }
        return self::$uniqueInstance;
    }

    public function getCompilationsList($startIndex = null, $nbRecs = null)
    {
        try
        {
            $res = $this->adapt->getCompilationsList($startIndex, $nbRecs);
            return $res;

        } catch (Exception $e)
        {
            if (isDebugMode())
            {
                throw $e;
            }
        }
    }

    public function getCompilation($id)
    {
        try
        {
            return $this->adapt->getCompilation($id);
        } catch (Exception $e)
        {
            if (isDebugMode())
            {
                throw $e;
            }
        }
    }

    public function removeCompilation(Compilation $rec)
    {
        try
        {
            return $this->adapt->removeCompilation($rec);
        } catch (Exception $e)
        {
            if (isDebugMode())
            {
                throw $e;
            }
        }
    }

    public function storeCompilation(Compilation &$rec)
    {
        try
        {
            $oldId = $rec->getId();
            $newCompilationID = $this->adapt->storeCompilation($rec);

            if (empty($newCompilationID))
                return false;

            if (empty($oldId))
                $rec->setId($newCompilationID);

            return true;
        } catch (Exception $e)
        {
            if (isDebugMode())
            {
                throw $e;
            } 
        }
    }

    public function getPlayListOfCompilation(Compilation $rec)
    {
        $res = new PlayList();
	try
        {
            $fact_art = ArtisteFactory::getInstance();
            $fact_cont = ContenuFactory::getInstance();
            $tab = $this->adapt->getPlayListOfCompilation($rec);
            $i = 0;
            $max = count($tab);
            $res = array();
            while($i < $max)
            {
                $id_art = $tab[$i];
                $id_cont = $tab[$i][$i];

                $res->addMorceau( $fact_art->getArtiste($id_art), $fact_cont->getContenu($id_cont) );
            }
        }catch(Exception $e)
        {
            if(isDebugMode()) { throw $e; } // on relance l'exception pour debug
        }
        return $res;
    }
}
?>