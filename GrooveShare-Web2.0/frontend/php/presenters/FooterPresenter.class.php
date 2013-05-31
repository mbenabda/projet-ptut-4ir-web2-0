<?php
require_once(realpath(dirname(__FILE__)."/../../../common/php/interfaces/")."/IPresenter.class.php");

class FooterPresenter implements IPresenter
{

    public function __construct()
    {}

    public function generateHTML()
    {
        $html = "
            <!--###############################################################################################-->   
            <div id=\"footer\" style=\"text-align: center; color: #ffffff\">
                © WEB 2.0 TEAM INSA 2012.
                <a style=\"text-decoration: none; color: #42596d\" href='mailto&#58;&#102;%6&#53;di%74&#110;&#64;v&#111;ia&#108;&#46;&#102;r'>Contact Admin</a>
            </div>
        ";
        return $html;
    }

    public function generateJS()
    { return ""; }
}
?>