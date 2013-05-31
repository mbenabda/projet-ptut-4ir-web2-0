<?php
//isDebugMode() est définie dans config.php

require_once(realpath(dirname(__FILE__)."/../../interfaces/")."/INoteArtisteAdapter.class.php");
require_once(realpath(dirname(__FILE__))."/MySQLDBConnecter.class.php");


class NoteArtisteAdapter implements INoteArtisteAdapter
{

    public function __construct() { }
    
    
    public function getNotesArtisteListForArtiste(Artiste $art, $startIndex = null, $nbRecs = null)
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

        $sql = TODO;
        unset($limit);

        $query = MySQLDBConnecter::query($sql); //Envoie une requête au serveur MySQL
        unset($sql);

        while($datas = mysql_fetch_assoc($query)) //Retourne une ligne de résultat MySQL sous la forme d'un tableau associatif, d'un tableau indexé, ou les deux
        {
            $row = array();
            $row['id'] = (int) $datas['id_note_artiste'];
            $row['valeur_note_artiste'] = (int) $datas['valeur_note_artiste'];
            $row['date_note_artiste'] = MySQLDBConnecter::unEscapeString($datas['date_note_artiste']);
            $row['id_artiste'] = (int) $datas['id_artiste'];

            $result->append(new NoteArtiste($row));
            unset($row);
        }

        unset($query);
        unset($datas);

        MySQLDBConnecter::disconnect();

        return $result;
    }

    public function getNoteArtiste($id)
    {
        MySQLDBConnecter::connect();

        $id_note_artiste = (int) $id;
        $result = null;

        $sql = TODO;

        unset($id_note_artiste);

        $query = MySQLDBConnecter::query($sql);
        unset($sql);

        if(mysql_num_rows($query)>0)
        {
            $datas = mysql_fetch_assoc($query);
            $row = array();
            $row['id'] = (int) $datas['id_note_artiste'];
            $row['valeur_note_artiste'] = (int) $datas['valeur_note_artiste'];
            $row['date_note_artiste'] = MySQLDBConnecter::unEscapeString($datas['date_note_artiste']);
            $row['id_artiste'] = (int) $datas['id_artiste'];

          
            $result = new NoteArtiste($row);
            unset($datas);
            unset($row);
        }

        unset($query);

        MySQLDBConnecter::disconnect();

        return $result;

    }

    public function removeNoteArtiste(NoteArtiste $noteArtiste)
    {
        if($noteArtiste == null)
            return false;

        MySQLDBConnecter::connect();

        $result = true;
        $id_note_artiste = (int) ($note_artiste->getId());
        
        $sql = "DELETE FROM note_artiste WHERE id_note_artiste = ".$id_note_artiste;
        $query = MySQLDBConnecter::query($sql);

  
        unset($id_note_artiste);
        unset($sql);
        unset($query);
        MySQLDBConnecter::disconnect();

        return $result;
    }

   public function storeNoteArtiste(NoteArtiste &$noteArtiste)
    {
        if($noteArtiste == null)
            return false;

        MySQLDBConnecterDB::connect();

        $result = true;

        $id_note_artiste = (int) $noteArtiste->getId();
        $isInsertMode = (bool)( $this->getNoteArtiste($id_note_artiste) == null);
       
        $date_note_artiste = $noteArtiste->getDateNote();
        $valeur_note_artiste = $noteArtiste->getValeurNote();
        $id_artiste = $noteArtiste->getIdArtiste();
        $id_personne = $noteArtiste->getIdPersonne();
        
      //TODO sql
        
    }
}
?>
