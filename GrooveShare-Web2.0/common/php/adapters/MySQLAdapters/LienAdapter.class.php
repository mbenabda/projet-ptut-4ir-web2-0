<?php

require_once(realpath(dirname(__FILE__)."/../../interfaces/")."/ILienAdapter.class.php");
require_once(realpath(dirname(__FILE__))."/MySQLDBConnecter.class.php");


class LienAdapter implements ILienAdapter
{
     public function __construct() { }


    public function getLiensList($startIndex = null, $nbRecs = null)
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

        $sql = "SELECT * FROM Liens AS l
                              INNER JOIN Artistes AS l_artiste
                              ON l.id_artiste = l_artiste.id_artiste
                         ".$limit;
        unset($limit);

        $query = MySQLDBConnecter::query($sql); //Envoie une requête au serveur MySQL
        unset($sql);

        $result = new ArrayObject();

        while($datas = mysql_fetch_assoc($query)) //Retourne une ligne de résultat MySQL sous la forme d'un tableau associatif, d'un tableau indexé, ou les deux
        {
            $row = array();
            $row['id'] = (int) $datas['id_lien'];
            $row['url'] = MySQLDBConnecter::unEscapeString($datas['url_lien']);
            $row['id_artiste'] = (int) $datas['id_artiste'];
            $result->append(new Lien($row));
            unset($row);
        }

        unset($query);
        unset($datas);

        MySQLDBConnecter::disconnect();

        return $result;
    }

    public function getLiensListForArtiste(Artiste $art, $startIndex = null, $nbRecs = null)
    {
        $result = new ArrayObject();
        if($art == null)
            return $result;

        $id_artiste = (int) $art->getId();

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

        $sql = "SELECT * FROM Liens AS l
                              INNER JOIN Artistes AS l_artiste
                              ON l.id_artiste = l_artiste.id_artiste
                         WHERE l.id_artiste = ".$id_artiste."
                         ".$limit;
        unset($limit);

        $query = MySQLDBConnecter::query($sql); //Envoie une requête au serveur MySQL
        unset($sql);

        while($datas = mysql_fetch_assoc($query)) //Retourne une ligne de résultat MySQL sous la forme d'un tableau associatif, d'un tableau indexé, ou les deux
        {
            $row = array();
            $row['id'] = (int) $datas['id_lien'];
            $row['url'] = MySQLDBConnecter::unEscapeString($datas['url_lien']);
            $row['id_artiste'] = (int) $datas['id_artiste'];
            $result->append(new Lien($row));
            unset($row);
        }

        unset($query);
        unset($datas);

        MySQLDBConnecter::disconnect();

        return $result;
    }

    public function getLien($id)
    {
        MySQLDBConnecter::connect();

        $id_lien = (int) $id;
        $result = null;

        $sql = "SELECT * FROM Liens AS t
                              INNER JOIN Artistes AS t_artiste
                              ON t.id_artiste = t_artiste.id_artiste
                         WHERE t.id_lien = ".$id_lien;

        unset($id_lien);

        $query = MySQLDBConnecter::query($sql);
        unset($sql);

        if(mysql_num_rows($query)>0)
        {
            $datas = mysql_fetch_assoc($query);
            $row = array();
            $row['id'] = (int) $datas['id_lien'];
            $row['url'] = MySQLDBConnecter::unEscapeString($datas['url_lien']);
            $row['id_artiste'] = (int) $datas['id_artiste'];
            $result = new Lien($row);
            unset($datas);
            unset($row);
        }

        unset($query);

        MySQLDBConnecter::disconnect();

        return $result;

    }

    public function removeLien(Lien $lien) 
    {
        if($lien == null)
            return false;

        MySQLDBConnecter::connect();

        $result = true;
        $id_lien = (int) ($lien->getId());
        $id_artiste = (int) ($lien->getIdArtiste());
        $sql = "DELETE FROM Liens WHERE id_lien = ".$id_lien." AND id_artiste = ".$id_artiste;
        $query = MySQLDBConnecter::query($sql);

        if ($query != null)
        {
            $art_adapter = new ArtisteAdapter();
            $result = $art_adapter->removeArtiste($lien->getIdArtiste());
        }else
        {
            $result = false;
        }

        unset($id_lien);
        unset($id_artiste);
        unset($sql);
        unset($query);
        MySQLDBConnecter::disconnect();

        return $result;
    }

    public function storeLien(Lien &$lien)
    {
        if($lien == null)
            return false;

        MySQLDBConnecterDB::connect();

        $result = true;
        //$art_adapter = new ArtisteAdapter();

        $id_lien = (int) $lien->getId();
        $isInsertMode = (bool)( $this->getLien($id_lien) == null);
        
        $url_lien = $lien->getURL();
        $id_artiste = $lien->getIdArtiste();

        if($isInsertMode == true)
        {
           $sql = "INSERT INTO Liens(`id_lien`,
                                          `url_lien`,
                                          `id_artiste`)
                                          
                                VALUES(NULL,
                                        '".$url_lien."',
                                        ".$id_artiste.")";
         
            $query = MySQLDBConnecter::query($sql);
            $result = (bool) ($query != null);
        }
        else
        {
            $lien_check = $this->getLien($id_lien);

            if($lien_check != null)
            {
                $sql = "UPDATE Liens SET `url_lien = '".$url_lien."',
                                             `id_artiste` = ".$id_artiste.",
                                       WHERE `id_lien` = ".$id_lien;
                $query = MySQLDBConnecter::query($sql);
                $result = (bool) ($query != null);
            }else
            {
                $result = false;
            }
        }

        unset($id_lien);

        
        unset($url_lien);
        unset($id_artiste);


        $datas = "";
        if($isInsertMode && $result != false)
        {
            $query = MySQLDBConnecter::query("SELECT LAST_INSERT_ID() as dernier_id FROM Liens");
            if($query != null)
            {
                $datas = mysql_fetch_assoc($query);
                $lien->setId((int) $datas['dernier_id']);
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
