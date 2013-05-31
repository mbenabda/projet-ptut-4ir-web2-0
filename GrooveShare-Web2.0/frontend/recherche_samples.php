<?php


define("__CONTROLEUR_FRONTEND_RECHERCHE_SAMPLES__", "comment va ????");
require_once("../common/php/config.php");


require_once(realpath(dirname(__FILE__)."/../common/php/tools/")."/DataPurifier.class.php");
require_once(realpath(dirname(__FILE__)."/../common/php/tools/")."/HTMLSkeletonGenerator.class.php");

require_once(realpath(dirname(__FILE__)."/../common/php/model/")."/Sample.class.php");

require_once(realpath(dirname(__FILE__)."/../common/php/factories/")."/SampleFactory.class.php");

require_once(realpath(dirname(__FILE__)."/php/presenters/")."/GlobalNavBarPresenter.class.php");
require_once(realpath(dirname(__FILE__)."/php/presenters/")."/FooterPresenter.class.php");
require_once(realpath(dirname(__FILE__)."/php/presenters/")."/HeaderPresenter.class.php");
require_once(realpath(dirname(__FILE__)."/php/presenters/")."/SignInBoxPresenter.class.php");
require_once(realpath(dirname(__FILE__)."/php/presenters/")."/RatingStarPresenter.class.php");

$html = new HTMLSkeletonGenerator();  
$html->setLang("fr");
$footer = new FooterPresenter();
$header = new HeaderPresenter();

$signInBox=new SignInBoxPresenter();
$RatingStar=new RatingStarPresenter();
        //$ComboBox=new ComboBoxPresenter();
//todo complete this
//$factory_sample = SampleFactory::getInstance();


$global_nav_bar = new GlobalNavBarPresenter();
$global_nav_bar->addPage("Compils", "btn_compils", "recherche_compiles.php");
$global_nav_bar->addPage("Samples", "btn_samples", "recherche_samples.php", true);
$global_nav_bar->addPage("Vidéos", "btn_videos", "recherche_videos.php");
$global_nav_bar->addPage("Artistes", "btn_artistes", "recherche_artistes.php");


require_once(realpath(dirname(__FILE__)."/pages/")."/recherche_samples.php");
?>
