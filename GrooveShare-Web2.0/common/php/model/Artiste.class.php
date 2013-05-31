<?php
require_once(realpath(dirname(__FILE__)."/../exceptions/")."/IllegalArgumentTypeException.class.php");
require_once(realpath(dirname(__FILE__)."/../exceptions/")."/MissingArgumentException.class.php");
require_once(realpath(dirname(__FILE__)."/../tools/")."/DataPurifier.class.php");
require_once(realpath(dirname(__FILE__)."/")."/Personne.class.php");

class Artiste extends Personne
{
    private $id_artiste = null;
    private $url_site_artiste = null;
    private $biographie_artiste = null;
    private $credit_artiste = 0;
    //private $id_personne;

    public function __construct($paramsArray = null)
    {
        parent::__construct($paramsArray);
        if(!is_null($paramsArray))
        {
            if(!is_array($paramsArray))
            {
                throw new IllegalArgumentTypeException("Class Artiste: the argument given to the constructor must be an ARRAY.");
            }else
            {
                // arguments facultatifs
                if(isset($paramsArray['id']))
                {
                    $this->setId($paramsArray['id']);
                }
                if(isset($paramsArray['biographie']))
                {
                    $this->setBiographie($paramsArray['biographie']);
                }

                if(isset($paramsArray['url_site']) && !empty($paramsArray['url_site']))
                {
                    $this->setUrlSite($paramsArray['url_site']);
                }

                // arguments obligatoires
                if(isset($paramsArray['credit']))
                {
                    $this->setCredit($paramsArray['credit']);
                }else
                {
                    throw new MissingArgumentException("Class Artiste: missing argument 'credit' on constructor call.");
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
        return $this->id_artiste;
    }

    public function getBiographie()
    {
        return $this->biographie_artiste;
    }

    public function getUrlSite()
    {
        return $this->url_site_artiste;
    }

    public function getCredit()
    {
        return $this->credit_artiste;
    }

    public function setId($val)
    {
        $clean = DataPurifier::purifyInt($val);
        if($clean !== false)
        {
            $this->id_artiste = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class Artiste: id must be an INT.");
        }
    }

    public function setBiographie($val)
    {
        $clean = DataPurifier::purifyString($val);
        if($clean !== false)
        {
            $this->biographie_artiste = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class Artiste: biographie must be an URL.");
        }
    }

    public function setUrlSite($val)
    {
        $clean = DataPurifier::purifyURL($val);
        if($clean !== false)
        {
            $this->url_site_artiste = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class Artiste: url_site must be an URL.");
        }
    }

    public function setCredit($val)
    {
        $clean = DataPurifier::purifyInt($val);
        if($clean !== false)
        {
            $this->credit_artiste = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class Artiste: credit must be an INT.");
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
            throw new IllegalArgumentTypeException("Class Artiste: id_personne must be an INT.");
        }
    }*/
}

?>