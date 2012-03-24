<?php

$pageTitlePrefix = 'Blog - ';

function index() {
	$vars['pageTitle'] = 'Accueil';
	render('home', $vars);
}

function article($id) {
	$vars['id'] = 1;
	$vars['titre'] = 'Première article';
	$vars['content'] = 'Contenu';
	$vars['pageTitle'] = $vars['titre'];
	render('article', $vars);
}