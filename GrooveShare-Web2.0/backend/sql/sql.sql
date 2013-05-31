DELETE FROM Membres;
DELETE FROM Morceaux;
DELETE FROM Contenus;
DELETE FROM Samples;
DELETE FROM Videos;
DELETE FROM Photos;
DELETE FROM Pays;
DELETE FROM Liens;
DELETE FROM Langues;
DELETE FROM Artistes;
DELETE FROM Personnes;
DELETE FROM Administrateurs;
DELETE FROM Categories;
DELETE FROM Compilations;
DELETE FROM News;
DELETE FROM Styles_musicaux;
DELETE FROM categorie_artiste;
DELETE FROM traduction_categorie;
DELETE FROM langue_pays;
DELETE FROM note_contenu;
DELETE FROM commentaire_contenu;
DELETE FROM commentaire_artiste;
DELETE FROM note_artiste;
DELETE FROM commentaire_compilation;
DELETE FROM note_compilation;
DELETE FROM commentaire_news;
DELETE FROM note_news;
DELETE FROM participation_compilation;
DELETE FROM admin_responsable_compilation;
DELETE FROM admin_responsable_news;

DROP TABLE IF EXISTS Membres ;
DROP TABLE IF EXISTS Morceaux ;
DROP TABLE IF EXISTS Contenus ;
DROP TABLE IF EXISTS Samples ;
DROP TABLE IF EXISTS Videos ;
DROP TABLE IF EXISTS Photos ;
DROP TABLE IF EXISTS Pays ;
DROP TABLE IF EXISTS Liens ;
DROP TABLE IF EXISTS Langues ;
DROP TABLE IF EXISTS Artistes ;
DROP TABLE IF EXISTS Personnes ;
DROP TABLE IF EXISTS Administrateurs ;
DROP TABLE IF EXISTS Categories ;
DROP TABLE IF EXISTS Compilations ;
DROP TABLE IF EXISTS News ;
DROP TABLE IF EXISTS Styles_musicaux ;
DROP TABLE IF EXISTS categorie_artiste ;
DROP TABLE IF EXISTS traduction_categorie ;
DROP TABLE IF EXISTS langue_pays ;
DROP TABLE IF EXISTS note_contenu ;
DROP TABLE IF EXISTS commentaire_contenu ;
DROP TABLE IF EXISTS commentaire_artiste ;
DROP TABLE IF EXISTS note_artiste ;
DROP TABLE IF EXISTS commentaire_compilation ;
DROP TABLE IF EXISTS note_compilation ;
DROP TABLE IF EXISTS commentaire_news ;
DROP TABLE IF EXISTS note_news ;
DROP TABLE IF EXISTS participation_compilation ;
DROP TABLE IF EXISTS admin_responsable_compilation ;
DROP TABLE IF EXISTS admin_responsable_news ;

CREATE TABLE Pays
(
    id_pays INT AUTO_INCREMENT NOT NULL,
    nom_pays VARCHAR(50) NOT NULL,

    PRIMARY KEY (id_pays)
) ENGINE=MyISAM;

CREATE TABLE Langues
(
    id_langue INT AUTO_INCREMENT NOT NULL,
    nom_langue VARCHAR(50) NOT NULL,
    code_langue VARCHAR(6) NOT NULL,
    url_drapeau_langue TEXT,

    PRIMARY KEY (id_langue)
) ENGINE=MyISAM;

CREATE TABLE Categories
(
    id_categorie INT AUTO_INCREMENT NOT NULL,
    nom_categorie VARCHAR(100) NOT NULL,

    PRIMARY KEY (id_categorie)
) ENGINE=MyISAM;

CREATE TABLE Styles_musicaux
(
    id_style_musique INT AUTO_INCREMENT NOT NULL,
    nom_style_musique VARCHAR(50),

    PRIMARY KEY (id_style_musique)
) ENGINE=MyISAM;


CREATE TABLE Liens
(
    id_lien INT AUTO_INCREMENT NOT NULL,
    url_lien TEXT NOT NULL,
    id_artiste INT NOT NULL,

    PRIMARY KEY (id_lien)
) ENGINE=MyISAM;

