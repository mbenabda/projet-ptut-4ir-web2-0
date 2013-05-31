<?php

/*
 * codé par fadi
 * todo review this
 */

require_once(realpath(dirname(__FILE__) . "/../../interfaces/") . "/INoteNewsAdapter.class.php");
require_once(realpath(dirname(__FILE__) . "/") . "/NoteNewsAdapter.class.php");
require_once(realpath(dirname(__FILE__)) . "/MySQLDBConnecter.class.php");

class NoteNewsAdapter implements INoteNewsAdapter {

    public function __construct() {
        
    }

    public function getNoteNews($id) {
        MySQLDBConnecter::connect();
        $id_note_news = (int) $id;
        $result = null;
        $sql = "SELECT * FROM note_news AS t
                         WHERE t.id_note_news = " . $id_note_news; //TODO verifier requete sql
        unset($id_note_news);

        $query = MySQLDBConnecter::query($sql);
        unset($sql);

        if (mysql_num_rows($query) > 0) {
            $datas = mysql_fetch_assoc($query);
            $row = array();
            $row['id_note_news'] = (int) $datas['id_note_news'];
            $row['id_personne'] = (int) $datas['id_personne'];
            $row['id_news'] = (int) $datas['id_news'];
            $row['date_note_news'] = MySQLDBConnecter::unEscapeString($datas['date_note_news']);
            $row['valeur_note_news'] = (int) $datas['valeur_note_news'];
            $result = new CommentaireContenu($row);
            unset($row);
            unset($datas);
        }
        unset($query);
        MySQLDBConnecter::disconnect();
        return $result;
    }

    public function getNoteNewsList($startIndex = null, $nbRecs = null) {
        MySQLDBConnecter::connect();
        $limit = "";
        if ($nbRecs != null) {
            $limit = " LIMIT ";

            if ($startIndex != null) {
                $limit .= ((int) $startIndex) . ", ";
            }

            $limit .= ((int) $nbRecs) . " ";
        }

        $sql = "SELECT * FROM note_news AS t" . $limit; //TODO verifier requete SQL
        unset($limit);

        $query = MySQLDBConnecter::query($sql); //Envoie une requête au serveur MySQL
        unset($sql);

        $result = new ArrayObject();

        while ($datas = mysql_fetch_assoc($query)) { //Retourne une ligne de résultat MySQL sous la forme d'un tableau associatif, d'un tableau indexé, ou les deux
            $row = array();
            $row['id_note_news'] = (int) $datas['id_note_news'];
            $row['id_personne'] = (int) $datas['id_personne'];
            $row['id_news'] = (int) $datas['id_news'];
            $row['date_note_news'] = MySQLDBConnecter::unEscapeString($datas['date_note_news']);
            $row['valeur_note_news'] = (int) $datas['valeur_note_news'];
            $result->append(new CommentaireContenu($row));
            unset($row);
        }

        unset($query);
        unset($datas);
        MySQLDBConnecter::disconnect();
        return $result;
    }

    public function removeNoteNews(NoteNews $rec) {
        if ($rec == null)
            return false;

        MySQLDBConnecter::connect();
        $result = true;

        $id_note_news = (int) ($rec->getId());
        $sql = "DELETE FROM note_news WHERE id_note_news = " . $id_note_news;
        $query = MySQLDBConnecter::query($sql);
        unset($id_note_news);
        unset($sql);
        unset($query);
        MySQLDBConnecter::disconnect();
        return $result;
    }

    public function storeNoteNews(NoteNews &$rec) {
        if ($rec == null)
            return false;

        MySQLDBConnecter::connect();
        $result = true;


        $id_note_news = (int) $rec->getId();
        $id_personne = (int) $rec->getIdPersonne();
        $id_news = (int) $rec->getIdNews();
        $date_note_news = MySQLDBConnecter::escapeString($rec->getDateNote());
        $valeur_note_news = MySQLDBConnecter::escapeString($rec->getValeurNote());

        if ($isInsertMode) {  //pour savoir s'il ya un Id déjà dans l'objet qu'on veut mettre dans la base, si c'est true, ça veut dire qu'il n'y en a pas
            $sql = "INSERT INTO commentaire_contenu(`id_note_news`,
                                            `id_personne`,
                                            `id_news`,
                                            `date_note_news`,
                                            `valeur_note_news`)
                                    VALUES(NULL,
                                           " . $id_personne . ",
                                           " . $id_news . ",
                                           " . $date_note_news . ",
                                           " . $valeur_note_news . ")";
            $query = MySQLDBConnecter::query($sql);
            $result = (bool) ($query != null);
            if ($result != false) {
                $query = MySQLDBConnecter::query("SELECT LAST_INSERT_ID() as dernier_id FROM note_news");
                $datas = mysql_fetch_assoc($query);
                $rec->setId((int) $datas['dernier_id']);
                unset($datas);
            }
            unset($sql);
            unset($query);
        } else {
            $sql = "UPDATE note_news SET `id_personne` = " . $id_personne . ",
                                            `id_news` = " . $id_news . ",
                                             `date_note_news` = " . $date_note_news . ",
                                             `valeur_note_news` = " . $valeur_note_news . "
                                       WHERE `id_note_news` = " . $id_note_news;
            $query = MySQLDBConnecter::query($sql);
            $result = (bool) ($query != null);

            unset($sql);
            unset($query);
        }


        unset($id_note_news);
        unset($id_personne);
        unset($date_note_news);
        unset($id_news);
        unset ($valeur_note_news);
        unset($isInsertMode);
        MySQLDBConnecter::disconnect();

        return $result;
    }

}

?>
