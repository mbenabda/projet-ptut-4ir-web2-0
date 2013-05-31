<?php

/*
 * Codé par Fadi
 * todo check this
 */

require_once(realpath(dirname(__FILE__) . "/../adapters/MySQLAdapters/") . "/CommentaireContenuAdapter.class.php");
require_once(realpath(dirname(__FILE__) . "/../model/") . "/CommentaireContenu.class.php");

class CommentaireContenuFactory {

    private $adapt;
    private static $uniqueInstance = null;

    public function __construct() {
        $this->adapt = new CommentaireContenuAdapter();  //instancie un adapter    
    }

    public static function getInstance() {  //permet d'avoir une unique instance de PersonneFactory
        if (is_null(self::$uniqueInstance)) {
            self::$uniqueInstance = new CommentaireContenuFactory();
        }
        return self::$uniqueInstance;
    }

    public function getCommentaireContenuList($startIndex = null, $nbRecs = null) {
        try {
            return $this->adapt->getCommentaireContenuList($startIndex, $nbRecs);
        } catch (Exception $e) {
            if (isDebugMode()) {
                throw $e;
            } // on relance l'exception pour debug
        }
    }

    public function getCommentaireContenu($id) {
        try {
            return $this->adapt->getCommentaireContenu($id);
        } catch (Exception $e) {
            if (isDebugMode()) {
                throw $e;
            } // on relance l'exception pour debug
        }
    }

    public function removeCommentaireContenu(CommentaireContenu $rec) {
        try {
            return $this->adapt->removeCommentaireContenu($rec);
        } catch (Exception $e) {
            if (isDebugMode()) {
                throw $e;
            } // on relance l'exception pour debug
        }
    }

    public function storeCommentaireContenu(CommentaireContenu &$rec) {
        try {
            return $this->adapt->storeCommentaireContenu($rec);
        } catch (Exception $e) {
            if (isDebugMode()) {
                throw $e;
            } // on relance l'exception pour debug
        }
    }

}

?>
