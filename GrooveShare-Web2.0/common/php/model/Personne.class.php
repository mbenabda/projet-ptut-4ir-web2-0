<?php
require_once(realpath(dirname(__FILE__)."/../exceptions/")."/IllegalArgumentTypeException.class.php");
require_once(realpath(dirname(__FILE__)."/../exceptions/")."/MissingArgumentException.class.php");
require_once(realpath(dirname(__FILE__)."/../tools/")."/DataPurifier.class.php");

/*
CREATE TABLE Personnes
(
	id_personne INT AUTO_INCREMENT NOT NULL,
	nom_personne VARCHAR(50),
	prenom_personne VARCHAR(50),
	date_naissance_personne DATE NOT NULL,
	adresse_personne TEXT,
	email_personne VARCHAR(100) NOT NULL,
	CP_personne VARCHAR(20),
	ville_personne VARCHAR(50),
	login_personne VARCHAR(50) NOT NULL,
	pass_personne LONGTEXT NOT NULL,
	url_avatar_personne TEXT,
	publie_personne BOOL NOT NULL DEFAULT FALSE,
	id_langue INT NOT NULL,
	id_pays INT NOT NULL,

	PRIMARY KEY (id_personne)
) ENGINE=MyISAM;
*/

/*
Documentation sur les filtres:
http://ca.php.net/manual/en/book.filter.php

Tuto SDZ
http://www.siteduzero.com/tutoriel-3-423618-les-filtres-en-php-pour-valider-les-donnees-utilisateur.html
 */

class Personne
{
    protected $id_personne = null;
    protected $nom_personne = null;
    protected $prenom_personne = null;
    protected $date_naissance_personne = null;
    protected $adresse_personne = null;
    protected $email_personne = null;
    protected $CP_personne = null;
    protected $ville_personne = null;
    protected $login_personne = null;
    protected $pass_personne = null;
    protected $url_avatar_personne = null;
    protected $publie_personne = null;
    protected $id_langue = null; // Langue préférée
    protected $id_pays = null; // Pays de résidence

    public function __construct($paramsArray = null)
    {
        if(!is_null($paramsArray))
        {
            if(!is_array($paramsArray))
            {
                throw new IllegalArgumentTypeException("Class Personne: the argument given to the constructor must be an ARRAY.");
            }else
            {
                // argument facultatif
                if(isset($paramsArray['id_personne']))
                {
                    $this->setId($paramsArray['id_personne']);
                }
                
                if(isset($paramsArray['nom']))
                {
                    $this->setNom($paramsArray['nom']);
                }

                if(isset($paramsArray['prenom']))
                {
                    $this->setPrenom($paramsArray['prenom']);
                }

                if(isset($paramsArray['adresse']))
                {
                    $this->setAdresse($paramsArray['adresse']);
                }

                if(isset($paramsArray['CP']))
                {
                    $this->setCP($paramsArray['CP']);
                }

                if(isset($paramsArray['ville']))
                {
                    $this->setVille($paramsArray['ville']);
                }

                if(isset($paramsArray['url_avatar']) && !empty($paramsArray['url_avatar']))
                {
                    $this->setURLAvatar($paramsArray['url_avatar']);
                }


                // arguments obligatoires
                if(isset($paramsArray['date_naissance']))
                {
                    $this->setDateNaissance($paramsArray['date_naissance']);
                }else
                {
                    throw new MissingArgumentException("Class Personne: missing argument 'date_naissance' on constructor call.");
                }

                if(isset($paramsArray['email']))
                {
                    $this->setEmail($paramsArray['email']);
                }else
                {
                    throw new MissingArgumentException("Class Personne: missing argument 'email' on constructor call.");
                }

                if(isset($paramsArray['login']))
                {
                    $this->setLogin($paramsArray['login']);
                }else
                {
                    throw new MissingArgumentException("Class Personne: missing argument 'login' on constructor call.");
                }

                if(isset($paramsArray['pass']))
                {
                    $this->setPass($paramsArray['pass']);
                }else
                {
                    throw new MissingArgumentException("Class Personne: missing argument 'pass' on constructor call.");
                }

                if(isset($paramsArray['isPublie']))
                {
                    $this->setIsPublie($paramsArray['isPublie']);
                }else
                {
                    throw new MissingArgumentException("Class Personne: missing argument 'isPublie' on constructor call.");
                }

                if(isset($paramsArray['id_langue']))
                {
                    $this->setIdLangue($paramsArray['id_langue']);
                }else
                {
                    throw new MissingArgumentException("Class Personne: missing argument 'id_langue' on constructor call.");
                }

                if(isset($paramsArray['id_pays']))
                {
                    $this->setIdPays($paramsArray['id_pays']);
                }else
                {
                    throw new MissingArgumentException("Class Personne: missing argument 'id_pays' on constructor call.");
                }
            }
        }
    }

