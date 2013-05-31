<?php

if(!defined("__CONTROLEUR_FRONTEND_RECHERCHE_COMPILES__"))
    {
        die("Acces restreint.");
    }

    $html->setTitle("Share Your Groove: Recherche Compiles");
    $html->setKeywords("");
    $html->setDescription("");
    //$html->setIcon("");
    //$html->setShortcutIcon("");
    
    /*
     * Ajout des feuilles de styles CSS
     */    
    $html->addStylesheet("./css/design.css", "screen", "Include des Feuilles de styles");
    $html->addStylesheet("./css/recherche_compiles.css");

    
     /*
     * Ajout des scripts JavaScript
     */
   
    $html->addScript("http://code.jquery.com/jquery-latest.js");
    $html->addScript("./js/JQuery/jquery.bxSlider.min.js");
    $html->addScript("./js/jquery.tipsy.js");
    $html->addScript("./js/jquery.raty.js");
   
    $html->addScript("http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js");
    $html->addScript("./js/jquery.scrollablecombo.js");

    // génération de l'entête HTML
    echo $html->generateHTMLHead();

    //generation du header
    echo $header->generateHTML();
    echo $signInBox->generateJS();
    echo $RatingStar->generateJS();
    //generation du menu
    echo $global_nav_bar->generateHTML();
?>

            <div id="contenu">


                <div class="clr"></div>
                <div id="bloc_compil" class="bloc">
                    <span class="titre_bloc">Compil</span>
                    <div class="contenu_bloc">
                        <div class="wrap">
                            <div class="bx-wrapper" style="width: 950px; position: relative;">
                                <div class="bx-window" style="position: relative;width: 930px;height: 200px;overflow: hidden;">
                                    <ul id="slider1">
                                        <li style="width: 800px; float: left; list-style: none outside none;">
                                            <div class="left">
                                                <img width="169" height="169" src="../img/pic_velvet1.jpg">
                                            </div>
                                            <div class="right">
                                                <div class="album">
                                                    The Velvet Underground & Nico
                                                </div>
                                                <div class="band">
                                                    The Velvet Underground
                                                </div>
                                                <div class="compillist">
                <!--Liste compiles à vérifier -->   <?php echo (!isset($liste_compiles) ? "" : $liste_compiles->generateHTML()); ?>
                                                 </div>
                                            </div>
                                        </li>
                                        <li style="width: 800px; float: left; list-style: none outside none;">
                                            <div class="left">
                                                <img width="169" height="169" src="../img/pic_velvet2.jpg">
                                            </div>
                                            <div class="right">
                                                <div class="album">
                                                    White Light / White Heat
                                                </div>
                                                <div class="band">
                                                    The Velvet Underground
                                                </div>
                                                <div class="compillist">
<!--à vérifier si c'est pareil que liste_compils en haut -->   <?php echo (!isset($liste_compiles) ? "" : $liste_compiles->generateHTML()); ?>
                                                   </div>
                                            </div>
                                        </li>
                                        <li style="width: 800px; float: left; list-style: none outside none;">
                                            <div class="left">
                                                <img width="169" height="169" src="../img/pic_velvet3.jpg">
                                            </div>
                                            <div class="right">
                                                <div class="album">
                                                    The Velvet Underground & Nico
                                                </div>
                                                <div class="band">
                                                    The Velvet Underground
                                                </div>
                                                <div class="compillist">
<!--à vérifier si c'est pareil que liste_compils en haut -->   <?php echo (!isset($liste_compiles) ? "" : $liste_compiles->generateHTML()); ?>
                                                  </div>
                                            </div>
                                        </li>
                                        <li style="width: 800px; float: left; list-style: none outside none;">
                                            <div class="left">
                                                <img width="169" height="169" src="../img/pic_velvet4.jpg">
                                            </div>
                                            <div class="right">
                                                <div class="album">
                                                    The Velvet Underground & Nico
                                                </div>
                                                <div class="band">
                                                    The Velvet Underground
                                                </div>
                                                <div class="compillist">
<!--à vérifier si c'est pareil que liste_compils en haut -->   <?php echo (!isset($liste_compiles) ? "" : $liste_compiles->generateHTML()); ?>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                /*
                 * <div id="bloc_filtre" class="bloc">
                    <span class="titre_bloc">Filtrer</span>
                    <div class="contenu_bloc">
                        <div class="toolbelt">
                            <div class="search-option-box">
                                <div class="search-option-label">Type:</div>
                                <div class="search-option">Music</div>
                                <div class="search-option">Instrumental</div>
                                <div class="search-option">Remix</div>
                                <div class="search-option">Live</div>
                            </div>
                            <div class="search-option-box">
                                <div class="search-option-label">Trier par:</div>
                                <div class="search-option">Pertinence</div>
                                <div class="search-option">Date de mise en ligne</div>
                                <div class="search-option">Nombre de vues</div>
                                <div class="search-option">Avis</div>
                            </div>
                            <div class="search-option-box">
                                <div class="search-option-label">Catégories:</div>
                                <div class="search-option">Hip-Hop</div>
                                <div class="search-option">House</div>
                                <div class="search-option">Rap</div>
                                <div class="search-option">R'nb</div>
                                <div class="search-option">Dancefloor</div>
                                <div class="search-option">Pop</div>
                            </div>
                            <div class="search-option-box">
                                <div class="search-option-label">Langue:</div>
                                <div class="search-option">Français</div>
                                <div class="search-option">English</div>
                                <div class="search-option">Deutch</div>
                            </div>
                        </div>
                    </div>
                </div>
                 */
                ?>

                    <?php echo $CompilesResult->generateHTML(); ?>

                <div class="clr"></div>

            </div>

        
        <script type="text/javascript">
            //Slider
            $(document).ready(function(){
                $('#slider1').bxSlider({
                    //configuration du slider
                      
                });
            });
            
            //Sign in twitter like
            $(document).ready(function() {

                $(".signin").click(function(e) {          
                    e.preventDefault();
                    $("fieldset#signin_menu").toggle();
                    $(".signin").toggleClass("menu-open");
                });
			
                $("fieldset#signin_menu").mouseup(function() {
                    return false
                });
                $(document).mouseup(function(e) {
                    if($(e.target).parent("a.signin").length==0) {
                        $(".signin").removeClass("menu-open");
                        $("fieldset#signin_menu").hide();
                    }
                });			
			
            });
            
            $(function() {
                $('#forgot_username_link').tipsy({gravity: 'w'});   
            });
            
            //Pour les rating stars
             $(function() {$('.star').raty({
                    start: function() {
                        return $(this).attr('data-rating');
                    }
                });    
            });
        </script>
        
<?php
   
    echo (!isset($global_nav_bar) ? "" : $global_nav_bar->generateJS());
    echo (!isset($liste_compiles) ? "" : $liste_compiles->generateJS());
   
    echo $footer->generateHTML();
    echo $html->generateHTMLEnd();
?>