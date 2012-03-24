<?php
define('GET_VAR_NAME', 'page');
define('INDEX_ACTION', 'index');
define('BASE_URL', 'http://localhost/mvc/');
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__))); //racine du projet
define('WEBROOT_DIR', 'www'); //repertoire où seront stocké les images, les fichiers css, les js, etc.
define('WWW_ROOT', ROOT . DS . WEBROOT_DIR); //chemin vers ce dossier
define('THEME_PATH', ROOT . DS . 'views' . DS . 'themes' . DS . $theme); //chemin vers le dossier de theme
define('CSS_DIR', BASE_URL . 'views/themes/' . $theme . '/css/');
define('IMG_DIR', BASE_URL . 'views/themes/' . $theme . '/img/');
define('JS_DIR', BASE_URL . 'views/themes/' . $theme . '/js/');
