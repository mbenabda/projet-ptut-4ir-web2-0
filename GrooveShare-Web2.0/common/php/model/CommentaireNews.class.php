<?php
require_once(realpath(dirname(__FILE__)."/../exceptions/")."/IllegalArgumentTypeException.class.php");
require_once(realpath(dirname(__FILE__)."/../exceptions/")."/MissingArgumentException.class.php");
require_once(realpath(dirname(__FILE__)."/../tools/")."/DataPurifier.class.php");

class CommentaireNews
{
    private $id_commentaire_news;
    private $id_personne;
    private $date_commentaire_news;
    private $texte_commentaire_news;
    private $id_news;

    public function __construct($paramsArray = null)
    {
        if(!is_null($paramsArray))
        {
            if(!is_array($paramsArray))
            {
                throw new IllegalArgumentTypeException("Class CommentaireNews: the argument given to the constructor must be an ARRAY.");
            }else
            {
                if (isset($paramsArray['id']))
                {
                    $this->setId($paramsArray['id']);
                }

                // arguments obligatoires

                if(isset($paramsArray['id_personne']))
                {
                    $this->setIdPersonne($paramsArray['id_personne']);
                }else
                {
                    throw new MissingArgumentException("Class CommentaireNews: missing argument 'id_personne' on constructor call.");
                }

                if(isset($paramsArray['date_commentaire']))
                {
                    $this->setDateCommentaire($paramsArray['date_commentaire']);
                }else
                {
                    throw new MissingArgumentException("Class CommentaireNews: missing argument 'date_commentaire' on constructor call.");
                }

                if(isset($paramsArray['texte_commentaire']))
                {
                    $this->setTexteCommentaire($paramsArray['texte_commentaire']);
                }else
                {
                    throw new MissingArgumentException("Class CommentaireNews: missing argument 'texte_commentaire' on constructor call.");
                }

                if(isset($paramsArray['id_news']))
                {
                    $this->setIdNews($paramsArray['id_news']);
                }else
                {
                    throw new MissingArgumentException("Class CommentaireNews: missing argument 'id_news' on constructor call.");
                }
            }
        }
    }

    public function getId()
    {
        return $this->id_commentaire_news;
    }

    public function setId($val)
    {
        $clean = DataPurifier::purifyInt($val);
        if ($clean !== false)
        {
            $this->id_commentaire_news = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class CommentaireNews: id must be an INT.");
        }
    }

    public function getIdPersonne()
    {
        return $this->id_personne;
    }

    public function getDateCommentaire()
    {
        return $this->date_commentaire_news;
    }

    public function getTexteCommentaire()
    {
        return $this->texte_commentaire_news;
    }

    public function getIdNews()
    {
        return $this->id_news;
    }

    public function setIdPersonne($val)
    {
        $clean = DataPurifier::purifyInt($val);
        if($clean !== false)
        {
            $this->id_personne = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class CommentaireNews: id_personne must be an INT.");
        }
    }

    public function setDateCommentaire($val)
    {
        $clean = DataPurifier::purifyDateTime($val);
        if($clean !== false)
        {
            $this->date_commentaire_news = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class CommentaireNews: date_commentaire must be an DATETIME.");
        }
    }

    public function setTexteCommentaire($val)
    {
        $clean = DataPurifier::purifyString($val);
        if($clean !== false)
        {
            $this->texte_commentaire_news = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class CommentaireNews: texte_commentaire must be an LONGTEXT.");
        }
    }

    public function setIdNews($val)
    {
        $clean = DataPurifier::purifyInt($val);
        if($clean !== false)
        {
            $this->id_personne = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class CommentaireNews: id_news must be an INT.");
        }
    }
}
?>