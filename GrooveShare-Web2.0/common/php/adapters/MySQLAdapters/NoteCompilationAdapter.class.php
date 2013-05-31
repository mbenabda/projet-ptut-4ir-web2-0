<?php
//isDebugMode() est définie dans config.php

require_once(realpath(dirname(__FILE__)."/../../interfaces/")."/INoteCompilationAdapter.class.php");
require_once(realpath(dirname(__FILE__))."/MySQLDBConnecter.class.php");


class NoteCompilationAdapter implements INoteCompilationAdapter
{

    public function __construct() { }
    
    
    public function getNotesCompilationListForCompilation(Compilation $comp, $startIndex = null, $nbRecs = null)
    {
        $result = new ArrayObject();
        if($comp == null)
            return $result;

        $id_compilation = (int) $comp->getId();

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
            $row['id'] = (int) $datas['id_note_compilation'];
            $row['valeur_note_compilation'] = (int) $datas['valeur_note_compilation'];
            $row['date_note_compilation'] = MySQLDBConnecter::unEscapeString($datas['date_note_compilation']);
            $row['id_compilation'] = (int) $datas['id_compilation'];

            $result->append(new NoteCompilation($row));
            unset($row);
        }

        unset($query);
        unset($datas);

        MySQLDBConnecter::disconnect();

        return $result;
    }

    public function getNoteCompilation($id)
    {
        MySQLDBConnecter::connect();

        $id_note_compilation = (int) $id;
        $result = null;

        $sql = TODO;

        unset($id_note_compilation);

        $query = MySQLDBConnecter::query($sql);
        unset($sql);

        if(mysql_num_rows($query)>0)
        {
            $datas = mysql_fetch_assoc($query);
            $row = array();
            $row['id'] = (int) $datas['id_note_compilation'];
            $row['valeur_note_compilation'] = (int) $datas['valeur_note_compilation'];
            $row['date_note_compilation'] = MySQLDBConnecter::unEscapeString($datas['date_note_compilation']);
            $row['id_compilation'] = (int) $datas['id_compilation'];

          
            $result = new NoteCompilation($row);
            unset($datas);
            unset($row);
        }

        unset($query);

        MySQLDBConnecter::disconnect();

        return $result;

    }

    public function removeNoteCompilation(NoteCompilation $noteCompilation)
    {
        if($noteCompilation == null)
            return false;

        MySQLDBConnecter::connect();

        $result = true;
        $id_note_compilation = (int) ($note_compilation->getId());
        
        $sql = "DELETE FROM note_compilation WHERE id_note_compilation = ".$id_note_compilatione;
        $query = MySQLDBConnecter::query($sql);

  
        unset($id_note_compilation);
        unset($sql);
        unset($query);
        MySQLDBConnecter::disconnect();

        return $result;
    }

   public function storeNoteCompilation(NoteCompilation $noteCompilation)
    {
        if($noteCompilation == null)
            return false;

        MySQLDBConnecterDB::connect();

        $result = true;

        $id_note_compilation = (int) $noteCompilation->getId();
        $isInsertMode = (bool)( $this->getNoteCompilation($id_note_compilation) == null);
       
        $date_note_compilation = $noteCompilation->getDateNote();
        $valeur_note_compilation = $noteCompilation->getValeurNote();
        $id_compilation = $noteCompilation->getIdCompilation();
 
        
      //TODO sql
        
    }
}
?>
