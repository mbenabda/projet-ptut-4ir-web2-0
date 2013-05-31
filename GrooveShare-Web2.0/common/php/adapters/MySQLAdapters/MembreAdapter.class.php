<?php
//isDebugMode() est définie dans config.php

require_once(realpath(dirname(__FILE__)."/../../interfaces/")."/IMembreAdapter.class.php");
require_once(realpath(dirname(__FILE__)."/")."/PersonneAdapter.class.php");
require_once(realpath(dirname(__FILE__))."/MySQLDBConnecter.class.php");

class MembreAdapter implements IMembreAdapter
{
    public function __construct() { }

    public function getMembresList($startIndex = null, $nbRecs = null)
    {
        MySQLDBConnecter::connect();
        $limit = "";
        if($nbRecs != null)
        {
            $limit = " LIMIT ";
            if($startIndex != null)
            {
                $limit .= ((int) $startIndex).", ";
            }
            $limit .= ((int) $nbRecs)." ";
        }
        $sql = "SELECT * FROM Membres AS t
                              INNER JOIN Personnes AS t_personne
                              ON t.id_personne = t_personne.id_personne
                         ".$limit;
        unset($limit);  //pour vider la mémoire qui correspond à la variable $limit

        $query = MySQLDBConnecter::query($sql);
        unset($sql);

        $result = new ArrayObject();

        while($datas = mysql_fetch_assoc($query))
        {
            $row = array();
            $row['id'] = (int) $datas['id_membre'];
            $row['credit'] = (int) $datas['credit_membre'];
            $row['id_personne'] = (int) $datas['id_personne'];
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
            $result->append(new Membre($row));
            unset($row);
        }

        unset($query);
        unset($datas);

        MySQLDBConnecter::disconnect();

        return $result;
    }

    public function getMembre($id)
    {
        MySQLDBConnecter::connect();
        $id_membre = (int) $id;
        $result = null;
        $sql = "SELECT * FROM Membres AS t
                              INNER JOIN Personnes AS t_personne
                              ON t.id_personne = t_personne.id_personne
                         WHERE t.id_membre = ".$id_membre;
        unset($id_membre);

        $query = MySQLDBConnecter::query($sql);
        unset($sql);

        if(mysql_num_rows($query) > 0)
        {
            $datas = mysql_fetch_assoc($query);
            $row = array();
            $row['id'] = (int) $datas['id_membre'];
            $row['credit'] = (int) $datas['credit_membre'];
            $row['id_personne'] = (int) $datas['id_personne'];
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
            $result = new Membre($row);
            unset($row);
            unset($datas);
        }

        unset($query);

        MySQLDBConnecter::disconnect();

        return $result;
    }

    public function removeMembre(Membre $rec)
    {
        if($rec == null)
            return false;

        MySQLDBConnecter::connect();
        $result = true;

        $id_membre = (int) ($rec->getId());
        $id_personne = (int) ($rec->getIdPersonne());

        $sql = "DELETE FROM Membres WHERE id_membre = ".$id_membre." AND id_personne = ".$id_personne;
        $query = MySQLDBConnecter::query($sql);

        if ($query != null)
        {
            $pers_adapter = new PersonneAdapter();
            $result = $pers_adapter->removePersonne($rec->getIdPersonne());
        }else
        {
            $result = false;
        }

        unset($id_membre);
        unset($id_personne);
        unset($sql);
        unset($query);
        MySQLDBConnecter::disconnect();

        return $result;
    }

    public function storeMembre(Membre &$rec)
    {
        if($rec == null)
            return false;

        MySQLDBConnecter::connect();
        $result = true;
        $pers_adapter = new PersonneAdapter();

        $id_membre =  (int) $rec->getId();
        $credit_membre = (int) $rec->getCredit();
        $isInsertMode = (bool)( $this->getMembre($id_membre) == null);
        $nom_personne = MySQLDBConnecter::escapeString($rec->getNom());
        $prenom_personne = MySQLDBConnecter::escapeString($rec->getPrenom());
        $date_naissance_personne = MySQLDBConnecter::escapeString($rec->getDateNaissance());
        $adresse_personne = MySQLDBConnecter::escapeString($rec->getAdresse());
        $email_personne = MySQLDBConnecter::escapeString($rec->getEmail());
        $CP_personne = MySQLDBConnecter::escapeString($rec->getCP());
        $ville_personne = MySQLDBConnecter::escapeString($rec->getVille());
        $login_personne = MySQLDBConnecter::escapeString($rec->getLogin());
        $pass_personne = MySQLDBConnecter::escapeString($rec->getPass());
        $url_avatar_personne = "http://darmowegrafiki.5m.pl/avatary/gify_ikony/avatar-default-normal.gif";//MySQLDBConnecter::escapeString($rec->getUrlAvatar());
        $publie_personne = MySQLDBConnecter::escapeString($rec->isPublie());
        $id_langue = (int) $rec->getIdLangue();
        $id_pays = (int) $rec->getIdPays();

        $pers = new Personne(array(
                                'nom' => $nom_personne,
                                'prenom' => $prenom_personne,
                                'date_naissance' => $date_naissance_personne,
                                'adresse' => $adresse_personne,
                                'email' => $email_personne,
                                'CP' => $CP_personne,
                                'ville' => $ville_personne,
                                'login' => $login_personne,
                                'pass' => $pass_personne,
                                'url_avatar' => $url_avatar_personne,
                                'isPublie' => $publie_personne,
                                'id_langue' => $id_langue,
                                'id_pays' => $id_pays
                            ));
        $sql = "";

        if($isInsertMode)  //pour savoir s'il ya un Id déjà dans l'objet qu'on veut mettre dans la base, si c'est true, ça veut dire qu'il n'y en a pas
        {

            $result = ($pers_adapter->storePersonne($pers) != false);
            $id_personne = (int) $pers->getIdPersonne();
            if($result != false)
            {

                $sql = "INSERT INTO Membres(`id_membre`,
                                            `credit_membre`,
                                            `id_personne`)
                                    VALUES(NULL,
                                           ".$credit_membre.",
                                           ".$id_personne.")";
                $query = MySQLDBConnecter::query($sql);
                $result = (bool) ($query != null);
                if($result != false)
                {
                    $query = MySQLDBConnecter::query("SELECT LAST_INSERT_ID() as dernier_id FROM Membres");
                    $datas = mysql_fetch_assoc($query);
                    $rec->setId((int) $datas['dernier_id']);
                    $rec->setIdPersonne($id_personne);
                    unset($datas);
                }
                unset($sql);
                unset($query);
            }
        }else
        {
            $pers->setIdPersonne((int) $rec->getIdPersonne());
            $result = ($pers_adapter->storePersonne($pers) != false);
            $id_personne = (int) $pers->getIdPersonne();
            if($result != false)
            {
                $sql = "UPDATE Membres SET `id_personne` = ".$id_personne.",
                                            `credit_membre` = ".$credit_membre."
                                       WHERE `id_membre` = ".$id_membre;
                $query = MySQLDBConnecter::query($sql);
                $result = (bool) ($query != null);
                if($result != false)
                {
                    $rec->setIdPersonne($id_personne);
                }
                unset($sql);
                unset($query);
            }
        }

        unset($pers_adapter);
        unset($isInsertMode);
        unset($id_membre);
        unset($credit_membre);
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
        unset($pers);

        MySQLDBConnecter::disconnect();

        return $result;
    }
}
?>
