<?php
//isDebugMode() est définie dans config.php

require_once(realpath(dirname(__FILE__)."/../../interfaces/")."/IVideoAdapter.class.php");
require_once(realpath(dirname(__FILE__))."/MySQLDBConnecter.class.php");

class VideoAdapter implements IVideoAdapter
{

    public function __construct() { }


    public function getVideosList($startIndex = null, $nbRecs = null)
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

        $sql = "SELECT * FROM Videos AS t
                              INNER JOIN Contenus AS t_contenus
                              ON t.id_contenu = t_contenus.id_contenu
                         ".$limit;
        unset($limit);

        $query = MySQLDBConnecter::query($sql); //Envoie une requête au serveur MySQL
        unset($sql);

        $result = new ArrayObject();

        while($datas = mysql_fetch_assoc($query)) //Retourne une ligne de résultat MySQL sous la forme d'un tableau associatif, d'un tableau indexé, ou les deux
        {
            $row = array();
            $row['id'] = (int) $datas['id_video'];
            $row['prix'] = (int) $datas['prix_video'];
            $row['id_contenu'] = (int) $datas['id_contenu'];
            $row['date_creation'] = MySQLDBConnecter::unEscapeString($datas['date_creation_contenu']);
            $row['date_publication'] = MySQLDBConnecter::unEscapeString($datas['date_publication_contenu']);
            $row['titre'] = MySQLDBConnecter::unEscapeString($datas['titre_contenu']);
            $row['url'] = MySQLDBConnecter::unEscapeString($datas['url_contenu']);
            $row['isPublie'] = MySQLDBConnecter::unEscapeString($datas['publie_contenu']);
            $row['id_artiste_auteur'] = (int) $datas['id_artiste_auteur'];
            $result->append(new Video($row));
            unset($row);
        }

        unset($query);
        unset($datas);

        MySQLDBConnecter::disconnect();

