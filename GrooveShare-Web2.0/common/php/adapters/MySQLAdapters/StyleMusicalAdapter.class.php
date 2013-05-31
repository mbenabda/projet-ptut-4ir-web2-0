<?php

require_once(realpath(dirname(__FILE__)."/../../interfaces/")."/IStyleMusical.class.php");
require_once(realpath(dirname(__FILE__))."/MySQLDBConnecter.class.php");

class StyleMusicalAdapter implements IStyleMusicalAdapter
{
    public function __construct() { }
     
     public function getStyleMusicalList()
     {
        MySQLDBConnecter::connect();
        $sql = "SELECT * FROM Styles_musicaux ";
        $query = MySQLDBConnecter::query($sql); //Envoie une requête au serveur MySQL
        unset($sql);

        $result = new ArrayObject();

        while($datas = mysql_fetch_assoc($query)) //Retourne une ligne de résultat MySQL sous la forme d'un tableau associatif, d'un tableau indexé, ou les deux
        {
            $row = array();
            $row['id'] = (int) $datas['id_style_musique'];
            $row['nom'] = MySQLDBConnecter::unEscapeString($datas['nom_style_musique']);           
            $result->append(new StyleMusical($row));
            unset($row);
        }

        unset($query);
        unset($datas);

        MySQLDBConnecter::disconnect();

        return $result;
     }
     
     
     public function getStyleMusical($id)
     {
        MySQLDBConnecter::connect();
        $id_style_musique = (int) $id;
        $result = null;
        $sql = "SELECT * FROM Styles_musicaux WHERE id_style_musique = ".$id_style_musique;
        unset($id_style_musique);

        $query = MySQLDBConnecter::query($sql);
        unset($sql);
        
        if(mysql_num_rows($query)>0)
        {
            $datas = mysql_fetch_assoc($query);
            $row = array();
            $row['id'] = (int) $datas['id_style_musique'];
            $row['nom'] = MySQLDBConnecter::unEscapeString($datas['nom_style_musique']); 
            $result = new StyleMusical($row);
            unset($datas);
            unset($row);
        }

        unset($query);

        MySQLDBConnecter::disconnect();
        
        return $result;
    }
    
    
    public function removeStyleMusical(StyleMusical $stm)
    {
        if($stm == null)
            return false;

        MySQLDBConnecter::connect();

        $result = true;
        $id_style_musique = (int) $stm->getId();
        $sql = "SELECT id_style_musique FROM Styles_musicaux WHERE id_style_musique = ".$id_style_musique;
        $query = MySQLDBConnecter::query($sql);

        if (mysql_num_rows($query) > 0)
        {
            $sql = "DELETE FROM Styles_musicaux WHERE id_style_musique = ".$id_style_musique;
            $query = MySQLDBConnecter::query($sql);
        }else
        {
            $result = false;
        }

        unset($id_style_musique);
        unset($sql);
        unset($query);

        MySQLDBConnecter::disconnect();

        return $result;
    }
    
    
    public function storeStyleMusical(StyleMusical &$stm)
    {
        if($stm == null)
        return null;
        
        MySQLDBConnecterDB::connect();
        $id_style_musique=  (int) $stm->getId();
        $result = $id_style_musique;
        $isInsertMode = empty($id_style_musique); //Détermine si une variable est vide
        $nom_style_musique = MySQLDBConnecter::escapeString($stm->getNom());
        
        $sql = "";

        if($isInsertMode == true)  //pour savoir s'il ya un Id déjà dans l'objet qu'on veut mettre dans la base, si c'est true, ça veut dire qu'il n'y en a pas
        {
            $sql = "INSERT INTO Styles_musicaux(`id_style_musique`,
                                                 `nom_style_musique`)
                                         VALUES(NULL,
                                                '".$nom_style_musique."')";
        }
        else
        {
            $sql = "SELECT id_style_musique FROM Styles_musicaux WHERE id_style_musique = " .$id_style_musique;

            $query = MySQLDBConnecter::query($sql);
            if (mysql_num_rows($query) > 0) //Retourne le nombre de lignes d'un résultat MySQL
            {
                $sql = "UPDATE Styles_musicaux SET `nom_style_musique`	= '".$nom_style_musique."'                  
                                                      WHERE `id_style_musique` = ".$id_style_musique;
            }
        }

        unset($id_style_musique);
        unset($nom_style_musique);

        $query = MySQLDBConnecter::query($sql);

        $datas = "";
        if($isInsertMode)
        {
            $query = MySQLDBConnecter::query("SELECT LAST_INSERT_ID() as dernier_id FROM Styles_musicaux");
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
