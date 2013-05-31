<?php
//TODO a verifier
require_once(realpath(dirname(__FILE__)."/../../interfaces/")."/ICompilationAdapter.class.php");
require_once(realpath(dirname(__FILE__))."/MySQLDBConnecter.class.php");


class CompilationAdapter implements ICompilationAdapter {
      
    public function __construct() { }
    
    public function getCompilationsList($startIndex = null, $nbRecs  = null) {
            
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
        $sql = "SELECT * FROM Compilations ".$limit;

        unset($limit);  //pour vider la mémoire qui correspond à la variable $limit

        $query = MySQLDBConnecter::query($sql);
        unset($sql);

        $result = new ArrayObject();
    
        while($datas = mysql_fetch_assoc($query)){ 
            
            $row = array();
            $row['id'] = (int) $datas['id_compilation'];
            $row['nom'] = MySQLDBConnecter::unEscapeString($datas['nom_compilation']);
            $row['prix'] = (int) $datas['prix_compilation'];
            $row['url_cover_front'] = MySQLDBConnecter::unEscapeString($datas['url_cover_front_compilation']);
            $row['url_cover_back'] = MySQLDBConnecter::unEscapeString($datas['url_cover_back_compilation']);
            $row['description'] = MySQLDBConnecter::unEscapeString($datas['description_compilation']);
            $row['date_creation'] = MySQLDBConnecter::unEscapeString($datas['date_creation_compilation']);
            $row['date_publication'] = MySQLDBConnecter::unEscapeString($datas['date_publication_compilation']);
            $row['isPublie'] = MySQLDBConnecter::unEscapeString($datas['publie_compilation']);
            $row['id_admin'] = (int) $datas['id_admin_responsable'];       
            $result->append(new Compilation($row));
            unset($row);
        }
        unset($query);
        unset($datas);

        MySQLDBConnecter::disconnect();

        return $result;
    }

    public function getCompilationsCount()
    {
        MySQLDBConnecter::connect();
        $result = 0;

        $sql = "SELECT COUNT(id_compilation) AS nb_compils FROM Compilations";

        $query = MySQLDBConnecter::query($sql);
        unset($sql);

        $datas = mysql_fetch_assoc($query);

        $result = (int)$datas['nb_compils'];

        unset($query);
        unset($datas);

        MySQLDBConnecter::disconnect();

        return $result;
    }

    public function getCompilation($id) {
        
        MySQLDBConnecter::connect();
        $id_compilation = (int) $id;
        $result = null;
        
        $sql = "SELECT FROM Compilations
                       WHERE id_compilation =" .$id_compilation;
        unset ($id_compilation);
        
        $query = MySQLDBConnecter::query($sql);
        unset($sql);
        
        if(mysql_num_rows($query) > 0)
        {
            $datas = mysql_fetch_assoc($query);
            $row = array();
            $row['id'] = (int) $datas['id_compilation'];
            $row['nom'] = MySQLDBConnecter::unEscapeString($datas['nom_compilation']);
            $row['prix'] = (int) $datas['prix_compilation'];
            $row['url_cover_front'] = MySQLDBConnecter::unEscapeString($datas['url_cover_front_compilation']);
            $row['url_cover_back'] = MySQLDBConnecter::unEscapeString($datas['url_cover_back_compilation']);
            $row['description'] = MySQLDBConnecter::unEscapeString($datas['description_compilation']);
            $row['date_creation'] = MySQLDBConnecter::unEscapeString($datas[' date_creation_compilation']);
            $row['date_publication'] = MySQLDBConnecter::unEscapeString($datas[' date_publication_compilation']);
            $row['isPublie'] = MySQLDBConnecter::unEscapeString($datas[' publie_compilation']);
            $row['id_admin'] = (int) $datas['id_admin_responsable'];       
            $result = new Compilation($row);
            unset($row);
            unset($datas);
        }
        unset($query);

        MySQLDBConnecter::disconnect();

        return $result;
    }
    
    public function removeCompilation(Compilation $rec) 
    {
       
        if($rec == null)
            return false;
            
        MySQLDBConnecter::connect();
        $result = true;
        $id_compilation = (int)$rec->getId();
        $comp_check = $this->getCompilation($id_compilation);

        if($comp_check != null)
        {
            $sql = "DELETE FROM Compilations WHERE id_compilation = ".$id_compilation;
            $query = MySQLDBConnecter::query($sql);
            $result = ($query != null);

            unset($sql);
            unset($query);
        }else
        {
            $result = false;
        }

        unset($comp_check);
        unset($id_compilation);
        
        MySQLDBConnecter::disconnect();

        return $result;
    }
    
