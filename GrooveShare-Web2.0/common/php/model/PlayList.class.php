<?php

class PlayList
{
    private $play_list;
    private $curr_tab_id;

    public function __construct()
    {
        $this->play_list = array();
        $this->curr_tab_id = 0;
    }


    public function addMorceau(Artiste $art, Contenu $cont)
    {
        if( $art!= null && $cont != null )
        {
            $i = $this->curr_tab_id;

            $this->play_list[$i] = $art;
            $this->play_list[$i][$i] = $cont;

            $this->curr_tab_id = $i + 1;
        }
    }

    public function getItemsCount()
    {
        return ($this->curr_tab_id + 1);
    }

    public function getArtiste($item_no)
    {
        $tab = $this->play_list;
        return $tab[$item_no];
    }

    public function getContenu($item_no)
    {
        $tab = $this->play_list;
        return $tab[$item_no][$item_no];
    }
}
?>
