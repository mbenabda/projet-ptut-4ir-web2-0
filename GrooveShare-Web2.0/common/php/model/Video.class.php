<?php
require_once(realpath(dirname(__FILE__)."/../exceptions/")."/IllegalArgumentTypeException.class.php");
require_once(realpath(dirname(__FILE__)."/../exceptions/")."/MissingArgumentException.class.php");
require_once(realpath(dirname(__FILE__)."/../tools/")."/DataPurifier.class.php");
require_once(realpath(dirname(__FILE__)."/")."/Contenu.class.php");

class Video extends Contenu
{
    private $id_video;
    //private $id_contenu;

    public function __construct($paramsArray = null)
    {
        parent::__construct($paramsArray);
        if(!is_null($paramsArray))
        {
            if(!is_array($paramsArray))
            {
                throw new IllegalArgumentTypeException("Class Video: the argument given to the constructor must be an ARRAY.");
            }else
            {
                // arguments facultatifs
                if(isset($paramsArray['id']))
                {
                    $this->setId($paramsArray['id']);
                }
                /*
                // arguments obligatoires
                if(isset($paramsArray['id_contenu']))
                {
                    $this->setIdContenu($paramsArray['id_contenu']);
                }else
                {
                    throw new MissingArgumentException("Class Video: missing argument 'id_contenu' on constructor call.");
                }
                */
            }
        }
    }

    public function getId()
    {
        return $this->id_video;
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
            throw new IllegalArgumentTypeException("Class Video: id_contenu must be an INT.");
        }
    }
    */

    public function setId($val)
    {
        $clean = DataPurifier::purifyInt($val);
        if($clean !== false)
        {
            $this->id_video = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class Video: id must be an INT.");
        }
    }
}

?>