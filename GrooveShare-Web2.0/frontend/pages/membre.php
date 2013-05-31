<?php

    if(!defined("__CONTROLEUR_FRONTEND_MEMBRE__"))
    {
        die("Acces restreint.");
    }

    $html->setTitle("Share Your Groove: Membre");
    $html->setKeywords("");
    $html->setDescription("");
    //$html->setIcon("");
    //$html->setShortcutIcon("");
    
    
    /*
     * Ajout des feuilles de styles CSS
     */    

    $html->addStylesheet("./css/design.css", "screen", "Include des Feuilles de styles");
    $html->addStylesheet("./css/membre.css");
    $html->addStylesheet("./css/skins/tango/skin_caroussel_photos.css","screen","skin du slider photos");
    $html->addStylesheet("./css/skins/tango/skin_caroussel_videos.css","screen","skin du slider videos");
    $html->addStylesheet("./css/skins/ticker-style.css","screen","CSS du ticker d'annonce");     
    $html->addStylesheet("./css/skins/sharing.css","screen","css du social");
    $html->addStylesheet("./css/skins/jplayer.blue.monday.css","screen","css du player audio");
    $html->addStylesheet("./css/skins/easy.css","screen","ccs easy : pour gerer le popup des photos et des videos");
    $html->addStylesheet("./css/skins/easyprint.css");    
    
    
    
    /*
     * Ajout des scripts JavaScript
     */
    $html->addScript("./js/JQuery/jquery.jcarousel.min.js");
    $html->addScript("./js/easy/easy.js");
    $html->addScript("./js/easy/main_easy.js");
    $html->addScript("./js/JQuery/jquery.ticker.js","Pour le ticker d'annonce");
    $html->addScript("./js/jquery.raty.js","Pour les rating stars");

//TODO JavaScript a verifier dans artiste.php
    
    
    // génération de l'entête HTML
    echo $html->generateHTMLHead();
    //generation du header
    echo $header->generateHTML();
    echo $RatingStar->generateJS();
    echo $signInBox->generateJS();    
    //generation du menu
    echo $global_nav_bar->generateHTML();
?>


      <div id="contenu">

            <div id="annonces">
            <?php echo (!isset($news_thumbail) ? "" : $news_thumbail->generateHTML()); ?>
            </div>           
                <div class="clr"></div>

                <div class="bigbloc_1"> 
                    <div id="bloc_artistes_favoris" class="bloc">
                        <span class="titre_bloc">Artistes favoris</span>
                        <div class="contenu_bloc">
                            <div class="artistes_list">
 <!-- artiste_favoris à faire --> <?php echo (!isset($artiste_favoris) ? "" : $artiste_favoris->generateHTML()); ?>
                            </div>
                        </div>
                    </div>

                    <div id="bloc_presentation" class="bloc">
                        <span class="titre_bloc">Profil</span>
                        <div class="contenu_bloc">

                            <div class="image_profil">
                                <img src="http://static.flickr.com/66/199481236_dc98b5abb3_s.jpg" width="75" height="75" alt="" />
                            </div>            
                            <div class="nom">Michel</div>
                            <div class="pays">Etats Unis</div>
                              
                            <div class="statut">Statut : "J'ai mangé des frites aujourd'hui !"</div>
                            
                            <div id="social_content">
                                <ul class="tt-wrapper">
                                    <li><a class="tt-gplus" href="#"><span>Google Plus</span></a></li>
                                    <li><a class="tt-twitter" href="#"><span>Twitter</span></a></li>
                                    <!--<li><a class="tt-dribbble" href="#"><span>Dribbble</span></a></li>-->
                                    <li><a class="tt-facebook" href="#"><span>Facebook</span></a></li>
                                    <li><a class="tt-linkedin" href="#"><span>LinkedIn</span></a></li>
                                    <!--<li><a class="tt-forrst" href="#"><span>Forrst</span></a></li>-->
                                </ul>
                            </div>


                        </div>

                    </div></div>
                     <div id="bloc_actu_artistes" class="bloc">
                        <span class="titre_bloc">Actu des Artistes</span>
                        <div class="contenu_bloc">
 <!-- actu des artistes à faire --> <?php echo (!isset($actu_artiste) ? "" : $actu_artiste->generateHTML()); ?>
                    </div>
                    </div>
 
                <div class="clr"></div>

            </div>


        <script type="text/javascript">
            jQuery(document).ready(function() {
                jQuery('#mycarousel_photos').jcarousel({
                    //configuration du carroussel
                    scroll: 1
                });
            });
            
            jQuery(document).ready(function() {
                jQuery('#mycarousel_videos').jcarousel({
                    //configuration du carroussel
                    scroll: 1
                });
            });
            
            function tick(){
                $('#ticker li:first').animate({'opacity':0}, 200, function () { $(this).appendTo($('#ticker')).css('opacity', 3); });
            }
            setInterval(function(){ tick () }, 4000);
            
            $(function () {
                $('#js-news').ticker();
            });
            
            $(function() {$('.star').raty({
                    start: function() {
                        return $(this).attr('data-rating');
                    }
                });    
            });
            
            $(document).ready(function() {
                $(".vote a").click(function() {
                    $(this).parent().animate({
                        width: '+=5px'
                    }, 10);
                    $(this).prev().html(parseInt($(this).prev().html()) + 1);
                    return false;
                });
            });
            
            function hidelink(x){
                document.getElementById(1).innerHTML="<span>0</span>";
                document.getElementById(2).innerHTML="<span>0</span>";
                document.getElementById(3).innerHTML="<span>0</span>";
                document.getElementById(x).innerHTML="<span>+1 thx for voting</span>";
            }
            </script>
            

            
<?php
    echo (!isset($actu_artiste) ? "" : $actu_artiste->generateJS());
    echo (!isset($global_nav_bar) ? "" : $global_nav_bar->generateJS());
    echo (!isset($artiste_favoris) ? "" : $artiste_favoris->generateJS());
    echo (!isset($news_thumbail) ? "" : $news_thumbail->generateJS());

    echo $footer->generateHTML();
    echo $html->generateHTMLEnd();
?>