        return $result;
    }

    public function getVideosListByArtiste(Artiste $art, $startIndex = null, $nbRecs = null)
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

        $sql = "SELECT * FROM Videos AS t
                              INNER JOIN Contenus AS t_contenus
                              ON t.id_contenu = t_contenus.id_contenu
                         WHERE t_contenus.id_artiste_auteur = ".$id_artiste."
                         ".$limit;
        unset($limit);

        $query = MySQLDBConnecter::query($sql); //Envoie une requête au serveur MySQL
        unset($sql);

        while($datas = mysql_fetch_assoc($query)) //Retourne une ligne de résultat MySQL sous la forme d'un tableau associatif, d'un tableau indexé, ou les deux
        {
            $row = array();
            $row['id'] = (int) $datas['id_video'];
            $row['prix'] = (int) $datas['prix_video'];
            $row['id_contenu'] = (int) $datas['id_contenu'];
            $row['date_creation'] = MySQLDBConnecter::unEscapeString($datas['date_creation_contenu']);
            $row['date_publication'] = MySQLDBConnecter::unEscapeString($datas['date_publication_contenu']);
            $row['titre'] = MySQLDBConnecter::unEscapeString($datas['titre_contenu']);
            $row['url'] = MySQLDBConnecter::unEscapeString($datas['url_contenu']);
            $row['isPublie'] = MySQLDBConnecter::unEscapeString($datas['publie_contenu']);
            $row['id_artiste_auteur'] = (int) $datas['id_artiste_auteur'];
            $result->append(new Video($row));
            unset($row);
        }

        unset($query);
        unset($datas);

        MySQLDBConnecter::disconnect();

        return $result;
    }

    public function getVideo($id)
    {
        MySQLDBConnecter::connect();

        $id_video = (int) $id;
        $result = null;

        $sql = "SELECT * FROM Videos AS t
                              INNER JOIN Contenus AS t_contenus
                              ON t.id_contenu = t_contenus.id_contenu
                         WHERE t.id_video = ".$id_video;

        unset($id_video);

        $query = MySQLDBConnecter::query($sql);
        unset($sql);

        if(mysql_num_rows($query)>0)
        {
            $datas = mysql_fetch_assoc($query);
            $row = array();
            $row['id'] = (int) $datas['id_video'];
            $row['prix'] = (int) $datas['prix_video'];
            $row['id_contenu'] = (int) $datas['id_contenu'];
            $row['date_creation'] = MySQLDBConnecter::unEscapeString($datas['date_creation_contenu']);
            $row['date_publication'] = MySQLDBConnecter::unEscapeString($datas['date_publication_contenu']);
            $row['titre'] = MySQLDBConnecter::unEscapeString($datas['titre_contenu']);
            $row['url'] = MySQLDBConnecter::unEscapeString($datas['url_contenu']);
            $row['isPublie'] = MySQLDBConnecter::unEscapeString($datas['publie_contenu']);
            $row['id_artiste_auteur'] = (int) $datas['id_artiste_auteur'];
            $result = new Video($row);
            unset($datas);
            unset($row);
        }

        unset($query);

        MySQLDBConnecter::disconnect();

        return $result;

    }

    public function removeVideo(Video $video)
    {
        if($video == null)
            return false;

        MySQLDBConnecter::connect();

        $result = true;
        $id_video = (int) ($video->getId());
        $id_contenu = (int) ($video->getIdContenu());
        $sql = "DELETE FROM Videos WHERE id_video = ".$id_video." AND id_contenu = ".$id_contenu;
        $query = MySQLDBConnecter::query($sql);

        if ($query != null)
        {
            $cont_adapter = new ContenuAdapter();
            $result = $cont_adapter->removeContenu($video->getIdContenu());
        }else
        {
            $result = false;
        }

        unset($id_video);
        unset($id_contenu);
        unset($sql);
        unset($query);
        MySQLDBConnecter::disconnect();

        return $result;
    }

    public function storeVideo(Video &$video)
    {
        if($video == null)
            return false;

        MySQLDBConnecterDB::connect();

        $result = true;
        $cont_adapter = new ContenuAdapter();

        $id_video = (int) $video->getId();
        $isInsertMode = (bool)( $this->getVideo($id_video) == null);
        $prix_video = $video->getPrix();
        $date_creation = $video->getDateCreation();
        $date_publication = $video->getDatePublication();
        $id_artiste_auteur = $video->getIdArtisteAuteur();
        $titre = $video->getTitre();
        $url = $video->getURL();
        $isPublie = $video->isPublie();
        $cont = new Contenu(array(
                                'date_creation' => $date_creation,
                                'date_publication' => $date_publication,
                                'titre' => $titre,
                                'url' => $url,
                                'isPublie' =>$isPublie ,
                                'id_artiste_auteur' =>$id_artiste_auteur
                            ));

        if($isInsertMode)
        {
            $result = ($cont_adapter->storeContenu($cont) != false);
            $id_contenu = (int) $cont->getIdContenu();
            if($result != false)
            {
                $sql = "INSERT INTO Videos(`id_video`,
                                            `prix_video`,
                                           `id_contenu`)
                                    VALUES(NULL,
                                           ".$prix_video.",
                                           ".$id_contenu.")";
                $query = MySQLDBConnecter::query($sql);
                $result = (bool) ($query != null);
                if($result != false)
                {
                    $query = MySQLDBConnecter::query("SELECT LAST_INSERT_ID() as dernier_id FROM Videos");
                    $datas = mysql_fetch_assoc($query);
                    $video->setId((int) $datas['dernier_id']);
                    $video->setIdContenu($id_contenu);
                    unset($datas);
                }
                unset($sql);
                unset($query);
            }
        }else
        {
            $cont->setIdContenu((int) $video->getIdContenu());
            $result = ($cont_adapter->storeContenu($cont) != false);
            $id_contenu = (int) $cont->getIdContenu();
            if($result != false)
            {
                $sql = "UPDATE Videos SET `id_contenu` = ".$id_contenu.",
                                           `prix_video` = ".$prix_video."
                                      WHERE `id_video` = ".$id_video;
                $query = MySQLDBConnecter::query($sql);
                $result = (bool) ($query != null);
                if($result != false)
                {
                    $video->setIdContenu($id_contenu);
                }
                unset($sql);
                unset($query);
            }
        }

        unset($cont_adapter);
        unset($isInsertMode);
        unset($id_video);
        unset($prix_video);
        unset($date_creation);
        unset($date_publication);
        unset($id_artiste_auteur);
        unset($titre);
        unset($url);
        unset($isPublie);
        unset($cont);

        MySQLDBConnecter::disconnect();

        return $result;
    }
}
?>