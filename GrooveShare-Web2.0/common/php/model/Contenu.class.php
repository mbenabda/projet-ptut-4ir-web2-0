<?php
require_once(realpath(dirname(__FILE__)."/../exceptions/")."/IllegalArgumentTypeException.class.php");
require_once(realpath(dirname(__FILE__)."/../exceptions/")."/MissingArgumentException.class.php");
require_once(realpath(dirname(__FILE__)."/../tools/")."/DataPurifier.class.php");

/*
CREATE TABLE Contenus
(
	id_contenu INT AUTO_INCREMENT NOT NULL,
	date_creation_contenu DATETIME NOT NULL,
	date_publication_contenu DATETIME,
	titre_contenu TEXT NOT NULL,
	url_contenu TEXT NOT NULL,
	publie_contenu BOOL NOT NULL DEFAULT FALSE,
	id_artiste_auteur INT NOT NULL,

	PRIMARY KEY (id_contenu)
) ENGINE=MyISAM;
 */


/*
Documentation sur les filtres:
http://ca.php.net/manual/en/book.filter.php

Tuto SDZ
http://www.siteduzero.com/tutoriel-3-423618-les-filtres-en-php-pour-valider-les-donnees-utilisateur.html
 */

class Contenu
{
    protected $id_contenu = null;
    protected $date_creation_contenu = null;
    protected $date_publication_contenu = null;
    protected $titre_contenu = null;
    protected $url_contenu = null;
    protected $publie_contenu = null;
    protected $id_artiste_auteur = null;

    public function __construct($paramsArray = null)
    {
        if(!is_null($paramsArray))
        {
            if(!is_array($paramsArray))
            {
                throw new IllegalArgumentTypeException("Class Contenu: the argument given to the constructor must be an ARRAY.");
            }else
            {
                // argument facultatif
                if(isset($paramsArray['id_contenu']))
                {
                    $this->setId($paramsArray['id_contenu']);
                }

                if(isset($paramsArray['date_creation']))
                {
                    $this->setDateCreation($paramsArray['date_creation']);
                }

                if(isset($paramsArray['date_publication']))
                {
                    $this->setDatePublication($paramsArray['date_publication']);
                }

                // arguments obligatoires

                if(isset($paramsArray['titre']))
                {
                    $this->setTitre($paramsArray['titre']);
                }else
                {
                    throw new MissingArgumentException("Class Contenu: missing argument 'titre' on constructor call.");
                }

                if(isset($paramsArray['url']))
                {
                    $this->setURL($paramsArray['url']);
                }else
                {
                    throw new MissingArgumentException("Class Contenu: missing argument 'url' on constructor call.");
                }

                if(isset($paramsArray['isPublie']))
                {
                    $this->setIsPublie($paramsArray['isPublie']);
                }else
                {
                    throw new MissingArgumentException("Class Contenu: missing argument 'isPublie' on constructor call.");
                }

                if(isset($paramsArray['id_artiste_auteur']))
                {
                    $this->setIdArtisteAuteur($paramsArray['id_artiste_auteur']);
                }else
                {
                    throw new MissingArgumentException("Class Contenu: missing argument 'id_artiste_auteur' on constructor call.");
                }
            }
        }
    }

    public function getIdContenu()
    {
        return $this->id_contenu;
    }

    public function getDateCreation()
    {
        return $this->date_creation_contenu;
    }

    public function getDatePublication()
    {
        return $this->date_publication_contenu;
    }

    public function getTitre()
    {
        return $this->titre_contenu;
    }

    public function getURL()
    {
        return $this->url_contenu;
    }

    public function isPublie()
    {
        return $this->publie_contenu;
    }

    public function getIdArtisteAuteur()
    {
        return $this->id_artiste_auteur;
    }



    public function setIdContenu($id)
    {
        $clean = DataPurifier::purifyInt($id);

        if($clean !== false)
        {
            $this->id_contenu = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class Contenu: id must be an INT.");
        }
    }

    public function setDateCreation($theDate)
    {
        $clean = DataPurifier::purifyDate($theDate);

        if($clean !== false)
        {
            $this->date_creation_contenu = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class Contenu: date_creation must be a DATE.");
        }
    }

    public function setDatePublication($theDate)
    {
        $clean = DataPurifier::purifyDate($theDate);

        if($clean !== false)
        {
            $this->date_publication_contenu = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class Contenu: date_publication must be a DATE.");
        }
    }

    public function setTitre($titre)
    {
        $clean = DataPurifier::purifyString($titre);

        if($clean !== false)
        {
            $this->titre_contenu = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class Contenu: titre must be a STRING.");
        }
    }

    public function setURL($url)
    {
        $clean = DataPurifier::purifyURL($url);

        if($clean !== false)
        {
            $this->url_contenu = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class Contenu: url must be an URL.");
        }
    }

    public function setIsPublie ($isPublie)
    {
        $clean = DataPurifier::purifyBoolean($isPublie);

        if($clean !== false)
        {
            $this->publie_contenu = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class Contenu: isPublie must be a BOOL.");
        }
    }

    public function setIdArtisteAuteur($id)
    {
        $clean = DataPurifier::purifyInt($id);

        if($clean !== false)
        {
            $this->id_artiste_auteur = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class Contenu: id_artiste_auteur must be an INT.");
        }
    }
}




?>