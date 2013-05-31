<?php

require_once(realpath(dirname(__FILE__)."/../common/php/factories/")."/CommentaireArtisteFactory.class.php");
require_once(realpath(dirname(__FILE__)."/../common/php/factories/")."/ArtisteFactory.class.php");
require_once(realpath(dirname(__FILE__)."/../common/php/factories/")."/PersonneFactory.class.php");
require_once(realpath(dirname(__FILE__)."/php/presenters/")."/CommentairesArtistrePresenter.class.php");


if (isset($_POST['id']))
{
    $id_artiste = $_POST['id'];
    $factory_personne = PersonneFactory::getInstance();
    $factory_commentaire_artiste_lecture = CommentaireArtisteFactory::getInstance();
    $liste_commentaire = $factory_commentaire_artiste_lecture->getCommentairesListForArtiste($id_artiste,0,10);
    $liste_commentaire_with_personne = new ArrayObject();
    $commentaire_with_personne = array();


 foreach($liste_commentaire as $currComent)
        {
           $personne = $factory_personne->getPersonne($currComent->getIdPersonne());
           $commentaire_with_personne['prenom_personne']=$personne->getPrenom();
           $commentaire_with_personne['nom_personne']=$personne->getNom();
           $commentaire_with_personne['avatar_personne']=$personne->getURLAvatar();
           $commentaire_with_personne['commentaire']=$currComent;
           
           $liste_commentaire_with_personne->append($commentaire_with_personne);
        }
        
    $commentaire_artiste_presenter = new CommentaireArtistePresenter($liste_commentaire_with_personne);
    echo $commentaire_artiste_presenter->generateHTML();
}

?>
