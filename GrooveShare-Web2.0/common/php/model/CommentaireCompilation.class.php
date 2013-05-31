<?php
require_once(realpath(dirname(__FILE__)."/../exceptions/")."/IllegalArgumentTypeException.class.php");
require_once(realpath(dirname(__FILE__)."/../exceptions/")."/MissingArgumentException.class.php");
require_once(realpath(dirname(__FILE__)."/../tools/")."/DataPurifier.class.php");

class CommentaireCompilation
{
    private $id_commentaire_compilation;
    private $id_compilation;
    private $date_commentaire_compilation;
    private $texte_commentaire_compilation;
    private $id_personne;

    public function __construct($paramsArray = null)
    {
        if(!is_null($paramsArray))
        {
            if(!is_array($paramsArray))
            {
                throw new IllegalArgumentTypeException("Class CommentaireCompilation: the argument given to the constructor must be an ARRAY.");
            }else
            {
                if (isset($paramsArray['id']))
                {
                    $this->setId($paramsArray['id']);
                }
                
                // arguments obligatoires
                if(isset($paramsArray['id_compilation']))
                {
                    $this->setIdCompilation($paramsArray['id_compilation']);
                }else
                {
                    throw new MissingArgumentException("Class CommentaireCompilation: missing argument 'id_compilation' on constructor call.");
                }

                if(isset($paramsArray['date_commentaire']))
                {
                    $this->setDateCommentaire($paramsArray['date_commentaire']);
                }else
                {
                    throw new MissingArgumentException("Class CommentaireCompilation: missing argument 'date_commentaire' on constructor call.");
                }

                if(isset($paramsArray['texte_commentaire']))
                {
                    $this->setTexteCommentaireCompilation($paramsArray['texte_commentaire']);
                }else
                {
                    throw new MissingArgumentException("Class CommentaireCompilation: missing argument 'texte_commentaire' on constructor call.");
                }

                if(isset($paramsArray['id_personne']))
                {
                    $this->setIdPersonne($paramsArray['id_personne']);
                }else
                {
                    throw new MissingArgumentException("Class CommentaireCompilation: missing argument 'id_personne' on constructor call.");
                }
            }
        }
    }


    public function getId()
    {
        return $this->id_commentaire_compilation;
    }

    public function setId($val)
    {
        $clean = DataPurifier::purifyInt($val);
        if ($clean !== false)
        {
            $this->id_commentaire_compilation = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class CommentaireCompilation: id must be an INT.");
        }
    }

    public function getIdCompilation()
    {
        return $this->id_compilation;
    }

    public function getDateCommentaire()
    {
        return $this->date_commentaire_compilation;
    }

    public function getTexteCommentaire()
    {
        return $this->texte_commentaire_compilation;
    }

    public function getIdPersonne()
    {
        return $this->id_personne;
    }

    public function setIdCompilation($val)
    {
        $clean = DataPurifier::purifyInt($val);
        if($clean !== false)
        {
            $this->id_compilation = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class CommentaireCompilation: id_compilation must be an INT.");
        }
    }

    public function setDateCommentaire($val)
    {
        $clean = DataPurifier::purifyDateTime($val);
        if($clean !== false)
        {
            $this->date_commentaire_compilation = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class CommentaireCompilation: date_commentaire must be an DATETIME.");
        }
    }

    public function setTexteCommentaire($val)
    {
        $clean = DataPurifier::purifyString($val);
        if($clean !== false)
        {
            $this->texte_commentaire_compilation = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class CommentaireCompilation: texte_commentaire must be an LONGTEXT.");
        }
    }

    public function setIdPersonne($val)
    {
        $clean = DataPurifier::purifyInt($val);
        if($clean !== false)
        {
            $this->id_personne = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class CommentaireCompilation: id_personne must be an INT.");
        }
    }
}
?>