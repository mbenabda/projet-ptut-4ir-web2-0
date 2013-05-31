<?php

require_once(realpath(dirname(__FILE__)."/../../../common/php/interfaces/")."/IPresenter.class.php");

class ActuArtistePresenter implements IPresenter
{
    private $currNewsId;
    private $baseDir;
    private $actu;
    
    public function __construct($baseDir = "")
    {
        $this->currActuId = -1;

        $this->baseDir = $baseDir; //le dossier dans lequel se trouve toutes les pages
        if(!empty($baseDir))
        {
            $last = substr($baseDir, -1);
            $this->baseDir = $baseDir . ($last == "/" ? "": "/");
        }
        $this->actualite = array();
    }
    
    public function addActu(Artiste $rec)
    {
        $this->actuArray[] = $rec->getActualité(); // a voir
    }
    
}

?>
