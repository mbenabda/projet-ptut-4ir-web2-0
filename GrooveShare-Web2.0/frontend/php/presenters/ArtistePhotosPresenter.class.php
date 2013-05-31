<?php

require_once(realpath(dirname(__FILE__)."/../../../common/php/interfaces/")."/IPresenter.class.php");

class ArtistePhotosPresenter 
{

    private $liste_photos;
    
    public function __construct(ArrayObject $tabPhotos = NULL)
    {
        $this->liste_photos = $tabPhotos;
    }

    public function generateHTML()
    {
        $liste = $this->liste_photos;
                    
        if(count($liste) <= 0) //html vide car ya pas de pages
            return "";

        $html = "";
        foreach($liste as $currPhoto)
        {
           
            $html .= "
                
 <li><a href=\"".$currPhoto->getURL()."\" class=\"popup\"><img src=\"".$currPhoto->getURL()."\" width=\"140\" height=\"100\" alt=\"\" /></a></li>";

              
        }

        return $html;
    }

    public function generateJS()
    { return ""; }
}
?>