    public function storeCompilation(Compilation &$rec) 
    {
        
            if($rec == null)
            return false;
            
        MySQLDBConnecterDB::connect();

        $result = true;
        $id_compilation = (int)$rec->getId();
        $isInsertMode = (bool) empty($id_compilation);

        $nom_compilation = MySQLDBConnecter::escapeString($rec->getNom());
        $prix_compilation = (int) ($rec->getPrix());
        $url_cover_front_compilation = MySQLDBConnecter::escapeString($rec->getUrlCoverFront());
        $url_cover_back_compilation = MySQLDBConnecter::escapeString($rec->getUrlCoverBack());
        $description_compilation = MySQLDBConnecter::escapeString($rec->getDescription());
        $date_creation_compilation = MySQLDBConnecter::escapeString($rec->getDateCreation());
        $date_publication_compilation = MySQLDBConnecter::escapeString($rec->getDatePublication());
        $publie_compilation = MySQLDBConnecter::escapeString($rec->isPublie());
        $id_admin_responsable = (int) $rec->getIdAdminResponsable();

        $sql = "";

        if($isInsertMode == true)  //pour savoir s'il ya un Id déjà dans l'objet qu'on veut mettre dans la base, si c'est true, ça veut dire qu'il n'y en a pas
        {
         $sql = "INSERT INTO Compilations(`id_compilation`,
                                          `nom_compilation`,
                                          `prix_compilation`,
                                          `url_cover_front_compilation`,
                                          `url_cover_back_compilation`,
                                          `description_compilation`,
                                          `date_creation_compilation`,
                                          `date_publication_compilation`,
                                          `publie_compilation`,
                                          `id_admin_responsable`)
                                          
                                VALUES(NULL,
                                        '".$nom_compilation."',
                                        '".$prix_compilation."',
                                        '".$url_cover_front_compilation."',
                                        '".$url_cover_back_compilation."',
                                        '".$description_compilation."',
                                        '".$date_creation_compilation."',
                                        '".$date_publication_compilation."',
                                        '".$publie_compilation."',
                                        ".$id_admin_responsable.")";
         
            $query = MySQLDBConnecter::query($sql);
            $result = (bool) ($query != null);
        }
        else
        {
            $comp_check = $this->getCompilation($id_compilation);

            if($comp_check != null)
            {
                $sql = "UPDATE Compilations SET `nom_compilation = '".$nom_compilation."',
                                             `prix_compilation`  = '".$prix_compilation."',
                                             `url_cover_front_compilation` = '".$url_cover_front_compilation."',
                                             `url_cover_back_compilation` = '".$url_cover_back_compilation."',
                                             `description_compilation` = '".$description_compilation."',
                                             `date_creation_compilation` = '".$date_creation_compilation."',
                                             `date_publication_compilation` = '".$date_publication_compilation."',
                                             `publie_compilation` = '".$publie_compilation."',
                                             `id_admin_responsable` = '".$id_admin_responsable."',
                                       WHERE `id_compilation` = ".$id_compilation;
                $query = MySQLDBConnecter::query($sql);
                $result = (bool) ($query != null);
            }else
            {
                $result = false;
            }
        }

        unset($id_compilation);

        
        unset($nom_compilation);
        unset($prix_compilation);
        unset($url_cover_front_compilation);
        unset($url_cover_back_compilation);
        unset($description_compilation);
        unset($date_creation_compilation);
        unset($date_publication_compilation);        
        unset($publie_compilation);
        unset($id_admin_responsable);


        $datas = "";
        if($isInsertMode && $result != false)
        {
            $query = MySQLDBConnecter::query("SELECT LAST_INSERT_ID() as dernier_id FROM Compilations");
            if($query != null)
            {
                $datas = mysql_fetch_assoc($query);
                $rec->setId((int) $datas['dernier_id']);
            }
        }

        unset($datas);
        unset($query);
        unset($sql);

        MySQLDBConnecter::disconnect();

        return $result;
    }



    public function getPlayListOfCompilation(Compilation $rec)
    {
        $_id = (int) $rec->getId();
        if($rec == null || empty($_id) )
            return null;

        MySQLDBConnecter::connect();

        $sql = "SELECT DISTINCT t_art.id_artiste AS id_art,
                                t_mor.id_contenu AS id_cont
                FROM participation_compilation AS t_pcomp,
                     Compilations AS t_comp,
                     Artistes AS t_art,
                     Morceaux AS t_mor,
                     Contenus AS t_cont
                WHERE t_comp.id_compilation = ".((int)$rec->getId())."
                AND t_pcomp.id_compilation = t_comp.id_compilation
                AND t_pcomp.id_morceau = t_mor.id_morceau
                AND t_mor.id_morceau = t_cont.id_contenu
                AND t_cont.publie_contenu = 1
                AND t_cont.id_artiste_auteur = t_art.id_artiste
";

        $query = MySQLDBConnecter::query($sql);
        unset($sql);

        $result = array();
        $i = 0;

        while($datas = mysql_fetch_assoc($query))
        {
            $art = (int) $datas['id_art'];
            $cont = (int) $datas['id_cont'];

            $result[$i] = $art;
            $result[$i][$i] = $cont;

            $i++;
        }

        unset($query);
        unset($datas);

        MySQLDBConnecter::disconnect();

        return $result;
    }
}

?>
