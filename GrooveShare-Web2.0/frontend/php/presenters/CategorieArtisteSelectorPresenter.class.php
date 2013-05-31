<?php
require_once(realpath(dirname(__FILE__)."/../../../common/php/interfaces/")."/IPresenter.class.php");

class CategorieArtisteSelectorPresenter implements IPresenter
{
    private $allCategories = null;
    private $selectedIds = null;
    private $nbMaxCatPerRow = null;
    public function __construct(ArrayObject $allCategories, $selectedIds = array())
    {
        $this->allCategories = $allCategories;
        $this->selectedIds = $selectedIds;
        $this->nbMaxCatPerRow = 4;
    }

    public function generateHTML()
    {
        $html = "";
        $t = "\t\t\t\t\t\t\t";
        $currNbCatOnRow = 0;
        $tableRow = "";
        $isLastRowClosed = true;
        foreach($this->allCategories as $currCat)
        {
            $isLastRowClosed = false;
            $currId = (int) $currCat->getId();
            $tableRow .= "
            <td>
                <input type = 'checkbox'
                       name = 'id_categories[]'
                       value = '".$currId."'
                       id = 'categorie_".$currId."'
                       title = \"".$currCat->getNom()."\"".(in_array($currId, $this->selectedIds) ? " checked = 'checked' " : "")."/>
                ".$currCat->getNom()."
            </td>";

            if(($currNbCatOnRow + 1) % $this->nbMaxCatPerRow == 0)
            {
                $html .= "
                <tr>
                    $tableRow
                </tr>";
                $tableRow = "";
                $isLastRowClosed = true;
            }
            $currNbCatOnRow = ($currNbCatOnRow + 1) % $this->nbMaxCatPerRow;
        }

        if($isLastRowClosed == false && !empty($tableRow))
        {
            $html .= "
                <tr>
                    $tableRow
                </tr>";
        }

        if(!empty($html))
        {
            $html = "
            <br/><br/>
            <table>
                ".$html."
            </table>\n";
        }else
        {
            $html = "Aucune catégorie enregistrée.\n";
        }
        
        return $html;
    }

    public function generateJS()
    { return ""; }
}
?>
