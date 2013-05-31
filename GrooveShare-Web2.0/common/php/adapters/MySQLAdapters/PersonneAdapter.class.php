<?php
//isDebugMode() est définie dans config.php

require_once(realpath(dirname(__FILE__)."/../../interfaces/")."/IPersonneAdapter.class.php");
require_once(realpath(dirname(__FILE__))."/MySQLDBConnecter.class.php");

class PersonneAdapter implements IPersonneAdapter
{
    
    public function __construct() { }
    
    public function getPersonne($id)
    {
        MySQLDBConnecter::connect();
        $id_personne = (int) $id;
        $result = null;
        $sql = "SELECT * FROM Personnes WHERE id_personne = ".$id_personne ;
        unset($id_personne);

        $query = MySQLDBConnecter::query($sql);
        unset($sql);
        
        if(mysql_num_rows($query)>0)
        {
            $datas = mysql_fetch_assoc($query);
            $row = array();
            $row['id'] = (int) $datas['id_personne'];
            $row['nom'] = MySQLDBConnecter::unEscapeString($datas['nom_personne']);
            $row['prenom'] = MySQLDBConnecter::unEscapeString($datas['prenom_personne']);
            $row['date_naissance'] = MySQLDBConnecter::unEscapeString($datas['date_naissance_personne']);
            $row['adresse'] = MySQLDBConnecter::unEscapeString($datas['adresse_personne']);
            $row['email'] = MySQLDBConnecter::unEscapeString($datas['email_personne']);
            $row['CP'] = MySQLDBConnecter::unEscapeString($datas['CP_personne']);
            $row['ville'] = MySQLDBConnecter::unEscapeString($datas['ville_personne']);
            $row['login'] = MySQLDBConnecter::unEscapeString($datas['login_personne']);
            $row['pass'] = MySQLDBConnecter::unEscapeString($datas['pass_personne']);
            $row['url_avatar'] = MySQLDBConnecter::unEscapeString($datas['url_avatar_personne']);
            $row['isPublie'] = MySQLDBConnecter::unEscapeString($datas['publie_personne']);
            $row['id_langue'] = (int) $datas['id_langue'];
            $row['id_pays'] = (int) $datas['id_pays'];
            $result = new Personne($row);
            unset($datas);
            unset($row);
        }
        
        unset($query);

        MySQLDBConnecter::disconnect();      

        return $result;
    }
    
    public function removePersonne(Personne $pers)
    {
        if($pers == null)
            return false;
            
        MySQLDBConnecter::connect();
        $result = true;
        $id_personne = (int)$pers->getIdPersonne();
        $pers_check = $this->getPersonne($id_personne);

        if($pers_check != null)
        {
            $sql = "DELETE FROM Personnes WHERE id_personne = ".$id_personne;
            $query = MySQLDBConnecter::query($sql);
            $result = ($query != null);

            unset($sql);
            unset($query);
        }else
        {
            $result = false;
        }

        unset($pers_check);
        unset($id_personne);

        MySQLDBConnecter::disconnect();

        return $result;
    }

