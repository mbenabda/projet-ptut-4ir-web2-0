<?php

if(!defined("__CONTROLEUR_FRONTEND_RECHERCHE_SAMPLES__"))
    {
        die("Acces restreint.");
    }

    $html->setTitle("Share Your Groove: Recherche samples");
    $html->setKeywords("");
    $html->setDescription("");
    //$html->setIcon("");
    //$html->setShortcutIcon("");
    
    /*
     * Ajout des feuilles de styles CSS
     */    
    $html->addStylesheet("./css/design.css", "screen", "Include des Feuilles de styles");
    $html->addStylesheet("./css/recherche_samples.css");
    $html->addStylesheet("http://fonts.googleapis.com/css?family=Audiowide");
    
    
     /*
     * Ajout des scripts JavaScript
     */
    $html->addScript("./js/jquery.raty.js");  
    $html->addScript("./js/launch.rating.star.js");

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
                                    <div class="leftelt">
                                        <img src="http://www.primeloops.com/images/uploaded/thumb_Dubstep-SFX_1.jpg"/>
                                        <div class="social">
                                            <a href="#" class="sbtn">like</a>
                                            <a href="#" class="sbtn">share</a>
                                        </div>
                                    </div>
                                    <div class="rightelt">
                                        <div class="sampletitle">Dubstep SFX</div>
                                        <audio controls preload></audio>
                                        <div class="sampledesc">
                                            Contains:<div class="samplecontent">Over 150 cutting-edge Dubstep SFX samples, featuring Filter Sweeps, Impacts, Electric FX, Bass One-shots, Atmospheric Textures and more!</div>
                                            Genres:<div class="samplestyle">Dubstep, Electro, Sound FX</div>
                                            Format:<div class="sampleformat">.WAV, .AIFF Samples, FL Studio, Reason Refill, Akai MPC, Garageband, EXS24, Kontakt, Halion</div>
                                            Price:<div class="price">£16.95 (20.74 EUR)</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="elt">
                                    <div class="leftelt">
                                        <img src="http://www.primeloops.com/images/uploaded/thumb_Dirty-South-Vocal-Samples_1.jpg"/>
                                        <div class="social">
                                            <a href="#" class="sbtn">like</a>
                                            <a href="#" class="sbtn">share</a>
                                        </div>
                                    </div>
                                    <div class="rightelt">
                                        <div class="sampletitle">Dirty South vocal</div>
                                        <audio controls preload></audio>
                                        <div class="sampledesc">
                                            Contains:<div class="samplecontent">Over 400 blazin' hot, original Dirty South Vocal Samples to instantly hype up your tracks!</div>
                                            Genres:<div class="samplestyle">Dirty South, Hip Hop, Urban</div>
                                            Format:<div class="sampleformat">.WAV, Acid Samples, Akai MPC, Garageband, Reason Refill, Kontakt, Halion, EXS24, Sonar SFZ</div>
                                            Price:<div class="price">£17.95 (21.97 EUR)</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="colcontainer">
                                <div class="elt">
                                    <div class="leftelt">
                                        <img src="http://www.primeloops.com/images/uploaded/thumb_Rasta-Vocal-Samples-3_1.jpg"/>
                                        <div class="social">
                                            <a href="#" class="sbtn">like</a>
                                            <a href="#" class="sbtn">share</a>
                                        </div>
                                    </div>
                                    <div class="rightelt">
                                        <div class="sampletitle">Rasta Vocal</div>
                                        <audio controls preload></audio>
                                        <div class="sampledesc">
                                            Contains:<div class="samplecontent">Huge collection of over 280 blockbustin', royalty-free Rasta Vocal Samples and Patois Shouts, all ready for instant download in supreme 24-bit audio quality!</div>
                                            Genres:<div class="samplestyle">Drum n Bass, Dubstep</div>
                                            Format:<div class="sampleformat">.WAV, .AIFF Samples, Akai MPC, EXS24, FL Studio, Halion, Kontakt, Reason Refill, Garageband, Sonar SFZ</div>
                                            Price:<div class="price">£14.95 (18.29 EUR)</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="elt">
                                    <div class="leftelt">
                                        <img src="http://www.primeloops.com/images/uploaded/thumb_Hyper-Vocals_1.jpg"/>
                                        <div class="social">
                                            <a href="#" class="sbtn">like</a>
                                            <a href="#" class="sbtn">share</a>
                                        </div>
                                    </div>
                                    <div class="rightelt">
                                        <div class="sampletitle">Hyper vocals</div>
                                        <audio controls preload></audio>
                                        <div class="sampledesc">
                                            Contains:<div class="samplecontent">Over 120 Robot Vocals, Machine Hypes & Vocoder Samples for Dubstep, Electro, Techno, Urban & Dance!</div>
                                            Genres:<div class="samplestyle">Electro, Glitch, Dubstep</div>
                                            Format:<div class="sampleformat">.WAV, .AIFF Samples, Garageband, FL Studio, Akai MPC, Sonar SFZ, Kontakt, Halion, EXS24, Reason Refill</div>
                                            Price:<div class="price">£9.95 (12.18 EUR)</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <div class="colcontainer">
                                <div class="elt">
                                    <div class="leftelt">
                                        <img src="http://www.primeloops.com/images/uploaded/thumb_Rasta-Vocal-Samples-3_1.jpg"/>
                                        <div class="social">
                                            <a href="#" class="sbtn">like</a>
                                            <a href="#" class="sbtn">share</a>
                                        </div>
                                    </div>
                                    <div class="rightelt">
                                        <div class="sampletitle">Rasta Vocal</div>
                                        <audio controls preload></audio>
                                        <div class="sampledesc">
                                            Contains:<div class="samplecontent">Huge collection of over 280 blockbustin', royalty-free Rasta Vocal Samples and Patois Shouts, all ready for instant download in supreme 24-bit audio quality!</div>
                                            Genres:<div class="samplestyle">Drum n Bass, Dubstep</div>
                                            Format:<div class="sampleformat">.WAV, .AIFF Samples, Akai MPC, EXS24, FL Studio, Halion, Kontakt, Reason Refill, Garageband, Sonar SFZ</div>
                                            Price:<div class="price">£14.95 (18.29 EUR)</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="elt">
                                    <div class="leftelt">
                                        <img src="http://www.primeloops.com/images/uploaded/thumb_Hyper-Vocals_1.jpg"/>
                                        <div class="social">
                                            <a href="#" class="sbtn">like</a>
                                            <a href="#" class="sbtn">share</a>
                                        </div>
                                    </div>
                                    <div class="rightelt">
                                        <div class="sampletitle">Hyper vocals</div>
                                        <audio controls preload></audio>
                                        <div class="sampledesc">
                                            Contains:<div class="samplecontent">Over 120 Robot Vocals, Machine Hypes & Vocoder Samples for Dubstep, Electro, Techno, Urban & Dance!</div>
                                            Genres:<div class="samplestyle">Electro, Glitch, Dubstep</div>
                                            Format:<div class="sampleformat">.WAV, .AIFF Samples, Garageband, FL Studio, Akai MPC, Sonar SFZ, Kontakt, Halion, EXS24, Reason Refill</div>
                                            Price:<div class="price">£9.95 (12.18 EUR)</div>
                                        </div>
                                    </div>
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
    echo (!isset($liste_compiles) ? "" : $liste_compiles->generateJS());
   
    echo $footer->generateHTML();
    echo $html->generateHTMLEnd();
?>