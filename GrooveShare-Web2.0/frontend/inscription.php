<?php
define("__CONTROLEUR_FRONTEND_INSCRIPTION__", "comment va ????");
require_once("../common/php/config.php");

//contient définitions des constantes utilisées pour traduire les textes de la page d'insription
require_once(realpath(dirname(__FILE__)."/../common/php/lang/lang_fr/frontend/")."/inscription.php");
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
//require_once(realpath(dirname(__FILE__)."/../common/php/factories/")."/CategorieArtisteFactory.class.php");
require_once(realpath(dirname(__FILE__)."/../common/php/factories/")."/LangueFactory.class.php");
require_once(realpath(dirname(__FILE__)."/../common/php/factories/")."/PaysFactory.class.php");
require_once(realpath(dirname(__FILE__)."/php/presenters/")."/GlobalNavBarPresenter.class.php");
require_once(realpath(dirname(__FILE__)."/php/presenters/")."/PaysSelecorPresenter.class.php");
require_once(realpath(dirname(__FILE__)."/php/presenters/")."/CategorieArtisteSelectorPresenter.class.php");
require_once(realpath(dirname(__FILE__)."/php/presenters/")."/InscriptionResultPresenter.class.php");
require_once(realpath(dirname(__FILE__)."/php/presenters/")."/FooterPresenter.class.php");
require_once(realpath(dirname(__FILE__)."/php/presenters/")."/HeaderPresenter.class.php");
require_once(realpath(dirname(__FILE__)."/php/presenters/")."/SignInBoxPresenter.class.php");
$signInBox=new SignInBoxPresenter();
$clean = array();
$clean['login']          = null;
$clean['pass']           = null;
$clean['conf_pass']      = null;
$clean['email']          = null;
$clean['conf_email']     = null;
$clean['avatar']         = null;
$clean['isArtiste']      = 0;
$clean['nom']            = null;
$clean['prenom']         = null;
$clean['date_naissance'] = null;
$clean['adresse']        = null;
$clean['ville']          = null;
$clean['CP']             = null;
$clean['id_pays']        = 0;
$clean['id_categories']  = array();
$clean['url_site']       = null;
$clean['url_avatar']     = null;
$clean['isPublie']       = 1;
$clean['credit']         = 0;
$clean['id_langue']      = 0;
$selected_categories = array(); // liste des catégories passées en POST au formulaire, transformés en int php
$is_categoriesList_safe = true; // est ce que toutes les catégories sélectionnées existent en BDD ?
$is_form_submitted = false;

$erreurs = array();

//TODO décommenter lorsque LangueFactory sera fini
//$factory_langue = LangueFactoy::getInstance();
$factory_categorie = CategorieFactory::getInstance();
$factory_categorie_artiste = CategorieFactory::getInstance();
$factory_pays = PaysFactory::getInstance();
$factory_artiste = ArtisteFactory::getInstance();
$factory_membre = MembreFactory::getInstance();
$factory_personne = PersonneFactory::getInstance();