CREATE TABLE Personnes
(
    id_personne INT AUTO_INCREMENT NOT NULL,
    nom_personne VARCHAR(50),
    prenom_personne VARCHAR(50),
    date_naissance_personne DATE NOT NULL,
    adresse_personne TEXT,
    email_personne VARCHAR(100) NOT NULL,
    CP_personne VARCHAR(20),
    ville_personne VARCHAR(50),
    login_personne VARCHAR(50) NOT NULL,
    pass_personne LONGTEXT NOT NULL,
    url_avatar_personne TEXT,
    publie_personne BOOL NOT NULL DEFAULT FALSE,
    id_langue INT NOT NULL,
    id_pays INT NOT NULL,

    PRIMARY KEY (id_personne)
) ENGINE=MyISAM;

CREATE TABLE Contenus
(
    id_contenu INT AUTO_INCREMENT NOT NULL,
    date_creation_contenu DATETIME NOT NULL,
    date_publication_contenu DATETIME,
    titre_contenu TEXT NOT NULL,
    url_contenu TEXT NOT NULL,
    publie_contenu BOOL NOT NULL DEFAULT FALSE,
    id_artiste_auteur INT NOT NULL,

    PRIMARY KEY (id_contenu)
) ENGINE=MyISAM;

CREATE TABLE Compilations
(
    id_compilation INT AUTO_INCREMENT NOT NULL,
    nom_compilation TEXT NOT NULL,
    prix_compilation INT NOT NULL DEFAULT 0,
    url_cover_front_compilation TEXT,
    url_cover_back_compilation TEXT,
    description_compilation LONGTEXT,
    date_creation_compilation DATETIME NOT NULL,
    date_publication_compilation DATETIME,
    publie_compilation BOOL NOT NULL DEFAULT FALSE,
    id_admin_responsable INT NOT NULL,

    PRIMARY KEY (id_compilation)
) ENGINE=MyISAM;

CREATE TABLE News
(
    id_news INT AUTO_INCREMENT NOT NULL,
    titre_news TEXT NOT NULL,
    texte_news LONGTEXT NOT NULL,
    date_creation_news DATETIME NOT NULL,
    date_publication_news DATETIME NOT NULL,
    publie_news BOOL NOT NULL DEFAULT FALSE,
    id_admin_auteur INT NOT NULL,

    PRIMARY KEY (id_news)
) ENGINE=MyISAM;

CREATE TABLE Artistes
(
    id_artiste INT AUTO_INCREMENT NOT NULL,
    credit_artiste INT NOT NULL DEFAULT 0,
    biographie_artiste LONGTEXT,
    url_site_artiste TEXT,
    id_personne INT NOT NULL,

    PRIMARY KEY (id_artiste)
) ENGINE=MyISAM;

CREATE TABLE Administrateurs
(
    id_admin INT AUTO_INCREMENT NOT NULL,
    id_personne INT NOT NULL,

    PRIMARY KEY (id_admin)
) ENGINE=MyISAM;

CREATE TABLE commentaire_contenu
(
    id_commentaire_contenu INT AUTO_INCREMENT NOT NULL,
    id_personne INT NOT NULL,
    id_contenu INT NOT NULL,
    date_commentaire_contenu DATETIME NOT NULL,
    texte_commentaire_contenu LONGTEXT NOT NULL,

    PRIMARY KEY (id_commentaire_contenu)
) ENGINE=MyISAM;

CREATE TABLE Membres
(
    id_membre INT AUTO_INCREMENT NOT NULL,
    credit_membre INT NOT NULL DEFAULT 0,
    id_personne INT NOT NULL,

    PRIMARY KEY (id_membre)
) ENGINE=MyISAM;

CREATE TABLE Morceaux
(
    id_morceau INT AUTO_INCREMENT NOT NULL,
    dl_possible_morceau BOOL NOT NULL DEFAULT FALSE,
    id_contenu INT NOT NULL,
    id_style_musique INT NOT NULL,

    PRIMARY KEY (id_morceau)
) ENGINE=MyISAM;

CREATE TABLE Samples
(
    id_sample INT AUTO_INCREMENT NOT NULL,
    prix_sample INT NOT NULL DEFAULT 0,
    id_contenu INT NOT NULL,

    PRIMARY KEY (id_sample)
) ENGINE=MyISAM;

