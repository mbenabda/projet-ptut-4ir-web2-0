<?php

 //TODO a verifier

require_once(realpath(dirname(__FILE__)."/../../interfaces/")."/ICommentaireNewsAdapter.class.php");
require_once(realpath(dirname(__FILE__))."/MySQLDBConnecter.class.php");

class CommentaireNewsAdapter implements ICommentaireNewsAdapter 
{
    public function __construct() { }

    public function getCommentairesNewsListForNews(News $news,$startIndex, $nbRecs)
    {
        $result = new ArrayObject();
        if($news == null)
            return $result;

        $id_news = (int) $news->getId();

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

        $sql = "SELECT * FROM commentaire_news AS l
                              INNER JOIN News AS l_news
                              ON l.id_news = l_news.id_news
                              INNER JOIN Personnes AS l_personne
                              ON l.id_personne= l_personne.id_personne
                         WHERE l.id_news = ".$id_news."
                         ".$limit;
        unset($limit);

        $query = MySQLDBConnecter::query($sql); //Envoie une requête au serveur MySQL
        unset($sql);

        while($datas = mysql_fetch_assoc($query)) //Retourne une ligne de résultat MySQL sous la forme d'un tableau associatif, d'un tableau indexé, ou les deux
        {
            $row = array();
            $row['id'] = (int) $datas['id_commentaire_news'];
            $row['id_personne'] = (int) $datas['id_personne'];
            $row['id_news'] = (int) $datas['id_news'];
            $row['date'] = MySQLDBConnecter::unEscapeString($datas['date_commentaire_news']);
            $row['texte'] = MySQLDBConnecter::unEscapeString($datas['texte_commentaire_news']);
            $result->append(new CommentaireNews($row));
            unset($row);
        }

        unset($query);
        unset($datas);

        MySQLDBConnecter::disconnect();

        return $result;
    }
    
    public function getCommentaireNews($id)
    {
        MySQLDBConnecter::connect();

        $id_comm_news = (int) $id;
        $result = null;

        $sql = "SELECT * FROM commentaire_news AS l
                              INNER JOIN News AS l_news
                              ON l.id_news = l_news.id_news
                              INNER JOIN Personnes AS l_personne
                              ON l.id_personne= l_personne.id_personne
                         WHERE l.id_commentaire_news = ".$id_comm_news;

        unset($id_comm_news);

        $query = MySQLDBConnecter::query($sql);
        unset($sql);

        if(mysql_num_rows($query)>0)
        {
            $datas = mysql_fetch_assoc($query);
            $row = array();
            $row['id'] = (int) $datas['id_commentaire_news'];
            $row['id_personne'] = (int) $datas['id_personne'];
            $row['id_news'] = (int) $datas['id_news'];
            $row['date'] = MySQLDBConnecter::unEscapeString($datas['date_commentaire_news']);
            $row['texte'] = MySQLDBConnecter::unEscapeString($datas['texte_commentaire_news']);
            $result = new CommentaireNews($row);
            unset($datas);
            unset($row);
        }

        unset($query);

        MySQLDBConnecter::disconnect();

        return $result;

    }
    
       public function removeCommentaireNews(CommentaireNews $comm_news)
    {
        if($comm_news == null)
            return false;
            
        MySQLDBConnecter::connect();
        $result = true;
        $id_comm_news= (int)$comm_news->getId();
        $comm_news_check = $this->getCommentaireNews($id_comm_news);

        if($comm_news_check!= null)
        {
            $sql = "DELETE FROM commentaire_news WHERE id_commentaire_news = ".$id_comm_news;
            $query = MySQLDBConnecter::query($sql);
            $result = ($query != null);

            unset($sql);
            unset($query);
        }else
        {
            $result = false;
        }

        unset($comm_news_check);
        unset($id_comm_news);
        
        MySQLDBConnecter::disconnect();

        return $result;
    }

    public function storeCommentaireNews(CommentaireNews &$comm_news)
    {
        if($comm_news == null)
            return false;
            
        MySQLDBConnecterDB::connect();

        $result = true;
        $id_comm_news = (int)$comm_news->getId();
        $isInsertMode = (bool) empty($id_comm_news);

        $date_commentaire = MySQLDBConnecter::escapeString($comm_news->getDateCommentaire());
        $texte_commentaire = MySQLDBConnecter::escapeString($comm_news->getTexteCommentaire());
        $id_personne = (int) $comm_news->getIdPersonne();
        $id_news = (int) $comm_news->getIdCompilation();

        $sql = "";

        if($isInsertMode == true)  //pour savoir s'il ya un Id déjà dans l'objet qu'on veut mettre dans la base, si c'est true, ça veut dire qu'il n'y en a pas
        {
        $sql = "INSERT INTO commentaire_news (`id_commentaire_news`,
                                                 `id_personne`,
                                                 `id_news`,
                                                 `date_commentaire_news`,
                                                 `texte_commentaire_news`)
                                        VALUES(NULL,
                                        ".$id_personne.",
                                        ".$id_news.",
                                       '".$date_commentaire."',
                                        '".$texte_commentaire."')";
        
            $query = MySQLDBConnecter::query($sql);
            $result = (bool) ($query != null);
        }
        else
        {
            $comm_news_check = $this->getCommentaireNews($id_comm_news);

            if($comm_news_check != null)
            {
                $sql = "UPDATE News SET   `id_personne`  = ".$id_personne.",
                                            `id_news` = ".$id_news.",
                                            `date_commentaire_news` = '".$date_commentaire."',
                                            `texte_commentaire_news`  = '".$texte_commentaire."'
                                     WHERE `id_commentaire_news` = ".$id_comm_news;
                $query = MySQLDBConnecter::query($sql);
                $result = (bool) ($query != null);
            }else
            {
                $result = false;
            }
        }

        unset($id_comm_news);
        unset($id_news);
        unset($id_personne);
        unset($date_commentaire);
        unset($texte_commentaire);

        $datas = "";
        if($isInsertMode && $result != false)
        {
            $query = MySQLDBConnecter::query("SELECT LAST_INSERT_ID() as dernier_id FROM commentaire_news");
            if($query != null)
            {
                $datas = mysql_fetch_assoc($query);
                $comm_news->setId((int) $datas['dernier_id']);
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
