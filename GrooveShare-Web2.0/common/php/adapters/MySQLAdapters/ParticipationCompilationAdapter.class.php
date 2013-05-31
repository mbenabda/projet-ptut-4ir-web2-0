<?php 
/*
require_once(realpath(dirname(__FILE__)."/../../interfaces/")."/IParticipationCompilation.class.php");
require_once(realpath(dirname(__FILE__))."/MySQLDBConnecter.class.php");


class ParticipationCompilationAdapter implements IParticipationCompilation
{
    public function __construct() { }
    
    public function getParticipationCompilation($id)
    {
        MySQLDBConnecter::connect();

        $id_part     = (int) $id;
        $result = null;

        $sql = "SELECT * FROM Morceaux AS l
                              INNER JOIN Styles_musicaux AS l_style_musique
                              ON l.id_style_musique = l_style_musique.id_style_musique
                              INNER JOIN Contenus AS l_contenu
                              ON l.id_contenu = l_contenu.id_contenu
                         WHERE l.id_morceau = ".$id_morceau;

        unset($id_morceau);

        $query = MySQLDBConnecter::query($sql);
        unset($sql);

        if(mysql_num_rows($query)>0)
        {
            $datas = mysql_fetch_assoc($query);
            $row = array();
            $row['id'] = (int) $datas['id_morceau'];
            $row['isdlmorceau'] = MySQLDBConnecter::unEscapeString($datas['dl_possible_morceau']);
            $row['id_contenu'] = (int) $datas['id_contenu'];
            $row['id_style_musique'] = (int) $datas['id_style_musique'];
            $result = new Morceau($row);
            unset($datas);
            unset($row);
        }

        unset($query);

        MySQLDBConnecter::disconnect();

        return $result;

    }
}
*/
?>
