<?php

require_once(realpath(dirname(__FILE__) . "/../exceptions/") . "/IllegalArgumentTypeException.class.php");
require_once(realpath(dirname(__FILE__) . "/../exceptions/") . "/MissingArgumentException.class.php");
require_once(realpath(dirname(__FILE__) . "/../tools/") . "/DataPurifier.class.php");

class CommentaireContenu {

    private $id_commentaire_contenu;
    private $date_commentaire_contenu;
    private $texte_commentaire_contenu;
    private $id_contenu;

    public function __construct($paramsArray = null)
    {
        if (!is_null($paramsArray))
        {
            if (!is_array($paramsArray))
            {
                throw new IllegalArgumentTypeException("Class CommentaireContenu: the argument given to the constructor must be an ARRAY.");
            } else
            {
                if (isset($paramsArray['id']))
                {
                    $this->setId($paramsArray['id']);
                }
                
                // arguments obligatoires

                if (isset($paramsArray['id_personne']))
                {
                    $this->setIdPersonne($paramsArray['id_personne']);
                }else
                {
                    throw new MissingArgumentException("Class CommentaireContenu: missing argument 'id_personne' on constructor call.");
                }

                if (isset($paramsArray['date_commentaire']))
                {
                    $this->setDateCommentaire($paramsArray['date_commentaire']);
                }else
                {
                    throw new MissingArgumentException("Class CommentaireContenu: missing argument 'date_commentaire' on constructor call.");
                }

                if (isset($paramsArray['texte_commentaire']))
                {
                    $this->setTexteCommentaire($paramsArray['texte_commentaire']);
                }else
                {
                    throw new MissingArgumentException("Class CommentaireContenu: missing argument 'texte_commentaire' on constructor call.");
                }

                if (isset($paramsArray['id_contenu']))
                {
                    $this->setIdContenu($paramsArray['id_contenu']);
                }else
                {
                    throw new MissingArgumentException("Class CommentaireContenu: missing argument 'id_contenu' on constructor call.");
                }
            }
        }
    }

    public function getId()
    {
        return $this->id_commentaire_contenu;
    }

    public function setId($val)
    {
        $clean = DataPurifier::purifyInt($val);
        if ($clean !== false)
        {
            $this->id_commentaire_contenu = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class CommentaireContenu: id must be an INT.");
        }
    }

    public function getIdPersonne()
    {
        return $this->id_personne;
    }

    public function getDateCommentaire()
    {
        return $this->date_commentaire_contenu;
    }

    public function getTexteCommentaire()
    {
        return $this->texte_commentaire_contenu;
    }

    public function getIdContenu()
    {
        return $this->id_contenu;
    }

    public function setIdPersonne($val)
    {
        $clean = DataPurifier::purifyInt($val);
        if ($clean !== false)
        {
            $this->id_personne = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class CommentaireContenu: id_personne must be an INT.");
        }
    }

    public function setDateCommentaire($val)
    {
        $clean = DataPurifier::purifyDateTime($val);
        if ($clean !== false)
        {
            $this->date_commentaire_contenu = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class CommentaireContenu: date_commentaire must be an DATETIME.");
        }
    }

    public function setTexteCommentaire($val)
    {
        $clean = DataPurifier::purifyString($val);
        if ($clean !== false)
        {
            $this->texte_commentaire_contenu = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class CommentaireContenu: texte_commentaire must be an LONGTEXT.");
        }
    }

    public function setIdContenu($val)
    {
        $clean = DataPurifier::purifyInt($val);
        if ($clean !== false)
        {
            $this->id_personne = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class CommentaireContenu: id_contenu must be an INT.");
        }
    }

}
?>