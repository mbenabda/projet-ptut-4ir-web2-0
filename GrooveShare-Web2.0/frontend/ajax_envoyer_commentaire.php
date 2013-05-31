 
<?php

require_once(realpath(dirname(__FILE__)."/../common/php/factories/")."/CommentaireArtisteFactory.class.php");
$id_membre_connecte=1;


$factory_commentaire_artiste = CommentaireArtisteFactory::getInstance();
if(isset($_POST['commentaire'])){
    if (isset($_POST['id'])){
            $id_artiste=$_POST['id'];
            $commentaire_artiste = new CommentaireArtiste();
            $commentaire_artiste->setIdPersonne($id_membre_connecte);
            $commentaire_artiste->setIdArtiste($id_artiste);
            $commentaire_artiste->setTexteCommentaire(DataPurifier::purifyString($_POST['commentaire']));
            //TODO recuperer la date de creation

            $factory_commentaire_artiste->storeCommentaireArtiste($commentaire_artiste);
    }
}
        
        
?>