<?php
//isDebugMode() est définie dans config.php

require_once(realpath(dirname(__FILE__)."/../../")."/config.php");
require_once(realpath(dirname(__FILE__)."/../../exceptions/")."/QueryException.class.php");
require_once(realpath(dirname(__FILE__)."/../../exceptions/")."/MediumUnreachableException.class.php");

class MySQLDBConnecter
{
    private static $uniqueInstance = null;
    private static $uniqueConnection = null;

    private function __construct()
    {
    }

    public static function connect()
    {
        if(is_null(self::$uniqueInstance) or is_null(self::$uniqueConnection))
        {
            $host = (defined("__BDD_URL_HOTE__") ? __BDD_URL_HOTE__ : "localhost");
            $dbName = (defined("__BDD_NOM_BASE__") ? __BDD_NOM_BASE__ : "");
            $uName = (defined("__BDD_NOM_UTILISATEUR__") ? __BDD_NOM_UTILISATEUR__ : "ptut" );
            $pwd = (defined("__BDD_MOT_DE_PASSE__") ? __BDD_MOT_DE_PASSE__ : "ptut");

            self::$uniqueInstance = new MySQLDBConnecter();

            $co = mysql_connect($host, $uName, $pwd);

            if(!$co)
                throw new MediumUnreachableException("<b>Connexion BDD impossible : </b><br/>\n" . mysql_error());

            if(!mysql_select_db($dbName))
                throw new MediumUnreachableException("<b>Impossible de sélectionner la base de données :</b><br/>\n" . mysql_error());

            self::$uniqueConnection = $co;
        }
        return self::$uniqueConnection;
    }

    public static function disconnect()
    {
        /*
        if(!is_null(self::$uniqueInstance) and !is_null(self::$uniqueConnection))
        {
            //mysql_disconnect();

            if(isset(self::$uniqueInstance))
            {
                self::$uniqueInstance = null;
            }

            if(isset(self::$uniqueConnection))
            {
                self::$uniqueConnection = null;
            }
        }
        */
    }

    public static function escapeString($string)
    {
        if(is_numeric($string))
        {
            // retourne le nombre contenu dans la chaine, quelque soit son type (int, float ou autre)
            return $string + 0;
        }


        $escapedString = $string;
        if (get_magic_quotes_gpc())
        {
            $escapedString = stripslashes($string);
        }

        /*
         * si pas connecté à la BDD, impossible d'utiliser mysql_real_escape_string()
         * donc on s'arrete là
         */
        if(self::$uniqueConnection == null)
            return $escapedString;

        $escapedString = mysql_real_escape_string($escapedString);
        return $escapedString;
    }

    public static function unEscapeString($string)
    {
        return $string;
    }

    public static function query($sql)
    {
        $queryResult = mysql_query($sql);
        if(!$queryResult)
        {
            throw new QueryException(mysql_error() . "\n" . $sql);
            return null;
        }
        return $queryResult;
    }
}

?>
