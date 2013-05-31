<?php

require_once(realpath(dirname(__FILE__)."/../model/")."/News.class.php");
require_once(realpath(dirname(__FILE__)."/../model/")."/Administrateur.class.php");

interface INewsAdapter 
{
    public function getNewsList($startIndex = null, $nbRecs = null);
    public function getNews($id);
    public function getNewsListByAdministrateur(Administrateur $admin, $startIndex = null, $nbRecs = null);
    public function removeNews(News $news);
    public function storeNews(News &$news);    
}

?>
