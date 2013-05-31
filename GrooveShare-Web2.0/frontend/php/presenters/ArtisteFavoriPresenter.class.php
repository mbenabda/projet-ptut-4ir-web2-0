<?php

require_once(realpath(dirname(__FILE__)."/../../../common/php/interfaces/")."/IPresenter.class.php");


class ArtisteFavoriPresenter implements IPresenter

{
    private $currNewsId;
    private $baseDir;
    private $artisteFavori;
    
    public function __construct($baseDir = "")
    {
        $this->currArtFavorieId = -1;

        $this->baseDir = $baseDir; //le dossier dans lequel se trouve toutes les pages
        if(!empty($baseDir))
        {
            $last = substr($baseDir, -1);
            $this->baseDir = $baseDir . ($last == "/" ? "": "/");
        }
        $this->artisteFavori = array();
    }
    
    public function addArtFavori(News $rec)
    {
        $this->artFavoriArray[] = $rec;
    }
}

?>
