<?php


//TODO a verifier
require_once(realpath(dirname(__FILE__)."/../model/")."/CommentaireCompilation.class.php");
require_once(realpath(dirname(__FILE__)."/../model/")."/Compilation.class.php");
require_once(realpath(dirname(__FILE__)."/../model/")."/Personne.class.php");

interface ICommentaireCompilationAdapter 
{  

    public function getCommentairesCompilationListForCompilation(Compilation $comp,$startIndex, $nbRecs);     
    public function getCommentaireCompilation($id);    
    public function removeCommentaireCompilation(CommentaireCompilation $comm_compil);        
    public function storeCommentaireCompilation(CommentaireCompilation &$comm_compil);
}

?>
