<?php
require_once(realpath(dirname(__FILE__)."/../exceptions/")."/IllegalArgumentTypeException.class.php");
require_once(realpath(dirname(__FILE__)."/../exceptions/")."/MissingArgumentException.class.php");
require_once(realpath(dirname(__FILE__)."/../tools/")."/DataPurifier.class.php");

/* CREATE TABLE Langues
(
	id_langue INT AUTO_INCREMENT NOT NULL,
	nom_langue VARCHAR(50) NOT NULL,
	code_langue VARCHAR(6) NOT NULL,
	url_drapeau_langue TEXT,

	PRIMARY KEY (id_langue)
) ENGINE=MyISAM;
*/


/*
Documentation sur les filtres:
http://ca.php.net/manual/en/book.filter.php

Tuto SDZ
http://www.siteduzero.com/tutoriel-3-423618-les-filtres-en-php-pour-valider-les-donnees-utilisateur.html
 */

class Langue
{
    private $id_langue = null;
    private $nom_langue = null;
    private $code_langue = null;
    private $url_drapeau = null;

    public function __construct($paramsArray = null)
    {
        if(!is_null($paramsArray))
        {
            if(!is_array($paramsArray))
            {
                throw new IllegalArgumentTypeException("Class Langue: the argument given to the constructor must be an ARRAY.");
            }else
            {
                // arguments facultatifs
                if(isset($paramsArray['id']))
                {
                    $this->setId($paramsArray['id']);
                }

                if(isset($paramsArray['url_drapeau']))
                {
                    $this->setURLDrapeau($paramsArray['url_drapeau']);
                }
                
                // arguments obligatoires
                if(isset($paramsArray['nom']))
                {
                    $this->setNom($paramsArray['nom']);
                }else
                {
                    throw new MissingArgumentException("Class Langue: missing argument 'nom' on constructor call.");
                }


                if(isset($paramsArray['code']))
                {
                    $this->setCode($paramsArray['code']);
                }else
                {
                    throw new MissingArgumentException("Class Langue: missing argument 'code' on constructor call.");
                }
            }
        }
    }

    public function getId()
    {
        return $this->id_langue;
    }

    public function getNom()
    {
        return $this->nom_langue;
    }

    public function getCode()
    {
        return $this->code_langue;
    }

    public function getURLDrapeau()
    {
        return $this->url_drapeau;
    }

    public function setId($id)
    {
        $clean = DataPurifier::purifyInt($id);

        if($clean !== false)
        {
            $this->id_langue = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class Langue: id must be an INT.");
        }
    }



    public function setNom($nom)
    {
        $clean = DataPurifier::purifyString($nom);

        if($clean !== false)
        {
            $this->nom_langue = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class Langue: nom must be a VARCHAR(50).");
        }
    }

    public function setCode($code)
    {
        $clean = DataPurifier::purifyString($code);

        if($clean !== false)
        {
            $this->code_langue = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class Langue: code must be a VARCHAR(6).");
        }
    }

    public function setURLDrapeau($url)
    {
        $clean = DataPurifier::purifyURL($url);

        if($clean !== false)
        {
            $this->url_drapeau = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class Langue: url_drapeau must be an URL.");
        }
    }
}

?>