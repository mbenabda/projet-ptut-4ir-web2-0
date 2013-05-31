<?php
require_once(realpath(dirname(__FILE__)."/../../../common/php/interfaces/")."/IPresenter.class.php");

class ListeNewArtistesPresenter implements IPresenter
{

    private $liste_artistes;
    
    public function __construct(ArrayObject $tabArtistes = NULL)
    {
        $this->liste_artistes = $tabArtistes;
    }

    public function generateHTML()
    {
        $liste = $this->liste_artistes;
                    
        if(count($liste) <= 0) //html vide car ya pas de pages
            return "";

        $html = "";
        foreach($liste as $currArtiste)
        {
           
            $html .= "
                <li><a href = \"artiste.php?id=".$currArtiste->getId()."\"><img src=\"".$currArtiste->getUrlAvatar()."\" width=\"75\" height=\"75\" alt=\"\" /></a></li>"; // a modifier pour aller sur la bonne page
        }

        $html = "
        <ul id = 'mycarousel' class = 'jcarousel-skin-tango'>".
            $html."
        </ul>";
        return $html;
    }

    public function generateJS()
    { return ""; }
}
?>