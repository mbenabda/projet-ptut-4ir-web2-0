<?php
require_once(realpath(dirname(__FILE__)."/../exceptions/")."/IllegalArgumentTypeException.class.php");
require_once(realpath(dirname(__FILE__)."/../exceptions/")."/MissingArgumentException.class.php");
require_once(realpath(dirname(__FILE__)."/../tools/")."/DataPurifier.class.php");

class Compilation
{
    private $url_cover_front_compilation;
    private $date_publication_compilation;
    private $id_compilation;
    private $description_compilation;
    private $url_cover_back_compilation;
    private $date_creation_compilation;
    private $nom_compilation;
    private $publie_compilation = false;
    private $id_admin_responsable;
    private $prix_compilation = 0;

    public function __construct($paramsArray = null)
    {
        if(!is_null($paramsArray))
        {
            if(!is_array($paramsArray))
            {
                throw new IllegalArgumentTypeException("Class Compilations: the argument given to the constructor must be an ARRAY.");
            }else
            {

                // arguments facultatifs
                if(isset($paramsArray['url_cover_front']))
                {
                    $this->setUrlCoverFront($paramsArray['url_cover_front']);
                }

                if(isset($paramsArray['date_publication']))
                {
                    $this->setDatePublication($paramsArray['date_publication']);
                }

                if(isset($paramsArray['id']))
                {
                    $this->setId($paramsArray['id']);
                }

                if(isset($paramsArray['description']))
                {
                    $this->setDescription($paramsArray['description']);
                }

                if(isset($paramsArray['url_cover_back']))
                {
                    $this->setUrlCoverBack($paramsArray['url_cover_back']);
                }

                // arguments obligatoires
                if(isset($paramsArray['date_creation']))
                {
                    $this->setDateCreation($paramsArray['date_creation']);
                }else
                {
                    throw new MissingArgumentException("Class Compilation: missing argument 'date_creation' on constructor call.");
                }

                if(isset($paramsArray['nom']))
                {
                    $this->setNom($paramsArray['nom']);
                }else
                {
                    throw new MissingArgumentException("Class Compilation: missing argument 'nom' on constructor call.");
                }

                if(isset($paramsArray['isPublie']))
                {
                    $this->setIsPublie($paramsArray['isPublie']);
                }else
                {
                    throw new MissingArgumentException("Class Compilation: missing argument 'isPublie' on constructor call.");
                }

                if(isset($paramsArray['id_admin']))
                {
                    $this->setIdAdminResponsable($paramsArray['id_admin']);
                }else
                {
                    throw new MissingArgumentException("Class Compilation: missing argument 'id_admin' on constructor call.");
                }

                if(isset($paramsArray['prix']))
                {
                    $this->setPrix($paramsArray['prix']);
                }else
                {
                    throw new MissingArgumentException("Class Compilation: missing argument 'prix' on constructor call.");
                }
            }
        }
    }


    public function getUrlCoverFront()
    {
            return $this->url_cover_front_compilation;
    }

    public function getDatePublication()
    {
            return $this->date_publication_compilation;
    }

    public function getId()
    {
            return $this->id_compilation;
    }

    public function getDescription()
    {
            return $this->description_compilation;
    }

    public function getUrlCoverBack()
    {
            return $this->url_cover_back_compilation;
    }

    public function getDateCreation()
    {
            return $this->date_creation_compilation;
    }

    public function getNom()
    {
            return $this->nom_compilation;
    }

    public function isPublie()
    {
            return $this->publie_compilation;
    }

    public function getIdAdminResponsable()
    {
            return $this->id_admin_responsable;
    }

    public function getPrix()
    {
        return $this->prix_compilation;
    }

    public function setDatePublication($val)
    {
        $clean = DataPurifier::purifyDateTime($val);
        if($clean !== false)
        {
            $this->date_publication_compilation = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class Compilation: date_publication must be an DATETIME.");
        }
    }

    public function setId($val)
    {
        $clean = DataPurifier::purifyInt($val);
        if($clean !== false)
        {
            $this->id_compilation = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class Compilation: id must be an INT.");
        }
    }

    public function setDescription($val)
    {
        $clean = DataPurifier::purifyString($val);
        if($clean !== false)
        {
            $this->description_compilation = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class Compilation: description must be an LONGTEXT.");
        }
    }

    public function setUrlCoverFront($val)
    {
        $clean = DataPurifier::purifyURL($val);
        if($clean !== false)
        {
            $this->url_cover_front_compilation = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class Compilation: url_cover_front must be an URL.");
        }
    }

    public function setUrlCoverBack($val)
    {
        $clean = DataPurifier::purifyURL($val);
        if($clean !== false)
        {
            $this->url_cover_back_compilation = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class Compilation: url_cover_back must be an URL.");
        }
    }

    public function setDateCreation($val)
    {
        $clean = DataPurifier::purifyDateTime($val);
        if($clean !== false)
        {
            $this->date_creation_compilation = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class Compilation: date_creation must be an DATETIME.");
        }
    }

    public function setNom($val)
    {
        $clean = DataPurifier::purifyString($val);
        if($clean !== false)
        {
            $this->nom_compilation = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class Compilation: nom must be an TEXT.");
        }
    }

    public function setIsPublie($val)
    {
        $clean = DataPurifier::purifyBoolean($val);
        if($clean !== false)
        {
            $this->publie_compilation = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class Compilation: isPublie must be an BOOL.");
        }
    }

    public function setIdAdminResponsable($val)
    {
        $clean = DataPurifier::purifyInt($val);
        if($clean !== false)
        {
            $this->id_admin_responsable = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class Compilation: id_admin_responsable must be an INT.");
        }
    }

    public function setPrix($val)
    {
        $clean = DataPurifier::purifyInt($val);
        if($clean !== false)
        {
            $this->prix_compilation = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class Compilation: prix must be an INT.");
        }
    }
}

?>