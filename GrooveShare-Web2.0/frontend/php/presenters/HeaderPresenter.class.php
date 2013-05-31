<?php
require_once(realpath(dirname(__FILE__)."/../../../common/php/interfaces/")."/IPresenter.class.php");
//require_once(realpath(dirname(__FILE__)."/")."/SignInBoxPresenter.class.php");
//require_once(realpath(dirname(__FILE__)."/")."/ComboBoxPresenter.class.php");

class HeaderPresenter implements IPresenter
{

    public function __construct()
    { }

    public function generateHTML()
    {
        //global $signInBox;
        //".$signInBox->generateHTML()."
        $html ="
            <div id='header'>
                <a href='index.php'>
                    <img  src='http://c.dryicons.com/images/icon_sets/colorful_stickers_icons_set/png/256x256/home.png'/>
                </a>
             <div id='container'>
                <div id='topnav' class='topnav'><a href='inscription.php'>S'inscrire</a> Ou <a href='./login.php' class='signin'><span>Se connecter</span></a> </div>
                <fieldset id='signin_menu'>
                    <form method='post' id='signin' action='./login.php'>
                        <p>
                            <label for='username'>Pseudonyme</label>
                            <input id='username' name='username' value='' title='username' tabindex='4' type='text'>
                        </p>
                        <p>
                            <label for='password'>Mot de passe</label>
                            <input id='password' name='password' value='' title='password' tabindex='5' type='password'>
                        </p>
                        <p class='remember'>
                            <input id='signin_submit' value='Connexion' tabindex='6' type='submit'>
                        </p>
                        ";
        /*
                       <p class='remember'>
                            <input id='signin_submit' value='Connexion' tabindex='6' type='submit'>
                            <input id='remember' name='remember_me' value='1' tabindex='7' type='checkbox'>
                            <label for='remember'>Se souvenir de moi</label>
                        </p>
                        <p class='forgot'> <a href='#' id='resend_password_link'>Forgot your password?</a> </p>
                        <p class='forgot-username'> <a id=forgot_username_link
                                                       title='If you remember your password, try logging in with your email'
                                                       href='#'>Forgot your username?</a> </p>
         */
        $html .= "
                    </form>
                </fieldset>
            </div>
            </div>
            <div id='bandeau'>";
        /*
                <div class='box'>
                    <select id='ui_element'>
                        <option value='A' selected>Compiles</option>
                        <option value='B'>Artistes</option>
                        <option value='C'>Samples</option>
                    </select>
                </div>
                <form class='searchform'>
                    <input class='searchfield' type='text' value='Search...' onfocus=\"if (this.value == 'Search...') {this.value = '';}' onblur='if (this.value == '') {this.value = 'Search...';}\" />
                    <input class='searchbutton' type='button' value='Go' />
                </form>
         */
         $html .= "
            </div>
            ";
        
        return $html;
    }

    public function generateJS()
    { return ""; }
}
?>