<?php
require_once(realpath(dirname(__FILE__)."/../model/")."/Pays.class.php");

interface IPaysAdapter 
{
    public function getPaysList();
    public function getPays($id);
    public function removePays(Pays $pays);
    public function storePays(Pays $pays);
}
?>
