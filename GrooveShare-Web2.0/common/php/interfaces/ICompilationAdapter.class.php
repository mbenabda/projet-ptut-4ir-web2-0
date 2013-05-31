<?php

//TODO a verifier
require_once(realpath(dirname(__FILE__)."/../model/")."/Compilation.class.php");

interface ICompilationAdapter 
{
    public function getCompilationsList($startIndex, $nbRecs);
    public function getCompilation($id);
    public function removeCompilation(Compilation $rec);
    public function storeCompilation(Compilation &$rec);
    public function getCompilationsCount();
    public function getPlayListOfCompilation(Compilation $rec);
}



?>
