<?php

require_once(realpath(dirname(__FILE__)."/../../interfaces/")."/IMorceauAdapter.class.php");
require_once(realpath(dirname(__FILE__))."/MySQLDBConnecter.class.php");


class MorceauAdapter implements IMorceauAdapter
{
     public function __construct() { }


    public function getMorceauxList($startIndex = null, $nbRecs = null)
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

        $sql = "SELECT * FROM Morceaux AS l
                              INNER JOIN Styles_musicaux AS l_style_musique
                              ON l.id_style_musique = l_style_musique.id_style_musique
                              INNER JOIN Contenus AS l_contenu
                              ON l.id_contenu = l_contenu.id_contenu
                         ".$limit;
        unset($limit);

        $query = MySQLDBConnecter::query($sql); //Envoie une requête au serveur MySQL
        unset($sql);

        $result = new ArrayObject();

        while($datas = mysql_fetch_assoc($query)) //Retourne une ligne de résultat MySQL sous la forme d'un tableau associatif, d'un tableau indexé, ou les deux
        {
            $row = array();
            $row['id'] = (int) $datas['id_morceau'];
            $row['isdlmorceau'] = MySQLDBConnecter::unEscapeString($datas['dl_possible_morceau']);
            $row['id_contenu'] = (int) $datas['id_contenu'];
            $row['id_style_musique'] = (int) $datas['id_style_musique'];
            $result->append(new Morceau($row));
            unset($row);
        }

        unset($query);
        unset($datas);

        MySQLDBConnecter::disconnect();

        return $result;
    }

    public function getMorceauxListFromStyleMusique(StyleMusical $stm, $startIndex = null, $nbRecs = null)
    {
        $result = new ArrayObject();
        if($stm == null)
            return $result;

        $id_style_musique = (int) $stm->getId();

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

        $sql = "SELECT * FROM Morceaux AS l
                              INNER JOIN Styles_musicaux AS l_style_musique
                              ON l.id_style_musique = l_style_musique.id_style_musique
                              INNER JOIN Contenus AS l_contenu
                              ON l.id_contenu = l_contenu.id_contenu
                         WHERE l.id_style_musique = ".$id_style_musique."
                         ".$limit;
        unset($limit);

        $query = MySQLDBConnecter::query($sql); //Envoie une requête au serveur MySQL
        unset($sql);

        while($datas = mysql_fetch_assoc($query)) //Retourne une ligne de résultat MySQL sous la forme d'un tableau associatif, d'un tableau indexé, ou les deux
        {
            $row = array();
            $row['id'] = (int) $datas['id_morceau'];
            $row['isdlmorceau'] = MySQLDBConnecter::unEscapeString($datas['dl_possible_morceau']);
            $row['id_contenu'] = (int) $datas['id_contenu'];
            $row['id_style_musique'] = (int) $datas['id_style_musique'];
            $result->append(new Morceau($row));
            unset($row);
        }

        unset($query);
        unset($datas);

        MySQLDBConnecter::disconnect();

        return $result;
    }

    public function getMorceau($id)
    {
        MySQLDBConnecter::connect();

        $id_morceau = (int) $id;
        $result = null;

        $sql = "SELECT * FROM Morceaux AS l
                              INNER JOIN Styles_musicaux AS l_style_musique
                              ON l.id_style_musique = l_style_musique.id_style_musique
                              INNER JOIN Contenus AS l_contenu
                              ON l.id_contenu = l_contenu.id_contenu
                         WHERE l.id_morceau = ".$id_morceau;

        unset($id_morceau);

        $query = MySQLDBConnecter::query($sql);
        unset($sql);

        if(mysql_num_rows($query)>0)
        {
            $datas = mysql_fetch_assoc($query);
            $row = array();
            $row['id'] = (int) $datas['id_morceau'];
            $row['isdlmorceau'] = MySQLDBConnecter::unEscapeString($datas['dl_possible_morceau']);
            $row['id_contenu'] = (int) $datas['id_contenu'];
            $row['id_style_musique'] = (int) $datas['id_style_musique'];
            $result = new Morceau($row);
            unset($datas);
            unset($row);
        }

        unset($query);

        MySQLDBConnecter::disconnect();

        return $result;

    }

    public function removeMorceau(Morceau $morc)
    {
        if($morc == null)
            return false;

        MySQLDBConnecter::connect();

        $result = true;

        $id_morceau = (int) ($morc->getId());
        //$id_contenu = (int) ($morc->getIdContenu());
        //$id_style_musique = (int) ($morc->getIdStyleMusique());
        $sql = "DELETE FROM Morceaux WHERE id_morceau= ".$id_morceau;
        $query = MySQLDBConnecter::query($sql);

        if ($query != null)
        {
            $cont_adapter = new ContenuAdapter();
            $result = $cont_adapter->removeContenu($morc->getIdContenu());
            
        }else
        {
            $result = false;
        }

       // unset($id_contenu);
        //unset($id_style_musique);
        unset($id_morceau);
        unset($sql);
        unset($query);
        MySQLDBConnecter::disconnect();

        return $result;
    }

    public function storeMorceau(Morceau &$morc)
    {
        if($morc == null)
            return false;

        MySQLDBConnecterDB::connect();

        $result = true;

        $id_morceau = (int) $morc->getId();
        $isInsertMode = (bool)( $this->getMorceau($id_morceau) == null);
        
        $id_contenu = $morc->getIdContenu();
        $id_style_musique = $morc->getIdStyleMusique();

        if($isInsertMode == true)
        {
           $sql = "INSERT INTO Morceau(`id_morceau`,
                                        `dl_possible_morceau`,
                                        `id_contenu`,
                                        `id_style_musique`)
                                          
                                VALUES(NULL,
                                       TRUE,     
                                       ".$id_contenu.",
                                       ".$id_style_musique.")";
         
            $query = MySQLDBConnecter::query($sql);
            $result = (bool) ($query != null);
        }
        else
        {
            $morceau_check = $this->getMorceau($id_morceau);

            if($morceau_check != null)
            {
                $sql = "UPDATE Morceaux SET `dl_possible_morceau = TRUE,
                                             `id_contenu` = '".$id_contenu."',
                                             `id_style_musique` = '".$id_style_musique."',
                                       WHERE `id_morceau` = ".$id_morceau;
                $query = MySQLDBConnecter::query($sql);
                $result = (bool) ($query != null);
            }else
            {
                $result = false;
            }
        }

        unset($id_morceau);

        
        unset($id_contenu);
        unset($id_style_musique);


        $datas = "";
        if($isInsertMode && $result != false)
        {
            $query = MySQLDBConnecter::query("SELECT LAST_INSERT_ID() as dernier_id FROM Morceaux");
            if($query != null)
            {
                $datas = mysql_fetch_assoc($query);
                $morc->setId((int) $datas['dernier_id']);
            }
        }

        unset($datas);
        unset($query);
        unset($sql);

        MySQLDBConnecter::disconnect();

        return $result;
    }
}

?>
