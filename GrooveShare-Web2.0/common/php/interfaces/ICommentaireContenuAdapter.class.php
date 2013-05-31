<?php

/*
 * Codé par fadi
 * Todo check this
 */

require_once(realpath(dirname(__FILE__)."/../model/")."/CommentaireContenu.class.php");


interface ICommentaireContenuAdapter {
    public function getCommentaireContenuListForContenu(Contenu $cont, $startIndex = null, $nbRecs = null);
    public function getCommentaireContenu($id);
    public function removeCommentaireContenu(CommentaireContenu $comm_cont);
    public function storeCommentaireContenu(CommentaireContenu &$comm_cont);
}

?>
