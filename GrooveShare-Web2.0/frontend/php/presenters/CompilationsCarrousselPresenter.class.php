<?php
require_once(realpath(dirname(__FILE__)."/../../../common/php/interfaces/")."/IPresenter.class.php");
require_once(realpath(dirname(__FILE__)."/")."/CompilationThumbnailPresenter.class.php");


class CompilationsCarrousselPresenter implements IPresenter
{
    private $play_list;
    private $compils_list;
    private $nb_compils;
    private $nb_play_lists;

    public function __construct($compilations_list)/*, ArrayObject $play_list)*/
    {
        $this->compils_list = $compilations_list;

        $this->nb_compils = ($compilations_list == null ? 0 : count($this->compils_list));
        /*
        $this->play_list = $play_list;
        $this->nb_play_lists = ($play_list == null ? 0 : count($this->play_list));*/
    }
    
    
    public function generateHTML()
    {
        if( $this->nb_compils <= 0 /*|| $this->nb_play_lists <= 0*/ )
            return "";

        $c_list = $this->compils_list;
        //$p_list = $this->play_list;

        $html = "";
        $i = 0;

        while($i < $this->nb_compils)
        {
            $pres = new CompilationThumbnailPresenter($c_list[$i]/*, $p_list[$i]*/);
            $html .= $pres->generateHTML()."\n";
            $i++;
        }

       return "
<span class = 'titre_bloc'>Last Compil</span>
<div class='contenu_bloc'>
    <div class = 'wrap'>
        <div class = 'bx-wrapper' style = 'width: 950px; position: relative;'>
            <div class = 'bx-window' style = 'position: relative;width: 930px;height: 200px;overflow: hidden;'>
                <ul id = 'slider1'>
                    ".$html."
                </ul>
            </div>
        </div>
    </div>
</div>";
    }

    public function generateJS()
    {
        $js = "
        <script type = 'text/javascript'>
        //configuration du slider
        $(document).ready(function(){
            $('#slider1').bxSlider({
                auto: true
            });
        });
        </script>\n\n";

        if( $this->nb_compils > 0 && $this->nb_play_lists > 0 )
        {
            $c_list = $this->compils_list;
            $p_list = $this->play_list;

            $i = 0;

            while($i < $this->nb_compils)
            {
                $pres = new CompilationThumbnailPresenter($c_list[$i], $p_list[$i]);
                $js .= $pres->generateJS()."<br/>\n";
                $i++;
            }
        }

       return $js;
    }
}
?>
