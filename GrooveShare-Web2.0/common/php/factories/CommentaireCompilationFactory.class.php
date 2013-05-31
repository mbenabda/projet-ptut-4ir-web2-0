<?php

/*
 * Codé par: Fadi
 * todo Revision par: 
 */

require_once(realpath(dirname(__FILE__) . "/../adapters/MySQLAdapters/") . "/CommentaireCompilationAdapter.class.php");
require_once(realpath(dirname(__FILE__) . "/../model/") . "/CommentaireCompilation.class.php");

class CommentaireCompilationFactory {

    private $adapt;
    private static $uniqueInstance = null;

    public function __construct() {
        $this->adapt = new CommentaireCompilationAdapter();  //instancie un adapter   
    }

    public static function getInstance() {  //permet d'avoir une unique instance de PersonneFactory
        if (is_null(self::$uniqueInstance)) {
            self::$uniqueInstance = new CommentaireCompilationFactory();
        }
        return self::$uniqueInstance;
    }

    //Liste des commentaires faits sur une compilation donné 
    public function getCommentairesListForCompilation($id, $startIndex, $nbRecs) {
        try {
            return $this->adapt->getCommentairesListForCompilation($id, $startIndex, $nbRecs);
        } catch (Exception $e) {
            if (isDebugMode()) {
                throw $e;
            }
        }
    }

    //Liste des commentaires faits par une personne donné sur toutes les compilation
    public function getCommentairesCompilationListOfMembre($id, $startIndex, $nbRecs) {
        try {
            return $this->adapt->getCommentairesCompitlationListOfMembreForArtiste($id, $startIndex, $nbRecs);
        } catch (Exception $e) {
            if (isDebugMode()) {
                throw $e;
            }
        }
    }

    //remove les commentaires sur une compilation donné  
    public function removeCommentaireForCompilation(CommentaireArtiste $rec) {
        try {
            return $this->adapt->removeCommentaireForCompilation($rec);
        } catch (Exception $e) {
            if (isDebugMode()) {
                throw $e;
            }
        }
    }

    //remove les commentaires d'un membre donné  
    public function removeCommentaireOfMembreForCompilation(CommentaireArtiste $rec) {
        try {
            return $this->adapt->removeCommentaireOfMembreForCompilation($rec);
        } catch (Exception $e) {
            if (isDebugMode()) {
                throw $e;
            }
        }
    }

    public function storeCommentaireCompilation(CommentaireArtiste $rec){
        try {
            return $this->adapt->storeCommentaireCompilation($rec);
        } catch (Exception $e) {
            if (isDebugMode()) {
                throw $e;
            }
        }        
    }
}

?>