CREATE TABLE Videos
(
    id_video INT AUTO_INCREMENT NOT NULL,
    id_contenu INT NOT NULL,

    PRIMARY KEY (id_video)
) ENGINE=MyISAM;

CREATE TABLE Photos
(
    id_photo INT AUTO_INCREMENT NOT NULL,
    id_contenu INT NOT NULL,

    PRIMARY KEY (id_photo)
) ENGINE=MyISAM;

CREATE TABLE categorie_artiste
(
    id_artiste INT NOT NULL,
    id_categorie INT NOT NULL,

    PRIMARY KEY (id_artiste, id_categorie)
) ENGINE=MyISAM;

CREATE TABLE traduction_categorie
(
    id_categorie INT NOT NULL,
    id_langue INT NOT NULL,
    traduction_nom_categorie VARCHAR(100) NOT NULL,

    PRIMARY KEY (id_categorie, id_langue)
) ENGINE=MyISAM;

CREATE TABLE note_contenu
(
    id_note_contenu INT AUTO_INCREMENT NOT NULL,
    id_personne INT  NOT NULL,
    id_contenu INT NOT NULL,
    date_note_contenu DATETIME NOT NULL,
    valeur_note_contenu INT NOT NULL,

    PRIMARY KEY (id_note_contenu)
) ENGINE=MyISAM;

CREATE TABLE commentaire_artiste
(
    id_commentaire_artiste INT AUTO_INCREMENT NOT NULL,
    id_personne INT NOT NULL,
    id_artiste INT NOT NULL,
    date_commentaire_artiste DATETIME NOT NULL,
    texte_commentaire_artiste LONGTEXT NOT NULL,

    PRIMARY KEY (id_commentaire_artiste)
) ENGINE=MyISAM;

CREATE TABLE note_artiste
(
    id_note_artiste INT AUTO_INCREMENT NOT NULL,
    id_artiste INT NOT NULL,
    date_note_artiste DATETIME NOT NULL,
    valeur_note_artiste INT NOT NULL,

    PRIMARY KEY (id_note_artiste)
) ENGINE=MyISAM;

CREATE TABLE commentaire_compilation
(
    id_commentaire_compilation INT AUTO_INCREMENT NOT NULL,
    id_compilation INT NOT NULL,
    id_personne INT NOT NULL,
    date_commentaire_compilation DATETIME NOT NULL,
    texte_commentaire_compilation LONGTEXT NOT NULL,

    PRIMARY KEY (id_commentaire_compilation)
) ENGINE=MyISAM;

CREATE TABLE note_compilation
(
    id_note_compilation INT AUTO_INCREMENT NOT NULL,
    id_compilation INT NOT NULL,
    id_personne INT NOT NULL,
    date_note_compilation DATETIME NOT NULL,
    valeur_note_compilation INT NOT NULL,

    PRIMARY KEY (id_note_compilation)
) ENGINE=MyISAM;

CREATE TABLE commentaire_news
(
    id_commentaire_news INT AUTO_INCREMENT NOT NULL,
    id_personne INT NOT NULL,
    id_news INT NOT NULL,
    date_commentaire_news DATETIME NOT NULL,
    texte_commentaire_news LONGTEXT NOT NULL,

    PRIMARY KEY (id_commentaire_news)
) ENGINE=MyISAM;

CREATE TABLE note_news
(
    id_note_news INT AUTO_INCREMENT NOT NULL,
    id_personne INT NOT NULL,
    id_news INT NOT NULL,
    date_note_news DATETIME NOT NULL,
    valeur_note_news INT NOT NULL,

    PRIMARY KEY (id_note_news)
) ENGINE=MyISAM;

CREATE TABLE participation_compilation
(
    id_compilation INT NOT NULL,
    id_morceau INT NOT NULL,

    PRIMARY KEY (id_compilation, id_morceau)
) ENGINE=MyISAM;


INSERT INTO `Categories` (`id_categorie`, `nom_categorie`) VALUES
(1, 'Auteur'),
(2, 'Compositeur'),
(3, 'Interprete'),
(4, 'Maison de disques'),
(5, 'Label ind&#233;pendant'),
(6, 'Home Studio');


