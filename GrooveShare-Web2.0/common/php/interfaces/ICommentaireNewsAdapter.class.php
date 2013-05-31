<?php

//TODO a verifier
require_once(realpath(dirname(__FILE__)."/../model/")."/CommentaireNews.class.php");
require_once(realpath(dirname(__FILE__)."/../model/")."/News.class.php");
require_once(realpath(dirname(__FILE__)."/../model/")."/Personne.class.php");

interface ICommentaireNewsAdapter 
{
    
    public function getCommentairesNewsListForNews(News $news,$startIndex, $nbRecs);     
    public function getCommentaireNews($id);    
    public function removeCommentaireNews(CommentaireNews $comm_news);        
    public function storeCommentaireNews(CommentaireNews &$comm_news);
}

?>
