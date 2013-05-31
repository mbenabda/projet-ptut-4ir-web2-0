<?php
//JE NE L'AI PAS ENCORE TERMINE(MAGUETTE)
//TODO: Vérifier
require_once(realpath(dirname(__FILE__)."/../../interfaces/")."/ITraductionCategorieAdapter.class.php");
require_once(realpath(dirname(__FILE__))."/MySQLDBConnecter.class.php");


class TraductionCategorieAdapter //implements ITraductionCategorieAdapter 
{
    public function __construct() { }
    
    public function getTraductionCategorie($idCat,$idLan){
        
        MySQLDBConnecter::connect();
        $id_categorie = (int) $idCat;
        $id_categorie = (int) $idLan;
        $result = null;
        $sql = "SELECT * FROM traduction_categorie AS tc
                              INNER JOIN Categories AS t_categorie
                              ON tc.id_cat = t_cat.id_categorie
                              INNER JOIN langues AS t_lang
                              ON tc.id_lang = t_lang.id_langue
                         WHERE tc.id_categorie = .$id_categorie AND tc.id_langue =$idLan" ;
        unset($id_categorie);
        unset($id_langue);

        $query = MySQLDBConnecter::query($sql);
        unset($sql);

        if(mysql_num_rows($query) > 0)
        {
            $datas = mysql_fetch_assoc($query);
            $row = array();
            $row['idCat'] = (int) $datas['id_categorie'];
            $row['idLang'] = (int) $datas['id_langue'];
            $row['traduction_nom_categorie'] = MySQLDBConnecter::unEscapeString($datas['traduction_nom_categorie']);
           
            unset($row);
            unset($datas);
        }

        unset($query);

        MySQLDBConnecter::disconnect();

        return $result;
        
    }
    
    public function removeTraductionCategorie(TraductionCategorie $tra){
                
        if($rec == null)
            return false;

        MySQLDBConnecter::connect();
        $result = true;

             
        MySQLDBConnecter::connect();
        $result = true;
        $trad_nom_cat = $tra;
        $trad_check = $this->getTraductionCategorie((int)$tra->getIdCategorie());

        if($trad_check != null)
        {
            $sql = "DELETE FROM traduction_categorie WHERE traduction_nom_categorie = ".$trad_nom_cat;
            $query = MySQLDBConnecter::query($sql);
            $result = ($query != null);

            unset($sql);
            unset($query);
        }else
        {
            $result = false;
        }

        unset($trad_check);
        unset($trad_nom_cat);
        
        MySQLDBConnecter::disconnect();

        return $result;
    }
    
    public function storeTraductionCategorie(TraductionCategorie &$tra){
        if($tra == null)
            return false;
            
        MySQLDBConnecterDB::connect();

        $result = true;
        $id_categorie = (int)$tra->getIdCategorie();
        $isInsertMode = (bool) empty($id_categorie );

        $id_categorie = (int)($tra->getIdCategorie());
        $id_langue = (int)($tra->getIdLangue());
        $traduction_nom_categorie = MySQLDBConnecter::escapeString($tra->getTraductionNom());
        

        $sql = "";

        if($isInsertMode == true)  //pour savoir s'il ya un Id déjà dans l'objet qu'on veut mettre dans la base, si c'est true, ça veut dire qu'il n'y en a pas
        {
         $sql = "INSERT INTO traduction_categorie(`id_categorie`,
                                                  `id_langue`,
                                                  `traduction_nom_categorie`)
                                          
                                           VALUES('".$id_categorie."',
                                                  '".$id_langue."',
                                                  '".$traduction_nom_categorie.")";
         
            $query = MySQLDBConnecter::query($sql);
            $result = (bool) ($query != null);
        }
        

        unset($id_categorie);

        
        unset($nom_langue);
        unset($traduction_nom_categorie);
        
        unset($datas);
        unset($query);
        unset($sql);

        MySQLDBConnecter::disconnect();

        return $result;
    }
        
}

?>
