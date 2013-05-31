<?php

require_once(realpath(dirname(__FILE__) . "/../../../common/php/interfaces/") . "/IPresenter.class.php");
require_once(realpath(dirname(__FILE__)."/../../../common/php/model/")."/Compilation.class.php");
require_once(realpath(dirname(__FILE__)."/../../../common/php/factories/")."/CompilationFactory.class.php");

class CompilesResultPresenter implements IPresenter {

    private $compils_list;
    private $nb_compils;
    private $path_to_covers_from_controlers;
    public function __construct($compilations_list) {
        $this->compils_list = $compilations_list;
        $this->nb_compils = ($compilations_list == null ? 0 : count($this->compils_list));
        $this->path_to_covers_from_controlers = "../common/images/covers_compilations/";
    }

    public function generateHTML() {
         if( $this->nb_compils <= 0 )
         return "";
        $c_list = $this->compils_list;
        
        $html = " ";
        $cpt=0;
        $i=0;
       
        while(($i<2)&&($cpt<$this->nb_compils)){
            $j=0;
            $html=$html."<div class='colcontainer'>";
            while(($j<3)&&($cpt<$this->nb_compils)){
                $compile=$c_list[$cpt];
                $elt="
                    
                        <div class='galeryelt'>
                                    <div class='eltthumb'>
                                        <a href='./compilation.php?id=".$compile->getId()."'>
                                            <img class='imglayer' src='".$this->path_to_covers_from_controlers.$compile->getUrlCoverFront()."'/>
                                            <div  class='star' data-rating='5'></div>
                                            <div class='mask'></div>
                                        </a>
                                    </div>
                                    <div class='eltdesc'>
                                        Title: <div class='title'>".$compile->getNom()."</div><br/>
                                        <!--Artist: <div class='artist'></div><br/>-->
                                        Publication: <div class='pubdate'>".$compile->getDatePublication()."</div><br/>
                                        Price: <div class='price'>".$compile->getPrix()."</div><br/>
                                       <!--Todo rajouter le reste des infos acessible-->
                                        <div class='social'>
                                            <a href='#' class='sbtn'>like</a>
                                            <a href='#' class='sbtn'>share</a>
                                            <div class='views'>12000 views</div>
                                        </div>
                                    </div>
                                </div>

                ";
                
                $html=$html.$elt;
                $j++;
                $cpt++;
            }
            $html=$html."</div>";
            $i++;
        }
        
        return "<div id='bloc_result' class='bloc'>
                    <span class='titre_bloc'>Results</span>
                    <div class='contenu_bloc'><div class='rescontainer'>".$html."</div></div>
                    </div>";
    }

    
    public function generateJS() {
        $html = "";
        return $html;
    }

    public function generateImportCSS(HTMLSkeletonGenerator &$html) {
        
    }

    public function generateImportJS(HTMLSkeletonGenerator &$html) {
       
    }

}
?> 

