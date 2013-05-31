<?php

//TODO a verifier
require_once(realpath(dirname(__FILE__)."/../../interfaces/")."/ICommentaireArtisteAdapter.class.php");
require_once(realpath(dirname(__FILE__))."/MySQLDBConnecter.class.php");

class CommentaireArtisteAdapter implements ICommentaireArtisteAdapter 
{
    
    public function __construct() { }

    public function getCommentairesListForArtiste($art,$startIndex, $nbRecs)
    {
        $result = new ArrayObject();
        if($art == null)
            return $result;

        $id_artiste = $art;

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
        $sql = "SELECT * FROM commentaire_artiste 
                         WHERE id_artiste = ".$id_artiste."  ORDER by id_commentaire_artiste DESC
                         ".$limit;
        unset($limit);

        $query = MySQLDBConnecter::query($sql); //Envoie une requête au serveur MySQL
        unset($sql);

        while($datas = mysql_fetch_assoc($query)) //Retourne une ligne de résultat MySQL sous la forme d'un tableau associatif, d'un tableau indexé, ou les deux
        {
            $row = array();
            $row['id'] = (int) $datas['id_commentaire_artiste'];
            $row['id_personne'] = (int) $datas['id_personne'];
            $row['id_artiste'] = (int) $datas['id_artiste'];
            
            $row['date_commentaire'] = MySQLDBConnecter::unEscapeString($datas['date_commentaire_artiste']);
            $row['texte_commentaire'] = MySQLDBConnecter::unEscapeString($datas['texte_commentaire_artiste']);
            $result->append(new CommentaireArtiste($row));
            unset($row);
        }

        unset($query);
        unset($datas);

        MySQLDBConnecter::disconnect();

        return $result;
    }
    
    public function getCommentaireArtiste($id)
    {
        MySQLDBConnecter::connect();

        $id_comm_artiste = (int) $id;
        $result = null;

        $sql = "SELECT * FROM commentaire_artiste AS l
                              INNER JOIN Personnes AS l_personne
                              ON l.id_personne = l_personne.id_personne
                              INNER JOIN Artistes AS l_artiste
                              ON l.id_artiste = l_artiste.id_artiste
                         WHERE l.id_commentaire_artiste = ".$id_comm_artiste;

        unset($id_comm_artiste);

        $query = MySQLDBConnecter::query($sql);
        unset($sql);

        if(mysql_num_rows($query)>0)
        {
            $datas = mysql_fetch_assoc($query);
            $row = array();
            $row['id'] = (int) $datas['id_commentaire_artiste'];
            $row['id_personne'] = (int) $datas['id_personne'];
            $row['id_artiste'] = (int) $datas['id_artiste'];
            $row['date'] = MySQLDBConnecter::unEscapeString($datas['date_commentaire_artiste']);
            $row['texte'] = MySQLDBConnecter::unEscapeString($datas['texte_commentaire_artiste']);
            $result = new CommentaireArtiste($row);
            unset($datas);
            unset($row);
        }

        unset($query);

        MySQLDBConnecter::disconnect();

        return $result;

    }
    
       public function removeCommentaireArtiste(CommentaireArtiste $comm_art)
    {
        if($comm_art == null)
            return false;
            
        MySQLDBConnecter::connect();
        $result = true;
        $id_comm_art= (int)$comm_art->getId();
        $comm_art_check = $this->getCommentaireArtiste($id_comm_art);

        if($comm_art_check!= null)
        {
            $sql = "DELETE FROM commentaire_artiste WHERE id_commentaire_artiste = ".$id_comm_art;
            $query = MySQLDBConnecter::query($sql);
            $result = ($query != null);

            unset($sql);
            unset($query);
        }else
        {
            $result = false;
        }

        unset($comm_art_check);
        unset($id_comm_art);
        
        MySQLDBConnecter::disconnect();

        return $result;
    }

    public function storeCommentaireArtiste(CommentaireArtiste &$comm_art)
    {
        if($comm_art == null)
            return false;
            
        MySQLDBConnecter::connect();

        $result = true;
        $id_comm_art = (int)$comm_art->getId();
        $isInsertMode = (bool) empty($id_comm_art);

        $date_commentaire = MySQLDBConnecter::escapeString($comm_art->getDateCommentaire());
        $texte_commentaire = MySQLDBConnecter::escapeString($comm_art->getTexteCommentaire());
        $id_personne = (int) $comm_art->getIdPersonne();
        $id_artiste = (int) $comm_art->getIdArtiste();

        $sql = "";

        if($isInsertMode == true)  //pour savoir s'il ya un Id déjà dans l'objet qu'on veut mettre dans la base, si c'est true, ça veut dire qu'il n'y en a pas
        {
        $sql = "INSERT INTO commentaire_artiste (`id_commentaire_artiste`,
                                                 `id_personne`,
                                                 `id_artiste`,
                                                 `date_commentaire_artiste`,
                                                 `texte_commentaire_artiste`)
                                        VALUES(NULL,
                                        ".$id_personne.",
                                        ".$id_artiste.",
                                       '".$date_commentaire."',
                                        '".$texte_commentaire."')";
            $query = MySQLDBConnecter::query($sql);
            $result = (bool) ($query != null);
        }
        else
        {
            $comm_art_check = $this->getCommentaireArtiste($id_comm_art);

            if($comm_art_check != null)
            {
                $sql = "UPDATE News SET   `id_personne`  = ".$id_personne.",
                                            `id_artiste` = ".$id_artiste.",
                                            `date_commentaire_artiste` = '".$date_commentaire."',
                                            `texte_commentaire_artiste`  = '".$texte_commentaire."'
                                     WHERE `id_commentaire_artiste` = ".$id_comm_art;
                $query = MySQLDBConnecter::query($sql);
                $result = (bool) ($query != null);
            }else
            {
                $result = false;
            }
        }

        unset($id_comm_art);
        unset($id_artiste);
        unset($id_personne);
        unset($date_commentaire);
        unset($texte_commentaire);

        $datas = "";
        if($isInsertMode && $result != false)
        {
            $query = MySQLDBConnecter::query("SELECT LAST_INSERT_ID() as dernier_id FROM commentaire_artiste");
            if($query != null)
            {
                $datas = mysql_fetch_assoc($query);
                $comm_art->setId((int) $datas['dernier_id']);
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
