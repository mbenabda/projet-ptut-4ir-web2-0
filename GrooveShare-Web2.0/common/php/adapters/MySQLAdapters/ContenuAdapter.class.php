<?php
//isDebugMode() est définie dans config.php

require_once(realpath(dirname(__FILE__)."/../../interfaces/")."/IContenuAdapter.class.php");
require_once(realpath(dirname(__FILE__))."/MySQLDBConnecter.class.php");

class ContenuAdapter implements IContenuAdapter
{
    public function __construct() { }
    
    public function getContenu($id) 
    {
        MySQLDBConnecter::connect();
        $id_contenu = (int) $id;
        $result = null;
        $sql = "SELECT * FROM Contenus WHERE id_contenu = ".$id_contenu ;
        //TODO fallait-il pas faire un INNER Join avec la table Artiste ici
        unset($id_contenu);

        $query = MySQLDBConnecter::query($sql);
        unset($sql);
        
        if(mysql_num_rows($query)>0)
        {
            $datas = mysql_fetch_assoc($query);
            $row = array();
            $row['id_contenu'] = (int) $datas['id_contenu'];
            $row['date_creation'] = MySQLDBConnecter::unEscapeString($datas['date_creation_contenu']);
            $row['date_publication'] = MySQLDBConnecter::unEscapeString($datas['date_publication_contenu']);
            $row['titre'] = MySQLDBConnecter::unEscapeString($datas['titre_contenu']);
            $row['url'] = MySQLDBConnecter::unEscapeString($datas['url_contenu']);
            $row['isPublie'] = MySQLDBConnecter::unEscapeString($datas['publie_contenu']);
            $row['id_artiste_auteur'] = (int) $datas['id_artiste_auteur'];
            $result = new Contenu($row);
            unset($datas);
            unset($row);
        }
        
        unset($query);

        MySQLDBConnecter::disconnect();      

        return $result;
    }

    public function removeContenu(Contenu $cont)
    {
        if($cont == null)
            return false;
            
        MySQLDBConnecter::connect();
        $result = true;
        $id_contenu = (int)$cont->getIdContenu();
        $cont_check = $this->getContenu($id_contenu);

        if($cont_check != null)
        {
            $sql = "DELETE FROM Contenus WHERE id_contenu = ".$id_contenu;
            $query = MySQLDBConnecter::query($sql);
            $result = ($query != null);

            unset($sql);
            unset($query);
        }else
        {
            $result = false;
        }

        unset($cont_check);
        unset($id_contenu);
        
        MySQLDBConnecter::disconnect();

        return $result;
    }

    public function storeContenu(Contenu &$cont)
    {
        if($cont == null)
            return false;
            
        MySQLDBConnecterDB::connect();

        $result = true;
        $id_contenu = (int)$cont->getIdContenu();
        $isInsertMode = (bool) empty($id_contenu);

        $date_creation_contenu = MySQLDBConnecter::escapeString($cont->getDateCreation());
        $date_publication_contenu = MySQLDBConnecter::escapeString($cont->getDatePublication());
        $titre_contenu = MySQLDBConnecter::escapeString($cont->getTitre());
        $url_contenu = MySQLDBConnecter::escapeString($cont->getURL());
        $publie_contenu = MySQLDBConnecter::escapeString($cont->isPublie());
        $id_artiste_auteur_contenu = (int) $cont->getIdArtisteAuteur();

        $sql = "";

        if($isInsertMode == true)  //pour savoir s'il ya un Id déjà dans l'objet qu'on veut mettre dans la base, si c'est true, ça veut dire qu'il n'y en a pas
        {
            $sql = "INSERT INTO Contenus (`id_contenu`,
                                          `date_creation_contenu`,
                                          `date_publication_contenu`,
                                          `titre_contenu`,
                                          `url_contenu`,
                                          `publie_contenu`,
                                          `id_artiste_auteur`)
                                VALUES(NULL,
                                        '".$date_creation_contenu."',
                                        '".$date_publication_contenu."',
                                        '".$titre_contenu."',
                                        '".$url_contenu."',
                                        '".$publie_contenu."',
                                        ".$id_artiste_auteur_contenu.")";
            $query = MySQLDBConnecter::query($sql);
            $result = (bool) ($query != null);
        }
        else
        {
            $cont_check = $this->getContenu($id_contenu);

            if($cont_check != null)
            {
                $sql = "UPDATE Contenus SET `date_creation_contenu`	= '".$date_creation_contenu."',
                                            `date_publication_contenu`  = '".$date_publication_contenu."',
                                            `titre_contenu`     = '".$titre_contenu."',
                                            `url_contenu`       = '".$url_contenu."',
                                            `publie_contenu`    = '".$publie_contenu."',
                                            `id_artiste_auteur` = ".$id_artiste_auteur_contenu."
                                     WHERE `id_contenu` = ".$id_contenu;
                $query = MySQLDBConnecter::query($sql);
                $result = (bool) ($query != null);
            }else
            {
                $result = false;
            }
        }

        unset($id_contenu);
        unset($date_creation_contenu);
        unset($date_publication_contenu);
        unset($titre_contenu);
        unset($url_contenu);
        unset($publie_contenu);
        unset($id_artiste_auteur_contenu);

        $datas = "";
        if($isInsertMode && $result != false)
        {
            $query = MySQLDBConnecter::query("SELECT LAST_INSERT_ID() as dernier_id FROM Contenus");
            if($query != null)
            {
                $datas = mysql_fetch_assoc($query);
                $cont->setIdContenu((int) $datas['dernier_id']);
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