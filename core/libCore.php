<?php
/**
 * \brief Rend la vue demandée en y affectant les différentes variables définies dans le contrôleur et génération des liens vers les fichiers .css et .js. A utiliser depuis le \b contrôleur
 *
 * \author Pierre Criulanscy
 * \since 0.1.1
 * \param $view nom de la vue à rendre
 * \param $vars variables à faire passer à la vue sous la forme d'un tableau associatif. La clé représente le nom de la variable qui pourra être utilisée dans la vue, sa valeur correspond à la valeur de la clé dans le tableau. Si $vars = array("var1" => "toto", "var2" => "titi"); alors dans la vue seront accessibles les variables $var1 et $var2 avec comme valeur respective "toto" et "titi"
 */
function render($view, $vars = array()) {
	global $currentController; //récupération de la variable qui stockera le contrôleur ocurant
	global $CSS_FILES; //récupération de la liste des fichiers .css
	global $JS_FILES; //récupération de la liste des fichiers .js
	global $pageTitle; //récupération du titre


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
	
	/* Tamporisation de sortie pour inclure la vue. Tout ce que l'on écrit avec ob_start() est "enregistré" dans un buffer. Le contenu de ce buffer (ici c'est à dire le contenu du fichier layout.php) peut-être récupéré dans une variable avec la fonction ob_get_clean() */
	ob_start(); 
	require_once("views/$currentController/$view.php"); //on bufferise le contenu de la vue
	$contentForLayout = ob_get_clean(); //qu'on stocke dans la variable $contentForLayout
	require_once(THEME_PATH . DS . 'layout.php'); //au final le layout est affiché avec en son sein le contenu de la vue
}

/**
 * \brief Ajoute un fichier .js dans le tableau global des fichiers à inclure. A utiliser depuis le \b contrôleur
 *
 * \author Pierre Criulanscy
 * \since 0.1.1
 * \param $js nom du fichier .js (avec l'extension)
 */
function addJS($js) {
	global $JS_FILES; //liste des fichiers .js

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

/**
 * \brief Ajoute un fichier .css dans le tableau global des fichiers à inclure. A utiliser depuis le \b contrôleur
 *
 * \author Pierre Criulanscy
 * \since 0.1.1
 * \param $css nom du fichier .css (avec l'extension)
 */
function addCSS($css) {
	global $CSS_FILES; //liste des fichiers .css

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


/**
 * \brief Redirige l'internaute vers l'action du contrôleur demandé. A utiliser depuis le \b contrôleur
 *
 * \author Pierre Criulanscy
 * \since 0.1.1
 * \param $controller nom du contrôleur
 * \param $action nom de l'action
 * \param $params paramètres éventuels à passer à l'action
 */
function redirect($controller, $action, $params = array()) {
	header('Location: ' . BASE_URL . l($controller, $action, $params));
	exit();
}

/**
 * \brief Création d'un lien au format prédéfini dans l'application (par défaut controller/action/[param1/params2]...). A utiliser depuis le \b contrôleur ou directement depuis la \b vue
 *
 * \author Pierre Criulanscy
 * \since 0.1.1
 * \param $controller nom du contrôleur
 * \param $action nom de l'action
 * \param $params paramètres éventuels à passer à l'action sous forme de tableau
 * \return le lien absolu vers l'action demandée
 */
function createLink($controller, $action, $params = array()) {
	
	$listeParams = '';

	if(isset($params)) {
		foreach($params as $param) {
			$listeParams .= "/$param";
		}
	}

	return BASE_URL . $controller . '/' . $action . $listeParams;
}


/**
 * \brief Alias de createLink(). A utiliser depuis le \b contrôleur ou directement depuis la \b vue
 *
 * \author Pierre Criulanscy
 * \since 0.1.1
 * \param $controller nom du contrôleur
 * \param $action nom de l'action
 * \param $params paramètres éventuels à passer à l'action sous forme de tableau
 * \return le lien absolu vers l'action demandée
 */
function l($controller, $action, $params = array()) {
	return createLink($controller, $action, $params);
}