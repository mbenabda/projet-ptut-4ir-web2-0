<?php
define("__CONTROLEUR_FRONTEND_INDEX__", "yo !");

require_once(dirname(__FILE__)."/../common/php/tools/HTMLSkeletonGenerator.class.php");
require_once(realpath(dirname(__FILE__)."/../common/php/model/")."/Artiste.class.php");
require_once(realpath(dirname(__FILE__)."/../common/php/model/")."/Compilation.class.php");
require_once(realpath(dirname(__FILE__)."/../common/php/factories/")."/ArtisteFactory.class.php");
require_once(realpath(dirname(__FILE__)."/../common/php/factories/")."/CompilationFactory.class.php");
require_once(dirname(__FILE__)."/php/presenters/GlobalNavBarPresenter.class.php");
require_once(realpath(dirname(__FILE__)."/php/presenters/")."/FooterPresenter.class.php");
require_once(realpath(dirname(__FILE__)."/php/presenters/")."/HeaderPresenter.class.php");
require_once(realpath(dirname(__FILE__)."/php/presenters/")."/ListeNewArtistesPresenter.class.php");
require_once(realpath(dirname(__FILE__)."/php/presenters/")."/CompilationsCarrousselPresenter.class.php");
require_once(realpath(dirname(__FILE__)."/php/presenters/")."/SignInBoxPresenter.class.php");
$signInBox=new SignInBoxPresenter();

$html = new HTMLSkeletonGenerator();  //ça, on ne le met que dans les controller...génére la structure de la page
$html->setLang("fr");

$footer = new FooterPresenter();
$header = new HeaderPresenter();

$factory_artiste = ArtisteFactory::getInstance();
$liste_new_artistes = new ListeNewArtistesPresenter($factory_artiste->getArtistesList(0,20));


$factory_compilation = CompilationFactory::getInstance();
$comps_carroussel = $factory_compilation->getCompilationsList(0, 10);
$carroussel_compilations = new CompilationsCarrousselPresenter($comps_carroussel);

$compilations_count = count($factory_compilation->getCompilationsList());

$global_nav_bar = new GlobalNavBarPresenter();
$global_nav_bar->addPage("Compils", "btn_compils", "recherche_compiles.php"/*, true*/);// a la place de #, je dois mettre par exemple ./compilation.php, true pour la page courante
$global_nav_bar->addPage("Samples", "btn_samples", "recherche_samples.php");
$global_nav_bar->addPage("Vidéos", "btn_videos", "recherche_videos.php");
$global_nav_bar->addPage("Artistes", "btn_artistes", "recherche_artistes.php");

include_once(dirname(__FILE__)."/pages/index.php");

?>