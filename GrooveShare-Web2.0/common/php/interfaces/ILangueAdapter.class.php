<?php
require_once(realpath(dirname(__FILE__)."/../model/")."/Langue.class.php");

interface ILangueAdapter 
{
    public function getLanguesList();
    public function getLangue($id);
    public function removeLangue(Langue $lang);
    public function storeLangue(Langue $lang);
}
?>
