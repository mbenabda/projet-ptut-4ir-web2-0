<?php
require_once(realpath(dirname(__FILE__)."/../exceptions/")."/IllegalArgumentTypeException.class.php");
require_once(realpath(dirname(__FILE__)."/../exceptions/")."/MissingArgumentException.class.php");
require_once(realpath(dirname(__FILE__)."/../tools/")."/DataPurifier.class.php");

class NoteNews
{
    private $id_note_news;
    private $id_personne;
    private $date_note_news;
    private $valeur_note_news;
    private $id_news;

    public function __construct($paramsArray = null)
    {
        if(!is_null($paramsArray))
        {
            if(!is_array($paramsArray))
            {
                throw new IllegalArgumentTypeException("Class NoteNews: the argument given to the constructor must be an ARRAY.");
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
                    throw new MissingArgumentException("Class NoteNews: missing argument 'id_personne' on constructor call.");
                }

                if(isset($paramsArray['date_note']))
                {
                    $this->setDateNote($paramsArray['date_note']);
                }else
                {
                    throw new MissingArgumentException("Class NoteNews: missing argument 'date_note' on constructor call.");
                }

                if(isset($paramsArray['valeur_note']))
                {
                    $this->setValeurNote($paramsArray['valeur_note']);
                }else
                {
                    throw new MissingArgumentException("Class NoteNews: missing argument 'valeur_note' on constructor call.");
                }

                if(isset($paramsArray['id_news']))
                {
                    $this->setIdNews($paramsArray['id_news']);
                }else
                {
                    throw new MissingArgumentException("Class NoteNews: missing argument 'id_news' on constructor call.");
                }
            }
        }
    }

    public function getId()
    {
        return $this->id_note_news;
    }

    public function setId($val)
    {
        $clean = DataPurifier::purifyInt($val);
        if ($clean !== false)
        {
            $this->id_note_news = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class NoteNews: id must be an INT.");
        }
    }
    
    public function getIdPersonne()
    {
        return $this->id_personne;
    }

    public function getDateNote()
    {
        return $this->date_note_news;
    }

    public function getValeurNote()
    {
        return $this->valeur_note_news;
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
            throw new IllegalArgumentTypeException("Class NoteNews: id_personne must be an INT.");
        }
    }

    public function setDateNote($val)
    {
        $clean = DataPurifier::purifyDateTime($val);
        if($clean !== false)
        {
            $this->date_note_news = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class NoteNews: date_note must be an DATETIME.");
        }
    }

    public function setValeurNote($val)
    {
        $clean = DataPurifier::purifyInt($val);
        if($clean !== false)
        {
            $this->valeur_note_news = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class NoteNews: valeur_note must be an INT.");
        }
    }

    public function setIdNews($val)
    {
        $clean = DataPurifier::purifyInt($val);
        if($clean !== false)
        {
            $this->id_news = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class NoteNews: id_news must be an INT.");
        }
    }
}
?>