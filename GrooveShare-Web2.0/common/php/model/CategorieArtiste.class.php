<?php
require_once(realpath(dirname(__FILE__)."/../exceptions/")."/IllegalArgumentTypeException.class.php");
require_once(realpath(dirname(__FILE__)."/../exceptions/")."/MissingArgumentException.class.php");
require_once(realpath(dirname(__FILE__)."/../tools/")."/DataPurifier.class.php");

class CategorieArtiste
{
    private $id_artiste;
    private $id_categorie;

    public function __construct($paramsArray = null)
    {
        if(!is_null($paramsArray))
        {
            if(!is_array($paramsArray))
            {
                throw new IllegalArgumentTypeException("Class CategorieArtiste: the argument given to the constructor must be an ARRAY.");
            }else
            {
                // arguments obligatoires
                if(isset($paramsArray['id_artiste']))
                {
                    $this->setIdArtiste($paramsArray['id_artiste']);
                }else
                {
                    throw new MissingArgumentException("Class CategorieArtiste: missing argument 'id_artiste' on constructor call.");
                }

                if(isset($paramsArray['id_categorie']))
                {
                    $this->setIdCategorie($paramsArray['id_categorie']);
                }else
                {
                    throw new MissingArgumentException("Class CategorieArtiste: missing argument 'id_categorie' on constructor call.");
                }
            }
        }
    }

    public function getIdArtiste()
    {
        return $this->id_artiste;
    }

    public function getIdCategorie()
    {
        return $this->id_categorie;
    }

    public function setIdArtiste($val)
    {
        $clean = DataPurifier::purifyInt($val);
        if($clean !== false)
        {
            $this->id_artiste = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class CategorieArtiste: id_artiste must be an INT.");
        }
    }

    public function setIdCategorie($val)
    {
        $clean = DataPurifier::purifyInt($val);
        if($clean !== false)
        {
            $this->id_categorie = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class CategorieArtiste: id_categorie must be an INT.");
        }
    }
}
?>