<?php

//TODO a verifier
require_once(realpath(dirname(__FILE__)."/../model/")."/CommentaireArtiste.class.php");
require_once(realpath(dirname(__FILE__)."/../model/")."/Artiste.class.php");
require_once(realpath(dirname(__FILE__)."/../model/")."/Personne.class.php");

interface ICommentaireArtisteAdapter
{ 
    //Liste des commentaires faits sur un artiste donné 
    public function getCommentairesListForArtiste($art,$startIndex, $nbRecs);     
    public function getCommentaireArtiste($id);    
    public function removeCommentaireArtiste(CommentaireArtiste $comm_art);        
    public function storeCommentaireArtiste(CommentaireArtiste &$comm_art);
}


?>
