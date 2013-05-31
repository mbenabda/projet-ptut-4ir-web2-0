<?php
//isDebugMode() est définie dans config.php

require_once(realpath(dirname(__FILE__)."/../../interfaces/")."/INoteContenuAdapter.class.php");
require_once(realpath(dirname(__FILE__))."/MySQLDBConnecter.class.php");


class NoteContenuAdapter implements INoteContenuAdapter
{

    public function __construct() { }
    
    
    public function getNotesContenuListForContenu(Contenu $cont, $startIndex = null, $nbRecs = null)
    {
        $result = new ArrayObject();
        if($cont == null)
            return $result;

        $id_contenu = (int) $cont->getId();

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
            $row['id'] = (int) $datas['id_note_contenu'];
            $row['valeur_note_contenu'] = (int) $datas['valeur_note_contenu'];
            $row['date_note_contenu'] = MySQLDBConnecter::unEscapeString($datas['date_note_contenu']);
            $row['id_contenu'] = (int) $datas['id_contenu'];

            $result->append(new NoteContenu($row));
            unset($row);
        }

        unset($query);
        unset($datas);

        MySQLDBConnecter::disconnect();

        return $result;
    }

    public function getNoteContenu($id)
    {
        MySQLDBConnecter::connect();

        $id_note_contenu = (int) $id;
        $result = null;

        $sql = TODO;

        unset($id_note_contenu);

        $query = MySQLDBConnecter::query($sql);
        unset($sql);

        if(mysql_num_rows($query)>0)
        {
            $datas = mysql_fetch_assoc($query);
            $row = array();
            $row['id'] = (int) $datas['id_note_contenu'];
            $row['valeur_note_contenu'] = (int) $datas['valeur_note_contenu'];
            $row['date_note_contenu'] = MySQLDBConnecter::unEscapeString($datas['date_note_contenu']);
            $row['id_contenu'] = (int) $datas['id_contenu'];

          
            $result = new NoteContenu($row);
            unset($datas);
            unset($row);
        }

        unset($query);

        MySQLDBConnecter::disconnect();

        return $result;

    }

    public function removeNoteContenu(NoteContenu $noteContenu)
    {
        if($noteContenu == null)
            return false;

        MySQLDBConnecter::connect();

        $result = true;
        $id_note_contenu = (int) ($note_contenu->getId());
        
        $sql = "DELETE FROM note_contenu WHERE id_note_contenu = ".$id_note_contenu;
        $query = MySQLDBConnecter::query($sql);

  
        unset($id_note_contenu);
        unset($sql);
        unset($query);
        MySQLDBConnecter::disconnect();

        return $result;
    }

   public function storeNoteContenu(NoteContenu &$noteContenu)
    {
        if($noteContenu == null)
            return false;

        MySQLDBConnecterDB::connect();

        $result = true;

        $id_note_contenu = (int) $noteContenu->getId();
        $isInsertMode = (bool)( $this->getNoteContenu($id_note_contenu) == null);
       
        $date_note_contenu = $noteContenu->getDateNote();
        $valeur_note_contenu = $noteContenu->getValeurNote();
        $id_contenu = $noteContenu->getIdContenu();
        $id_personne = $noteContenu->getIdPersonne();
        
      //TODO sql
        
    }
}
?>
