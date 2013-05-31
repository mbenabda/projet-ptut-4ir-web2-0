<?php
require_once(realpath(dirname(__FILE__)."/../exceptions/")."/IllegalArgumentTypeException.class.php");
require_once(realpath(dirname(__FILE__)."/../exceptions/")."/MissingArgumentException.class.php");
require_once(realpath(dirname(__FILE__)."/../tools/")."/DataPurifier.class.php");
require_once(realpath(dirname(__FILE__)."/")."/Personne.class.php");

class Administrateur extends Personne
{
    private $id_admin;
    //private $id_personne;

    public function __construct($paramsArray = null)
    {
        parent::__construct($paramsArray);
        
        if(!is_null($paramsArray))
        {
            if(!is_array($paramsArray))
            {
                throw new IllegalArgumentTypeException("Class Administrateur: the argument given to the constructor must be an ARRAY.");
            }else
            {
                if(isset($paramsArray['id']))
                {
                    $this->setId($paramsArray['id']);
                }
                /*
                if(isset($paramsArray['id_personne']))
                {
                    $this->setIdPersonne($paramsArray['id_personne']);
                }else
                {
                    throw new MissingArgumentException("Class Membre: missing argument 'id_personne' on constructor call.");
                }*/
            }
        }
    }

    public function getId()
    {
        return $this->id_admin;
    }

    public function setId($val)
    {
        $clean = DataPurifier::purifyInt($val);
        if($clean !== false)
        {
            $this->id_admin = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class Administrateur: id must be an INT.");
        }
    }

    /*
    public function getIdPersonne()
    {
        return $this->id_personne;
    }

    public function setIdPersonne($val)
    {
        $clean = DataPurifier::purifyInt($val);
        if($clean !== false)
        {
            $this->id_personne = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class Administrateur: id_personne must be an INT.");
        }
    }*/
}
?>