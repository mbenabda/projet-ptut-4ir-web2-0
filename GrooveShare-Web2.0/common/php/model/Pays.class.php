<?php
require_once(realpath(dirname(__FILE__)."/../exceptions/")."/IllegalArgumentTypeException.class.php");
require_once(realpath(dirname(__FILE__)."/../exceptions/")."/MissingArgumentException.class.php");
require_once(realpath(dirname(__FILE__)."/../tools/")."/DataPurifier.class.php");

/*
CREATE TABLE Pays
(
	id_pays INT AUTO_INCREMENT NOT NULL,
	nom_pays VARCHAR(50) NOT NULL,

	PRIMARY KEY (id_pays)
) ENGINE=MyISAM;
 */

/*
Documentation sur les filtres:
http://ca.php.net/manual/en/book.filter.php

Tuto SDZ
http://www.siteduzero.com/tutoriel-3-423618-les-filtres-en-php-pour-valider-les-donnees-utilisateur.html
 */

class Pays
{
    private $id_pays = null;
    private $nom_pays = null;
    
    public function __construct($paramsArray = null)
    {
        if(!is_null($paramsArray))
        {
            if(!is_array($paramsArray))
            {
                throw new IllegalArgumentTypeException("Class Pays: the argument given to the constructor must be an ARRAY.");
            }else
            {
                // argument facultatif
                if(isset($paramsArray['id']))
                {
                    $this->setId($paramsArray['id']);
                }

                // arguments obligatoires
                if(isset($paramsArray['nom']))
                {
                    $this->setNom($paramsArray['nom']);
                }else
                {
                    throw new MissingArgumentException("Class Pays: missing argument 'nom' on constructor call.");
                }
            }
        }
    }


    public function getId()
    {
        return $this->id_pays;
    }

    public function getNom()
    {
        return $this->nom_pays;
    }

    public function setId($id)
    {
        $clean = DataPurifier::purifyInt($id);

        if($clean !== false)
        {
            $this->id_pays = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class Pays: id must be an INT.");
        }
    }

    public function setNom($nom)
    {
        $clean = DataPurifier::purifyString($nom);

        if($clean !== false)
        {
            $this->nom_pays = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class Pays: nom must be a VARCHAR(50).");
        }
    }
}
?>