<?php
require_once(realpath(dirname(__FILE__)."/../exceptions/")."/IllegalArgumentTypeException.class.php");
require_once(realpath(dirname(__FILE__)."/../exceptions/")."/MissingArgumentException.class.php");
require_once(realpath(dirname(__FILE__)."/../tools/")."/DataPurifier.class.php");

class ParticipationCompilation
{
    private $id_compilation;
    private $id_morceau;

    public function __construct($paramsArray = null)
    {
        if(!is_null($paramsArray))
        {
            if(!is_array($paramsArray))
            {
                throw new IllegalArgumentTypeException("Class ParticipationCompilation: the argument given to the constructor must be an ARRAY.");
            }else
            {
                // arguments obligatoires

                if(isset($paramsArray['id_compilation']))
                {
                    $this->setIdCompilation($paramsArray['id_compilation']);
                }else
                {
                    throw new MissingArgumentException("Class ParticipationCompilation: missing argument 'id_compilation' on constructor call.");
                }

                if(isset($paramsArray['id_morceau']))
                {
                    $this->setIdMorceau($paramsArray['id_morceau']);
                }else
                {
                    throw new MissingArgumentException("Class ParticipationCompilation: missing argument 'id_morceau' on constructor call.");
                }
            }
        }
    }

    public function getIdCompilation()
    {
        return $this->id_compilation;
    }

    public function getIdMorceau()
    {
        return $this->id_morceau;
    }

    public function setIdCompilation($val)
    {
        $clean = DataPurifier::purifyInt($val);
        if($clean !== false)
        {
            $this->id_compilation = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class ParticipationCompilation: id_compilation must be an INT.");
        }
    }

    public function setIdMorceau($val)
    {
        $clean = DataPurifier::purifyInt($val);
        if($clean !== false)
        {
            $this->id_morceau = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class ParticipationCompilation: id_morceau must be an INT.");
        }
    }
}
?>