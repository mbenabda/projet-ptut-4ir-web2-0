<?php
if( !isset($_GET['id']) )
{
    header('Location: ./index.php');
}




define("__CONTROLEUR_FRONTEND_MEMBRE__", "comment va ????");
require_once("../common/php/config.php");


require_once(realpath(dirname(__FILE__)."/../common/php/tools/")."/DataPurifier.class.php");
require_once(realpath(dirname(__FILE__)."/../common/php/tools/")."/HTMLSkeletonGenerator.class.php");
require_once(realpath(dirname(__FILE__)."/../common/php/model/")."/Artiste.class.php");
require_once(realpath(dirname(__FILE__)."/../common/php/model/")."/Membre.class.php");
require_once(realpath(dirname(__FILE__)."/../common/php/model/")."/Categorie.class.php");
require_once(realpath(dirname(__FILE__)."/../common/php/model/")."/Langue.class.php");
require_once(realpath(dirname(__FILE__)."/../common/php/model/")."/CategorieArtiste.class.php");
require_once(realpath(dirname(__FILE__)."/../common/php/model/")."/Pays.class.php");
require_once(realpath(dirname(__FILE__)."/../common/php/factories/")."/PersonneFactory.class.php");
require_once(realpath(dirname(__FILE__)."/../common/php/factories/")."/ArtisteFactory.class.php");
require_once(realpath(dirname(__FILE__)."/../common/php/factories/")."/MembreFactory.class.php");
require_once(realpath(dirname(__FILE__)."/../common/php/factories/")."/CategorieFactory.class.php");
require_once(realpath(dirname(__FILE__)."/../common/php/factories/")."/CategorieArtisteFactory.class.php");
require_once(realpath(dirname(__FILE__)."/../common/php/factories/")."/LangueFactory.class.php");
require_once(realpath(dirname(__FILE__)."/../common/php/factories/")."/PaysFactory.class.php");
require_once(realpath(dirname(__FILE__)."/php/presenters/")."/GlobalNavBarPresenter.class.php");
require_once(realpath(dirname(__FILE__)."/php/presenters/")."/PaysSelecorPresenter.class.php");
require_once(realpath(dirname(__FILE__)."/php/presenters/")."/CategorieArtisteSelectorPresenter.class.php");
//require_once(realpath(dirname(__FILE__)."/php/presenters/")."/InscriptionResultPresenter.class.php");
//require_once(realpath(dirname(__FILE__)."/php/presenters/")."/ArtisteResultPresenter.class.php");
require_once(realpath(dirname(__FILE__)."/php/presenters/")."/FooterPresenter.class.php");
require_once(realpath(dirname(__FILE__)."/php/presenters/")."/HeaderPresenter.class.php");
require_once(realpath(dirname(__FILE__)."/php/presenters/")."/SignInBoxPresenter.class.php");
require_once(realpath(dirname(__FILE__)."/php/presenters/")."/RatingStarPresenter.class.php");
$RatingStar=new RatingStarPresenter();
$signInBox=new SignInBoxPresenter();


$html = new HTMLSkeletonGenerator();  //ça, on ne le met que dans les controller...génére la structure de la page
$html->setLang("fr");
$footer = new FooterPresenter();
$header = new HeaderPresenter();
$global_nav_bar = new GlobalNavBarPresenter();
$global_nav_bar->addPage("Compils", "btn_compils", "recherche_compiles.php"/*, true*/);// a la place de #, je dois mettre par exemple ./compilation.php, true pour la page courante
$global_nav_bar->addPage("Samples", "btn_samples", "recherche_samples.php");
$global_nav_bar->addPage("Vidéos", "btn_videos", "recherche_videos.php");
$global_nav_bar->addPage("Artistes", "btn_artistes", "recherche_artistes.php");


require_once(realpath(dirname(__FILE__)."/pages/")."/membre.php");
?>