if(isset($_POST['login']) &&
   isset($_POST['pass']) &&
   isset($_POST['conf_pass']) &&
   isset($_POST['email']) &&
   isset($_POST['conf_email']) &&
   isset($_POST['date_naissance']) &&
   isset($_POST['id_pays']))
{
    $is_form_submitted = true;// ici, j'ai cliqué sur valider
    $clean['login']      = DataPurifier::purifyString($_POST['login']);
    $clean['pass']       = DataPurifier::purifyString($_POST['pass']);
    $clean['conf_pass']  = DataPurifier::purifyString($_POST['conf_pass']);
    $clean['email']      = DataPurifier::purifyEmail($_POST['email']);
    $clean['conf_email'] = DataPurifier::purifyEmail($_POST['conf_email']);
    $clean['id_langue']  = 0; // TODO gérer langue
    $clean['id_pays']    = DataPurifier::purifyInt($_POST['id_pays']); // id du pays choisi

    if(isset($_POST['nom']))
        $clean['nom'] = DataPurifier::purifyString($_POST['nom']);

    if(isset($_POST['prenom']))
        $clean['prenom'] = DataPurifier::purifyString($_POST['prenom']);

    if(isset($_POST['adresse']))
        $clean['adresse'] = DataPurifier::purifyString($_POST['adresse']);

    if(isset($_POST['CP']))
        $clean['CP'] = DataPurifier::purifyString($_POST['CP']);

    if(isset($_POST['ville']))
        $clean['ville'] = DataPurifier::purifyString($_POST['ville']);

    if(isset($_POST['date_naissance']))
        $clean['date_naissance'] = DataPurifier::purifyDate($_POST['date_naissance'], "yyyy-mm-dd");

    if(isset($_POST['avatar']))
        $clean['avatar'] = $_POST['avatar'];
        
    // TODO upload avatar

    if(isset($_POST['isArtiste']))
        $clean['isArtiste'] = 1;

    if(isset($_POST['id_categories']))
    {
        foreach($_POST['id_categories'] as $curr)
            $selected_categories[] = DataPurifier::purifyInt($curr);
    }

    if(isset($_POST['url_site']))
        $clean['url_site'] = DataPurifier::purifyURL($_POST['url_site']);



    if(empty($clean['date_naissance']))
        $erreurs['date_naissance'] = _INSCRIPTION_ERR_EMPTYFIELD_DATE_NAISSANCE;

    if(empty($clean['login']))
        $erreurs['login'] = _INSCRIPTION_ERR_EMPTYFIELD_LOGIN;

    if(empty($clean['pass']))
        $erreurs['pass'] = _INSCRIPTION_ERR_EMPTYFIELD_PASS;

    if(empty($clean['conf_pass']))
        $erreurs['conf_pass'] = _INSCRIPTION_ERR_EMPTYFIELD_CONF_PASS;

    if($clean['conf_pass'] != $clean['pass'])
    {
        $erreurs['conf_pass'] = _INSCRIPTION_ERR_INVALIDVALUE_CONF_PASS;
        $clean['conf_pass'] = "";
    }

    if(empty($clean['email']))
        $erreurs['email'] = _INSCRIPTION_ERR_EMPTYFIELD_EMAIL;

    if(empty($clean['conf_email']))
        $erreurs['conf_email'] = _INSCRIPTION_ERR_EMPTYFIELD_CONF_EMAIL;

    if($clean['conf_email'] != $clean['email'])
    {
        $erreurs['conf_email'] = _INSCRIPTION_ERR_INVALIDVALUE_CONF_EMAIL;
        $clean['conf_email'] = "";
    }
    //TODO décommenter quand LangueFactory OK
    /*
    if(empty($clean['id_langue']))
        $erreurs['id_langue'] = _INSCRIPTION_ERR_EMPTYFIELD_LANGUE;
    */

    if(empty($clean['id_pays']))
        $erreurs['id_pays'] = _INSCRIPTION_ERR_EMPTYFIELD_PAYS;

    if(!empty($clean['isArtiste']) && $clean['isArtiste'] != 0)
    {
        if(count($selected_categories) <= 0)
        {
            $erreurs['id_categories'] = _INSCRIPTION_ERR_EMPTYFIELD_CATEGORIE;
        }else
        {
            // est ce que toutes les catégories sélectionnées existent en BDD ?
            foreach($selected_categories as $currId)
            {
                $curr_categorie = $factory_categorie->getCategorie($currId);
                if(!empty($curr_categorie))
                {
                    $clean['id_categories'][] = (int)$currId;
                }else
                {
                    $is_categoriesList_safe = false;
                    break;
                }
            }
        }
    }

    if(count($erreurs) == 0)
    {
        try{
            //TODO décommenter lorsque LangueFactory sera fini
            /*
            // est ce que la langue sélectionnée existe en BDD ?
            $record_langue = $factory_langue->getLangue($clean['id_langue']);
            // si ce n'est pas le cas => tentative de détournement du formulaire
            // donc on ne doit pas enregistrer la personne.
            if(empty($record_langue))
            {
                $errMsg = _INSCRIPTION_ERR_INVALIDVALUE_LANGUE;
                $erreurs['id_langue'] = $errMsg;
                throw new Exception($errMsg);
            }
            */

            // est ce que toutes les catégories sélectionnées existent en BDD ?
            // si ce n'est pas le cas => tentative de détournement du formulaire
            // donc on ne doit pas enregistrer la personne.
            if(!$is_categoriesList_safe)
            {
                $errMsg = _INSCRIPTION_ERR_INVALIDVALUE_CATEGORIE;
                $erreurs['id_categories'] = $errMsg;
                throw new Exception($errMsg);
            }
            
            // est ce que toutes le pays sélectionné existe en BDD ?
            $record_pays = $factory_pays->getPays($clean['id_pays']);
            // si ce n'est pas le cas => tentative de détournement du formulaire
            // donc on ne doit pas enregistrer la personne.
            if(empty($record_pays))
            {
                $errMsg = _INSCRIPTION_ERR_INVALIDVALUE_PAYS;
                $erreurs['id_pays'] = $errMsg;
                throw new Exception($errMsg);
            }

            if($factory_personne->isRegisteredEmail($clean['email']))
            {
                $errMsg = _INSCRIPTION_ERR_ALREADYEXISTS_EMAIL;
                $erreurs['email'] = $errMsg;
                throw new Exception($errMsg);
            }

            if($factory_personne->isRegisteredLogin($clean['login']))
            {
                $errMsg = _INSCRIPTION_ERR_ALREADYEXISTS_LOGIN;
                $erreurs['login'] = $errMsg;
                throw new Exception($errMsg);
            }

            /*
             * tout est OK, on peut enregistrer le nouvel inscrit
             */

            // si Artiste: création d'un enregistrement "Artiste" en BDD
            if(((bool) $clean['isArtiste']) == true)
            {
                $record_art  = new Artiste($clean);

                if(!($factory_artiste->storeArtiste($record_art, $selected_categories)))
                {
                    $errMsg = _INSCRIPTION_ERR_STOREFAILED_ARTISTE;
                    $erreurs['store_artiste'] = $errMsg;
                    throw new Exception($errMsg);
                }
            }else
            {
                $record_membre  = new Membre($clean);

                if(!($factory_membre->storeMembre($record_membre)))
                {
                    $errMsg = _INSCRIPTION_ERR_STOREFAILED_MEMBRE;
                    $erreurs['store_membre'] = $errMsg;
                    throw new Exception($errMsg);
                }
            }
            // membre créé avec succes
        }
        catch(Exception $e)
        {
            if(isDebugMode())
            {
                print_r($erreurs);
                print_r($e);
                die("<b>Arrêt du script pour débuggage de l'exception.</b>");
            }
        }
    }
}


