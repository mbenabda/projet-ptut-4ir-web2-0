<?php
    if(!defined("__CONTROLEUR_FRONTEND_INDEX__"))
    {
        die("Acces restreint.");
    }

    $html->setTitle("Share Your Groove: Accueil");
    $html->setKeywords("");
    $html->setDescription("");
    //$html->setIcon("");
    //$html->setShortcutIcon("");

    /*
     * Ajout des feuilles de styles CSS
     */
    $html->addStylesheet("./css/design.css", "screen", "Include des Feuilles de styles");
    $html->addStylesheet("./css/accueil.css");
    $html->addStylesheet("./css/skins/tango/skin.css", // lien
                         "screen", // media
                         "Skin du slider d'image d'artistes"); // commentaire
    $html->addStylesheet("./css/skins/ticker-style.css", "screen", "CSS du ticker d'annonce");
    $html->addStylesheet("./css/skins/jsShare.css", "screen", "CSS du social jquery");

    /*
     * Ajout des scripts JavaScript
     */
    $html->addScript("http://code.jquery.com/jquery-latest.js");
   

    $html->addScript("./js/JQuery/jquery.bxSlider.min.js");
    $html->addScript("./js/JQuery/jquery.jcarousel.min.js",
                     "Carroussel d'image de nouveaux d'artistes");
    $html->addScript("./js/JQuery/jquery.ticker.js",
                     "Pour le ticker d'annonce");
    $html->addScript("./js/jquery.raty.js",
                     "Pour les rating stars");
    $html->addScript("./js/jsShare.js",
                     "JQuery social");

    // génération de l'entête HTML
    echo $html->generateHTMLHead();
    //generation du header
    echo $header->generateHTML();
    echo $signInBox->generateJS();
    //generation du menu
    echo $global_nav_bar->generateHTML();









    /*

                    <div class="wrap">
                        <div class="bx-wrapper" style="width: 950px; position: relative;">
                            <div class="bx-window" style="position: relative;width: 930px;height: 200px;overflow: hidden;">
                                <ul id="slider1">
                                    <li style="width: 800px; float: left; list-style: none outside none;">
                                        <div class="left">
                                            <img width="169" height="169" src="./img/pic_velvet1.jpg">
                                        </div>
                                        <div class="right">
                                            <div class="album">
                                                The Velvet Underground & Nico
                                            </div>
                                            <div class="band">
                                                The Velvet Underground
                                            </div>
                                            <div class="compillist">
                                                <ul>
                                                    <li>1-Rihana feat eminem</li>
                                                    <li>2-Pitbul run the show</li>
                                                    <li>3-Inna vs 50ct</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <li style="width: 800px; float: left; list-style: none outside none;">
                                        <div class="left">
                                            <img width="169" height="169" src="./img/pic_velvet2.jpg">
                                        </div>
                                        <div class="right">
                                            <div class="album">
                                                White Light / White Heat
                                            </div>
                                            <div class="band">
                                                The Velvet Underground
                                            </div>
                                            <div class="compillist">
                                                <ul>
                                                    <li>1-kikooo</li>
                                                    <li>2-loool</li>
                                                    <li>3-coool</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <li style="width: 800px; float: left; list-style: none outside none;">
                                        <div class="left">
                                            <img width="169" height="169" src="./img/pic_velvet3.jpg">
                                        </div>
                                        <div class="right">
                                            <div class="album">
                                                The Velvet Underground & Nico
                                            </div>
                                            <div class="band">
                                                The Velvet Underground
                                            </div>
                                            <div class="compillist">
                                                <ul>
                                                    <li>1-Rihana feat eminem</li>
                                                    <li>2-Pitbul run the show</li>
                                                    <li>3-Inna vs 50ct</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <li style="width: 800px; float: left; list-style: none outside none;">
                                        <div class="left">
                                            <img width="169" height="169" src="./img/pic_velvet4.jpg">
                                        </div>
                                        <div class="right">
                                            <div class="album">
                                                The Velvet Underground & Nico
                                            </div>
                                            <div class="band">
                                                The Velvet Underground
                                            </div>
                                            <div class="compillist">
                                                <ul>
                                                    <li>1-Rihana feat eminem</li>
                                                    <li>2-Pitbul run the show</li>
                                                    <li>3-Inna vs 50ct</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
     */

?>
  
<div id="contenu">
            <div id="annonces">
                <ul id="js-news" class="js-hidden">
                    <li class="news-item"><a href="#">This is the 1st latest news item.</a></li>
                    <li class="news-item"><a href="#">This is the 2nd latest news item.</a></li>
                    <li class="news-item"><a href="#">This is the 3rd latest news item.</a></li>
                    <li class="news-item"><a href="#">This is the 4th latest news item.</a></li>
                </ul>
            </div>
            <div class="clr"></div>
