<?php
//fonctions
function getControllers() {

	static $controllers;
	if (is_array($controllers))
		return $controllers;

	$dirname = 'controllers/';
	$dir = opendir($dirname); 

	while($file = readdir($dir)) {
		if($file != '.' && $file != '..' && !is_dir($dirname.$file))
		{
			$controllers[] = str_replace('Controller.php', '', $file);
		}
	}

	closedir($dir);

	return $controllers;
}

function render($view, $vars = array()) {
	global $currentController;
	extract($vars);
	ob_start(); //on commence la tamporisation de sortie
	require_once("views/$currentController/$view.php"); //on bufferise le contenu de la vue
	$contentForLayout = ob_get_clean(); //qu'on stocke dans la variable $contentForLayout
	require_once(THEME_PATH . DS . 'layout.php'); //au final le layout est affiché avec en son sein le contenu de la vue
}

function addJS($js) {
	global $JS_FILES;
	if (is_array($js)) {
		foreach($js as $jsName) {
			if(!in_array($JS_FILES, $jsName)) {
				$JS_FILES[] = $jsName;
			}
		}
	}
	else {

	}
}