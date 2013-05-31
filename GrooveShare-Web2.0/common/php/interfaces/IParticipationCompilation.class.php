<?php
//TODO Participationcompilationadapter a faire...............
require_once(realpath(dirname(__FILE__)."/../model/")."/Compilation.class.php");
require_once(realpath(dirname(__FILE__)."/../model/")."/Morceau.class.php");
require_once(realpath(dirname(__FILE__)."/../model/")."/ParticipationCompilation.class.php");


interface IParticipationCompilation 
{
    //public function getParticipationCompilationList($startIndex = null, $nbRecs = null);
    public function getParticipationCompilation($id);
    public function getParticipationCompilationListFromMorceau(Morceau $morc, $startIndex = null, $nbRecs = null);
    public function getParticipationCompilationListFromCompilation(Compilation $comp, $startIndex = null, $nbRecs = null);
    public function removeParticipationCompilation(ParticipationCompilation $part);
    public function storeParticipationCompilation(ParticipationCompilation &$part);    
}

?>
