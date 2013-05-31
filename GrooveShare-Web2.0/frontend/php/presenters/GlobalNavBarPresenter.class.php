<?php
require_once(realpath(dirname(__FILE__)."/../../../common/php/interfaces/")."/IPresenter.class.php");

class GlobalNavBarPresenter implements IPresenter
{
    private $currPageId;
    private $baseDir;
    private $pages;

    public function __construct($baseDir = "")
    {
        $this->currPageId = -1;

        $this->baseDir = $baseDir; //le dossier dans lequel se trouve toutes les pages
        if(!empty($baseDir))
        {
            $last = substr($baseDir, -1);
            $this->baseDir = $baseDir . ($last == "/" ? "": "/");
        }
        $this->pages = array();
    }

    public function addPage($name, $class, $link, $isCurrentPage = false)
    {
        $this->pages[] = array(
                           'class' => $class,
                           'link'  => $link,
                           'name'  => $name
                        );

        if($isCurrentPage !=  false)
            $this->currPageId = (int) (count($this->pages) - 1);
    }

    public function generateHTML()
    {
        $pages = $this->pages;
                    
        if(count($pages) <= 0) //html vide car ya pas de pages
            return "";

        $html = "";
        foreach($pages as $currId => $values)
        {
            $link = $this->baseDir . $values['link'];
            $htmlID = ($currId == $this->currPageId ? "id = 'current_active_page' " : "");
            $html .= "
                <li class = '".$values['class']."' ".$htmlID."><a href = '".$link."'>".$values['name']."</a></li>";
        }

        $html = "
        <div id=\"menu\"> 
        <ul class = 'menu'>
            ".$html."
        </ul>
        </div>
        ";

        return $html;
    }

    public function generateJS()
    { return ""; }
}
?>
