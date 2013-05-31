<?php

/*
 * Codé par: Fadi
 * todo Revision par: 
 */

require_once(realpath(dirname(__FILE__) . "/../adapters/MySQLAdapters/") . "/CommentaireArtisteAdapter.class.php");
require_once(realpath(dirname(__FILE__) . "/../model/") . "/CommentaireArtiste.class.php");

class CommentaireArtisteFactory {

    private $adapt;
    private static $uniqueInstance = null;

    public function __construct() {
        $this->adapt = new CommentaireArtisteAdapter();  //instancie un adapter   
    }

    public static function getInstance() {  //permet d'avoir une unique instance de PersonneFactory
        if (is_null(self::$uniqueInstance)) {
            self::$uniqueInstance = new CommentaireArtisteFactory();
        }
        return self::$uniqueInstance;
    }

    public function getCommentairesListForArtiste($id, $startIndex, $nbRecs) {
        try {
            return $this->adapt->getCommentairesListForArtiste($id, $startIndex, $nbRecs);
        } catch (Exception $e) {
            if (isDebugMode()) {
                throw $e;
            }
        }
    }

    public function getCommentairesListOfMembreForArtiste($id, $startIndex, $nbRecs) {
        try {
            return $this->adapt->getCommentairesListOfMembreForArtiste($id, $startIndex, $nbRecs);
        } catch (Exception $e) {
            if (isDebugMode()) {
                throw $e;
            }
        }
    }

    public function removeCommentaireForArtiste(CommentaireArtiste $rec) {
        try {
            return $this->adapt->removeCommentaireForArtiste($rec);
        } catch (Exception $e) {
            if (isDebugMode()) {
                throw $e;
            }
        }
    }

    public function removeCommentaireOfMembreForArtiste(CommentaireArtiste $rec) {
        try {
            return $this->adapt->removeCommentaireOfMembreForArtiste($rec);
        } catch (Exception $e) {
            if (isDebugMode()) {
                throw $e;
            }
        }
    }

    public function storeCommentaireArtiste(CommentaireArtiste $rec){
        try {
            return $this->adapt->storeCommentaireArtiste($rec);
        } catch (Exception $e) {
            if (isDebugMode()) {
                throw $e;
            }
        }
    }
    
    
     
}
?>
