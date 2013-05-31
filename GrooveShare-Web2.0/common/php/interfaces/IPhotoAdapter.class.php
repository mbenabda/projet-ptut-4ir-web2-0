<?php
require_once(realpath(dirname(__FILE__)."/../model/")."/Photo.class.php");
require_once(realpath(dirname(__FILE__)."/../model/")."/Artiste.class.php");
require_once(realpath(dirname(__FILE__)."/../model/")."/Contenu.class.php");

interface IPhotoAdapter 
{
    public function getPhotosList($startIndex = null, $nbRecs = null);
    public function getPhotosListByArtiste(Artiste $art, $startIndex = null, $nbRecs = null);
    public function getPhoto($id);
    public function removePhoto(Photo $photo);
    public function storePhoto(Photo &$photo);
}
?>