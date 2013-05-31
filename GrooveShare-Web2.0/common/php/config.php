<?php

       
/*   
    define("__BDD_URL_HOTE__", "localhost");
    define("__BDD_NOM_BASE__", "site_musique");
    define("__BDD_NOM_UTILISATEUR__", "root");
    define("__BDD_MOT_DE_PASSE__", "");
*/
   
    define("__BDD_URL_HOTE__", "localhost");
    define("__BDD_NOM_BASE__", "site_musique");
    define("__BDD_NOM_UTILISATEUR__", "ptut");
    define("__BDD_MOT_DE_PASSE__", "ptut");

// commenter la ligne suivante pour quitter le mode debug (développement)
   define("__DEBUG_MODE_ON__", "1");


    include_once("globalFunctions.php");
    if(isDebugMode())
    {
        error_reporting(E_ALL | E_STRICT);
        set_exception_handler('globalUncaughtExceptionHandler');
    }
?>
