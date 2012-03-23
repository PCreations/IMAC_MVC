<?php
include_once('models/quizz.php');

function index() {
	echo "Bienvenue sur l'index du controller quizz";
}

function hello($name) {
	echo "Bonjour $name !";
}

function metAuCarre($nombre) {
	$vars['nombre'] = $nombre * $nombre;
	$vars['pageTitle'] = "Met au carré";
	$quizz = getQuizz();
	render('metAuCarre', $vars);
	//require_once('views/quizz/metAuCarre.php');
}

function form() {
	$pageTitle = "Form bidon";
	$vars['pageTitle'] = 'Formulaire bidon';
	if (isset($_POST['pseudo']) && !empty($_POST['pseudo'])) {
		$vars['pseudo'] = $_POST['pseudo'];
		render('resultForm', $vars);
	}
	else {
		render('form', $vars);
	}
}