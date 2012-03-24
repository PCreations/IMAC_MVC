<?php
/**
 * Thème global de l'application
 * @var string
 */
$theme = 'default';

/**
 * Contrôleur courant utiliser pour inclure les vues correspondantes
 * @var string 
 */
$currentController;

/**
 * Titre par défaut des pages. Peut-être surchargé par $pageTitlePrefix et $finalPageTitle
 * @var string 
 */ 
$pageTitle = 'IMAC MVC'; 

/**
 * Tableau contenant la liste des fichiers .js à inclure
 * @var array 
 */
$JS_FILES = array();

/**
 * Tableau contenant la liste des fichiers .css à inclure
 * @var array 
 */
$CSS_FILES = array();



/**
 * inclusion du coeur de l'application 
 */
require_once('core/core.php');


/**********************/
// INCLURE ICI TOUTES LES ACTIONS A EFFECTUER AVANT LE ROUTING (Comme par exemple vérifier les droits d'acces et eventuellement rediriger vers la page de login)
/**********************/


/**
 * Lancement du routing pour inclure la bonne page 
 */
dispatch();

