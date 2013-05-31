<?php

/*
 * Codé par: Fadi
 * todo Revision par: 
 */

require_once(realpath(dirname(__FILE__) . "/../adapters/MySQLAdapters/") . "/NoteNewsAdapter.class.php");
require_once(realpath(dirname(__FILE__) . "/../model/") . "/NoteNews.class.php");

class NoteNewsFactory {

    public function __construct() {
        $this->adapt = new CommentaireNewsAdapter();  //instancie un adapter   
    }

    public static function getInstance() {  //permet d'avoir une unique instance de PersonneFactory
        if (is_null(self::$uniqueInstance)) {
            self::$uniqueInstance = new CommentaireNewsFactory();
        }
        return self::$uniqueInstance;
    }

    public function getNoteNewsList($startIndex = null, $nbRecs = null) {
        try {
            return $this->adapt->getNoteNewsList($startIndex, $nbRecs);
        } catch (Exception $e) {
            if (isDebugMode()) {
                throw $e;
            }
        }
    }

    public function getNoteNews($id) {
        try {
            return $this->adapt->getNoteNews($id);
        } catch (Exception $e) {
            if (isDebugMode()) {
                throw $e;
            }
        }
    }

    public function removeNoteNews(NoteNews $rec) {
        try {
            return $this->adapt->removeNoteNews($rec);
        } catch (Exception $e) {
            if (isDebugMode()) {
                throw $e;
            }
        }
    }

    public function storeNoteNews(NoteNews &$rec) {
        try {
            return $this->adapt->storeNoteNews($rec);
        } catch (Exception $e) {
            if (isDebugMode()) {
                throw $e;
            }
        }
    }

}

?>
