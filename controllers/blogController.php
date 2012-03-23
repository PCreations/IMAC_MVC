<?php
require_once("models/blog.php");

function index() {
	$listeArticles = getArticles();

	foreach($listeArticles as &$article) {
		$article['titre'] = htmlspecialchars($article['titre']);
		$article['text'] = htmlspecialchars($article['text']);
	}

	$vars['listeArticles'] = $listeArticles;
	render('blog', 'listeArticles', $vars);
}