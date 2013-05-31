<?php

require_once(realpath(dirname(__FILE__)."/../../interfaces/")."/INewsAdapter.class.php");
require_once(realpath(dirname(__FILE__))."/MySQLDBConnecter.class.php");


class NewsAdapter implements INewsAdapter
{
    public function __construct() { }
   
    public function getNewsList($startIndex = null, $nbRecs = null)
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

        $sql = "SELECT * FROM News AS l
                              INNER JOIN Administrateurs AS l_administrateur
                              ON l.id_admin_auteur = l_administrateur.id_admin
                         ".$limit;
        unset($limit);

        $query = MySQLDBConnecter::query($sql); //Envoie une requête au serveur MySQL
        unset($sql);

        $result = new ArrayObject();

        while($datas = mysql_fetch_assoc($query)) //Retourne une ligne de résultat MySQL sous la forme d'un tableau associatif, d'un tableau indexé, ou les deux
        {
            $row = array();
            $row['id'] = (int) $datas['id_news'];
            $row['titre'] = MySQLDBConnecter::unEscapeString($datas['titre_news']);
            $row['texte'] = MySQLDBConnecter::unEscapeString($datas['texte_news']);
            $row['date_creation'] = MySQLDBConnecter::unEscapeString($datas['date_creation_news']);
            $row['date_publication'] = MySQLDBConnecter::unEscapeString($datas['date_publication_news']);
            $row['isPublie'] = MySQLDBConnecter::unEscapeString($datas['publie_news']);
            $row['id_admin_auteur'] = (int) $datas['id_admin_auteur'];
            $result->append(new News($row));
            unset($row);
        }

        unset($query);
        unset($datas);

        MySQLDBConnecter::disconnect();

