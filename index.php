<?php
/* variables globales */
$theme = 'default';
$currentController;
$JS_FILES = array();
$CSS_FILES = array();

/* constantes */
require_once("core/constants.php");

/* connexion bdd */
//inclusion connexion bdd

/* fonctions du coeur */
require_once("core/functions.php");

$controllersList = getControllers();

if(isset($_GET['page'])) {

	/* ROUTAGE */
	$url = ltrim($_GET['page'], '/'); //suppression des "/" en début
	$url = rtrim($url, '/'); //suppression des "/" en fin
	$params = explode('/', $url); //on coupe en fonction des "/"
	$currentController = $params[0]; //le nom du controller est le premier élement
	$action = (isset($params[1])) ? $params[1] : 'index';
	$params = array_slice($params, 2); //on récupère uniquement un tableau contenant les paramètres

	/* APPEL DE LA BONNE PAGE */
	//On vérifie que le controller existe bien
	if(!in_array($currentController, $controllersList))
		$currentController = '404';
}
else {
	//on affiche l'index
}

$controllerFilePath = 'controllers/' . $currentController . 'Controller.php';

require_once($controllerFilePath);

/* reset des fichiers CSS et JS pour qu'ils correspondent à ceux par défaut du controller */
if (isset($defaultCSS)) {
	if(is_array($defaultCSS)) {
		$CSS_FILES = $defaultCSS;
	}
}
if (isset($defaultJS)) {
	if(is_array($defaultJS)) {
		$JS_FILES = $defaultJS;
	}
}

//On vérifie si l'action existe bien
if (!function_exists($action)) //si la fonction n'existe pas on redirige vers l'index du controller
	$action = 'index';
//$action($params[0]);
call_user_func_array($action, $params);