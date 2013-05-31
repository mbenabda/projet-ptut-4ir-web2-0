<?php

if(!defined("__CONTROLEUR_FRONTEND_RECHERCHE_ARTISTES__"))
    {
        die("Acces restreint.");
    }

    $html->setTitle("Share Your Groove: Recherche Artiste");
    $html->setKeywords("");
    $html->setDescription("");
    //$html->setIcon("");
    //$html->setShortcutIcon("");
    
    
    /*
     * Ajout des feuilles de styles CSS
     */    
    
    $html->addStylesheet("./css/design.css", "screen", "Include des Feuilles de styles");
    $html->addStylesheet("./css/recherche_artistes.css");
    $html->addStylesheet("http://fonts.googleapis.com/css?family=Audiowide");
      
    
    
     /*
     * Ajout des scripts JavaScript
     */
    $html->addScript("http://code.jquery.com/jquery-latest.js");
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
                                <div class="elt">
                                    <img src="img/unknown.jpg" />
                                    <div class="artistdesc">
                                        Nom: <div class="nomartist">Akon</div>
                                        Catégories: <div class="catartist">chanteur</div>
                                        Statuts: <div class="artiststatus">professionel</div>
                                    </div>
                                </div>
                                <div class="elt">
                                    <img src="img/unknown.jpg" />
                                    <div class="artistdesc"></div>
                                </div>
                                <div class="elt">
                                    <img src="img/unknown.jpg" />
                                    <div class="artistdesc"></div>
                                </div>
                                <div class="elt">
                                    <img src="img/unknown.jpg" />
                                    <div class="artistdesc"></div>
                                </div>
                            </div>
                                                        <div class="colcontainer">
                                <div class="elt">
                                    <img src="img/unknown.jpg" />
                                    <div class="artistdesc"></div>
                                </div>
                                <div class="elt">
                                    <img src="img/unknown.jpg" />
                                    <div class="artistdesc"></div>
                                </div>
                                <div class="elt">
                                    <img src="img/unknown.jpg" />
                                    <div class="artistdesc"></div>
                                </div>
                                <div class="elt">
                                    <img src="img/unknown.jpg" />
                                    <div class="artistdesc"></div>
                                </div>
                            </div> 
                            <div class="clr"></div>                     
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
    echo (!isset($news_thumbail) ? "" : $news_thumbail->generateJS());
    
    echo $footer->generateHTML();
    echo $html->generateHTMLEnd();
?>    