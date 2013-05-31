<?php

/*
 * Codé par: Fadi
 * todo Revision par: 
 */

require_once(realpath(dirname(__FILE__) . "/../adapters/MySQLAdapters/") . "/CommentaireNewsAdapter.class.php");
require_once(realpath(dirname(__FILE__) . "/../model/") . "/CommentaireNews.class.php");

class CommentaireNewsFactory {

    private $adapt;
    private static $uniqueInstance = null;

    public function __construct() {
        $this->adapt = new CommentaireNewsAdapter();  //instancie un adapter   
    }

    public static function getInstance() {  //permet d'avoir une unique instance de PersonneFactory
        if (is_null(self::$uniqueInstance)) {
            self::$uniqueInstance = new CommentaireNewsFactory();
        }
        return self::$uniqueInstance;
    }

    //Liste des commentaires faits sur un news donné 
    public function getCommentairesListForNews($id, $startIndex, $nbRecs) {
        try {
            return $this->adapt->getCommentairesListForNews($id, $startIndex, $nbRecs);
        } catch (Exception $e) {
            if (isDebugMode()) {
                throw $e;
            }
        }
    }

    //Liste des commentaires faits par une personne donné sur toutes les news
    public function getCommentairesListOfMembreForNews($id, $startIndex, $nbRecs) {
        try {
            return $this->adapt->getCommentairesListOfMembreForNews($id, $startIndex, $nbRecs);
        } catch (Exception $e) {
            if (isDebugMode()) {
                throw $e;
            }
        }
    }

    //remove les commentaires sur un news donné  
    public function removeCommentaireForNews(CommentaireArtiste $rec) {
        try {
            return $this->adapt->removeCommentaireForNews($rec);
        } catch (Exception $e) {
            if (isDebugMode()) {
                throw $e;
            }
        }
    }

    //remove les commentaires d'un membre donné  
    public function removeCommentaireOfMembreForNews(CommentaireArtiste $rec) {
        try {
            return $this->adapt->removeCommentaireOfMembreForNews($rec);
        } catch (Exception $e) {
            if (isDebugMode()) {
                throw $e;
            }
        }
    }

    public function storeCommentaireNews(CommentaireArtiste $rec) {
        try {
            return $this->adapt->storeCommentaireNews($rec);
        } catch (Exception $e) {
            if (isDebugMode()) {
                throw $e;
            }
        }
    }

}

?>
