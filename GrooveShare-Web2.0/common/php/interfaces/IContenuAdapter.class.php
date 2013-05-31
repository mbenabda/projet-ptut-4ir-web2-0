<?php
require_once(realpath(dirname(__FILE__)."/../model/")."/Contenu.class.php");

interface IContenuAdapter 
{
    public function getContenu($id);
    public function removeContenu(Contenu $cont);
    public function storeContenu(Contenu &$cont);
}

?>
