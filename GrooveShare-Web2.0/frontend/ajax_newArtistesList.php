<?php
require_once(realpath(dirname(__FILE__)."/../common/php/model/")."/Artiste.class.php");
require_once(realpath(dirname(__FILE__)."/../common/php/factories/")."/ArtisteFactory.class.php");
require_once(realpath(dirname(__FILE__)."/php/presenters/")."/ListeNewArtistesPresenter.class.php");

$artiste_compilation = ArtisteFactory::getInstance();
$art_carroussel = $artiste_compilation->getArtistesList(0, 10);
if(count($art_carroussel) > 0)
{
    $carroussel_artistes = new ListeNewArtistesPresenter($art_carroussel);
    echo $carroussel_artistes->generateHTML()."\n";
}

?>
