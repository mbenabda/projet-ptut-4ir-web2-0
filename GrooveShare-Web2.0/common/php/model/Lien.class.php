<?php
require_once(realpath(dirname(__FILE__)."/../exceptions/")."/IllegalArgumentTypeException.class.php");
require_once(realpath(dirname(__FILE__)."/../exceptions/")."/MissingArgumentException.class.php");
require_once(realpath(dirname(__FILE__)."/../tools/")."/DataPurifier.class.php");

/*
CREATE TABLE IF NOT EXISTS `Liens` (
  `id_lien` int(11) NOT NULL AUTO_INCREMENT,
  `url_lien` text NOT NULL,
  `id_artiste` int(11) NOT NULL,
  PRIMARY KEY (`id_lien`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
*/


/*
Documentation sur les filtres:
http://ca.php.net/manual/en/book.filter.php

Tuto SDZ
http://www.siteduzero.com/tutoriel-3-423618-les-filtres-en-php-pour-valider-les-donnees-utilisateur.html
 */

class Lien
{
    private $id_lien = null;
    private $url_lien = null;
    private $id_artiste = null;

    public function __construct($paramsArray = null)
    {
        if(!is_null($paramsArray))
        {
            if(!is_array($paramsArray))
            {
                throw new IllegalArgumentTypeException("Class Lien: the argument given to the constructor must be an ARRAY.");
            }else
            {
                // argument facultatif
                if(isset($paramsArray['id']))
                {
                    $this->setId($paramsArray['id']);
                }

                // arguments obligatoires
                if(isset($paramsArray['url']))
                {
                    $this->setNom($paramsArray['url']);
                }else
                {
                    throw new MissingArgumentException("Class Lien: missing argument 'url' on constructor call.");
                }


                if(isset($paramsArray['id_artiste']))
                {
                    $this->setNom($paramsArray['id_artiste']);
                }else
                {
                    throw new MissingArgumentException("Class Lien: missing argument 'id_artiste' on constructor call.");
                }
            }
        }
    }

    public function getId()
    {
        return $this->id_lien;
    }

    public function getURL()
    {
        return $this->url_lien;
    }

    public function getIdArtiste()
    {
        return $this->id_artiste;
    }

    public function setId($id)
    {
        $clean = DataPurifier::purifyInt($id);

        if($clean !== false)
        {
            $this->id_lien = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class Lien: id must be an INT.");
        }
    }

    public function setURL($url)
    {
        $clean = DataPurifier::purifyURL($url);

        if($clean !== false)
        {
            $this->url_lien = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class Lien: url must be an URL.");
        }
    }

    public function setIdArtiste($id)
    {
        $clean = DataPurifier::purifyInt($id);

        if($clean !== false)
        {
            $this->id_artiste = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class Lien: id_artiste must be an INT.");
        }
    }
    
}

?>