<?php
require_once(realpath(dirname(__FILE__)."/../../../common/php/interfaces/")."/IPresenter.class.php");

class CommentaireArtistePresenter implements IPresenter
{

    private $liste_commentaires;
    
    public function __construct(ArrayObject $tabComent)
    {
        $this->liste_commentaires = $tabComent;
    }

    public function generateHTML()
    {
        $liste = $this->liste_commentaires;
                    
        if(count($liste) <= 0) //html vide car ya pas de pages
            return "";

        $html = "";
        foreach($liste as $currComent)
        {
           
            $html .=  "<li>
                                    <img src=\"".$currComent['avatar_personne']."\">".
                                    $currComent['prenom_personne']." ".$currComent['nom_personne']." : ".$currComent['commentaire']->getTexteCommentaire()."
                      </li>";
        }

        return $html;
    }

    public function generateJS()
    { return ""; }
}
?>