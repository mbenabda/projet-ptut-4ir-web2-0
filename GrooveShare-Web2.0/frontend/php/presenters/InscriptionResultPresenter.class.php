<?php
require_once(realpath(dirname(__FILE__)."/../../../common/php/interfaces/")."/IPresenter.class.php");


class InscriptionResultPresenter implements IPresenter
{
    private $inscriptionErrorsArray = null;

    public function __construct($inscriptionErrorsArray)
    {
        $this->inscriptionErrorsArray = $inscriptionErrorsArray;
    }

    public function generateHTML()
    {
        $tabErrs = $this->inscriptionErrorsArray;
        $html = "";
        $errsHTML = "";

        if(is_array($tabErrs))
        {
            if(count($tabErrs) > 0)
            {
                $errsHTML = implode("<br/>\n", $tabErrs);
            }
            else
            {
                $errsHTML = "Tout s'est bien passé";
            }
        }

        $html = "
        <br/>
        <div id = 'bloc_resultat_inscription' class = 'bloc'>
            <span class = 'titre_bloc'>RESULTAT DE L'INSCRIPTION</span>
            <section class = 'contenu_bloc'>
                ".$errsHTML."
            </section>
        </div>";
        return $html;
    }

    public function generateJS()
    {
        return "";
    }
    
}
?>