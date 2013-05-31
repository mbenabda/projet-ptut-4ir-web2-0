<?php
require_once(realpath(dirname(__FILE__)."/../exceptions/")."/IllegalArgumentTypeException.class.php");
require_once(realpath(dirname(__FILE__)."/../exceptions/")."/MissingArgumentException.class.php");
require_once(realpath(dirname(__FILE__)."/../tools/")."/DataPurifier.class.php");

class TraductionCategorie
{
    private $id_categorie;
    private $traduction_nom_categorie;
    private $id_langue;

    public function __construct($paramsArray = null)
    {
        if(!is_null($paramsArray))
        {
            if(!is_array($paramsArray))
            {
                throw new IllegalArgumentTypeException("Class TraductionCategorie: the argument given to the constructor must be an ARRAY.");
            }else
            {
                // arguments obligatoires

                if(isset($paramsArray['id_categorie']))
                {
                    $this->setIdCategorie($paramsArray['id_categorie']);
                }else
                {
                    throw new MissingArgumentException("Class TraductionCategorie: missing argument 'id_categorie' on constructor call.");
                }

                if(isset($paramsArray['traduction_nom']))
                {
                    $this->setTraductionNom($paramsArray['traduction_nom']);
                }else
                {
                    throw new MissingArgumentException("Class TraductionCategorie: missing argument 'traduction_nom' on constructor call.");
                }

                if(isset($paramsArray['id_langue']))
                {
                    $this->setIdLangue($paramsArray['id_langue']);
                }else
                {
                    throw new MissingArgumentException("Class TraductionCategorie: missing argument 'id_langue' on constructor call.");
                }
            }
        }
    }

    public function getIdCategorie()
    {
        return $this->id_categorie;
    }

    public function getTraductionNom()
    {
        return $this->traduction_nom_categorie;
    }

    public function getIdLangue()
    {
        return $this->id_langue;
    }

    public function setIdCategorie($val)
    {
        $clean = DataPurifier::purifyInt($val);
        if($clean !== false)
        {
            $this->id_categorie = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class TraductionCategorie: id_categorie must be an INT.");
        }
    }

    public function setTraductionNom($val)
    {
        $clean = DataPurifier::purifyString($val);
        if($clean !== false)
        {
            $this->traduction_nom_categorie = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class TraductionCategorie: traduction_nom must be an VARCHAR(100).");
        }
    }

    public function setIdLangue($val)
    {
        $clean = DataPurifier::purifyInt($val);
        if($clean !== false)
        {
            $this->id_langue = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class TraductionCategorie: id_langue must be an INT.");
        }
    }
}
?>