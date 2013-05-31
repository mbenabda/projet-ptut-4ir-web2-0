<?php
//isDebugMode() est définie dans config.php

require_once(realpath(dirname(__FILE__)."/../../interfaces/")."/ICategorieArtisteAdapter.class.php");
require_once(realpath(dirname(__FILE__))."/MySQLDBConnecter.class.php");
require_once(realpath(dirname(__FILE__)."/")."/ArtisteAdapter.class.php");
require_once(realpath(dirname(__FILE__)."/")."/CategorieAdapter.class.php");

class CategorieArtisteAdapter implements ICategorieArtisteAdapter
{
    public function __construct() { }

    public function getCategorieArtistesList()
    {
        MySQLDBConnecter::connect();

        $sql = "SELECT * FROM categorie_artiste ";

        $query = MySQLDBConnecter::query($sql); //Envoie une requête au serveur MySQL
        unset($sql);

        $result = new ArrayObject();

        while($datas = mysql_fetch_assoc($query)) //Retourne une ligne de résultat MySQL sous la forme d'un tableau associatif, d'un tableau indexé, ou les deux
        {
            $row = array();
            $row['id_artiste'] = (int) $datas['id_artiste'];
            $row['id_categorie'] = (int) $datas['id_categorie'];
            $result->append(new Categorie($row));
            unset($row);
        }

        unset($query);
        unset($datas);

        MySQLDBConnecter::disconnect();

        return $result;
    }
    
    public function getCategoriesListByArtiste(Artiste $art)
    {
        $result = new ArrayObject();
        if($art == null)
            return $result;
            
        MySQLDBConnecter::connect();
        $id_artiste = (int) ($art->getId());
        $sql = "SELECT id_categorie FROM categorie_artiste WHERE id_artiste = ".$id_artiste ;
        unset($id_artiste);

        $query = MySQLDBConnecter::query($sql);
        unset($sql);

        $adapt = new CategorieAdapter();
        
        while($datas = mysql_fetch_assoc($query))
        {
            $curr =  $adapt->getCategorie($datas['id_categorie']);
            if($curr != null)
                $result->append($curr);
            unset($curr);
        }
        unset($adapt);
        unset($datas);
        unset($query);
        
        MySQLDBConnecter::disconnect();

        return $result;
    }
    
    public function getArtistesListByCategorie(Categorie $cat)
    {
        $result = new ArrayObject();
        if($cat == null)
            return $result;
            
        MySQLDBConnecter::connect();
        
        $id_categorie = (int) ($cat->getId());
       
        $sql = "SELECT id_artiste FROM categorie_artiste WHERE id_categorie = ".$id_categorie ;
        unset($id_categorie);

        $query = MySQLDBConnecter::query($sql);
        unset($sql);

        $adapt = new ArtisteAdapter();

        while($datas = mysql_fetch_assoc($query))
        {
            $curr =  $adapt->getArtiste($datas['id_artiste']);
            if($curr != null)
                $result->append($curr);
            unset($curr);
        }
        unset($adapt);
        unset($datas);
        unset($query);
        
        MySQLDBConnecter::disconnect();

        return $result;
    }
    
    public function removeCategorieForArtiste(Artiste $art,Categorie $cat)
    {
        if($art == null || $cat == null)
            return false;

        MySQLDBConnecter::connect();

        $result = true;
        $id_categorie = (int) ($cat->getId());
        $id_artiste = (int) ($art->getId());
        $sql = "SELECT id_categorie FROM categorie_artiste WHERE id_artiste = ".$id_artiste." AND id_categorie = ".$id_categorie;

        $query = MySQLDBConnecter::query($sql);

        if (mysql_num_rows($query) > 0)
        {
            $sql = "DELETE FROM categorie_artiste WHERE id_artiste = ".$id_artiste." AND id_categorie = ".$id_categorie;
            $query = MySQLDBConnecter::query($sql);
        }else
        {
            $result = false;
        }

        unset($id_artiste);
        unset($id_categorie);
        unset($sql);
        unset($query);
        MySQLDBConnecter::disconnect();

        return $result;
    }
   
    
    public function storeCategorieForArtiste(Artiste $art,Categorie $cat)
    {
        if($art == null || $cat == null)
            return false;
            
        MySQLDBConnecter::connect();
        
        $result = false;
        $doQuery = true;
        $id_artiste = (int) $art->getId();
        $id_categorie =  (int) $cat->getId();
        $art_adapter = new ArtisteAdapter();
        $cat_adapter = new CategorieAdapter();
        $art_check = $art_adapter->getArtiste($id_artiste);
        $cat_check = $cat_adapter->getCategorie($id_categorie);

        unset($art_adapter);
        unset($cat_adapter);

        if($art_check == null)
        {
            throw new QueryException("storeCategorieForArtiste: specified Artiste doesn't exist.");
            $doQuery = false;
        }
        unset($art_check);

        if($cat_check == null)
        {
            throw new QueryException("storeCategorieForArtiste: specified Categorie doesn't exist.");
            $doQuery = false;
        }
        unset($cat_check);

        if($doQuery)
        {
            $sql = "INSERT INTO categorie_artiste(`id_artiste`,
                                                  `id_categorie`)
                                            VALUES(".$id_artiste.",
                                                   ".$id_categorie.")";
            $query = MySQLDBConnecter::query($sql);
            unset($sql);
            $result = (bool)(mysql_affected_rows() > 0);
            unset($query);
        }
        
        unset($id_categorie);
        unset($id_artiste);
        unset($doQuery);

        MySQLDBConnecter::disconnect();

        return $result;
    }


    public function resetCategoriesForArtiste(Artiste $rec)
    {
        if($rec == null)
            return false;

        MySQLDBConnecter::connect();
        $result = true;
        $id_art = (int) $rec->getId();
        $art_adapt = new ArtisteAdapter();
        $art_check = $art_adapt->getArtiste($id_art);

        if(!empty($art_check))
        {
            $sql = "DELETE FROM categorie_artiste WHERE id_artiste = ".$id_art;
            $query = MySQLDBConnecter::query($sql);
            unset($sql);
        }else
        {
            $result = false;
        }
        unset($id_art);
        unset($art_adapt);
        unset($art_check);
        unset($query);

        MySQLDBConnecter::disconnect();

        return $result;
    }
}
?>