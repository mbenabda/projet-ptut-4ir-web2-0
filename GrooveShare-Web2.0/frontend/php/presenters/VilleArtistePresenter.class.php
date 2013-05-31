<?php
require_once(realpath(dirname(__FILE__)."/../../../common/php/interfaces/")."/IPresenter.class.php");

class VilleArtistePresenter implements IPresenter
{


    private $artiste;
    
 public function __construct($artiste)
    {
        $this->artiste = $artiste;

    }
    
public function generateHTML()
    {
      $art= $this->artiste;
      $html = $art->getVille();
      return $html;
      

    }

public function generateJS()
    { 
    return ""; 
    
    }
}
?>
