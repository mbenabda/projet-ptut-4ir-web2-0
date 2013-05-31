<?php
//isDebugMode() est définie dans config.php

require_once(realpath(dirname(__FILE__)."/../../interfaces/")."/IPaysAdapter.class.php");
require_once(realpath(dirname(__FILE__))."/MySQLDBConnecter.class.php");

class PaysAdapter implements IPaysAdapter
{
    
    public function __construct() { }
    
    
    public function getPaysList()
    {
        MySQLDBConnecter::connect();
        $sql = "SELECT * FROM Pays ";
        $query = MySQLDBConnecter::query($sql); //Envoie une requête au serveur MySQL
        unset($sql);

        $result = new ArrayObject();

        while($datas = mysql_fetch_assoc($query)) //Retourne une ligne de résultat MySQL sous la forme d'un tableau associatif, d'un tableau indexé, ou les deux
        {
            $row = array();
            $row['id'] = (int) $datas['id_pays'];
            $row['nom'] = MySQLDBConnecter::unEscapeString($datas['nom_pays']);
            $result->append(new Pays($row));
            unset($row);
        }

        unset($query);
        unset($datas);

        MySQLDBConnecter::disconnect();

        return $result;
    }
        
    public function getPays($id)
    {
        MySQLDBConnecter::connect();
        $id_pays = (int) $id;
        $result = null;
        $sql = "SELECT * FROM Pays WHERE id_pays = ".$id_pays ;
        unset($id_pays);

        $query = MySQLDBConnecter::query($sql);
        unset($sql);
        
        if(mysql_num_rows($query)>0)
        {
            $datas = mysql_fetch_assoc($query);
            $row = array();
            $row['id'] = (int) $datas['id_pays'];
            $row['nom'] = MySQLDBConnecter::unEscapeString($datas['nom_pays']);
            $result = new Pays($row);
            unset($datas);
            unset($row);
        }

        unset($query);

        MySQLDBConnecter::disconnect();
        
        return $result;
    }
    
    public function removePays(Pays $pays)
    {
        if($pays == null)
            return false;

        MySQLDBConnecter::connect();

        $result = true;
        $id_pays = (int) $pays->getId();
        $sql = "SELECT id_pays FROM Pays WHERE id_pays = ".$id_pays;
        $query = MySQLDBConnecter::query($sql);

        if (mysql_num_rows($query) > 0)
        {
            $sql = "DELETE FROM Pays WHERE id_pays = ".$id_pays;
            $query = MySQLDBConnecter::query($sql);
        }else
        {
            $result = false;
        }

        unset($id_pays);
        unset($sql);
        unset($query);

        MySQLDBConnecter::disconnect();

        return $result;
    }
    
     public function storePays(Pays $pays)
     {
        if($pays == null)
        return null;
        
        MySQLDBConnecterDB::connect();
        $id_pays =  (int) $pays->getId();
        $result = $id_pays;
        $isInsertMode = empty($id_pays); //Détermine si une variable est vide
        $nom_pays = MySQLDBConnecter::escapeString($pays->getNom());

        $sql = "";

        if($isInsertMode == true)  //pour savoir s'il ya un Id déjà dans l'objet qu'on veut mettre dans la base, si c'est true, ça veut dire qu'il n'y en a pas
        {
            $sql = "INSERT INTO Pays(`id_pays`,
                                          `nom_pays`)
                                VALUES(NULL,
                                        ".$nom_pays.")";
        }
        else
        {
            $sql = "SELECT id_pays FROM Pays WHERE id_pays = " .$id_pays;

            $query = MySQLDBConnecter::query($sql);
            if (mysql_num_rows($query) > 0) //Retourne le nombre de lignes d'un résultat MySQL
            {
                $sql = "UPDATE Pays SET `nom_pays`	= '".$nom_pays."'
                                     WHERE `id_pays` = ".$id_pays;
            }
        }

        unset($id_pays);
        unset($nom_pays);

        $query = MySQLDBConnecter::query($sql);

        $datas = "";
        if($isInsertMode)
        {
            $query = MySQLDBConnecter::query("SELECT LAST_INSERT_ID() as dernier_id FROM Pays");
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