if(empty($clean['date_naissance']))
    $clean['date_naissance'] = "yyyy-mm-dd";
    
/* Bloc de variables utilisables dans la vue inscription.php */
$html = new HTMLSkeletonGenerator();
$html->setLang("fr");
$footer = new FooterPresenter();
$header = new HeaderPresenter();

$global_nav_bar = new GlobalNavBarPresenter();
$global_nav_bar->addPage("Compils", "btn_compils", "recherche_compiles.php"/*, true*/);// a la place de #, je dois mettre par exemple ./compilation.php, true pour la page courante
$global_nav_bar->addPage("Samples", "btn_samples", "recherche_samples.php");
$global_nav_bar->addPage("Vidéos", "btn_videos", "recherche_videos.php");
$global_nav_bar->addPage("Artistes", "btn_artistes", "recherche_artistes.php");
$pays_selector = new PaysSelecorPresenter($factory_pays->getPaysList(), $clean['id_pays']);
$categorie_selector = new CategorieArtisteSelectorPresenter($factory_categorie->getCategoriesList(), $clean['id_categories']);

if($is_form_submitted == true) //c'est là où il va afficher, les erreurs sur la saisie
{
    $inscription_result = new InscriptionResultPresenter($erreurs);
}

unset($erreurs);
unset($selected_categories);
unset($is_categoriesList_safe);
unset($factory_categorie_artiste);
unset($factory_artiste);
unset($factory_membre);
unset($factory_categorie);
//TODO décommenter lorsque LangueFactory sera fini
//unset($factory_langue);
unset($factory_pays);

require_once(realpath(dirname(__FILE__)."/pages/")."/inscription.php");
?>