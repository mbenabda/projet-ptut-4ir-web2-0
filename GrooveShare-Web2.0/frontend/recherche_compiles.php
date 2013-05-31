<?php

define("__CONTROLEUR_FRONTEND_RECHERCHE_COMPILES__","");
require_once("../common/php/config.php");

//contient définitions des constantes utilisées pour traduire les textes de la page de compilation
//require_once(realpath(dirname(__FILE__)."/../common/php/lang/lang_fr/frontend/")."/recherche_compiles.php");
require_once(realpath(dirname(__FILE__)."/../common/php/tools/")."/DataPurifier.class.php");
require_once(realpath(dirname(__FILE__)."/../common/php/tools/")."/HTMLSkeletonGenerator.class.php");
require_once(realpath(dirname(__FILE__)."/../common/php/model/")."/Compilation.class.php");
require_once(realpath(dirname(__FILE__)."/../common/php/model/")."/CommentaireCompilation.class.php");
require_once(realpath(dirname(__FILE__)."/../common/php/model/")."/NoteCompilation.class.php");
require_once(realpath(dirname(__FILE__)."/../common/php/factories/")."/CompilationFactory.class.php");
require_once(realpath(dirname(__FILE__)."/../common/php/factories/")."/CommentaireCompilationFactory.class.php");
require_once(realpath(dirname(__FILE__)."/../common/php/factories/")."/NoteCompilationFactory.class.php");
require_once(realpath(dirname(__FILE__)."/php/presenters/")."/GlobalNavBarPresenter.class.php");
require_once(realpath(dirname(__FILE__)."/php/presenters/")."/FooterPresenter.class.php");
require_once(realpath(dirname(__FILE__)."/php/presenters/")."/HeaderPresenter.class.php");
require_once(realpath(dirname(__FILE__)."/php/presenters/")."/SignInBoxPresenter.class.php");
require_once(realpath(dirname(__FILE__)."/php/presenters/")."/RatingStarPresenter.class.php");
require_once(realpath(dirname(__FILE__)."/php/presenters/")."/CompilesResultPresenter.class.php");

$RatingStar=new RatingStarPresenter();
$signInBox=new SignInBoxPresenter();

$compilations_factory=new CompilationFactory();
$compilations_list=$compilations_factory->getCompilationsList();
$CompilesResult=new CompilesResultPresenter($compilations_list);

$html = new HTMLSkeletonGenerator();  //ça, on ne le met que dans les controller...génére la structure de la page
$html->setLang("fr");
$footer = new FooterPresenter();
$header = new HeaderPresenter();
$global_nav_bar = new GlobalNavBarPresenter();
$global_nav_bar->addPage("Compilssss", "btn_compils", "./recherche_compiles.php", true);// a la place de #, je dois mettre par exemple ./compilation.php, true pour la page courante
$global_nav_bar->addPage("Samples", "btn_samples", "./recherche_samples.php");
$global_nav_bar->addPage("Vidéos", "btn_videos", "./recherche_videos.php");
$global_nav_bar->addPage("Artistes", "btn_artistes", "./recherche_artistes.php");


require_once(realpath(dirname(__FILE__)."/pages/")."/recherche_compiles.php");


?>
