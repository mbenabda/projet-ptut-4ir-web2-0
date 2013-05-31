<?php
 //TODO a verifier

require_once(realpath(dirname(__FILE__)."/../../interfaces/")."/ICommentaireCompilationAdapter.class.php");
require_once(realpath(dirname(__FILE__))."/MySQLDBConnecter.class.php");

class CommentaireCompilationAdapter implements ICommentaireCompilationAdapter {
    
    public function __construct() { }

    public function getCommentairesCompilationListForCompilation(Compilation $comp, $startIndex, $nbRecs)
    {
        $result = new ArrayObject();
        if($comp == null)
            return $result;

        $id_comm_compil = (int) $comp->getId();

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

        $sql = "SELECT * FROM commentaire_compilation AS l
                              INNER JOIN Compilations AS l_compilation
                              ON l.id_compilation = l_compilation.id_compilation
                              INNER JOIN Personnes AS l_personne
                              ON l.id_personne= l_personne.id_personne
                         WHERE l.id_compilation = ".$id_comm_compil."
                         ".$limit;
        unset($limit);

        $query = MySQLDBConnecter::query($sql); //Envoie une requête au serveur MySQL
        unset($sql);

        while($datas = mysql_fetch_assoc($query)) //Retourne une ligne de résultat MySQL sous la forme d'un tableau associatif, d'un tableau indexé, ou les deux
        {
            $row = array();
            $row['id'] = (int) $datas['id_commentaire_compilation'];
            $row['id_compilation'] = (int) $datas['id_compilation'];
            $row['id_personne'] = (int) $datas['id_personne'];
            $row['date'] = MySQLDBConnecter::unEscapeString($datas['date_commentaire_compilation']);
            $row['texte'] = MySQLDBConnecter::unEscapeString($datas['texte_commentaire_compilation']);
            $result->append(new CommentaireCompilation($row));
            unset($row);
        }

        unset($query);
        unset($datas);

        MySQLDBConnecter::disconnect();

        return $result;
    }
    
    public function getCommentaireCompilation($id)
    {
        MySQLDBConnecter::connect();

        $id_comm_comp = (int) $id;
        $result = null;

        $sql = "SELECT * FROM commentaire_compilation AS l
                              INNER JOIN Compilations AS l_compilation
                              ON l.id_compilation = l_compilation.id_compilation
                              INNER JOIN Personnes AS l_personne
                              ON l.id_personne= l_personne.id_personne
                         WHERE l.id_commentaire_compilation = ".$id_comm_comp;

        unset($id_comm_comp);

        $query = MySQLDBConnecter::query($sql);
        unset($sql);

        if(mysql_num_rows($query)>0)
        {
            $datas = mysql_fetch_assoc($query);
            $row = array();
            $row['id'] = (int) $datas['id_commentaire_compilation'];
            $row['id_compilation'] = (int) $datas['id_compilation'];
            $row['id_personne'] = (int) $datas['id_personne'];
            $row['date'] = MySQLDBConnecter::unEscapeString($datas['date_commentaire_compilation']);
            $row['texte'] = MySQLDBConnecter::unEscapeString($datas['texte_commentaire_compilation']);
            $result = new CommentaireCompilation($row);
            unset($datas);
            unset($row);
        }

        unset($query);

        MySQLDBConnecter::disconnect();

        return $result;

    }
    
       public function removeCommentaireCompilation(CommentaireCompilation $comm_compil)
    {
        if($comm_compil == null)
            return false;
            
        MySQLDBConnecter::connect();
        $result = true;
        $id_comm_compil= (int)$comm_compil->getId();
        $comm_compil_check = $this->getCommentaireCompilation($id_comm_compil);

        if($comm_compil_check!= null)
        {
            $sql = "DELETE FROM commentaire_compilation WHERE id_commentaire_compilation = ".$id_comm_compil;
            $query = MySQLDBConnecter::query($sql);
            $result = ($query != null);

            unset($sql);
            unset($query);
        }else
        {
            $result = false;
        }

        unset($comm_compil_check);
        unset($id_comm_compil);
        
        MySQLDBConnecter::disconnect();

        return $result;
    }

    public function storeCommentaireCompilation(CommentaireCompilation &$comm_compil)
    {
        if($comm_compil == null)
            return false;
            
        MySQLDBConnecterDB::connect();

        $result = true;
        $id_comm_compil = (int)$comm_compil->getId();
        $isInsertMode = (bool) empty($id_comm_compil);

        $date_commentaire = MySQLDBConnecter::escapeString($comm_compil->getDateCommentaire());
        $texte_commentaire = MySQLDBConnecter::escapeString($comm_compil->getTexteCommentaire());
        $id_personne = (int) $comm_compil->getIdPersonne();
        $id_compilation = (int) $comm_compil->getIdCompilation();

        $sql = "";

        if($isInsertMode == true)  //pour savoir s'il ya un Id déjà dans l'objet qu'on veut mettre dans la base, si c'est true, ça veut dire qu'il n'y en a pas
        {
        $sql = "INSERT INTO commentaire_compilation (`id_commentaire_compilation`,
                                                 `id_compilation`,
                                                 `id_personne`,
                                                 `date_commentaire_compilation`,
                                                 `texte_commentaire_compilation`)
                                        VALUES(NULL,
                                        ".$id_compilation.",
                                        ".$id_personne.",
                                       '".$date_commentaire."',
                                        '".$texte_commentaire."')";
            $query = MySQLDBConnecter::query($sql);
            $result = (bool) ($query != null);
        }
        else
        {
            $comm_compil_check = $this->getCommentaireCompilation($id_comm_compil);

            if($comm_compil_check != null)
            {
                $sql = "UPDATE News SET   `id_compilation`  = ".$id_compilation.",
                                            `id_personne` = ".$id_personne.",
                                            `date_commentaire_compilation` = '".$date_commentaire."',
                                            `texte_commentaire_compilation`  = '".$texte_commentaire."'
                                     WHERE `id_commentaire_compilation` = ".$id_comm_compil;
                $query = MySQLDBConnecter::query($sql);
                $result = (bool) ($query != null);
            }else
            {
                $result = false;
            }
        }

        unset($id_comm_compil);
        unset($id_compilation);
        unset($id_personne);
        unset($date_commentaire);
        unset($texte_commentaire);

        $datas = "";
        if($isInsertMode && $result != false)
        {
            $query = MySQLDBConnecter::query("SELECT LAST_INSERT_ID() as dernier_id FROM commentaire_compilation");
            if($query != null)
            {
                $datas = mysql_fetch_assoc($query);
                $comm_compil->setId((int) $datas['dernier_id']);
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
