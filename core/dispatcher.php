<?php

/**
 * Cette fonction formate et affiche une chaîne de caractères dans la sortie standard.
 * @author Pierre Criulanscy
 * @param $defaultController controller par défaut à appelé si aucune page n'est demandée (i.e la page d'accueil du site)
 * @param format Chaîne décrivant le format d'affichage
 * @since 3.2
 * @return un booléen valant True si l'affichage c'est bien passé, False sinon
 */
function dispatch($defaultController = null, $defaultAction = INDEX_ACTION, $rewrite = false) {
	if(isset($_GET[GET_VAR_NAME]) && !empty($_GET[GET_VAR_NAME])) {
		$url = $_GET[GET_VAR_NAME];
	}
	else {
		if ($defaultController != null) {
			if($rewrite)
				redirect($defaultController, $defaultAction);
			else
				$url = $defaultController . '/' . $defaultAction;
		}
		else {
			$url = "pages/home";
		}
		
	}
	parseURL($url);
}

function parseURL($url) {
	global $currentController;
	global $CSS_FILES;
	global $JS_FILES;
	global $pageTitle;

	$url = rtrim($url, '/'); //suppression des "/" en fin
	$params = explode('/', $url); //on coupe en fonction des "/"
	$currentController = $params[0]; //le nom du controller est le premier élement
	$action = (isset($params[1])) ? $params[1] : 'index';
	$params = array_slice($params, 2); //on récupère uniquement un tableau contenant les paramètres

	/* Inclusion du controller demandé, s'il n'existe pas en inclu à la place le controller qui gere les erreurs 404 (ici le controller 404) */

	$controllerFilePath = getControllerFilePath($currentController);
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

	//Si on a spécifié un prefix pour le titre des pages dans le controller alors on le définit comme titre
	if(isset($pageTitlePrefix))
		$pageTitle = $pageTitlePrefix;

	//On vérifie si l'action existe bien
	if (!function_exists($action)) //si la fonction n'existe pas on redirige vers l'index du controller
		$action = 'index';

	/* Appel de l'action demandée pour le controller demandé */	
	call_user_func_array($action, $params);
}

function getControllerFilePath($controller) {
	$file = 'controllers/' . $controller . 'Controller.php';
	if(is_file($file))
		return $file;
	else
		return 'controllers/404Controller.php';
}