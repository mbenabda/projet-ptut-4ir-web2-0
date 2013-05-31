<?php

    if(!defined("__CONTROLEUR_FRONTEND_ARTISTE__"))
    {
        die("Acces restreint.");
    }

    $html->setTitle("Share Your Groove: Artiste");
    $html->setKeywords("");
    $html->setDescription("");
    //$html->setIcon("");
    //$html->setShortcutIcon("");
    
    
    /*
     * Ajout des feuilles de styles CSS
     */    
    
    $html->addStylesheet("./css/design.css", "screen", "Include des Feuilles de styles");
    $html->addStylesheet("./css/artiste.css");
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
    $html->addScript("https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js");
    $html->addScript("./js/JQuery/jquery.jcarousel.min.js");
    $html->addScript("./js/easy/easy.js");
    $html->addScript("./js/easy/main_easy.js");
    $html->addScript("./js/JQuery/jquery.ticker.js","Pour le ticker d'annonce");
    $html->addScript("./js/jquery.raty.js","Pour les rating stars");
    $html->addScript("./js/jplayer.playlist.min.js");
    $html->addScript("./js/jquery.jplayer.min.js");
    
    $html->addScript("./js/jplayer.execute.js");
    $html->addScript("./js/launch.caroussel.photos.js");
    $html->addScript("./js/launch.caroussel.videos.js");
    $html->addScript("./js/launch.fils.actualite.js");
    
    $html->addScript("./js/launch.ticker.annonce.js");
    $html->addScript("./js/launch.vote.js");

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
<!-- a gerer-->        <?php echo (!isset($news_thumbail) ? "" : $news_thumbail->generateHTML()); ?>
            </div>
                <div class="clr"></div>
                
                   <div class="bigbloc_1">

                    <div id="bloc_articles" class="bloc">
                        <span class="titre_bloc">Biographie</span>
                        <div class="contenu_bloc">
                            <div class="biographie">
                                
                                <?php echo $biographie_artiste->generateHTML(); ?>
                                
                            </div>
                        </div>
                    </div>
                    <div id="bloc_presentation" class="bloc">
                        <span class="titre_bloc">Profil</span>
                        <div class="contenu_bloc">

                            <div class="ratedartistimg">
                                <?php echo $avatar_artiste->generateHTML(); ?>
                            </div>
                            <div class="ratedartist">
                                <div class="name"> <?php echo $nom_artiste->generateHTML(); ?></div>
         
                                <div class="rating">
                                    <div class="star" data-rating="5"></div>
                                    <div class="vote" id="1"><span>40</span><a href="" id="v1" onclick="hidelink(1)">Vote</a> <?php echo $ville_artiste->generateHTML(); ?></div>
                                </div>
                            </div>  
                   
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
                            <div class="music" >


                                <div id="jquery_jplayer_2" class="jp-jplayer"></div>
                                <div id="jp_container_2" class="jp-audio">
                                    <div class="jp-type-playlist">
                                        <div class="jp-gui jp-interface">           
                                            <ul class="jp-controls">
                                                <li><a href="javascript:;" class="jp-previous" tabindex="1">previous</a></li>
                                                <li><a href="javascript:;" class="jp-play" tabindex="1">play</a></li>
                                                <li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li>
                                                <li><a href="javascript:;" class="jp-next" tabindex="1">next</a></li>
                                                <li><a href="javascript:;" class="jp-stop" tabindex="1">stop</a></li>
                                                <li><a href="javascript:;" class="jp-mute" tabindex="1" title="mute">mute</a></li>
                                                <li><a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute">unmute</a></li>

                                            </ul>           
                                            <div class="jp-progress">
                                                <div class="jp-seek-bar">
                                                    <div class="jp-play-bar"></div>
                                                </div>
                                            </div>
                                            <div class="jp-volume-bar">
                                                <div class="jp-volume-bar-value"></div>
                                            </div>
                                            <div class="jp-time-holder">
                                                <div class="jp-current-time"></div>
                                                <div class="jp-duration"></div>
                                            </div>
                                            <ul class="jp-toggles">
                                                <li><a href="javascript:;" class="jp-shuffle" tabindex="1" title="shuffle">shuffle</a></li>
                                                <li><a href="javascript:;" class="jp-shuffle-off" tabindex="1" title="shuffle off">shuffle off</a></li>
                                                <li><a href="javascript:;" class="jp-repeat" tabindex="1" title="repeat">repeat</a></li>
                                                <li><a href="javascript:;" class="jp-repeat-off" tabindex="1" title="repeat off">repeat off</a></li>
                                            </ul>           
                                        </div>
                                        <div class="jp-playlist">
                                            <ul>
                                                <li></li>
                                            </ul>
                                        </div>
                                        <div class="jp-no-solution">
                                            <span>Update Required</span>
                                            To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
                                        </div>
                                    </div>
                                </div>
                            </div>  
           
                        </div>

                    </div></div>           
                <div class="bigbloc_2">
                    <div id="bloc_photos" class="bloc">
                        <span class="titre_bloc">Photos</span>
                        <div class="contenu_bloc">

                            <ul id="mycarousel_photos" class="jcarousel-skin-tango-photos">
                                
                                <?php //echo $photos_presenter->generateHTML(); ?>
                               
                                <li><a href="http://www.remixthebook.com/wp-content/gallery/sound-art/tumblr_ldp249hh081qd1s5mo1_400.jpg" class="popup"><img src="http://www.remixthebook.com/wp-content/gallery/sound-art/tumblr_ldp249hh081qd1s5mo1_400.jpg" width="140" height="100" alt="" /></a></li>
                                <li><a href="http://apogaea.com/wp-content/uploads/2010/12/sound-mixing-desk.jpg" class="popup"><img src="http://apogaea.com/wp-content/uploads/2010/12/sound-mixing-desk.jpg" width="140" height="100" alt="" /></a></li>
                                <li><a href="http://soundexplorer.net/soundz/Sound_Explorer_Radio_Show_2011_11_11.jpg" class="popup"><img src="http://soundexplorer.net/soundz/Sound_Explorer_Radio_Show_2011_11_11.jpg" width="140" height="100" alt="" /></a></li>
                                <li><a href="http://tux.crystalxp.net/png/overlord59-dj-tux-mix-platine-1577.png" class="popup"><img src="http://tux.crystalxp.net/png/overlord59-dj-tux-mix-platine-1577.png" width="140" height="100" alt="" /></a></li>
                                <li><a href="http://www.fasila.fr/Photo%20web/vector-dj1.gif" class="popup"><img src="http://www.fasila.fr/Photo%20web/vector-dj1.gif" width="140" height="100" alt="" /></a></li>
                                <li><a href="http://tinycomb.com/wp-content/uploads/2009/03/dj-hero.jpg" class="popup"><img src="http://tinycomb.com/wp-content/uploads/2009/03/dj-hero.jpg" width="140" height="100" alt="" /></a></li>
                      

                            </ul>           
           
                        </div>
                    </div>
                    <div id="bloc_videos" class="bloc">
                        <span class="titre_bloc">Videos</span>
                        <div class="contenu_bloc">

                            <ul id="mycarousel_videos" class="jcarousel-skin-tango-videos">
                                <li><a href="http://www.youtube.com/v/pu14b5c5wxY?version=3&amp;hl=fr_FR" class="popup flash" rel="width:560;height:340"><img src="http://blogs.suntimes.com/ebert/sound%20waves.jpg" width="120" height="100" alt="" /></a></li>
                                <li><a href="http://www.youtube.com/v/pu14b5c5wxY?version=3&amp;hl=fr_FR" class="popup flash" rel="width:560;height:340"><img src="http://1.bp.blogspot.com/-pVBDRFVY5s4/Ty__j1MyCHI/AAAAAAAAAzQ/Gvre9i4tsHY/s1600/sound+&+vision.jpg" width="120" height="100" alt="" /></a></li>
                                <li><a href="http://www.youtube.com/v/pu14b5c5wxY?version=3&amp;hl=fr_FR" class="popup flash" rel="width:560;height:340"><img src="http://tinycomb.com/wp-content/uploads/2009/03/dj-hero.jpg" width="120" height="100" alt="" /></a></li>
                                <li><a href="http://www.youtube.com/v/pu14b5c5wxY?version=3&amp;hl=fr_FR" class="popup flash" rel="width:560;height:340"><img src="http://blogs.suntimes.com/ebert/sound%20waves.jpg" width="120" height="100" alt="" /></a></li>
                                <li><a href="http://www.youtube.com/v/pu14b5c5wxY?version=3&amp;hl=fr_FR" class="popup flash" rel="width:560;height:340"><img src="http://1.bp.blogspot.com/-pVBDRFVY5s4/Ty__j1MyCHI/AAAAAAAAAzQ/Gvre9i4tsHY/s1600/sound+&+vision.jpg" width="120" height="100" alt="" /></a></li>
                                <li><a href="http://www.youtube.com/v/pu14b5c5wxY?version=3&amp;hl=fr_FR" class="popup flash" rel="width:560;height:340"><img src="http://blogs.suntimes.com/ebert/sound%20waves.jpg" width="120" height="100" alt="" /></a></li>

                            </ul>
                        </div>
                    </div>
                </div>
                
                <div id="bloc_comentaires" class="bloc">
                    <span class="titre_bloc">Comentaires</span>
                    <div class="contenu_bloc">
      
                        <ul>
                              <li style="display: list-item;">
                                                <?php echo $avatar_commentateur->generateHTML(); ?>
                                                <form class="form">
                                                    <textarea name = "commentaire" id = 'commentaire' row="3" cols="80"></textarea>
                                                    <button type="button" class="button" id="bouton_envoyer_commentaire">Commenter</button>
                                                </form>
                              </li>
                             
                              <div id="comentaire_ajax">
                                          <script language ="javascript">
                                                $(document).ready(function()
                                                {
                                                    setInterval(function()
                                                    {
                                                        var dataString = "id="+<?php echo $_GET['id']; ?>;
     
                                                        $.ajax({
                                                            type: "POST",  
                                                            url: "ajax_commentaires.php",
                                                            data: dataString,  
                                                            success: function(response){
                                                                        $("#comentaire_ajax").html(response);
                                                                     },
                                                            dataType: "html"})
                                                    },1000)
                                                });
                                                
                                               
                                                
                                            </script>
                              </div>
                        </ul>
                    </div>
                </div>
                <div></div>

            </div>


<script language ="javascript">

$(document).ready(function(){
     
     $('#bouton_envoyer_commentaire').click(function(){
        envoyer_commentaire();
     });

});

function envoyer_commentaire(){
		
		var texte = $("#commentaire").val();
		var dataString = 'commentaire='+texte+'&id='+<?php echo $_GET['id']; ?>;
		$.ajax({  
			type: "POST",  
			url: "ajax_envoyer_commentaire.php",  
			data: dataString,  
			success: function() {
                             
			}
		});
		return false;
}
</script>


<?php
    echo (!isset($biographie_artiste) ? "" : $biographie_artiste->generateJS());
    echo (!isset($global_nav_bar) ? "" : $global_nav_bar->generateJS());
    echo (!isset($commentaire_artiste_presenter) ? "" : $commentaire_artiste_presenter->generateJS());
    echo (!isset($news_thumbail) ? "" : $news_thumbail->generateJS());

     
    echo $footer->generateHTML();
    echo $html->generateHTMLEnd();
?>