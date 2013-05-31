<?php
//isDebugMode() est définie dans config.php

require_once(realpath(dirname(__FILE__)."/../../interfaces/")."/ILangueAdapter.class.php");
require_once(realpath(dirname(__FILE__))."/MySQLDBConnecter.class.php");

class LangueAdapter implements ILangueAdapter
{
     public function __construct() { }
     
     public function getLanguesList()
     {
        MySQLDBConnecter::connect();
        $sql = "SELECT * FROM Langues ";
        $query = MySQLDBConnecter::query($sql); //Envoie une requête au serveur MySQL
        unset($sql);

        $result = new ArrayObject();

        while($datas = mysql_fetch_assoc($query)) //Retourne une ligne de résultat MySQL sous la forme d'un tableau associatif, d'un tableau indexé, ou les deux
        {
            $row = array();
            $row['id'] = (int) $datas['id_langue'];
            $row['nom'] = MySQLDBConnecter::unEscapeString($datas['nom_langue']);
            $row['code'] = MySQLDBConnecter::unEscapeString($datas['code_langue']);
            $row['url_drapeau'] = MySQLDBConnecter::unEscapeString($datas['url_drapeau_langue']);
            $result->append(new Langue($row));
            unset($row);
        }

        unset($query);
        unset($datas);

        MySQLDBConnecter::disconnect();

        return $result;
     }
     
     
     public function getLangue($id)
     {
        MySQLDBConnecter::connect();
        $id_langue = (int) $id;
        $result = null;
        $sql = "SELECT * FROM Langues WHERE id_langue = ".$id_langue ;
        unset($id_langue);

        $query = MySQLDBConnecter::query($sql);
        unset($sql);
        
        if(mysql_num_rows($query)>0)
        {
            $datas = mysql_fetch_assoc($query);
            $row = array();
            $row['id'] = (int) $datas['id_langue'];
            $row['nom'] = MySQLDBConnecter::unEscapeString($datas['nom_langue']);
            $row['code'] = MySQLDBConnecter::unEscapeString($datas['code_langue']);
            $row['url_drapeau'] = MySQLDBConnecter::unEscapeString($datas['url_drapeau_langue']);
            $result = new Langue($row);
            unset($datas);
            unset($row);
        }

        unset($query);

        MySQLDBConnecter::disconnect();
        
        return $result;
    }
    
    
    public function removeLangue(Langue $lang)
    {
        if($lang == null)
            return false;

        MySQLDBConnecter::connect();

        $result = true;
        $id_langue = (int) $lang->getId();
        $sql = "SELECT id_langue FROM Langues WHERE id_langue = ".$id_langue;
        $query = MySQLDBConnecter::query($sql);

        if (mysql_num_rows($query) > 0)
        {
            $sql = "DELETE FROM Langues WHERE id_langue = ".$id_langue;
            $query = MySQLDBConnecter::query($sql);
        }else
        {
            $result = false;
        }

        unset($id_langue);
        unset($sql);
        unset($query);

        MySQLDBConnecter::disconnect();

        return $result;
    }
    
    
    public function storeLangue(Langue $lang)
    {
        if($lang == null)
        return null;
        
        MySQLDBConnecterDB::connect();
        $id_langue =  (int) $lang->getId();
        $result = $id_langue;
        $isInsertMode = empty($id_langue); //Détermine si une variable est vide
        $nom_langue = MySQLDBConnecter::escapeString($lang->getNom());
        $code_langue = MySQLDBConnecter::escapeString($lang->getCode());
        $url_drapeau_langue = MySQLDBConnecter::escapeString($lang->getURLDrapeau());

        $sql = "";

        if($isInsertMode == true)  //pour savoir s'il ya un Id déjà dans l'objet qu'on veut mettre dans la base, si c'est true, ça veut dire qu'il n'y en a pas
        {
            $sql = "INSERT INTO Langues(`id_langue`,
                                        `nom_langue`,
                                        `code_langue`,
                                        `url_drapeau_langue`)
                                VALUES(NULL,
                                        '".$nom_langue."',
                                        '".$code_langue."',
                                        '".$url_drapeau_langue."')";
        }
        else
        {
            $sql = "SELECT id_langue FROM Langues WHERE id_langue = " .$id_langue;

            $query = MySQLDBConnecter::query($sql);
            if (mysql_num_rows($query) > 0) //Retourne le nombre de lignes d'un résultat MySQL
            {
                $sql = "UPDATE Langues SET `nom_langue`	= '".$nom_langue."',                   
                                            `code_langue` = '".$code_langue."',
                                            `url_drapeau_langue` = '".$url_drapeau_langue."'
                                     WHERE `id_langue` = ".$id_langue;
            }
        }

        unset($id_langue);
        unset($nom_langue);

        $query = MySQLDBConnecter::query($sql);

        $datas = "";
        if($isInsertMode)
        {
            $query = MySQLDBConnecter::query("SELECT LAST_INSERT_ID() as dernier_id FROM Langues");
            $datas = mysql_fetch_assoc($query);
            $result = (int) $datas['dernier_id'];
        }

        unset($datas);
        unset($query);
        unset($sql);

        MySQLDBConnecter::disconnect();

        return $result;
    }
    

}
?>
