<?php
require_once(realpath(dirname(__FILE__)."/../exceptions/")."/IllegalArgumentTypeException.class.php");
require_once(realpath(dirname(__FILE__)."/../exceptions/")."/MissingArgumentException.class.php");
require_once(realpath(dirname(__FILE__)."/../tools/")."/DataPurifier.class.php");
require_once(realpath(dirname(__FILE__)."/")."/Personne.class.php");

class Membre extends Personne
{
    private $id_membre;
    private $credit_membre = 0;
    //private $id_personne;

    public function __construct($paramsArray = null)
    {
        parent::__construct($paramsArray);
        if(!is_null($paramsArray))
        {
            if(!is_array($paramsArray))
            {
                throw new IllegalArgumentTypeException("Class Membre: the argument given to the constructor must be an ARRAY.");
            }else
            {
                // arguments facultatifs
                if(isset($paramsArray['id']))
                {
                    $this->setId($paramsArray['id']);
                }

                // arguments obligatoires
                if(isset($paramsArray['credit']))
                {
                    $this->setCredit($paramsArray['credit']);
                }else
                {
                    throw new MissingArgumentException("Class Membre: missing argument 'credit' on constructor call.");
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
        return $this->id_membre;
    }

    public function getCredit()
    {
        return $this->credit_membre;
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
            throw new IllegalArgumentTypeException("Class Membre: id_personne must be an INT.");
        }
    }*/
    public function setId($val)
    {
        $clean = DataPurifier::purifyInt($val);
        if($clean !== false)
        {
            $this->id_membre = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class Membre: id must be an INT.");
        }
    }

    public function setCredit($val)
    {
        $clean = DataPurifier::purifyInt($val);
        if($clean !== false)
        {
            $this->credit_membre = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class Membre: credit must be an INT.");
        }
    }

}
?>
