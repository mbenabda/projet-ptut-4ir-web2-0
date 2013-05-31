<?php
require_once(realpath(dirname(__FILE__)."/../model/")."/Sample.class.php");
require_once(realpath(dirname(__FILE__)."/../model/")."/Artiste.class.php");
require_once(realpath(dirname(__FILE__)."/../model/")."/Contenu.class.php");

interface ISampleAdapter
{
    public function getSamplesList($startIndex = null, $nbRecs = null);
    public function getSamplesListForArtiste(Artiste $art, $startIndex = null, $nbRecs = null);
    public function getSample($id);
    public function removeSample(Sample $sample);
    public function storeSample(Sample &$sample);
    public function getSamplesCount();
}
?>