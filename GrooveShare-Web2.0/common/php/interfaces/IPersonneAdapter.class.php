<?php
require_once(realpath(dirname(__FILE__)."/../model/")."/Personne.class.php");

interface IPersonneAdapter
{
    public function getPersonne($id);
    public function removePersonne(Personne $pers);
    public function storePersonne(Personne &$pers);
    public function isRegisteredEmail($email);
    public function isRegisteredLogin($login);
}
?>
