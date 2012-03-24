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
	global $pageTitle;
	global $JS_FILES;
	global $CSS_FILES;

	$jsList = '';
	$cssList = '';

	if(is_array($JS_FILES)) {
		foreach ($JS_FILES as $js) {
			$jsList .= "<script type=\"text/javascript\" scr=\"" . JS_DIR . "$js\"></script>\n";
		}
	}
	else
		$jsList = "<script type=\"text/javascript\" scr=\"" . JS_DIR . "$js\"></script>\n";
	if(is_array($CSS_FILES)) {
		foreach ($CSS_FILES as $css) {
			$cssList .= "<link rel=\"stylesheet\" href=\"" . CSS_DIR . "$css\" />";
		}	
	}
	else
		$cssList = "<link rel=\"stylesheet\" href=\"" . CSS_DIR . "$css\" />";
	

	/* récupération du titre de la page */
	$finalPageTitle = (isset($vars['pageTitle'])) ? $pageTitle .$vars['pageTitle'] : $pageTitle;

	extract($vars);
	$pageTitle = $finalPageTitle;
	
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
				$JS_FILES[] = $js;
			}
		}
	}
	else {
		$JS_FILES[] = $js;
	}
}

function addCSS($css) {
	global $CSS_FILES;
	if (is_array($css)) {
		foreach($css as $cssName) {
			if(!in_array($CS_FILES, $cssName)) {
				$CSS_FILES[] = $css;
			}
		}
	}
	else {
		$CSS_FILES[] = $css;
	}
}

function redirect($controller, $action) {
	header('Location: ' . BASE_URL . 'index.php?' . GET_VAR_NAME . '=' . $controller . '/' . $action);
	exit();
}

function createLink($controller, $action, $params = array()) {
	
	$listeParams = '';

	if(isset($params)) {
		foreach($params as $param) {
			$listeParams .= "/$param";
		}
	}

	return BASE_URL . $controller . '/' . $action . $listeParams;
}

function l($controller, $action, $params = array()) {
	return createLink($controller, $action, $params);
}