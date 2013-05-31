<?php
require_once(realpath(dirname(__FILE__)."/../exceptions/")."/IllegalArgumentTypeException.class.php");
require_once(realpath(dirname(__FILE__)."/../exceptions/")."/MissingArgumentException.class.php");
require_once(realpath(dirname(__FILE__)."/../tools/")."/DataPurifier.class.php");

class NoteContenu
{
    private $id_note_contenu;
    private $id_personne;
    private $date_note_contenu;
    private $valeur_note_contenu;
    private $id_contenu;

    public function __construct($paramsArray = null)
    {
        if(!is_null($paramsArray))
        {
            if(!is_array($paramsArray))
            {
                throw new IllegalArgumentTypeException("Class NoteContenu: the argument given to the constructor must be an ARRAY.");
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
                    throw new MissingArgumentException("Class NoteContenu: missing argument 'id_personne' on constructor call.");
                }

                if(isset($paramsArray['date_note']))
                {
                    $this->setDateNote($paramsArray['date_note']);
                }else
                {
                    throw new MissingArgumentException("Class NoteContenu: missing argument 'date_note' on constructor call.");
                }

                if(isset($paramsArray['valeur_note']))
                {
                    $this->setValeurNote($paramsArray['valeur_note']);
                }else
                {
                    throw new MissingArgumentException("Class NoteContenu: missing argument 'valeur_note' on constructor call.");
                }

                if(isset($paramsArray['id_contenu']))
                {
                    $this->setIdContenu($paramsArray['id_contenu']);
                }else
                {
                    throw new MissingArgumentException("Class NoteContenu: missing argument 'id_contenu' on constructor call.");
                }
            }
        }
    }

    public function getId()
    {
        return $this->id_note_contenu;
    }

    public function setId($val)
    {
        $clean = DataPurifier::purifyInt($val);
        if ($clean !== false)
        {
            $this->id_note_contenu = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class NoteContenu: id must be an INT.");
        }
    }
    
    public function getIdPersonne()
    {
        return $this->id_personne;
    }

    public function getDateNote()
    {
        return $this->date_note_contenu;
    }

    public function getValeurNote()
    {
        return $this->valeur_note_contenu;
    }

    public function getIdContenu()
    {
        return $this->id_contenu;
    }

    public function setIdPersonne($val)
    {
        $clean = DataPurifier::purifyInt($val);
        if($clean !== false)
        {
            $this->id_personne = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class NoteContenu: id_personne must be an INT.");
        }
    }

    public function setDateNote($val)
    {
        $clean = DataPurifier::purifyDateTime($val);
        if($clean !== false)
        {
            $this->date_note_contenu = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class NoteContenu: date_note must be an DATETIME.");
        }
    }

    public function setValeurNote($val)
    {
        $clean = DataPurifier::purifyInt($val);
        if($clean !== false)
        {
            $this->valeur_note_contenu = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class NoteContenu: valeur_note must be an INT.");
        }
    }

    public function setIdContenu($val)
    {
        $clean = DataPurifier::purifyInt($val);
        if($clean !== false)
        {
            $this->id_contenu = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class NoteContenu: id_contenu must be an INT.");
        }
    }
}
?>