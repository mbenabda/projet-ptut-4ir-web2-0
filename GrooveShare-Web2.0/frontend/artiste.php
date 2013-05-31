<?php



define("__CONTROLEUR_FRONTEND_ARTISTE__", "comment va ????");
require_once("../common/php/config.php");


require_once(realpath(dirname(__FILE__)."/../common/php/tools/")."/DataPurifier.class.php");
require_once(realpath(dirname(__FILE__)."/../common/php/tools/")."/HTMLSkeletonGenerator.class.php");
require_once(realpath(dirname(__FILE__)."/../common/php/model/")."/Artiste.class.php");
require_once(realpath(dirname(__FILE__)."/../common/php/model/")."/Membre.class.php");
require_once(realpath(dirname(__FILE__)."/../common/php/model/")."/Categorie.class.php");
require_once(realpath(dirname(__FILE__)."/../common/php/model/")."/Langue.class.php");
require_once(realpath(dirname(__FILE__)."/../common/php/model/")."/CategorieArtiste.class.php");
require_once(realpath(dirname(__FILE__)."/../common/php/model/")."/Pays.class.php");
require_once(realpath(dirname(__FILE__)."/../common/php/model/")."/CommentaireArtiste.class.php");
require_once(realpath(dirname(__FILE__)."/../common/php/factories/")."/PersonneFactory.class.php");
require_once(realpath(dirname(__FILE__)."/../common/php/factories/")."/ArtisteFactory.class.php");
require_once(realpath(dirname(__FILE__)."/../common/php/factories/")."/MembreFactory.class.php");
require_once(realpath(dirname(__FILE__)."/../common/php/factories/")."/CategorieFactory.class.php");
require_once(realpath(dirname(__FILE__)."/../common/php/factories/")."/CategorieArtisteFactory.class.php");
require_once(realpath(dirname(__FILE__)."/../common/php/factories/")."/LangueFactory.class.php");
require_once(realpath(dirname(__FILE__)."/../common/php/factories/")."/PaysFactory.class.php");
require_once(realpath(dirname(__FILE__)."/../common/php/factories/")."/CommentaireArtisteFactory.class.php");
require_once(realpath(dirname(__FILE__)."/../common/php/factories/")."/PhotoFactory.class.php");
require_once(realpath(dirname(__FILE__)."/php/presenters/")."/GlobalNavBarPresenter.class.php");
require_once(realpath(dirname(__FILE__)."/php/presenters/")."/BiographieArtistePresenter.class.php");
require_once(realpath(dirname(__FILE__)."/php/presenters/")."/CategorieArtisteSelectorPresenter.class.php");
require_once(realpath(dirname(__FILE__)."/php/presenters/")."/FooterPresenter.class.php");
require_once(realpath(dirname(__FILE__)."/php/presenters/")."/HeaderPresenter.class.php");
require_once(realpath(dirname(__FILE__)."/php/presenters/")."/NomArtistePresenter.class.php");
require_once(realpath(dirname(__FILE__)."/php/presenters/")."/VilleArtistePresenter.class.php");
require_once(realpath(dirname(__FILE__)."/php/presenters/")."/ImageArtistePresenter.class.php");
require_once(realpath(dirname(__FILE__)."/php/presenters/")."/CommentairesArtistrePresenter.class.php");
require_once(realpath(dirname(__FILE__)."/php/presenters/")."/SignInBoxPresenter.class.php");
require_once(realpath(dirname(__FILE__)."/php/presenters/")."/ArtistePhotosPresenter.class.php");
require_once(realpath(dirname(__FILE__)."/php/presenters/")."/RatingStarPresenter.class.php");
$RatingStar=new RatingStarPresenter();
$signInBox=new SignInBoxPresenter();


//TODO recuperer l'id de la session du mec
$id_membre_connecte = 1;
$est_connecte = 1;


$html = new HTMLSkeletonGenerator();  //ça, on ne le met que dans les controller...génére la structure de la page
$html->setLang("fr");
$footer = new FooterPresenter();
$header = new HeaderPresenter();
if (isset($_GET['id'])){
    $id_artiste = $_GET['id'];

    $factory_artiste = ArtisteFactory::getInstance();
    $factory_personne = PersonneFactory::getInstance();
    $factory_commentaire_artiste = CommentaireArtisteFactory::getInstance();
    $factory_commentaire_artiste_lecture = CommentaireArtisteFactory::getInstance();
    $factory_photo = PhotoFactory::getInstance();
    
    
    //affichage de la bio
    $biographie_artiste = new BiographieArtistePresenter($factory_artiste->getArtiste($id_artiste));
    //affichage du profil
    $nom_artiste = new NomArtistePresenter($factory_artiste->getArtiste($id_artiste));
    $ville_artiste = new VilleArtistePresenter($factory_artiste->getArtiste($id_artiste));
    $avatar_artiste = new ImageArtistePresenter($factory_artiste->getArtiste($id_artiste));
    //affichage de l'image du formulaire de commentaire :
    $avatar_commentateur = new ImageArtistePresenter($factory_personne->getPersonne($id_membre_connecte));
    
    //BLOC PHOTOS
    $photos_presenter = new ArtistePhotosPresenter($factory_photo->getPhotosListByArtiste($factory_artiste->getArtiste($id_artiste), 0, 50));
    


}



$global_nav_bar = new GlobalNavBarPresenter();
$global_nav_bar->addPage("Compils", "btn_compils", "recherche_compiles.php");
$global_nav_bar->addPage("Samples", "btn_samples", "recherche_samples.php");
$global_nav_bar->addPage("Vidéos", "btn_videos", "recherche_videos.php");
$global_nav_bar->addPage("Artistes", "btn_artistes", "recherche_artistes.php", true);


require_once(realpath(dirname(__FILE__)."/pages/")."/artiste.php");
?>
