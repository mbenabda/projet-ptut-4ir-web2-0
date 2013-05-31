<?php
require_once(realpath(dirname(__FILE__)."/../../../common/php/interfaces/")."/IPresenter.class.php");
require_once(realpath(dirname(__FILE__)."/../../../common/php/model/")."/Compilation.class.php");

class CompilationThumbnailPresenter implements IPresenter
{
    private $compilation;
    private $play_list;
    private $path_to_covers_from_controlers;

    public function __construct($compilation/*, PlayList $play_list*/)
    {
        $this->compilation = $compilation;
        //$this->play_list = $play_list;

        $this->path_to_covers_from_controlers = "../common/images/covers_compilations/";
    }

    public function generateHTML()
    {
        if($this->compilation == null)
            return "";

        $comp = $this->compilation;
        
        $html = "
<li style='width: 800px; float: left; list-style: none outside none;'>
    <div class='left'>
        <img width='169' height='169' src='".$this->path_to_covers_from_controlers.$comp->getUrlCoverFront()."' alt = \"".$comp->getNom()."\">
    </div>
    <div class='right'>
        <div class='album'>
           ".$comp->getNom()."
        </div>
        <div class='band'>
            ".$comp->getDatePublication()."
        </div>
        <div class='compillist'>
            ".$comp->getDescription()."
        </div>
    </div>
</li>
";
        return $html;
    }

    public function generateJS()
    {
        return "";
    }
}
?>
