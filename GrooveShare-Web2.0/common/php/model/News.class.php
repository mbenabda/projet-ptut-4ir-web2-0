<?php
require_once(realpath(dirname(__FILE__)."/../exceptions/")."/IllegalArgumentTypeException.class.php");
require_once(realpath(dirname(__FILE__)."/../exceptions/")."/MissingArgumentException.class.php");
require_once(realpath(dirname(__FILE__)."/../tools/")."/DataPurifier.class.php");

class News
{
    private $id_news;
    private $id_admin_auteur_news;
    private $titre_news;
    private $date_creation_news;
    private $publie_news = false;
    private $texte_news;
    private $date_publication_news;

    public function __construct($paramsArray = null)
    {
        if(!is_null($paramsArray))
        {
            if(!is_array($paramsArray))
            {
                throw new IllegalArgumentTypeException("Class News: the argument given to the constructor must be an ARRAY.");
            }else
            {
                // arguments facultatifs

                if(isset($paramsArray['id']))
                {
                    $this->setId($paramsArray['id']);
                }

                // arguments obligatoires
                if(isset($paramsArray['id_admin_auteur']))
                {
                    $this->setIdAdminAuteur($paramsArray['id_admin_auteur']);
                }else
                {
                    throw new MissingArgumentException("Class News: missing argument 'id_admin_auteur_news' on constructor call.");
                }

                if(isset($paramsArray['titre']))
                {
                    $this->setTitre($paramsArray['titre']);
                }else
                {
                    throw new MissingArgumentException("Class News: missing argument 'titre' on constructor call.");
                }

                if(isset($paramsArray['date_creation']))
                {
                    $this->setDateCreation($paramsArray['date_creation']);
                }else
                {
                    throw new MissingArgumentException("Class News: missing argument 'date_creation' on constructor call.");
                }

                if(isset($paramsArray['isPublie']))
                {
                    $this->setIsPublie($paramsArray['isPublie']);
                }else
                {
                    throw new MissingArgumentException("Class News: missing argument 'isPublie' on constructor call.");
                }

                if(isset($paramsArray['texte']))
                {
                    $this->setTexte($paramsArray['texte']);
                }else
                {
                    throw new MissingArgumentException("Class News: missing argument 'texte' on constructor call.");
                }

                if(isset($paramsArray['date_publication']))
                {
                    $this->setDatePublication($paramsArray['date_publication']);
                }else
                {
                    throw new MissingArgumentException("Class News: missing argument 'date_publication' on constructor call.");
                }
            }
        }
    }


    public function getId()
    {
        return $this->id_news;
    }



    public function getIdAdminAuteur()
    {
        return $this->id_admin_auteur_news;
    }

    public function getTitre()
    {
        return $this->titre_news;
    }

    public function getDateCreation()
    {
        return $this->date_creation_news;
    }

    public function isPublie()
    {
        return $this->publie_news;
    }

    public function getTexte()
    {
        return $this->texte_news;
    }

    public function getDatePublication()
    {
        return $this->date_publication_news;
    }



    public function setId($val)
    {
        $clean = DataPurifier::purifyInt($val);
        if($clean !== false)
        {
            $this->id_news = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class News: id must be an INT.");
        }
    }



    public function setIdAdminAuteur($val)
    {
        $clean = DataPurifier::purifyInt($val);
        if($clean !== false)
        {
            $this->id_admin_auteur_news = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class News: id_admin_auteur must be an INT.");
        }
    }

    public function setTitre($val)
    {
        $clean = DataPurifier::purifyString($val);
        if($clean !== false)
        {
            $this->titre_news = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class News: titre must be an TEXT.");
        }
    }

    public function setDateCreation($val)
    {
        $clean = DataPurifier::purifyDateTime($val);
        if($clean !== false)
        {
            $this->date_creation_news = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class News: date_creation must be a DATETIME.");
        }
    }

    public function setIsPublie($val)
    {
        $clean = DataPurifier::purifyBoolean($val);
        if($clean !== false)
        {
            $this->publie_news = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class News: isPublie must be a BOOL.");
        }
    }

    public function setTexte($val)
    {
        $clean = DataPurifier::purifyString($val);
        if($clean !== false)
        {
            $this->texte_news = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class News: texte must be a LONGTEXT.");
        }
    }

    public function setDatePublication($val)
    {
        $clean = DataPurifier::purifyDateTime($val);
        if($clean !== false)
        {
            $this->date_publication_news = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class News: date_publication must be a DATETIME.");
        }
    }


}

?>