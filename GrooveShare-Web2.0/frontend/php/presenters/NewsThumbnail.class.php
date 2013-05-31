<?php

require_once(realpath(dirname(__FILE__)."/../../../common/php/interfaces/")."/IPresenter.class.php");


class NewsThumbnail implements IPresenter
{
    private $currNewsId;
    private $baseDir;
    private $news;

    public function __construct($baseDir = "")
    {
        $this->currNewsId = -1;

        $this->baseDir = $baseDir; //le dossier dans lequel se trouve toutes les pages
        if(!empty($baseDir))
        {
            $last = substr($baseDir, -1);
            $this->baseDir = $baseDir . ($last == "/" ? "": "/");
        }
        $this->news = array();
    }
    
    public function addNews(News $rec)
    {
        $this->newsArray[] = $rec;
    }
    
    public function generateHTML()
    {
        $news = $this->news;
                    
        if(count($news) <= 0) //html vide car ya pas de pages
            return "";

        $html = "";
        foreach($news as $currId => $values)
        {
             $html .= "
                <li class = '".$values['class']."' ".$htmlID."><a href = '".$link."'>".$values['name']."</a></li>";
        }

        $html = "
        <ul class = 'menu'>
            ".$html."
        </ul>
        ";

        return $html;
    }
    
    
    public function generateJS()
    { return ""; }
    
    
}

?>
