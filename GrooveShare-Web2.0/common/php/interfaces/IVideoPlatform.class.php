<?php

require_once(realpath(dirname(__FILE__)."/")."/IPresenter.class.php");

interface IVideoPlatform extends IPresenter
{
    public function __construct($url_video);
    /* Rôle: détermine si le lien $url correspond
     * à une vidéo hébergée sur la plateforme courrante.
     * Retour: Vrai / Faux (Booléen)*/
    public static function canHandle($url);
    /* Rôle: Fournit l'expression régulière utilisée
     * par canHandle
     * Retour: expression régulière (Chaine de caractères) */
    public static function getRegexp();
    /* Rôle: Fournit une version standardisée du lien de la vidéo
     * Retour: lien normalisé (Chaine de caractères) */
    public function getCleanLink();
}
?>
    /* Les méthodes suivantes proviennent du extends IPresenter */
    /*
    public function generateHTML();
    public function generateJS();
    */