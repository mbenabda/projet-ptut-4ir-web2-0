<?php
//isDebugMode() est définie dans config.php

require_once(realpath(dirname(__FILE__)."/../../interfaces/")."/IPhotoAdapter.class.php");
require_once(realpath(dirname(__FILE__))."/MySQLDBConnecter.class.php");

class PhotoAdapter implements IPhotoAdapter
{
    
    public function __construct() { }
    

    public function getPhotosList($startIndex = null, $nbRecs = null)
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

        $sql = "SELECT * FROM Photos AS t
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
            $row['id'] = (int) $datas['id_photo'];
            $row['id_contenu'] = (int) $datas['id_contenu'];
            $row['date_creation'] = MySQLDBConnecter::unEscapeString($datas['date_creation_contenu']);
            $row['date_publication'] = MySQLDBConnecter::unEscapeString($datas['date_publication_contenu']);
            $row['titre'] = MySQLDBConnecter::unEscapeString($datas['titre_contenu']);
            $row['url'] = MySQLDBConnecter::unEscapeString($datas['url_contenu']);
            $row['isPublie'] = MySQLDBConnecter::unEscapeString($datas['publie_contenu']);
            $row['id_artiste_auteur'] = (int) $datas['id_artiste_auteur'];
            $result->append(new Photo($row));
            unset($row);
        }

        unset($query);
        unset($datas);

        MySQLDBConnecter::disconnect();

        return $result;
    }

    public function getPhotosListByArtiste(Artiste $art, $startIndex = null, $nbRecs = null)
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

        $sql = "SELECT * FROM Photos AS t
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
            $row['id'] = (int) $datas['id_photo'];
            $row['id_contenu'] = (int) $datas['id_contenu'];
            $row['date_creation'] = MySQLDBConnecter::unEscapeString($datas['date_creation_contenu']);
            $row['date_publication'] = MySQLDBConnecter::unEscapeString($datas['date_publication_contenu']);
            $row['titre'] = MySQLDBConnecter::unEscapeString($datas['titre_contenu']);
            $row['url'] = MySQLDBConnecter::unEscapeString($datas['url_contenu']);
            $row['isPublie'] = MySQLDBConnecter::unEscapeString($datas['publie_contenu']);
            $row['id_artiste_auteur'] = (int) $datas['id_artiste_auteur'];
            $result->append(new Photo($row));
            unset($row);
        }

        unset($query);
        unset($datas);

        MySQLDBConnecter::disconnect();

        return $result;
    }
    
    public function getPhoto($id) 
    {
        MySQLDBConnecter::connect();
        
        $id_photo = (int) $id;
        $result = null;

        $sql = "SELECT * FROM Photos AS t
                              INNER JOIN Contenus AS t_contenus
                              ON t.id_contenu = t_contenus.id_contenu
                         WHERE t.id_photo = ".$id_photo;
        
        unset($id_photo);

        $query = MySQLDBConnecter::query($sql);
        unset($sql);
        
        if(mysql_num_rows($query)>0)
        {
            $datas = mysql_fetch_assoc($query);
            $row = array();
            $row['id'] = (int) $datas['id_photo'];
            $row['id_contenu'] = (int) $datas['id_contenu'];
            $row['date_creation'] = MySQLDBConnecter::unEscapeString($datas['date_creation_contenu']);
            $row['date_publication'] = MySQLDBConnecter::unEscapeString($datas['date_publication_contenu']);
            $row['titre'] = MySQLDBConnecter::unEscapeString($datas['titre_contenu']);
            $row['url'] = MySQLDBConnecter::unEscapeString($datas['url_contenu']);
            $row['isPublie'] = MySQLDBConnecter::unEscapeString($datas['publie_contenu']);
            $row['id_artiste_auteur'] = (int) $datas['id_artiste_auteur'];
            $result = new Photo($row);
            unset($datas);
            unset($row);
        }

        unset($query);

        MySQLDBConnecter::disconnect();
        
        return $result;
            
    }

    public function removePhoto(Photo $photo) 
    {       
        if($photo == null)
            return false;

        MySQLDBConnecter::connect();

        $result = true;
        $id_photo = (int) ($photo->getId());
        $id_contenu = (int) ($photo->getIdContenu());
        $sql = "DELETE FROM Photos WHERE id_photo = ".$id_photo." AND id_contenu = ".$id_contenu;
        $query = MySQLDBConnecter::query($sql);

        if ($query != null)
        {
            $cont_adapter = new ContenuAdapter();
            $result = $cont_adapter->removeContenu($photo->getIdContenu());
        }else
        {
            $result = false;
        }

        unset($id_photo);
        unset($id_contenu);
        unset($sql);
        unset($query);
        MySQLDBConnecter::disconnect();

        return $result;    
    }

    public function storePhoto(Photo &$photo)
    {
        if($photo == null)
            return false;

        MySQLDBConnecterDB::connect();
        
        $result = true;
        $cont_adapter = new ContenuAdapter();

        $id_photo = (int) $photo->getId();
        $isInsertMode = (bool)( $this->getPhoto($id_photo) == null);

        $date_creation = $photo->getDateCreation();
        $date_publication = $photo->getDatePublication();
        $id_artiste_auteur = $photo->getIdArtisteAuteur();
        $titre = $photo->getTitre();
        $url = $photo->getURL();
        $isPublie = $photo->isPublie();
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
                $sql = "INSERT INTO Photos(`id_photo`,
                                           `id_contenu`)
                                    VALUES(NULL,
                                           ".$id_contenu.")";
                $query = MySQLDBConnecter::query($sql);
                $result = (bool) ($query != null);
                if($result != false)
                {
                    $query = MySQLDBConnecter::query("SELECT LAST_INSERT_ID() as dernier_id FROM Photos");
                    $datas = mysql_fetch_assoc($query);
                    $photo->setId((int) $datas['dernier_id']);
                    $photo->setIdContenu($id_contenu);
                    unset($datas);
                }
                unset($sql);
                unset($query);
            }
        }else
        {
            $cont->setIdContenu((int) $photo->getIdContenu());
            $result = ($cont_adapter->storeContenu($cont) != false);
            $id_contenu = (int) $cont->getIdContenu();
            if($result != false)
            {
                $sql = "UPDATE Photos SET `id_contenu` = ".$id_contenu."
                                      WHERE `id_photo` = ".$id_photo;
                $query = MySQLDBConnecter::query($sql);
                $result = (bool) ($query != null);
                if($result != false)
                {
                    $photo->setIdContenu($id_contenu);
                }
                unset($sql);
                unset($query);
            }
        }

        unset($cont_adapter);
        unset($isInsertMode);
        unset($id_photo);
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