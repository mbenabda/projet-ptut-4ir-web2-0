<?php

/*
 * Codé par fadi
 * todo check this
 */


require_once(realpath(dirname(__FILE__) . "/../model/") . "/NoteNews.class.php");

interface INoteNewsAdapter {

    public function getNoteNewsList($startIndex = null, $nbRecs = null);

    public function getNoteNews($id);

    public function removeNoteNews(NoteNews $rec);

    public function storeNoteNews(NoteNews &$rec);
}

?>
