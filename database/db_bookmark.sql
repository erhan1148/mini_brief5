CREATE DATABASE brief5

CREATE TABLE `categorie` (
    `categorie_id` int (11) PRIMARY KEY NOT NULL,
    `categorie_nom` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
)

INSERT INTO `categorie` (`categorie_id`, `categorie_nom`) VALUES
(1, 'OUTILS'),
(2, 'DESIGN'),
(3, 'FRONT-END'),
(4, 'BACK-END'),
(5, 'DEV WEB MOBILE'),
(6, 'VEILLES');

CREATE TABLE `lien` (
    `lien_id` int (11) PRIMARY KEY NOT NULL,
    `lien_nom` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
    `lien_url` varchar(5000) CHARACTER SET utf8 DEFAULT NULL,
    `lien_description` varchar(5000) CHARACTER SET utf8 DEFAULT NULL
  
);

INSERT INTO `lien` (`lien_id`, `lien_nom`,`lien_url`, `lien_description`) VALUES
(1, 'FIGMA', 'https://figma.com/', 'Outil de prototypage'),
(2, 'ALGOBOX', 'https://www.xm1math.net/algobox/', 'Logiciel algorithmes'),
(3, 'DEVELOPPEUR', 'https://code.visualstudio.com/', 'Éditeur de code extensible'),
(4, 'SUPPORTS', 'https://drive.google.com/file/d/13Jrto7jRgyCmP660VsZx76aI1zUYKE5j/view?usp=sharing', 'Google drive'),
(5, 'GITHUB', 'https://github.com/', 'Service web hébergement et de gestion de développement de logiciels '),
(6, 'CSS', 'https://openclassrooms.com/fr/courses/1603881-apprenez-a-creer-votre-site-web-avec-html5-et-css3', ' Langage informatique'),
(7, 'FLEXBOX', 'https://youtu.be/UcC76tcvLgA', 'Module css3'),
(8, 'JS', 'https://developer.mozilla.org/fr/docs/Web/JavaScript', 'Langage de programmation de scripts '),
(9, 'PHP', 'https://www.php.net/manual/fr/', 'Bdd'),
(10, 'RESPONSIVE', 'https://www.codingame.com/', 'Mobile'),



CREATE TABLE categorie_lien (
    categorie_id INTEGER,
    lien_id INTEGER,
    PRIMARY KEY (categorie_id, lien_id),
    FOREIGN KEY (categorie_id) REFERENCES categorie(categorie_id),
    FOREIGN KEY (lien_id) REFERENCES lien(lien_id)
);

