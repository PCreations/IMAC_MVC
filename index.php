<?php
/* variables globales */
$theme = 'default';
$currentController;
$pageTitle = 'IMAC MVC';
$JS_FILES = array();
$CSS_FILES = array();


/* récupération de la liste des controlleurs */

/* inclusion du coeur de l'application */
require_once('core/core.php');

/* connexion bdd */
//inclusion connexion bdd
dispatch();

