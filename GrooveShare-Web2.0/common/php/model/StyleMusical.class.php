<?php
require_once(realpath(dirname(__FILE__)."/../exceptions/")."/IllegalArgumentTypeException.class.php");
require_once(realpath(dirname(__FILE__)."/../exceptions/")."/MissingArgumentException.class.php");
require_once(realpath(dirname(__FILE__)."/../tools/")."/DataPurifier.class.php");

/* 
CREATE TABLE Styles_musicaux
(
	id_style_musique INT AUTO_INCREMENT NOT NULL,
	nom_style_musique VARCHAR(50),

	PRIMARY KEY (id_style_musique)
) ENGINE=MyISAM;
*/

/*
Documentation sur les filtres:
http://ca.php.net/manual/en/book.filter.php

Tuto SDZ
http://www.siteduzero.com/tutoriel-3-423618-les-filtres-en-php-pour-valider-les-donnees-utilisateur.html
 */

class StyleMusical
{
    private $id_style_musique = null;
    private $nom_style_musique = null;

    public function __construct($paramsArray = null)
    {
        if(!is_null($paramsArray))
        {
            if(!is_array($paramsArray))
            {
                throw new IllegalArgumentTypeException("Class StyleMusical: the argument given to the constructor must be an ARRAY.");
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
                    throw new MissingArgumentException("Class StyleMusical: missing argument 'nom' on constructor call.");
                }
            }
        }
    }


    public function getId()
    {
        return $this->id_style_musique;
    }

    public function getNom()
    {
        return $this->nom_style_musique;
    }

    public function setId($id)
    {
        $clean = DataPurifier::purifyInt($id);

        if($clean !== false)
        {
            $this->id_style_musique = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class StyleMusical: id must be an INT.");
        }
    }

    public function setNom($nom)
    {
        $clean = DataPurifier::purifyString($nom);

        if($clean !== false)
        {
            $this->nom_style_musique = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class StyleMusical: nom must be a VARCHAR(50).");
        }
    }
}
?>