    public function storePersonne(Personne &$pers)
    {
        if($pers == null)
            return false;
            
        MySQLDBConnecter::connect();

        $result = true;
        $id_personne =  (int) $pers->getIdPersonne();
        $isInsertMode = (bool) empty($id_personne);
        $nom_personne = MySQLDBConnecter::escapeString($pers->getNom());
        $prenom_personne = MySQLDBConnecter::escapeString($pers->getPrenom());
        $date_naissance_personne = MySQLDBConnecter::escapeString($pers->getDateNaissance());
        $adresse_personne = MySQLDBConnecter::escapeString($pers->getAdresse());
        $email_personne = MySQLDBConnecter::escapeString($pers->getEmail());
        $CP_personne = MySQLDBConnecter::escapeString($pers->getCP());
        $ville_personne = MySQLDBConnecter::escapeString($pers->getVille());
        $login_personne = MySQLDBConnecter::escapeString($pers->getLogin());
        $pass_personne = MySQLDBConnecter::escapeString($pers->getPass());
        $url_avatar_personne = "http://darmowegrafiki.5m.pl/avatary/gify_ikony/avatar-default-normal.gif";//MySQLDBConnecter::escapeString($pers->getUrlAvatar());
        $publie_personne = MySQLDBConnecter::escapeString($pers->isPublie());
        $id_langue = (int) $pers->getIdLangue();
        $id_pays = (int) $pers->getIdPays();

        $sql = "";

        if($isInsertMode == true)  //pour savoir s'il ya un Id déjà dans l'objet qu'on veut mettre dans la base, si c'est true, ça veut dire qu'il n'y en a pas
        {
            $sql = "INSERT INTO Personnes(`id_personne`,
                                          `nom_personne`,
                                          `prenom_personne`,
                                          `date_naissance_personne`,
                                          `adresse_personne`,
                                          `email_personne`,
                                          `CP_personne`,
                                          `ville_personne`,
                                          `login_personne`,
                                          `pass_personne`,
                                          `url_avatar_personne`,
                                          `publie_personne`,
                                          `id_langue`,
                                          `id_pays`)
                                VALUES(NULL,
                                        '".$nom_personne."',
                                        '".$prenom_personne."',
                                        '".$date_naissance_personne."',
                                        '".$adresse_personne."',
                                        '".$email_personne."',
                                        '".$CP_personne."',
                                        '".$ville_personne."',
                                        '".$login_personne."',
                                        '".$pass_personne."',
                                        '".$url_avatar_personne."',
                                        '".$publie_personne."',
                                        ".$id_langue.",
                                        ".$id_pays.")";
            $query = MySQLDBConnecter::query($sql);
            $result = (bool) ($query != null);
        }
        else
        {
            $pers_check = $this->getPersonne($id_personne);

            if($pers_check != null)
            {
                $sql = "UPDATE Personnes SET `nom_personne`	= '".$nom_personne."',
                                             `prenom_personne`  = '".$prenom_personne."',
                                             `date_naissance_personne` = '".$date_naissance_personne."',
                                             `adresse_personne` = '".$adresse_personne."',
                                             `email_personne`   = '".$email_personne."',
                                             `CP_personne`      = '".$CP_personne."',
                                             `ville_personne`   = '".$ville_personne."',
                                             `login_personne`   = '".$login_personne."',
                                             `pass_personne`    = '".$pass_personne."',
                                             `url_avatar_personne` = '".$url_avatar_personne."',
                                             `publie_personne`  = '".$publie_personne."',
                                             `id_langue` = ".$id_langue.",
                                             `id_pays`   = ".$id_pays."
                                     WHERE `id_personne` = ".$id_personne;

                $query = MySQLDBConnecter::query($sql);
                $result = (bool) ($query != null);
            }else
            {
                $result = false;
            }
        }

        unset($id_personne);
        unset($nom_personne);
        unset($prenom_personne);
        unset($date_naissance_personne);
        unset($adresse_personne);
        unset($email_personne);
        unset($CP_personne);
        unset($ville_personne);
        unset($login_personne);
        unset($pass_personne);
        unset($url_avatar_personne);
        unset($publie_personne);
        unset($id_langue);
        unset($id_pays);

        $datas = "";
        if($isInsertMode && $result != false)
        {
            $query = MySQLDBConnecter::query("SELECT LAST_INSERT_ID() as dernier_id FROM Personnes");
            if($query != null)
            {
                $datas = mysql_fetch_assoc($query);
                
                $pers->setIdPersonne((int) $datas['dernier_id']);
            }
        }

        unset($datas);
        unset($query);
        unset($sql);

        MySQLDBConnecter::disconnect();

        return $result;
    }

    public function isRegisteredEmail($email)
    {
        $email_personne = trim($email);
        
        if(empty($email_personne))
        { return true; }

        $email_personne = MySQLDBConnecter::escapeString($email);

        $sql = "SELECT id_personne FROM Personnes
                                   WHERE LOWER(email_personne) LIKE LOWER(\"%".$email_personne."%\")";
        $query = MySQLDBConnecter::query($sql);
        
        if($query == null)
        { return true; }
        
        $nbRecs = ((int) mysql_num_rows($query));

        unset($email_personne);
        unset($sql);
        unset($query);

        MySQLDBConnecter::disconnect();
        
        return ((bool)($nbRecs > 0));
    }

    public function isRegisteredLogin($login)
    {
        $login_personne = trim($login);

        if(empty($login_personne))
        { return true; }

        $login_personne = MySQLDBConnecter::escapeString($login);

        $sql = "SELECT id_personne FROM Personnes
                                   WHERE LOWER(login_personne) LIKE LOWER(\"%".$login_personne."%\")";
        $query = MySQLDBConnecter::query($sql);

        if($query == null)
        { return true; }

        $nbRecs = ((int) mysql_num_rows($query));

        unset($login_personne);
        unset($sql);
        unset($query);

        MySQLDBConnecter::disconnect();

        return ((bool)($nbRecs > 0));
    }
}
?>