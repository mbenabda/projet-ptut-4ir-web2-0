<?php
require_once(realpath(dirname(__FILE__)."/../common/php/model/")."/Compilation.class.php");
require_once(realpath(dirname(__FILE__)."/../common/php/factories/")."/CompilationFactory.class.php");
require_once(realpath(dirname(__FILE__)."/php/presenters/")."/CompilationsCarrousselPresenter.class.php");

$factory_compilation = CompilationFactory::getInstance();
$comps_carroussel = $factory_compilation->getCompilationsList(0, 10);
if(count($comps_carroussel) > 0)
{
    $carroussel_compilations = new CompilationsCarrousselPresenter($comps_carroussel);
    echo $carroussel_compilations->generateHTML()."\n".$carroussel_compilations->generateJS();
}

?>
