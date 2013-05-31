<?php

require_once(realpath(dirname(__FILE__)."/../../../common/php/interfaces/")."/IPresenter.class.php");

class NomArtistePresenter 
{


    private $artiste;
    
 public function __construct($artiste)
    {
        $this->artiste = $artiste;

    }
    
public function generateHTML()
    {
      $art= $this->artiste;
      $html = $art->getNom();
      return $html;
      

    }

public function generateJS()
    { 
    return ""; 
    
    }
}
?>