INSERT INTO `Pays` VALUES(NULL,'United States');
INSERT INTO `Pays` VALUES(NULL,'United Kingdom');
INSERT INTO `Pays` VALUES(NULL,'Canada');
INSERT INTO `Pays` VALUES(NULL,'Australia');
INSERT INTO `Pays` VALUES(NULL,'Afghanistan');
INSERT INTO `Pays` VALUES(NULL,'Albania');
INSERT INTO `Pays` VALUES(NULL,'Algeria');
INSERT INTO `Pays` VALUES(NULL,'American Samoa');
INSERT INTO `Pays` VALUES(NULL,'Andorra');
INSERT INTO `Pays` VALUES(NULL,'Angola');
INSERT INTO `Pays` VALUES(NULL,'Anguilla');
INSERT INTO `Pays` VALUES(NULL,'Antarctica');
INSERT INTO `Pays` VALUES(NULL,'Antigua and Barbuda	');
INSERT INTO `Pays` VALUES(NULL,'Argentina');
INSERT INTO `Pays` VALUES(NULL,'Armenia');
INSERT INTO `Pays` VALUES(NULL,'Aruba');
INSERT INTO `Pays` VALUES(NULL,'Australia');
INSERT INTO `Pays` VALUES(NULL,'Austria');
INSERT INTO `Pays` VALUES(NULL,'Azerbaijan');
INSERT INTO `Pays` VALUES(NULL,'Bahamas');
INSERT INTO `Pays` VALUES(NULL,'Bahrain');
INSERT INTO `Pays` VALUES(NULL,'Bangladesh');
INSERT INTO `Pays` VALUES(NULL,'Barbados');
INSERT INTO `Pays` VALUES(NULL,'Belarus');
INSERT INTO `Pays` VALUES(NULL,'Belgium');
INSERT INTO `Pays` VALUES(NULL,'Belize');
INSERT INTO `Pays` VALUES(NULL,'Benin');
INSERT INTO `Pays` VALUES(NULL,'Bermuda');
INSERT INTO `Pays` VALUES(NULL,'Bhutan');
INSERT INTO `Pays` VALUES(NULL,'Bolivia');
INSERT INTO `Pays` VALUES(NULL,'Bosnia and Herzegovina');
INSERT INTO `Pays` VALUES(NULL,'Botswana');
INSERT INTO `Pays` VALUES(NULL,'Brazil');
INSERT INTO `Pays` VALUES(NULL,'British Indian Ocean');
INSERT INTO `Pays` VALUES(NULL,'Brunei');
INSERT INTO `Pays` VALUES(NULL,'Bulgaria');
INSERT INTO `Pays` VALUES(NULL,'Burkina Faso');
INSERT INTO `Pays` VALUES(NULL,'Burma (Myanmar)');
INSERT INTO `Pays` VALUES(NULL,'Burundi');
INSERT INTO `Pays` VALUES(NULL,'Cambodia');
INSERT INTO `Pays` VALUES(NULL,'Cameroon');
INSERT INTO `Pays` VALUES(NULL,'Canada');
INSERT INTO `Pays` VALUES(NULL,'Cape Verde');
INSERT INTO `Pays` VALUES(NULL,'Cayman Islands');
INSERT INTO `Pays` VALUES(NULL,'Central African Republic');
INSERT INTO `Pays` VALUES(NULL,'Chad');
INSERT INTO `Pays` VALUES(NULL,'Chile');
INSERT INTO `Pays` VALUES(NULL,'China');
INSERT INTO `Pays` VALUES(NULL,'Christmas Island');
INSERT INTO `Pays` VALUES(NULL,'Cocos (Keeling) Islands');
INSERT INTO `Pays` VALUES(NULL,'Colombia');
INSERT INTO `Pays` VALUES(NULL,'Comoros');
INSERT INTO `Pays` VALUES(NULL,'Congo, Democratic Republic of the');
INSERT INTO `Pays` VALUES(NULL,'Congo, Republic of the');
INSERT INTO `Pays` VALUES(NULL,'Cook Islands');
INSERT INTO `Pays` VALUES(NULL,'Costa Rica');
INSERT INTO `Pays` VALUES(NULL,'Croatia');
INSERT INTO `Pays` VALUES(NULL,'Cyprus');
INSERT INTO `Pays` VALUES(NULL,'Czech Republic');
INSERT INTO `Pays` VALUES(NULL,'Denmark');
INSERT INTO `Pays` VALUES(NULL,'Djibouti');
INSERT INTO `Pays` VALUES(NULL,'Dominica');
INSERT INTO `Pays` VALUES(NULL,'Dominican Republic');
INSERT INTO `Pays` VALUES(NULL,'East Timor');
INSERT INTO `Pays` VALUES(NULL,'Ecuador');
INSERT INTO `Pays` VALUES(NULL,'Egypt');
INSERT INTO `Pays` VALUES(NULL,'El Salvador');
INSERT INTO `Pays` VALUES(NULL,'Equatorial Guinea');
INSERT INTO `Pays` VALUES(NULL,'Eritrea');
INSERT INTO `Pays` VALUES(NULL,'Estonia');
INSERT INTO `Pays` VALUES(NULL,'Ethiopia');
INSERT INTO `Pays` VALUES(NULL,'Falkland Islands (Malvinas)');
INSERT INTO `Pays` VALUES(NULL,'Faroe Islands');
INSERT INTO `Pays` VALUES(NULL,'Fiji');
INSERT INTO `Pays` VALUES(NULL,'Finland');
INSERT INTO `Pays` VALUES(NULL,'France');
INSERT INTO `Pays` VALUES(NULL,'French Guiana');
INSERT INTO `Pays` VALUES(NULL,'French Polynesia');
INSERT INTO `Pays` VALUES(NULL,'Gabon');
INSERT INTO `Pays` VALUES(NULL,'Gambia');
INSERT INTO `Pays` VALUES(NULL,'Georgia');
INSERT INTO `Pays` VALUES(NULL,'Germany');
INSERT INTO `Pays` VALUES(NULL,'Ghana');
INSERT INTO `Pays` VALUES(NULL,'Gibraltar');
INSERT INTO `Pays` VALUES(NULL,'Greece');
INSERT INTO `Pays` VALUES(NULL,'Greenland');
INSERT INTO `Pays` VALUES(NULL,'Grenada');
INSERT INTO `Pays` VALUES(NULL,'Guadeloupe');
INSERT INTO `Pays` VALUES(NULL,'Guam');
INSERT INTO `Pays` VALUES(NULL,'Guatemala');
INSERT INTO `Pays` VALUES(NULL,'Guinea');
INSERT INTO `Pays` VALUES(NULL,'Guinea-Bissau');
INSERT INTO `Pays` VALUES(NULL,'Guyana');
INSERT INTO `Pays` VALUES(NULL,'Haiti');
INSERT INTO `Pays` VALUES(NULL,'Honduras');
INSERT INTO `Pays` VALUES(NULL,'Hong Kong');
INSERT INTO `Pays` VALUES(NULL,'Hungary');
INSERT INTO `Pays` VALUES(NULL,'Iceland');
INSERT INTO `Pays` VALUES(NULL,'India');
INSERT INTO `Pays` VALUES(NULL,'Indonesia');
INSERT INTO `Pays` VALUES(NULL,'Iraq');
INSERT INTO `Pays` VALUES(NULL,'Ireland');
INSERT INTO `Pays` VALUES(NULL,'Israel');
INSERT INTO `Pays` VALUES(NULL,'Italy');
INSERT INTO `Pays` VALUES(NULL,'Ivory Coast');
INSERT INTO `Pays` VALUES(NULL,'Jamaica');
INSERT INTO `Pays` VALUES(NULL,'Japan');
INSERT INTO `Pays` VALUES(NULL,'Jordan');
INSERT INTO `Pays` VALUES(NULL,'Kazakhstan');
INSERT INTO `Pays` VALUES(NULL,'Kenya');
INSERT INTO `Pays` VALUES(NULL,'Kiribati');
INSERT INTO `Pays` VALUES(NULL,'Korea, South');
INSERT INTO `Pays` VALUES(NULL,'Kuwait');
INSERT INTO `Pays` VALUES(NULL,'Kyrgyzstan');
INSERT INTO `Pays` VALUES(NULL,'Laos');
INSERT INTO `Pays` VALUES(NULL,'Latvia');
INSERT INTO `Pays` VALUES(NULL,'Lebanon');
INSERT INTO `Pays` VALUES(NULL,'Lesotho');
INSERT INTO `Pays` VALUES(NULL,'Liberia');
INSERT INTO `Pays` VALUES(NULL,'Liechtenstein');
INSERT INTO `Pays` VALUES(NULL,'Lithuania');
INSERT INTO `Pays` VALUES(NULL,'Luxembourg');
INSERT INTO `Pays` VALUES(NULL,'Macau');
INSERT INTO `Pays` VALUES(NULL,'Macedonia, Republic of');
INSERT INTO `Pays` VALUES(NULL,'Madagascar');
INSERT INTO `Pays` VALUES(NULL,'Malawi');
INSERT INTO `Pays` VALUES(NULL,'Malaysia');
INSERT INTO `Pays` VALUES(NULL,'Maldives');
INSERT INTO `Pays` VALUES(NULL,'Mali');
INSERT INTO `Pays` VALUES(NULL,'Malta');
INSERT INTO `Pays` VALUES(NULL,'Marshall Islands');
INSERT INTO `Pays` VALUES(NULL,'Martinique');
INSERT INTO `Pays` VALUES(NULL,'Mauritania');
INSERT INTO `Pays` VALUES(NULL,'Mauritius');
INSERT INTO `Pays` VALUES(NULL,'Mayotte');
INSERT INTO `Pays` VALUES(NULL,'Mexico');
INSERT INTO `Pays` VALUES(NULL,'Micronesia');
INSERT INTO `Pays` VALUES(NULL,'Moldova');
INSERT INTO `Pays` VALUES(NULL,'Monaco');
INSERT INTO `Pays` VALUES(NULL,'Mongolia');
INSERT INTO `Pays` VALUES(NULL,'Montserrat');
INSERT INTO `Pays` VALUES(NULL,'Morocco');
INSERT INTO `Pays` VALUES(NULL,'Mozambique');
INSERT INTO `Pays` VALUES(NULL,'Namibia');
INSERT INTO `Pays` VALUES(NULL,'Nauru');
INSERT INTO `Pays` VALUES(NULL,'Nepal');
INSERT INTO `Pays` VALUES(NULL,'Netherlands');
INSERT INTO `Pays` VALUES(NULL,'Netherlands Antilles');
INSERT INTO `Pays` VALUES(NULL,'New Caledonia');
INSERT INTO `Pays` VALUES(NULL,'New Zealand');
INSERT INTO `Pays` VALUES(NULL,'Nicaragua');
INSERT INTO `Pays` VALUES(NULL,'Niger');
INSERT INTO `Pays` VALUES(NULL,'Nigeria');
INSERT INTO `Pays` VALUES(NULL,'Niue');
INSERT INTO `Pays` VALUES(NULL,'Norfolk Island');
INSERT INTO `Pays` VALUES(NULL,'Northern Mariana Islands');
INSERT INTO `Pays` VALUES(NULL,'Norway');
INSERT INTO `Pays` VALUES(NULL,'Oman');
INSERT INTO `Pays` VALUES(NULL,'Pakistan');
INSERT INTO `Pays` VALUES(NULL,'Palau');
INSERT INTO `Pays` VALUES(NULL,'Palestinian Territory');
INSERT INTO `Pays` VALUES(NULL,'Panama');
INSERT INTO `Pays` VALUES(NULL,'Papua New Guinea');
INSERT INTO `Pays` VALUES(NULL,'Paraguay');
INSERT INTO `Pays` VALUES(NULL,'Peru');
INSERT INTO `Pays` VALUES(NULL,'Philippines');
INSERT INTO `Pays` VALUES(NULL,'Pitcairn Island');
INSERT INTO `Pays` VALUES(NULL,'Poland');
INSERT INTO `Pays` VALUES(NULL,'Portugal');
INSERT INTO `Pays` VALUES(NULL,'Puerto Rico');
INSERT INTO `Pays` VALUES(NULL,'Qatar');
INSERT INTO `Pays` VALUES(NULL,'R&#233;union');
INSERT INTO `Pays` VALUES(NULL,'Romania');
INSERT INTO `Pays` VALUES(NULL,'Russia');
INSERT INTO `Pays` VALUES(NULL,'Rwanda');
INSERT INTO `Pays` VALUES(NULL,'Saint Helena');
INSERT INTO `Pays` VALUES(NULL,'Saint Kitts and Nevis');
INSERT INTO `Pays` VALUES(NULL,'Saint Lucia');
INSERT INTO `Pays` VALUES(NULL,'Saint Pierre and Miquelon');
INSERT INTO `Pays` VALUES(NULL,'Saint Vincent and the Grenadines');
INSERT INTO `Pays` VALUES(NULL,'Samoa');
INSERT INTO `Pays` VALUES(NULL,'San Marino');
INSERT INTO `Pays` VALUES(NULL,'S&#227;o Tome and Principe');
INSERT INTO `Pays` VALUES(NULL,'Saudi Arabia');
INSERT INTO `Pays` VALUES(NULL,'Senegal');
INSERT INTO `Pays` VALUES(NULL,'Serbia and Montenegro');
INSERT INTO `Pays` VALUES(NULL,'Seychelles');
INSERT INTO `Pays` VALUES(NULL,'Sierra Leone');
INSERT INTO `Pays` VALUES(NULL,'Singapore');
INSERT INTO `Pays` VALUES(NULL,'Slovakia');
INSERT INTO `Pays` VALUES(NULL,'Slovenia');
INSERT INTO `Pays` VALUES(NULL,'Solomon Islands');
INSERT INTO `Pays` VALUES(NULL,'Somalia');
INSERT INTO `Pays` VALUES(NULL,'South Africa');
INSERT INTO `Pays` VALUES(NULL,'South Georgia and the South Sandwich Islands');
INSERT INTO `Pays` VALUES(NULL,'Spain');
INSERT INTO `Pays` VALUES(NULL,'Sri Lanka');
INSERT INTO `Pays` VALUES(NULL,'Suriname');
INSERT INTO `Pays` VALUES(NULL,'Svalbard and Jan Mayen');
INSERT INTO `Pays` VALUES(NULL,'Swaziland');
INSERT INTO `Pays` VALUES(NULL,'Sweden');
INSERT INTO `Pays` VALUES(NULL,'Switzerland');
INSERT INTO `Pays` VALUES(NULL,'Taiwan');
INSERT INTO `Pays` VALUES(NULL,'Tajikistan');
INSERT INTO `Pays` VALUES(NULL,'Tanzania');
INSERT INTO `Pays` VALUES(NULL,'Thailand');
INSERT INTO `Pays` VALUES(NULL,'Togo');
INSERT INTO `Pays` VALUES(NULL,'Tokelau');
INSERT INTO `Pays` VALUES(NULL,'Tonga');
INSERT INTO `Pays` VALUES(NULL,'Trinidad and Tobago');
INSERT INTO `Pays` VALUES(NULL,'Tunisia');
INSERT INTO `Pays` VALUES(NULL,'Turkey');
INSERT INTO `Pays` VALUES(NULL,'Turkmenistan');
INSERT INTO `Pays` VALUES(NULL,'Turks and Caicos Islands');
INSERT INTO `Pays` VALUES(NULL,'Tuvalu');
INSERT INTO `Pays` VALUES(NULL,'Uganda');
INSERT INTO `Pays` VALUES(NULL,'Ukraine');
INSERT INTO `Pays` VALUES(NULL,'United Arab Emirates');
INSERT INTO `Pays` VALUES(NULL,'United Kingdom');
INSERT INTO `Pays` VALUES(NULL,'United States');
INSERT INTO `Pays` VALUES(NULL,'United States Minor Outlying Islands');
INSERT INTO `Pays` VALUES(NULL,'Uruguay');
INSERT INTO `Pays` VALUES(NULL,'Uzbekistan');
INSERT INTO `Pays` VALUES(NULL,'Vanuatu');
INSERT INTO `Pays` VALUES(NULL,'Vatican City');
INSERT INTO `Pays` VALUES(NULL,'Venezuela');
INSERT INTO `Pays` VALUES(NULL,'Vietnam');
INSERT INTO `Pays` VALUES(NULL,'Virgin Islands, British');
INSERT INTO `Pays` VALUES(NULL,'Virgin Islands, U. S.');
INSERT INTO `Pays` VALUES(NULL,'Wallis and Futuna');
INSERT INTO `Pays` VALUES(NULL,'Western Sahara');
INSERT INTO `Pays` VALUES(NULL,'Yemen');
INSERT INTO `Pays` VALUES(NULL,'Zambia');
INSERT INTO `Pays` VALUES(NULL,'Zimbabw');