<?php
//isDebugMode() est définie dans config.php

require_once(realpath(dirname(__FILE__)."/../../interfaces/")."/ICategorieAdapter.class.php");
require_once(realpath(dirname(__FILE__))."/MySQLDBConnecter.class.php");

class CategorieAdapter implements ICategorieAdapter
{
    public function __construct() { }

    public function getCategoriesList()
    {
        MySQLDBConnecter::connect();

        $sql = "SELECT * FROM Categories ";

        $query = MySQLDBConnecter::query($sql); //Envoie une requête au serveur MySQL
        unset($sql);

        $result = new ArrayObject();

        while($datas = mysql_fetch_assoc($query)) //Retourne une ligne de résultat MySQL sous la forme d'un tableau associatif, d'un tableau indexé, ou les deux
        {
            $row = array();
            $row['id'] = (int) $datas['id_categorie'];
            $row['nom'] = MySQLDBConnecter::unEscapeString($datas['nom_categorie']);
            $result->append(new Categorie($row));
            unset($row);
        }

        unset($query);
        unset($datas);
        
        MySQLDBConnecter::disconnect();

        return $result;
    }
    
    public function getCategorie($id)
    {
        MySQLDBConnecter::connect();
        $id_categorie = (int) $id;
        $result = null;
        $sql = "SELECT * FROM Categories WHERE id_categorie = ".$id_categorie ;
        unset($id_categorie);

        $query = MySQLDBConnecter::query($sql);
        unset($sql);
        
        if(mysql_num_rows($query)>0)
        {
            $datas = mysql_fetch_assoc($query);
            $row = array();
            $row['id'] = (int) $datas['id_categorie'];
            $row['nom'] = MySQLDBConnecter::unEscapeString($datas['nom_categorie']);
            $result = new categorie($row);
            unset($datas);
            unset($row);
        }

        unset($query);

        MySQLDBConnecter::disconnect();
        
        return $result;
    }
    
    public function removeCategorie(Categorie $cat)
    {
        if($cat == null)
            return false;
            
        MySQLDBConnecter::connect();
        $result = true;
        $id_categorie = (int) $cat->getId();
        $sql = "SELECT id_categorie FROM Categories WHERE id_categorie = ".$id_categorie;

        $query = MySQLDBConnecter::query($sql);
        unset($sql);

        if (mysql_num_rows($query) > 0)
        {
            $sql = "DELETE FROM Categories WHERE id_categorie = ".$id_categorie;
            unset($sql);
            $query = MySQLDBConnecter::query($sql);
        }else
        {
            $result = false;
        }
        unset($id_categorie);
        unset($query);

        MySQLDBConnecter::disconnect();

        return $result;
    }
    
    public function storeCategorie(Categorie $cat)
    {
        if($cat == null)
            return null;
        MySQLDBConnecterDB::connect();
        $id_categorie =  (int) $cat->getId();
        $result = $id_categorie;
        $isInsertMode = empty($id_categorie); //Détermine si une variable est vide
        $nom_categorie = MySQLDBConnecter::escapeString($cat->getNom());

        $sql = "";

        if($isInsertMode == true)  //pour savoir s'il ya un Id déjà dans l'objet qu'on veut mettre dans la base, si c'est true, ça veut dire qu'il n'y en a pas
        {
            $sql = "INSERT INTO Categories(`id_categorie`,
                                          `nom_categorie`)
                                VALUES(NULL,
                                        '".$nom_categorie."')";
        }
        else
        {
            $sql = "SELECT id_categorie FROM Categories WHERE id_categorie = " . $id_categorie;

            $query = MySQLDBConnecter::query($sql);
            if (mysql_num_rows($query) > 0) //Retourne le nombre de lignes d'un résultat MySQL
            {
                $sql = "UPDATE Categories SET `nom_categorie`	= '".$nom_categorie."'
                                     WHERE `id_categorie` = ".$id_categorie;
            }
        }

        unset($id_categorie);
        unset($nom_categorie);

        $query = MySQLDBConnecter::query($sql);

        $datas = "";
        if($isInsertMode)
        {
            $query = MySQLDBConnecter::query("SELECT LAST_INSERT_ID() as dernier_id FROM Categories");
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