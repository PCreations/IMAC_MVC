<?php
require_once("models/blog.php");

$defaultCSS = array('blog.css');

function index() {
	$listeArticles = getArticles();

	foreach($listeArticles as &$article) {
		$article['titre'] = htmlspecialchars($article['titre']);
		$article['text'] = htmlspecialchars($article['text']);
	}

	$vars['listeArticles'] = $listeArticles;
	render('listeArticles', $vars);
}