<?php


require_once(realpath(dirname(__FILE__) . "/../../interfaces/") . "/ICommentaireContenuAdapter.class.php");
require_once(realpath(dirname(__FILE__) . "/") . "/CommentaireContenuAdapter.class.php");
require_once(realpath(dirname(__FILE__)) . "/MySQLDBConnecter.class.php");

class CommentaireContenuAdapter implements ICommentaireContenuAdapter {

    public function __construct() {
        
    }

    public function getCommentaireContenuListForContenu(Contenu $cont, $startIndex = null, $nbRecs = null)
{
        $result = new ArrayObject();
        if($cont == null)
            return $result;

        $id_comm_cont = (int) $cont->getId();

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

        $sql = "SELECT * FROM commentaire_contenu AS l
                              INNER JOIN Contenus AS l_contenu
                              ON l.id_contenu = l_contenu.id_contenu
                              INNER JOIN Personnes AS l_personne
                              ON l.id_personne= l_personne.id_personne
                         WHERE l.id_compilation = ".$id_comm_cont."
                         ".$limit;
        unset($limit);

        $query = MySQLDBConnecter::query($sql); //Envoie une requête au serveur MySQL
        unset($sql);

        while($datas = mysql_fetch_assoc($query)) //Retourne une ligne de résultat MySQL sous la forme d'un tableau associatif, d'un tableau indexé, ou les deux
        {
            $row = array();
            $row['id'] = (int) $datas['id_commentaire_contenu'];
            $row['id_personne'] = (int) $datas['id_personne'];
            $row['date_commentaire_contenu'] = MySQLDBConnecter::unEscapeString($datas['date_commentaire_contenu']);
            $row['texte_commentaire_contenu'] = MySQLDBConnecter::unEscapeString($datas['texte_commentaire_contenu']);
            $row['id_contenu'] = (int) $datas['id_contenu'];
            $result->append(new CommentaireContenu($row));
            unset($row);
        }

        unset($query);
        unset($datas);

        MySQLDBConnecter::disconnect();

        return $result;
    }


    public function getCommentaireContenu($id) 
    {

        MySQLDBConnecter::connect();

        $id_comm_cont = (int) $id;
        $result = null;

        $sql = "SELECT * FROM commentaire_contenu AS l
                              INNER JOIN Contenus AS l_contenu
                              ON l.id_contenu = l_contenu.id_contenu
                              INNER JOIN Personnes AS l_personne
                              ON l.id_personne= l_personne.id_personne
                         WHERE l.id_commentaire_contenu = ".$id_comm_cont;

        unset($id_comm_cont);

        $query = MySQLDBConnecter::query($sql);
        unset($sql);

        if(mysql_num_rows($query)>0)
        {
            $datas = mysql_fetch_assoc($query);
            $row = array();
            $row['id'] = (int) $datas['id_commentaire_contenu'];
            $row['id_personne'] = (int) $datas['id_personne'];
            $row['date_commentaire_contenu'] = MySQLDBConnecter::unEscapeString($datas['date_commentaire_contenu']);
            $row['texte_commentaire_contenu'] = MySQLDBConnecter::unEscapeString($datas['texte_commentaire_contenu']);
            $row['id_contenu'] = (int) $datas['id_contenu'];
            $result = new CommentaireContenu($row);
            unset($datas);
            unset($row);
        }

        unset($query);

        MySQLDBConnecter::disconnect();

        return $result;

    }

    public function removeCommentaireContenu(CommentaireContenu $comm_cont) 
    {
       if($comm_cont == null)
            return false;
            
        MySQLDBConnecter::connect();
        $result = true;
        $id_comm_cont= (int)$comm_cont->getId();
        $comm_cont_check = $this->getCommentaireCompilation($id_comm_cont);

        if($comm_cont_check!= null)
        {
            $sql = "DELETE FROM commentaire_contenu WHERE id_commentaire_contenu = ".$id_comm_cont;
            $query = MySQLDBConnecter::query($sql);
            $result = ($query != null);

            unset($sql);
            unset($query);
        }else
        {
            $result = false;
        }

        unset($comm_cont_check);
        unset($id_comm_cont);
        
        MySQLDBConnecter::disconnect();

        return $result;
    }

    public function storeCommentaireContenu(CommentaireContenu &$comm_cont) 
    {
        if($comm_cont == null)
            return false;
            
        MySQLDBConnecterDB::connect();

        $result = true;
        $id_comm_cont = (int)$comm_cont->getId();
        $isInsertMode = (bool) empty($id_comm_cont);

        $date_commentaire = MySQLDBConnecter::escapeString($comm_cont->getDateCommentaire());
        $texte_commentaire = MySQLDBConnecter::escapeString($comm_cont->getTexteCommentaire());
        $id_personne = (int) $comm_cont->getIdPersonne();
        $id_contenu = (int) $comm_cont->getIdCompilation();

        $sql = "";

        if($isInsertMode == true)  //pour savoir s'il ya un Id déjà dans l'objet qu'on veut mettre dans la base, si c'est true, ça veut dire qu'il n'y en a pas
        {
        $sql = "INSERT INTO commentaire_contenu (`id_commentaire_compilation`,
                                                 `id_personne`,            
                                                 `id_contenu`,
                                                 `date_commentaire_compilation`,
                                                 `texte_commentaire_compilation`)
                                        VALUES(NULL,
                                        ".$id_personne.",
                                        ".$id_contenu.",
                                       '".$date_commentaire."',
                                        '".$texte_commentaire."')";
            $query = MySQLDBConnecter::query($sql);
            $result = (bool) ($query != null);
        }
        else
        {
            $comm_cont_check = $this->getCommentaireCompilation($id_comm_cont);

            if($comm_cont_check != null)
            {
                $sql = "UPDATE News SET   `id_contenu`  = ".$id_contenu.",
                                            `id_personne` = ".$id_personne.",
                                            `date_commentaire_compilation` = '".$date_commentaire."',
                                            `texte_commentaire_compilation`  = '".$texte_commentaire."'
                                     WHERE `id_commentaire_contenu` = ".$id_comm_cont;
                $query = MySQLDBConnecter::query($sql);
                $result = (bool) ($query != null);
            }else
            {
                $result = false;
            }
        }

        unset($id_comm_cont);
        unset($id_contenu);
        unset($id_personne);
        unset($date_commentaire);
        unset($texte_commentaire);

        $datas = "";
        if($isInsertMode && $result != false)
        {
            $query = MySQLDBConnecter::query("SELECT LAST_INSERT_ID() as dernier_id FROM commentaire_contenu");
            if($query != null)
            {
                $datas = mysql_fetch_assoc($query);
                $comm_cont->setId((int) $datas['dernier_id']);
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
