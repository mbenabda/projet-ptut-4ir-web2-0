<?php

require_once(realpath(dirname(__FILE__)."/../model/")."/NoteCompilation.class.php");

interface INoteCompilationAdapter
{
    public function getNotesCompilationListForCompilation(Compilation $comp, $startIndex = null, $nbRecs = null);
    public function getNoteCompilation($id);
    public function removeNoteCompilation(NoteCompilation $noteCompilation);
    public function storeNoteCompilation(NoteCompilation &$noteCompilation);
}
?>
