<?php

require_once(realpath(dirname(__FILE__)."/../model/")."/NoteContenu.class.php");

interface INoteContenuAdapter
{
    public function getNotesContenuListForContenu(Contenu $cont, $startIndex = null, $nbRecs = null);
    public function getNoteContenu($id);
    public function removeNoteContenu(NoteContenu $noteContenu);
    public function storeNoteContenu(NoteContenu &$noteContenu);
}
?>