<?php
        if($compilations_count > 0)
        {
            ?>
            <div id="bloc_lastcompil" class="bloc">
                     <?php echo $carroussel_compilations->generateHTML(); ?>
            </div>
            <?php
        }
 ?>

            <script language ="javascript">
                $(document).ready(function()
                {
                    setInterval(function()
                    {
                        $.ajax({
                            url: "ajax_compils_carroussel.php",
                            success: function(response){
                                        $("#bloc_lastcompil").html(response);
                                     },
                            dataType: "html"})
                    },30000)
                });
            </script>
            <div class="bigbloc">

                <div id="bloc_actu" class="bloc">
                    <span class="titre_bloc">News</span>
                    <div class="contenu_bloc">
                        <ul id="ticker" class="ticker">
                            <li style="display: list-item;">
                                <img src="http://a0.twimg.com/profile_images/1899297749/Ed_Lucente_-_III_normal.jpg">
                                jqBarGraph is jQuery plugin that gives you freedom to easily display your data as graphs. There are three types of graphs: simple, multi and stacked.
                            </li>
                            <li>
                                <img src="http://a0.twimg.com/profile_images/2153033019/Edited_30012011563_e_normal.jpg">                                Learn how to create image gallery in 4 lines of Jquery
                            </li>
                            <li>
                                <img src="http://a0.twimg.com/profile_images/1889023954/me10_normal.jpg">
                                jqFancyTransitions is easy-to-use jQuery plugin for displaying your photos as slideshow with fancy transition effects.
                            </li>
                            <li>
                                <img src="http://a0.twimg.com/profile_images/1916467905/2012-03-17_13-26-40_924_normal.jpg">
                                mooBarGraph is AJAX graph plugin for MooTools which support two types of graphs, simple bar and stacked bar graph.
                            </li>
                        </ul>

                            <div id="buttons-expanded">
                            </div>

                    </div>
                </div>

                <div id="bloc_classement" class="bloc">
                    <span class="titre_bloc">Classement</span>
                    <div class="contenu_bloc">
                        <ul>
                            <li>
                                <div class="ratedartistimg">
                                    <img src="http://static.flickr.com/66/199481236_dc98b5abb3_s.jpg" width="75" height="75" alt="" />
                                </div>
                                <div class="ratedartist">
                                    <div class="name">Eminem</div>
                                    <div class="rating">
                                        <div class="star" data-rating="5"></div>
                                        <div class="vote" id="1"><span>40</span><a href="" id="v1" onclick="hidelink(1)">Vote</a>mockingbird</div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="ratedartistimg">
                                    <img src="http://static.flickr.com/69/199481255_fdfe885f87_s.jpg" width="75" height="75" alt="" />
                                </div>
                                <div class="ratedartist">
                                    <div class="name">Rihanna</div>
                                    <div class="rating">
                                        <div class="star" data-rating="4"></div>
                                        <div class="vote" id="2"><span>30</span><a href="" id="v2" onclick="hidelink(2)">Vote</a>devil inside</div>

                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="ratedartistimg">
                                    <img src="http://static.flickr.com/72/199481203_ad4cdcf109_s.jpg" width="75" height="75" alt="" />
                                </div>
                                <div class="ratedartist">
                                    <div class="name">Pitbul</div>
                                    <div class="rating">
                                        <div class="star" data-rating="3"></div>
                                        <div class="vote" id="3"><span>40</span><a href="" id="v3" onclick="hidelink(3)">Vote</a>ibiza</div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
            <div class="clr"></div>

<?php
        if(isset($liste_new_artistes))
        {
            ?>
            <div id="bloc_newartist" class="bloc">
                <span class="titre_bloc">New Artists</span>
                <div class="contenu_bloc" id = 'newArtistesList_id'>
                        <?php echo $liste_new_artistes->generateHTML(); ?>
                </div>
            </div>
            <?php
        }

 ?>
            <script language ="javascript">
                $(document).ready(function()
                {
                    setInterval(function()
                    {
                        $.ajax({
                            url: "ajax_newArtistesList.php",
                            success: function(response){
                                        $("#newArtistesList_id").html(response);
                                        // Carroussel d'image de nouveaux d'artistes
                                        jQuery('#mycarousel').jcarousel({
                                            scroll: 1
                                        });

                                     },
                            dataType: "html"})
                    },5000)
                });
            </script>
            <div class="clr"></div>

        </div>



    <script type="text/javascript">

        // Carroussel d'image de nouveaux d'artistes
        jQuery(document).ready(function() {
            jQuery('#mycarousel').jcarousel({
                scroll: 1
            });
        });


        // Fil d'actualités
        function tick(){
            $('#ticker li:first').animate({'opacity':0}, 200, function () { $(this).appendTo($('#ticker')).css('opacity', 3); });
        }
        setInterval(function(){ tick () }, 4000);


        // Pour le ticker d'annonce
        $(function () {
            $('#js-news').ticker();
        });


        // Pour les rating stars
        $(function() {$('.star').raty({
                path: "./img/",
                start: function() {
                    return $(this).attr('data-rating');
                }
            });
        });


        // vote
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


        //JQuery social
        $(document).ready(function() {
            $('#buttons').jsShare({ maxwidth: 360 });
            $('#buttons-expanded').jsShare({ initialdisplay: 'expanded', maxwidth: 360 });
        });

    </script>
<?php
    echo $footer->generateHTML();
    echo (!isset($carroussel_compilations) ? "" : $carroussel_compilations->generateJS() );
    echo $html->generateHTMLEnd();
?>