<?php
require_once(realpath(dirname(__FILE__)."/../../../common/php/interfaces/")."/IPresenter.class.php");

class PaysSelecorPresenter implements IPresenter
{
    private $paysList = null;
    private $selectedPaysID = null;
    public function __construct(ArrayObject $paysList, $selectedPaysID = '0')
    {
        $this->paysList = $paysList;
        $this->selectedPaysID = (int) $selectedPaysID;
    }

    public function generateHTML()
    {
        $t = "\t\t\t\t\t\t\t";
        $html = "";
        foreach($this->paysList as $currPays)
        {
            $currId = (int) $currPays->getId();
            $html .= "
            $t<option value = '$currId' ".(($this->selectedPaysID == $currId) ? "selected = 'selected' " : "").">".$currPays->getNom()."</option>";
        }
        if(empty($html))
        {
            $html = "Aucun pays enregistré.";
        }else
        {
        $html = "<select name = 'id_pays' id = 'id_pays'>
                $t<option value = '0'".(($this->selectedPaysID == 0) ? " selected = 'selected'" : "").">Selectionner un pays</option>".$html."
            $t</select>\n";
        }
        return $html;
    }

    public function generateJS()
    { return ""; }
}
?>
