<?php
//isDebugMode() est définie dans config.php

require_once(realpath(dirname(__FILE__)."/../../interfaces/")."/ISampleAdapter.class.php");
require_once(realpath(dirname(__FILE__))."/MySQLDBConnecter.class.php");

class SampleAdapter implements ISampleAdapter
{

    public function __construct() { }


    public function getSamplesList($startIndex = null, $nbRecs = null)
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

        $sql = "SELECT * FROM Samples AS t
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
            $row['id'] = (int) $datas['id_sample'];
            $row['prix'] = (int) $datas['prix_sample'];
            $row['id_contenu'] = (int) $datas['id_contenu'];
            $row['date_creation'] = MySQLDBConnecter::unEscapeString($datas['date_creation_contenu']);
            $row['date_publication'] = MySQLDBConnecter::unEscapeString($datas['date_publication_contenu']);
            $row['titre'] = MySQLDBConnecter::unEscapeString($datas['titre_contenu']);
            $row['url'] = MySQLDBConnecter::unEscapeString($datas['url_contenu']);
            $row['isPublie'] = MySQLDBConnecter::unEscapeString($datas['publie_contenu']);
            $row['id_artiste_auteur'] = (int) $datas['id_artiste_auteur'];
            $result->append(new Sample($row));
            unset($row);
        }

        unset($query);
        unset($datas);

        MySQLDBConnecter::disconnect();

        return $result;
    }


    public function getSamplesCount()
    {
        MySQLDBConnecter::connect();
        $result = 0;

        $sql = "SELECT COUNT(id_sample) AS nb_samples FROM Samples";

        $query = MySQLDBConnecter::query($sql);
        unset($sql);

        $datas = mysql_fetch_assoc($query);

        $result = (int)$datas['nb_samples'];

        unset($query);
        unset($datas);

        MySQLDBConnecter::disconnect();

        return $result;
    }
    
    public function getSamplesListForArtiste(Artiste $art, $startIndex = null, $nbRecs = null)
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

        $sql = "SELECT * FROM Samples AS t
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
            $row['id'] = (int) $datas['id_sample'];
            $row['prix'] = (int) $datas['prix_sample'];
            $row['id_contenu'] = (int) $datas['id_contenu'];
            $row['date_creation'] = MySQLDBConnecter::unEscapeString($datas['date_creation_contenu']);
            $row['date_publication'] = MySQLDBConnecter::unEscapeString($datas['date_publication_contenu']);
            $row['titre'] = MySQLDBConnecter::unEscapeString($datas['titre_contenu']);
            $row['url'] = MySQLDBConnecter::unEscapeString($datas['url_contenu']);
            $row['isPublie'] = MySQLDBConnecter::unEscapeString($datas['publie_contenu']);
            $row['id_artiste_auteur'] = (int) $datas['id_artiste_auteur'];
            $result->append(new Sample($row));
            unset($row);
        }

        unset($query);
        unset($datas);

        MySQLDBConnecter::disconnect();

        return $result;
    }

    public function getSample($id)
    {
        MySQLDBConnecter::connect();

        $id_sample = (int) $id;
        $result = null;

        $sql = "SELECT * FROM Samples AS t
                              INNER JOIN Contenus AS t_contenus
                              ON t.id_contenu = t_contenus.id_contenu
                         WHERE t.id_sample = ".$id_sample;

        unset($id_sample);

        $query = MySQLDBConnecter::query($sql);
        unset($sql);

        if(mysql_num_rows($query)>0)
        {
            $datas = mysql_fetch_assoc($query);
            $row = array();
            $row['id'] = (int) $datas['id_sample'];
            $row['prix'] = (int) $datas['prix_sample'];
            $row['id_contenu'] = (int) $datas['id_contenu'];
            $row['date_creation'] = MySQLDBConnecter::unEscapeString($datas['date_creation_contenu']);
            $row['date_publication'] = MySQLDBConnecter::unEscapeString($datas['date_publication_contenu']);
            $row['titre'] = MySQLDBConnecter::unEscapeString($datas['titre_contenu']);
            $row['url'] = MySQLDBConnecter::unEscapeString($datas['url_contenu']);
            $row['isPublie'] = MySQLDBConnecter::unEscapeString($datas['publie_contenu']);
            $row['id_artiste_auteur'] = (int) $datas['id_artiste_auteur'];
            $result = new Sample($row);
            unset($datas);
            unset($row);
        }

        unset($query);

        MySQLDBConnecter::disconnect();

        return $result;

    }

    public function removeSample(Sample $sample)
    {
        if($sample == null)
            return false;

        MySQLDBConnecter::connect();

        $result = true;
        $id_sample = (int) ($sample->getId());
        $id_contenu = (int) ($sample->getIdContenu());
        $sql = "DELETE FROM Samples WHERE id_sample = ".$id_sample." AND id_contenu = ".$id_contenu;
        $query = MySQLDBConnecter::query($sql);

        if ($query != null)
        {
            $cont_adapter = new ContenuAdapter();
            $result = $cont_adapter->removeContenu($sample->getIdContenu());
        }else
        {
            $result = false;
        }

        unset($id_sample);
        unset($id_contenu);
        unset($sql);
        unset($query);
        MySQLDBConnecter::disconnect();

        return $result;
    }

    public function storeSample(Sample &$sample)
    {
        if($sample == null)
            return false;

        MySQLDBConnecterDB::connect();

        $result = true;
        $cont_adapter = new ContenuAdapter();

        $id_sample = (int) $sample->getId();
        $isInsertMode = (bool)( $this->getSample($id_sample) == null);
        $prix_sample = $sample->getPrix();
        $date_creation = $sample->getDateCreation();
        $date_publication = $sample->getDatePublication();
        $id_artiste_auteur = $sample->getIdArtisteAuteur();
        $titre = $sample->getTitre();
        $url = $sample->getURL();
        $isPublie = $sample->isPublie();
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
                $sql = "INSERT INTO Samples(`id_sample`,
                                            `prix_sample`,
                                           `id_contenu`)
                                    VALUES(NULL,
                                           ".$prix_sample.",
                                           ".$id_contenu.")";
                $query = MySQLDBConnecter::query($sql);
                $result = (bool) ($query != null);
                if($result != false)
                {
                    $query = MySQLDBConnecter::query("SELECT LAST_INSERT_ID() as dernier_id FROM Samples");
                    $datas = mysql_fetch_assoc($query);
                    $sample->setId((int) $datas['dernier_id']);
                    $sample->setIdContenu($id_contenu);
                    unset($datas);
                }
                unset($sql);
                unset($query);
            }
        }else
        {
            $cont->setIdContenu((int) $sample->getIdContenu());
            $result = ($cont_adapter->storeContenu($cont) != false);
            $id_contenu = (int) $cont->getIdContenu();
            if($result != false)
            {
                $sql = "UPDATE Samples SET `id_contenu` = ".$id_contenu.",
                                           `prix_sample` = ".$prix_sample."
                                      WHERE `id_sample` = ".$id_sample;
                $query = MySQLDBConnecter::query($sql);
                $result = (bool) ($query != null);
                if($result != false)
                {
                    $sample->setIdContenu($id_contenu);
                }
                unset($sql);
                unset($query);
            }
        }

        unset($cont_adapter);
        unset($isInsertMode);
        unset($id_sample);
        unset($prix_sample);
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