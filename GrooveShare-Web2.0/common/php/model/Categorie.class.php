<?php
require_once(realpath(dirname(__FILE__)."/../exceptions/")."/IllegalArgumentTypeException.class.php");
require_once(realpath(dirname(__FILE__)."/../exceptions/")."/MissingArgumentException.class.php");
require_once(realpath(dirname(__FILE__)."/../tools/")."/DataPurifier.class.php");

/*
CREATE TABLE Categories
(
	id_categorie INT AUTO_INCREMENT NOT NULL,
	nom_categorie VARCHAR(100) NOT NULL,

	PRIMARY KEY (id_categorie)
) ENGINE=MyISAM;
*/

/*
Documentation sur les filtres:
http://ca.php.net/manual/en/book.filter.php

Tuto SDZ
http://www.siteduzero.com/tutoriel-3-423618-les-filtres-en-php-pour-valider-les-donnees-utilisateur.html
 */

class Categorie
{
    private $id_categorie = null;
    private $nom_categorie = null;

    public function __construct($paramsArray = null)
    {
        if(!is_null($paramsArray))
        {
            if(!is_array($paramsArray))
            {
                throw new IllegalArgumentTypeException("Class Categorie: the argument given to the constructor must be an ARRAY.");
            }else
            {
                // argument facultatif
                if(isset($paramsArray['id']))  //permet de savoir si une variable est définie et différente de 'null'
                {
                    $this->setId($paramsArray['id']);
                }

                // arguments obligatoires
                if(isset($paramsArray['nom']))
                {
                    $this->setNom($paramsArray['nom']);
                }else
                {
                    throw new MissingArgumentException("Class Categorie: missing argument 'nom' on constructor call.");
                }
            }
        }
    }


    public function getId()
    {
        return $this->id_categorie;
    }

    public function getNom()
    {
        return $this->nom_categorie;
    }

    public function setId($id)
    {
        $clean = DataPurifier::purifyInt($id);

        if($clean !== false)
        {
            $this->id_categorie = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class Categorie: id must be an INT.");
        }
    }

    public function setNom($nom)
    {
        $clean = DataPurifier::purifyString($nom);

        if($clean !== false)
        {
            $this->nom_categorie = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class Categorie: nom must be a VARCHAR(100).");
        }
    }
}
?>