        return $result;
    }
    
    public function getNewsListByAdministrateur(Administrateur $admin, $startIndex = null, $nbRecs = null)
    {
        $result = new ArrayObject();
        if($admin == null)
            return $result;

        $id_admin = (int) $admin->getId();

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

        $sql = "SELECT * FROM News AS l
                              INNER JOIN Administrateurs AS l_administrateur
                              ON l.id_admin_auteur = l_administrateur.id_admin
                         WHERE l.id_admin_auteur = ".$id_admin."
                         ".$limit;
        unset($limit);

        $query = MySQLDBConnecter::query($sql); //Envoie une requête au serveur MySQL
        unset($sql);

        while($datas = mysql_fetch_assoc($query)) //Retourne une ligne de résultat MySQL sous la forme d'un tableau associatif, d'un tableau indexé, ou les deux
        {
            $row = array();
            $row['id'] = (int) $datas['id_news'];
            $row['titre'] = MySQLDBConnecter::unEscapeString($datas['titre_news']);
            $row['texte'] = MySQLDBConnecter::unEscapeString($datas['texte_news']);
            $row['date_creation'] = MySQLDBConnecter::unEscapeString($datas['date_creation_news']);
            $row['date_publication'] = MySQLDBConnecter::unEscapeString($datas['date_publication_news']);
            $row['isPublie'] = MySQLDBConnecter::unEscapeString($datas['publie_news']);
            $row['id_admin_auteur'] = (int) $datas['id_admin_auteur'];
            $result->append(new News($row));
            unset($row);
        }

        unset($query);
        unset($datas);

        MySQLDBConnecter::disconnect();

        return $result;
    }
    
    
    public function getNews($id)
    {
        MySQLDBConnecter::connect();
        $id_news = (int) $id;
        $result = null;
        $sql = "SELECT * FROM News AS l
                      INNER JOIN Administrateurs AS l_administrateur
                      ON l.id_admin_auteur = l_administrateur.id_admin
                      WHERE l.id_news = ".$id_news;
        unset($id_news);

        $query = MySQLDBConnecter::query($sql);
        unset($sql);
        
        if(mysql_num_rows($query)>0)
        {
            $datas = mysql_fetch_assoc($query);
            $row = array();
            $row['id'] = (int) $datas['id_news'];
            $row['titre'] = MySQLDBConnecter::unEscapeString($datas['titre_news']);
            $row['texte'] = MySQLDBConnecter::unEscapeString($datas['texte_news']);
            $row['date_creation'] = MySQLDBConnecter::unEscapeString($datas['date_creation_news']);
            $row['date_publication'] = MySQLDBConnecter::unEscapeString($datas['date_publication_news']);
            $row['isPublie'] = MySQLDBConnecter::unEscapeString($datas['publie_news']);
            $row['id_admin_auteur'] = (int) $datas['id_admin_auteur'];
            $result = new News($row);
            unset($datas);
            unset($row);
        }
        
        unset($query);

        MySQLDBConnecter::disconnect();      

        return $result;
    }
    
       public function removeNews(News $news)
    {
        if($news == null)
            return false;
            
        MySQLDBConnecter::connect();
        $result = true;
        $id_news = (int)$news->getId();
        $news_check = $this->getNews($id_news);

        if($news_check != null)
        {
            $sql = "DELETE FROM News WHERE id_news = ".$id_news;
            $query = MySQLDBConnecter::query($sql);
            $result = ($query != null);

            unset($sql);
            unset($query);
        }else
        {
            $result = false;
        }

        unset($news_check);
        unset($id_news);
        
        MySQLDBConnecter::disconnect();

        return $result;
    }
    
    
    public function storeNews(News &$news)
    {
        if($news == null)
            return false;
            
        MySQLDBConnecterDB::connect();

        $result = true;
        $id_news = (int)$news->getId();
        $isInsertMode = (bool) empty($id_news);

        $titre_news = MySQLDBConnecter::escapeString($news->getTitre());
        $texte_news = MySQLDBConnecter::escapeString($news->getTexte());
        $date_creation_news = MySQLDBConnecter::escapeString($news->getDateCreation());
        $date_publication_news = MySQLDBConnecter::escapeString($news->getDatePublication());
        $publie_news = MySQLDBConnecter::escapeString($news->isPublie());
        $id_admin_auteur = (int) $news->getIdAdminAuteur();

        $sql = "";

        if($isInsertMode == true)  //pour savoir s'il ya un Id déjà dans l'objet qu'on veut mettre dans la base, si c'est true, ça veut dire qu'il n'y en a pas
        {
        $sql = "INSERT INTO News (`id_news`,
                                  `titre_news`,
                                  `texte_news`,
                                  `date_creation_news`,
                                  `date_publication_news`,
                                  `publie_news`,
                                  `id_admin_auteur`)
                                 VALUES(NULL,
                                        '".$titre_news."',
                                        '".$texte_news."',
                                        '".$date_creation_news."',
                                        '".$date_publication_news."',
                                        '".$publie_news."',
                                        ".$id_admin_auteur.")";
            $query = MySQLDBConnecter::query($sql);
            $result = (bool) ($query != null);
        }
        else
        {
            $news_check = $this->getNews($id_news);

            if($news_check != null)
            {
                $sql = "UPDATE News SET `titre_news`	= '".$titre_news."',
                                            `texte_news`  = '".$texte_news."',
                                            `date_creation_news` = '".$date_creation_news."',
                                            `date_publication_news` = '".$date_publication_news."',
                                            `publie_news`    = '".$publie_news."',
                                            `id_admin_auteur` = ".$id_admin_auteur."
                                     WHERE `id_news` = ".$id_news;
                $query = MySQLDBConnecter::query($sql);
                $result = (bool) ($query != null);
            }else
            {
                $result = false;
            }
        }

        unset($id_news);
        unset($date_creation_news);
        unset($date_publication_news);
        unset($titre_news);
        unset($texte_news);
        unset($publie_news);
        unset($id_admin_auteur);

        $datas = "";
        if($isInsertMode && $result != false)
        {
            $query = MySQLDBConnecter::query("SELECT LAST_INSERT_ID() as dernier_id FROM News");
            if($query != null)
            {
                $datas = mysql_fetch_assoc($query);
                $news->setId((int) $datas['dernier_id']);
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
