<?php

require_once(realpath(dirname(__FILE__)."/../model/")."/Morceau.class.php");
require_once(realpath(dirname(__FILE__)."/../model/")."/StyleMusical.class.php");
require_once(realpath(dirname(__FILE__)."/../model/")."/Contenu.class.php");


interface IMorceauAdapter 
{
    public function getMorceauxList($startIndex = null, $nbRecs = null);
    public function getMorceau($id);
    public function getMorceauxListFromStyleMusique(StyleMusical $stm, $startIndex = null, $nbRecs = null);
    public function removeMorceau(Morceau $morc);
    public function storeMorceau(Morceau &$morc); 
}

?>