    public function getIdPersonne()
    {
        return $this->id_personne;
    }

    public function getNom()
    {
        return $this->nom_personne;
    }

    public function getPrenom()
    {
        return $this->prenom_personne;
    }

    public function getDateNaissance()
    {
        return $this->date_naissance_personne;
    }

    public function getAdresse()
    {
        return $this->adresse_personne;
    }

    public function getEmail()
    {
        return $this->email_personne;
    }

    public function getCP()
    {
        return $this->CP_personne;
    }

    public function getVille()
    {
        return $this->ville_personne;
    }

    public function getLogin()
    {
        return $this->login_personne;
    }

    public function getPass()
    {
        return $this->pass_personne;
    }

    public function getUrlAvatar()
    {
        return $this->url_avatar_personne;
    }

    public function isPublie()
    {
        return $this->publie_personne;
    }

    public function getIdLangue()
    {
        return $this->id_langue;
    }

    public function getIdPays()
    {
        return $this->id_pays;
    }



    public function setIdPersonne($id)
    {
        $clean = DataPurifier::purifyInt($id);

        if($clean !== false)
        {
            $this->id_personne = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class Personne: id_personne must be an INT.");
        }
    }

    public function setNom($nom)
    {
        $clean = DataPurifier::purifyString($nom);

        if($clean !== false)
        {
            $this->nom_personne = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class Personne: nom must be a VARCHAR(50).");
        }
    }

    public function setPrenom($prenom)
    {
        $clean = DataPurifier::purifyString($prenom);

        if($clean !== false)
        {
            $this->prenom_personne = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class Personne: prenom must be a VARCHAR(50).");
        }
    }

    public function setDateNaissance($theDate)
    {
        $clean = DataPurifier::purifyDate($theDate);

        if($clean !== false)
        {
            $this->date_naissance_personne = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class Personne: date must be a DATE.");
        }
    }

    public function setAdresse($adresse)
    {
        $clean = DataPurifier::purifyString($adresse);

        if($clean !== false)
        {
            $this->adresse_personne = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class Personne: adresse must be a STRING.");
        }
    }

    public function setEmail($email)
    {
        $clean = DataPurifier::purifyEmail($email);

        if($clean !== false)
        {
            $this->email_personne = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class Personne: email must be an EMAIL.");
        }
    }

    public function setCP($cp)
    {
        $clean = DataPurifier::purifyString($cp);

        if($clean !== false)
        {
            $this->CP_personne = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class Personne: CP must be a VARCHAR(20).");
        }
    }

    public function setVille($ville)
    {
        $clean = DataPurifier::purifyString($ville);

        if($clean !== false)
        {
            $this->ville_personne = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class Personne: ville must be a VARCHAR(50).");
        }
    }

    public function setLogin($login)
    {
        $clean = DataPurifier::purifyString($login);

        if($clean !== false)
        {
            $this->login_personne = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class Personne: login must be a VARCHAR(50).");
        }
    }

    public function setPass($pass)
    {
        $clean = DataPurifier::purifyString($pass);

        if($clean !== false)
        {
            $this->pass_personne = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class Personne: pass must be a STRING.");
        }
    }

    public function setURLAvatar($url)
    {
        $clean = DataPurifier::purifyURL($url);

        if($clean !== false)
        {
            $this->url_avatar_personne = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class Personne: url_avatar must be an URL.");
        }
    }

    public function setIsPublie($isPublie)
    {
        $clean = DataPurifier::purifyBoolean($isPublie);

        if($clean !== false)
        {
            $this->publie_personne = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class Personne: isPublie must be a BOOL.");
        }
    }

    public function setIdLangue($id)
    {
        $clean = DataPurifier::purifyInt($id);

        if($clean !== false)
        {
            $this->id_langue = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class Personne: id_langue must be an INT.");
        }
    }

    public function setIdPays($id)
    {
        $clean = DataPurifier::purifyInt($id);

        if($clean !== false)
        {
            $this->id_pays = $clean;
        }else
        {
            throw new IllegalArgumentTypeException("Class Personne: id_pays must be an INT.");
        }
    }
}
?>