<?php
if (!defined("__CONTROLEUR_FRONTEND_RECHERCHE_VIDEOS__")) {
    die("Acces restreint.");
}

$html->setTitle("Share Your Groove: Recherche VIDEOS");
$html->setKeywords("");
$html->setDescription("");
//$html->setIcon("");
//$html->setShortcutIcon("");

/*
 * Ajout des feuilles de styles CSS
 */
$html->addStylesheet("./css/design.css", "screen", "Include des Feuilles de styles");
$html->addStylesheet("./css/recherche_videos.css");
$html->addStylesheet("http://fonts.googleapis.com/css?family=Audiowide");
$html->addStylesheet("./css/skins/easy.css");
$html->addStylesheet("./css/skins/easyprint.css");

/*
 * Ajout des scripts JavaScript
 */
$html->addScript("http://code.jquery.com/jquery-latest.js");
$html->addScript("./js/jquery.raty.js");
$html->addScript("./js/launch.rating.star.js");
$html->addScript("./js/easy/easy.js");
$html->addScript("./js/easy/main_easy.js");

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


    <?php
    /*
    <div id="bloc_filtre" class="bloc">
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

    <div id="bloc_result" class="bloc">
        <span class="titre_bloc">Results</span>
        <div class="contenu_bloc">
            <div class="rescontainer">
                <div class="colcontainer">
                    <div class="galeryelt">
                        <div class="eltthumb">
                            <a href="http://www.youtube.com/v/pu14b5c5wxY?version=3&amp;hl=fr_FR" class="popup flash" rel="width:560;height:340">
                                <img class="imglayer" src="http://img.youtube.com/vi/pu14b5c5wxY/0.jpg" />
                                <div  class="star" data-rating="5"></div>
                                <div class="mask"></div>
                            </a>
                        </div>
                        <div class="eltdesc">
                            Title: <div class="title">Devil Inside</div><br/>
                            Artist: <div class="artist">Rihanna</div><br/>
                            Publication: <div class="pubdate">09-11-2011</div><br/>
                            Price: <div class="price">10 USD</div><br/>
                            <div class="social">
                                <a href="#" class="sbtn">like</a>
                                <a href="#" class="sbtn">share</a>
                                <div class="views">12000 views</div>
                            </div>
                        </div>
                    </div>
                    <div class="galeryelt">
                        <div class="eltthumb">
                            <a href="http://www.youtube.com/v/pu14b5c5wxY?version=3&amp;hl=fr_FR" class="popup flash" rel="width:560;height:340">
                                <img class="imglayer" src="http://img.youtube.com/vi/pu14b5c5wxY/0.jpg" />
                                <div  class="star" data-rating="5"></div>
                                <div class="mask"></div>
                            </a>
                        </div>
                        <div class="eltdesc">
                            Title: <div class="title">Devil Inside</div><br/>
                            Artist: <div class="artist">Rihanna</div><br/>
                            Publication: <div class="pubdate">09-11-2011</div><br/>
                            Price: <div class="price">10 USD</div><br/>
                            <div class="social">
                                <a href="#" class="sbtn">like</a>
                                <a href="#" class="sbtn">share</a>
                                <div class="views">12000 views</div>
                            </div>
                        </div>
                    </div>
                    <div class="galeryelt">
                        <div class="eltthumb">
                            <a href="http://www.youtube.com/v/pu14b5c5wxY?version=3&amp;hl=fr_FR" class="popup flash" rel="width:560;height:340">
                                <img class="imglayer" src="http://img.youtube.com/vi/pu14b5c5wxY/0.jpg" />
                                <div  class="star" data-rating="5"></div>
                                <div class="mask"></div>
                            </a>
                        </div>
                        <div class="eltdesc">
                            Title: <div class="title">Devil Inside</div><br/>
                            Artist: <div class="artist">Rihanna</div><br/>
                            Publication: <div class="pubdate">09-11-2011</div><br/>
                            Price: <div class="price">10 USD</div><br/>
                            <div class="social">
                                <a href="#" class="sbtn">like</a>
                                <a href="#" class="sbtn">share</a>
                                <div class="views">12000 views</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="colcontainer">
                    <div class="galeryelt">
                        <div class="eltthumb">
                            <a href="http://www.youtube.com/v/pu14b5c5wxY?version=3&amp;hl=fr_FR" class="popup flash" rel="width:560;height:340">
                                <img class="imglayer" src="http://img.youtube.com/vi/pu14b5c5wxY/0.jpg" />
                                <div  class="star" data-rating="5"></div>
                                <div class="mask"></div>
                            </a>
                        </div>
                        <div class="eltdesc">
                            Title: <div class="title">Devil Inside</div><br/>
                            Artist: <div class="artist">Rihanna</div><br/>
                            Publication: <div class="pubdate">09-11-2011</div><br/>
                            Price: <div class="price">10 USD</div><br/>
                            <div class="social">
                                <a href="#" class="sbtn">like</a>
                                <a href="#" class="sbtn">share</a>
                                <div class="views">12000 views</div>
                            </div>
                        </div>
                    </div>
                    <div class="galeryelt">
                        <div class="eltthumb">
                            <a href="http://www.youtube.com/v/pu14b5c5wxY?version=3&amp;hl=fr_FR" class="popup flash" rel="width:560;height:340">
                                <img class="imglayer" src="http://img.youtube.com/vi/pu14b5c5wxY/0.jpg" />
                                <div  class="star" data-rating="5"></div>
                                <div class="mask"></div>
                            </a>
                        </div>
                        <div class="eltdesc">
                            Title: <div class="title">Devil Inside</div><br/>
                            Artist: <div class="artist">Rihanna</div><br/>
                            Publication: <div class="pubdate">09-11-2011</div><br/>
                            Price: <div class="price">10 USD</div><br/>
                            <div class="social">
                                <a href="#" class="sbtn">like</a>
                                <a href="#" class="sbtn">share</a>
                                <div class="views">12000 views</div>
                            </div>
                        </div>
                    </div>
                    <div class="galeryelt">
                        <div class="eltthumb">
                            <a href="http://www.youtube.com/v/pu14b5c5wxY?version=3&amp;hl=fr_FR" class="popup flash" rel="width:560;height:340">
                                <img class="imglayer" src="http://img.youtube.com/vi/pu14b5c5wxY/0.jpg" />
                                <div  class="star" data-rating="5"></div>
                                <div class="mask"></div>
                            </a>
                        </div>
                        <div class="eltdesc">
                            Title: <div class="title">Devil Inside</div><br/>
                            Artist: <div class="artist">Rihanna</div><br/>
                            Publication: <div class="pubdate">09-11-2011</div><br/>
                            Price: <div class="price">10 USD</div><br/>
                            <div class="social">
                                <a href="#" class="sbtn">like</a>
                                <a href="#" class="sbtn">share</a>
                                <div class="views">12000 views</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="p-select" class="contenttoggler" style="display: block;margin: auto;">
                <a class="prev" href="#">&lt;&lt;</a>
                <a class="toc" href="#">1</a>
                <a class="toc" href="#">2</a>
                <a class="toc" href="#">3</a>
                <a class="toc" href="#">4</a>
                <a class="toc selected" href="#" >5</a>
                <a class="toc" href="#"  style="display: none;">6</a>
                <a class="toc" href="#"  style="display: none;">7</a>
                <a class="next" href="#">>></a>
            </div>
        </div>
    </div>

    <div class="clr"></div>

</div>             




<?php
echo (!isset($global_nav_bar) ? "" : $global_nav_bar->generateJS());
echo (!isset($liste_compiles) ? "" : $liste_compiles->generateJS());

echo $footer->generateHTML();
echo $html->generateHTMLEnd();
?>