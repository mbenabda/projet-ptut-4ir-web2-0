<?php
require_once(realpath(dirname(__FILE__)."/../model/")."/Video.class.php");
require_once(realpath(dirname(__FILE__)."/../model/")."/Artiste.class.php");
require_once(realpath(dirname(__FILE__)."/../model/")."/Contenu.class.php");

interface IVideoAdapter
{
    public function getVideosList($startIndex = null, $nbRecs = null);
    public function getVideosListByArtiste(Artiste $art, $startIndex = null, $nbRecs = null);
    public function getVideo($id);
    public function removeVideo(Video $video);
    public function storeVideo(Video &$video);
}
?>