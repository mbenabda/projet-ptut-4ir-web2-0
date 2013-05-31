<?php
    if(!defined("__CONTROLEUR_FRONTEND_INSCRIPTION__"))
    {
        die("Acces restreint.");
    }

    $html->setTitle("Share Your Groove: Inscription");
    $html->setKeywords("");
    $html->setDescription("");
    //$html->setIcon("");
    //$html->setShortcutIcon("");

    /*
     * Ajout des feuilles de styles CSS
     */
    $html->addStylesheet("./css/skins/ui-darkness/jquery-ui-1.8.20.custom.css", "screen", "Include des Feuilles de styles");
    $html->addStylesheet("./css/design.css");
    $html->addStylesheet("./css/formulaire.css");

    /*
     * Ajout des scripts JavaScript
     */
    $html->addScript("./js/JQuery/jquery-1.7.2.min.js");
    $html->addScript("./js/JQuery/jquery-ui-1.8.20.custom.min.js");
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
    //generation du menu
    echo $global_nav_bar->generateHTML();
    echo $signInBox->generateJS();

?>
 
            
            <div id="contenu">
            <?php echo (!isset($inscription_result) ? "" : $inscription_result->generateHTML()); ?>
            <div id="bloc_inscription" class="bloc">
                <span class="titre_bloc">FORMULAIRE D'INSCRIPTION</span>
                <form class="form" action = 'inscription.php' method = 'post'>
                    <section class="contenu_bloc">
                        <section class="gauche">
                            <table>
                                <tr>
                                    <td class = 'label'><label for = "login">Login*:</label></td>
                                    <td><input type = "text" name = "login" id = "login" value = "<?php echo $clean['login']; ?>" /></td>
                                </tr>
                                <tr>
                                    <td class = 'label'><label for = "pass">Mot de passe*:</label></td>
                                    <td><input type = "password" name = "pass" id = "pass"  value = "<?php echo $clean['pass']; ?>" /> </td>
                                </tr>
                                <tr>
                                    <td class = 'label'><label for = "conf_pass">Confirmation*:</label></td>
                                    <td><input type = "password" name = "conf_pass" id = "conf_pass" value = "<?php echo $clean['conf_pass']; ?>" /></td>
                                </tr>
                                <tr>
                                    <td class = 'label'><label for = "email">Email*:</label></td>
                                    <td><input type = "text" name = "email" id = "email" value = "<?php echo $clean['email']; ?>" /></td>
                                </tr>
                                <tr>
                                    <td class = 'label'><label for = "conf_email">Confirmation*:</label></td>
                                    <td><input type = "text" name = "conf_email" id = "conf_email" value = "<?php echo $clean['conf_email']; ?>" /></td>
                                </tr>
                                <tr>
                                    <td class = 'label'><label for = "avatar">Avatar:</label></td>
                                    <td><input type = "file" name = "avatar" id = "avatar"/></td>
                                </tr>
                                <tr>
                                    <td class = 'label'><label for = "isArtiste">Artiste?:</label></td>
                                    <td><input type = "checkbox" name = 'isArtiste' id = 'isArtiste' <?php echo ($clean['isArtiste'] != 0 ? " checked = 'checked'" : ""); ?> ></td>
                                </tr>
                            </table>

                        </section>
                        <section class="gauche">
                            <table>
                                <tr>
                                    <td class = 'label'><label for = "nom">Nom:</label></td>
                                    <td><input type = "text" name = "nom" id = "nom" value = "<?php echo $clean['nom']; ?>" /></td>
                                </tr>
                                <tr>
                                    <td class = 'label'><label for = "prenom">Prenom:</label></td>
                                    <td><input type = "text" name = "prenom" id = "prenom" value = "<?php echo $clean['prenom']; ?>" /></td>
                                </tr>
                                <tr>
                                    <td class = 'label'><label for = "date_naissance">Date de naissance*:</label></td>
                                    <td><input type = "text" name = "date_naissance" id = "date_naissance" value = "<?php echo $clean['date_naissance']; ?>"/></td>
                                </tr>
                                <tr>
                                    <td colspan = '2' id = "address_field">
                                        <label for = "adresse">Adresse:</label><br/>
                                        <textarea name = "adresse" id = 'adresse' rows="2"><?php echo $clean['adresse']; ?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td class = 'label'><label for = "ville">Ville:</label></td>
                                    <td><input type = "text" name = "ville" id = "ville" value = "<?php echo $clean['ville']; ?>" /></td>
                                </tr>
                                <tr>
                                    <td class = 'label'><label for = "CP">Code postal:</label></td>
                                    <td><input type = "text" name = "CP" id = "CP" value = "<?php echo $clean['CP']; ?>" /></td>
                                </tr>
                                <tr>
                                    <td class = 'label'><label for = "id_pays">Pays*:</label></td>
                                    <td>
                                        <?php echo (!isset($pays_selector) ? "" : $pays_selector->generateHTML()); ?>
                                    </td>
                                </tr>
                            </table>
                        </section>

                        <fieldset id = "option_artist">
                            <legend> Artiste </legend>
                            <section>
                                Categorie*:
                                <?php echo (!isset($categorie_selector) ? "" : $categorie_selector->generateHTML()); ?>
                            </section>

                            <section style = 'clear:both;'><label for = "url_site" >Site internet: </label><input type = "text" name = "url_site" id = "url_site" value = "<?php echo $clean['url_site']; ?>" /></section>

                        </fieldset>
                        <section> <button type = "submit">VALIDER</button> </section>
                    </section>
                </form>
            </div>
        </div>




    <!-- Datepicker -->
    <script type="text/javascript">
        $(function(){
            $('#date_naissance').datepicker({
                dateFormat:'yy-mm-dd',
                changeMonth: true,
                changeYear: true,
                yearRange : "1900:2012"
            })
        });
    </script>

    <!-- effet toggle lors du click sur checkbox artiste? -->
    <script type="text/javascript">
        $(function()
            {
                if($("#isArtiste").is(':checked') != true)
                {
                    $("#isArtiste").attr('checked', false);
                    $("#option_artist").css('display', 'none');
                }

                $("#isArtiste").click(function () {
                    $("#option_artist").slideToggle("fast");
                    })
            });

    </script>
<?php
    echo (!isset($inscription_result) ? "" : $inscription_result->generateJS());
    echo (!isset($global_nav_bar) ? "" : $global_nav_bar->generateJS());
    echo (!isset($pays_selector) ? "" : $pays_selector->generateJS());
    echo (!isset($categorie_selector) ? "" : $categorie_selector->generateJS());

    echo $footer->generateHTML();
    echo $html->generateHTMLEnd();
?>