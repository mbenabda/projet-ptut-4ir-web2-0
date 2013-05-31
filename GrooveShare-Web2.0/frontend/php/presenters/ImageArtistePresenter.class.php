<?php

require_once(realpath(dirname(__FILE__)."/../../../common/php/interfaces/")."/IPresenter.class.php");

class ImageArtistePresenter 
{


    private $artiste;
    
 public function __construct($artiste)
    {
        $this->artiste = $artiste;

    }
    
public function generateHTML()
    {
      $art= $this->artiste;
      $html =  "<img src=\"".$art->getUrlAvatar()."\" width=\"75\" height=\"75\" alt=\"\" />";
      return $html;

    }

public function generateJS()
    { 
    return ""; 
    
    }
}
?>
