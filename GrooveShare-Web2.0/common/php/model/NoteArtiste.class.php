<?php
require_once(realpath(dirname(__FILE__)."/../exceptions/")."/IllegalArgumentTypeException.class.php");
require_once(realpath(dirname(__FILE__)."/../exceptions/")."/MissingArgumentException.class.php");
require_once(realpath(dirname(__FILE__)."/../tools/")."/DataPurifier.class.php");

class NoteArtiste
{
    private $id_note_artiste;
    private $id_personne;
    private $date_note_artiste;
    private $valeur_note_artiste;
    private $id_artiste;

    public function __construct($paramsArray = null)
    {
        if(!is_null($paramsArray))
        {
            if(!is_array($paramsArray))
            {
                throw new IllegalArgumentTypeException("Class NoteArtiste: the argument given to the constructor must be an ARRAY.");
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
                    throw new MissingArgumentException("Class NoteArtiste: missing argument 'id_personne' on constructor call.");
                }

                if(isset($paramsArray['date_note']))
                {
                    $this->setDateNote($paramsArray['date_note']);
                }else
                {
                    throw new MissingArgumentException("Class NoteArtiste: missing argument 'date_note' on constructor call.");
                }

                if(isset($paramsArray['valeur_note']))
                {
                    $this->setValeurNote($paramsArray['valeur_note']);
                }else
                {
                    throw new MissingArgumentException("Class NoteArtiste: missing argument 'valeur_note' on constructor call.");
                }

                if(isset($paramsArray['id_artiste']))
                {
                    $this->setIdArtiste($paramsArray['id_artiste']);
                }else
                {
                    throw new MissingArgumentException("Class NoteArtiste: missing argument 'id_artiste' on constructor call.");
                }
            }
        }
    }

    public function getId()
    {
        return $this->id_note_artiste;
    }

    public function setId($val)
    {
        $clean = DataPurifier::purifyInt($val);
        if ($clean !== false)
        {
            $this->id_note_artiste = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class NoteArtiste: id must be an INT.");
        }
    }
    
    public function getIdPersonne()
    {
        return $this->id_personne;
    }

    public function getDateNote()
    {
        return $this->date_note_artiste;
    }

    public function getValeurNote()
    {
        return $this->valeur_note_artiste;
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
            throw new IllegalArgumentTypeException("Class NoteArtiste: id_personne must be an INT.");
        }
    }

    public function setDateNote($val)
    {
        $clean = DataPurifier::purifyDateTime($val);
        if($clean !== false)
        {
            $this->date_note_artiste = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class NoteArtiste: date_note must be an DATETIME.");
        }
    }

    public function setValeurNote($val)
    {
        $clean = DataPurifier::purifyInt($val);
        if($clean !== false)
        {
            $this->valeur_note_artiste = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class NoteArtiste: valeur_note must be an INT.");
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
            throw new IllegalArgumentTypeException("Class NoteArtiste: id_artiste must be an INT.");
        }
    }
}
?>