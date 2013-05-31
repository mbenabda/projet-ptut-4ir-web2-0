<?php
require_once(realpath(dirname(__FILE__)."/../exceptions/")."/IllegalArgumentTypeException.class.php");
require_once(realpath(dirname(__FILE__)."/../exceptions/")."/MissingArgumentException.class.php");
require_once(realpath(dirname(__FILE__)."/../tools/")."/DataPurifier.class.php");

class Morceau
{
    private $id_morceau;
    private $dl_possible_morceau = false;
    private $id_style_musique;
    private $id_contenu;

    public function __construct($paramsArray = null)
    {
        if(!is_null($paramsArray))
        {
            if(!is_array($paramsArray))
            {
                throw new IllegalArgumentTypeException("Class Morceau: the argument given to the constructor must be an ARRAY.");
            }else
            {
                // arguments facultatifs
                if(isset($paramsArray['id']))
                {
                    $this->setId($paramsArray['id']);
                }

                // arguments obligatoires
                if(isset($paramsArray['dl_possible']))
                {
                    $this->setIsDlPossible($paramsArray['dl_possible']);
                }else
                {
                    throw new MissingArgumentException("Class Morceau: missing argument 'dl_possible' on constructor call.");
                }

                if(isset($paramsArray['id_style_musique']))
                {
                    $this->setIdStyleMusique($paramsArray['id_style_musique']);
                }else
                {
                    throw new MissingArgumentException("Class Morceau: missing argument 'id_style_musique' on constructor call.");
                }

                if(isset($paramsArray['id_contenu']))
                {
                    $this->setIdContenu($paramsArray['id_contenu']);
                }else
                {
                    throw new MissingArgumentException("Class Morceau: missing argument 'id_contenu' on constructor call.");
                }
            }
        }
    }

    public function getId()
    {
        return $this->id_morceau;
    }

    public function isDlPossible()
    {
        return $this->dl_possible_morceau;
    }

    public function getIdStyleMusique()
    {
        return $this->id_style_musique;
    }

    public function getIdContenu()
    {
        return $this->id_contenu;
    }

    public function setId($val)
    {
        $clean = DataPurifier::purifyInt($val);
        if($clean !== false)
        {
            $this->id_morceau = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class Morceau: id must be an INT.");
        }
    }

    public function setIsDlPossible($val)
    {
        $clean = DataPurifier::purifyBoolean($val);
        if($clean !== false)
        {
            $this->dl_possible_morceau = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class Morceau: dl_possible must be an BOOL.");
        }
    }

    public function setIdStyleMusique($val)
    {
        $clean = DataPurifier::purifyInt($val);
        if($clean !== false)
        {
            $this->id_style_musique = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class Morceau: id_style_musique must be an INT.");
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
            throw new IllegalArgumentTypeException("Class Morceau: id_contenu must be an INT.");
        }
    }

}

?>