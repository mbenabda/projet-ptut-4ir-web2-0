<?php
require_once(realpath(dirname(__FILE__)."/../exceptions/")."/IllegalArgumentTypeException.class.php");
require_once(realpath(dirname(__FILE__)."/../exceptions/")."/MissingArgumentException.class.php");
require_once(realpath(dirname(__FILE__)."/../tools/")."/DataPurifier.class.php");

class NoteCompilation
{
    private $id_note_compilation;
    private $id_compilation;
    private $date_note_compilation;
    private $valeur_note_compilation;
    private $id_personne;

    public function __construct($paramsArray = null)
    {
        if(!is_null($paramsArray))
        {
            if(!is_array($paramsArray))
            {
                throw new IllegalArgumentTypeException("Class NoteCompilation: the argument given to the constructor must be an ARRAY.");
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
                    throw new MissingArgumentException("Class NoteCompilation: missing argument 'id_compilation' on constructor call.");
                }

                if(isset($paramsArray['date_note']))
                {
                    $this->setDateNote($paramsArray['date_note']);
                }else
                {
                    throw new MissingArgumentException("Class NoteCompilation: missing argument 'date_note' on constructor call.");
                }

                if(isset($paramsArray['valeur_note']))
                {
                    $this->setValeurNote($paramsArray['valeur_note']);
                }else
                {
                    throw new MissingArgumentException("Class NoteCompilation: missing argument 'valeur_note' on constructor call.");
                }

                if(isset($paramsArray['id_personne']))
                {
                    $this->setIdPersonne($paramsArray['id_personne']);
                }else
                {
                    throw new MissingArgumentException("Class NoteCompilation: missing argument 'id_personne' on constructor call.");
                }
            }
        }
    }

    public function getId()
    {
        return $this->id_note_compilation;
    }

    public function setId($val)
    {
        $clean = DataPurifier::purifyInt($val);
        if ($clean !== false)
        {
            $this->id_note_compilation = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class NoteCompilation: id must be an INT.");
        }
    }

    public function getIdCompilation()
    {
            return $this->id_compilation;
    }

    public function getDateNote()
    {
        return $this->date_note_compilation;
    }

    public function getValeurNote()
    {
        return $this->valeur_note_compilation;
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
            $this->id_personne = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class NoteCompilation: id_compilation must be an INT.");
        }
    }

    public function setDateNote($val)
    {
        $clean = DataPurifier::purifyDateTime($val);
        if($clean !== false)
        {
            $this->date_note_compilation = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class NoteCompilation: date_note must be an DATETIME.");
        }
    }

    public function setValeurNote($val)
    {
        $clean = DataPurifier::purifyInt($val);
        if($clean !== false)
        {
            $this->valeur_note_compilation = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class NoteCompilation: valeur_note must be an INT.");
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
            throw new IllegalArgumentTypeException("Class NoteCompilation: id_personne must be an INT.");
        }
    }
}
?>