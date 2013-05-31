<?php

require_once(realpath(dirname(__FILE__)."/../model/")."/NoteArtiste.class.php");

interface INoteArtisteAdapter
{
    public function getNotesArtisteListForArtiste(Artiste $art, $startIndex = null, $nbRecs = null);
    public function getNoteArtiste($id);
    public function removeNoteArtiste(NoteArtiste $noteArtiste);
    public function storeNoteArtiste(NoteArtiste &$noteArtiste);
}
?>
