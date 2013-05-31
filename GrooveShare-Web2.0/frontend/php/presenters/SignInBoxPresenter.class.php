<?php

require_once(realpath(dirname(__FILE__) . "/../../../common/php/interfaces/") . "/IPresenter.class.php");

class SignInBoxPresenter implements IPresenter {

    public function __construct() {
        
    }

    public function generateHTML() {
        $html = "                <div id='topnav' class='topnav'><a href='inscription.php'>Subscribe</a> Or Already have an account? <a href='../../login.php' class='signin'><span>Sign in</span></a> </div>
                    <fieldset id='signin_menu'>
                        <form method='post' id='signin' action=''>
                            <p>
                                <label for='username'>Username or email</label>
                                <input id='username' name='username' value='' title='username' tabindex='4' type='text'>
                            </p>
                            <p>
                                <label for='password'>Password</label>
                                <input id='password' name='password' value='' title='password' tabindex='5' type='password'>
                            </p>
                            <p class='remember'>
                                <input id='signin_submit' value='Sign in' tabindex='6' type='submit'>
                                <input id='remember' name='remember_me' value='1' tabindex='7' type='checkbox'>
                                <label for='remember'>Remember me</label>
                            </p>
                            <p class='forgot'> <a href='#' id='resend_password_link'>Forgot your password?</a> </p>
                            <p class='forgot-username'> <A id=forgot_username_link 
                                                           title='If you remember your password, try logging in with your email' 
                                                           href='#'>Forgot your username?</A> </p>
                        </form>
                    </fieldset>
            </div>";
        return $html;
    }

    public function generateJS() {
        $html = "
            
            <script type='text/javascript'>
            $(document).ready(function() {

                $('.signin').click(function(e) {          
                    e.preventDefault();
                    $('fieldset#signin_menu').toggle();
                    $('.signin').toggleClass('menu-open');
                });
			
                $('fieldset#signin_menu').mouseup(function() {
                    return false
                });
                $(document).mouseup(function(e) {
                    if($(e.target).parent('a.signin').length==0) {
                        $('.signin').removeClass('menu-open');
                        $('fieldset#signin_menu').hide();
                    }
                });			
			
            });
        </script>
        <script src='./js/jquery.tipsy.js' type='text/javascript'></script>
        <script type='text/javascript'>
            $(function() {
                $('#forgot_username_link').tipsy({gravity: 'w'});   
            });
        </script>";
        return $html;
    }

    public function generateImportCSS(HTMLSkeletonGenerator &$html) {
        
    }

    public function generateImportJS(HTMLSkeletonGenerator &$html) {
        $html->addScript("http://code.jquery.com/jquery-latest.js");
    }

}
?> 

