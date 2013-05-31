<?php
require_once(realpath(dirname(__FILE__)."/../exceptions/")."/IllegalArgumentTypeException.class.php");
require_once(realpath(dirname(__FILE__)."/../exceptions/")."/MissingArgumentException.class.php");
require_once(realpath(dirname(__FILE__)."/../tools/")."/DataPurifier.class.php");

class CommentaireArtiste
{
    private $id_commentaire_artiste;
    private $id_personne;
    private $date_commentaire_artiste;
    private $texte_commentaire_artiste;
    private $id_artiste;

    public function __construct($paramsArray = null)
    {
        if(!is_null($paramsArray))
        {
            if(!is_array($paramsArray))
            {
                throw new IllegalArgumentTypeException("Class CommentaireArtiste: the argument given to the constructor must be an ARRAY.");
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
                    throw new MissingArgumentException("Class CommentaireArtiste: missing argument 'id_personne' on constructor call.");
                }

                if(isset($paramsArray['date_commentaire']))
                {
                    $this->setDateCommentaire($paramsArray['date_commentaire']);
                }else
                {
                    throw new MissingArgumentException("Class CommentaireArtiste: missing argument 'date_commentaire' on constructor call.");
                }

                if(isset($paramsArray['texte_commentaire']))
                {
                    $this->setTexteCommentaire($paramsArray['texte_commentaire']);
                }else
                {
                    throw new MissingArgumentException("Class CommentaireArtiste: missing argument 'texte_commentaire' on constructor call.");
                }

                if(isset($paramsArray['id_artiste']))
                {
                    $this->setIdArtiste($paramsArray['id_artiste']);
                }else
                {
                    throw new MissingArgumentException("Class CommentaireArtiste: missing argument 'id_artiste' on constructor call.");
                }
            }
        }
    }

    public function getId()
    {
        return $this->id_commentaire_artiste;
    }

    public function setId($val)
    {
        $clean = DataPurifier::purifyInt($val);
        if ($clean !== false)
        {
            $this->id_commentaire_artiste = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class CommentaireArtiste: id must be an INT.");
        }
    }
    
    public function getIdPersonne()
    {
        return $this->id_personne;
    }

    public function getDateCommentaire()
    {
        return $this->date_commentaire_artiste;
    }

    public function getTexteCommentaire()
    {
        return $this->texte_commentaire_artiste;
    }

    public function getIdArtiste()
    {
        return $this->id_artiste;
    }

    public function setIdPersonne($val)
    {
        $clean = DataPurifier::purifyInt($val);
        if($clean !== false)
        {
            $this->id_personne = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class CommentaireArtiste: id_personne must be an INT.");
        }
    }

    public function setDateCommentaire($val)
    {
        $clean = DataPurifier::purifyDateTime($val);
        if($clean !== false)
        {
            $this->date_commentaire_artiste = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class CommentaireArtiste: date_commentaire must be an DATETIME.");
        }
    }

    public function setTexteCommentaire($val)
    {
        $clean = DataPurifier::purifyString($val);
        if($clean !== false)
        {
            $this->texte_commentaire_artiste = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class CommentaireArtiste: texte_commentaire must be an LONGTEXT.");
        }
    }

    public function setIdArtiste($val)
    {
        $clean = DataPurifier::purifyInt($val);
        if($clean !== false)
        {
            $this->id_artiste = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class CommentaireArtiste: id_artiste must be an INT.");
        }
    }
}
?>