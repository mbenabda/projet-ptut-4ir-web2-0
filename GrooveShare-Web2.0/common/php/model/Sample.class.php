<?php
require_once(realpath(dirname(__FILE__)."/../exceptions/")."/IllegalArgumentTypeException.class.php");
require_once(realpath(dirname(__FILE__)."/../exceptions/")."/MissingArgumentException.class.php");
require_once(realpath(dirname(__FILE__)."/../tools/")."/DataPurifier.class.php");
require_once(realpath(dirname(__FILE__)."/")."/Contenu.class.php");

class Sample extends Contenu
{
    private $id_sample;
    private $prix_sample = 0;
    //private $id_contenu;

    public function __construct($paramsArray = null)
    {
        parent::__construct($paramsArray);
        if(!is_null($paramsArray))
        {
            if(!is_array($paramsArray))
            {
                throw new IllegalArgumentTypeException("Class Sample: the argument given to the constructor must be an ARRAY.");
            }else
            {
                // arguments facultatifs
                if(isset($paramsArray['id']))
                {
                    $this->setId($paramsArray['id']);
                }

                // arguments obligatoires
                if(isset($paramsArray['prix']))
                {
                    $this->setPrix($paramsArray['prix']);
                }else
                {
                    throw new MissingArgumentException("Class Sample: missing argument 'prix' on constructor call.");
                }
                /*
                if(isset($paramsArray['id_contenu']))
                {
                    $this->setIdContenu($paramsArray['id_contenu']);
                }else
                {
                    throw new MissingArgumentException("Class Samples: missing argument 'id_contenu' on constructor call.");
                }
                */
            }
        }
    }

    public function getId()
    {
        return $this->id_sample;
    }

    public function getPrix()
    {
        return $this->prix_sample;
    }

    /*
    public function getIdContenu()
    {
        return $this->id_contenu;
    }

    public function setIdContenu($val)
    {
        $clean = DataPurifier::purifyInt($val);
        if($clean !== false)
        {
            $this->id_contenu = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class Sample: id_contenu must be an INT.");
        }
    }
    */

    public function setId($val)
    {
        $clean = DataPurifier::purifyInt($val);
        if($clean !== false)
        {
            $this->id_sample= $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class Sample: id must be an INT.");
        }
    }

    public function setPrix($val)
    {
        $clean = DataPurifier::purifyInt($val);
        if($clean !== false)
        {
            $this->prix_sample = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class Sample: prix must be an INT.");
        }
    }
}
?>