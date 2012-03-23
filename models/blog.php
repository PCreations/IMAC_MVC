<?php

function getArticles() {
	$listeArticles = array(
							array('titre' => 'Mon premier article',
								  'text' => 'Mon super <strong>texte</strong> !',
								  'pseudo' => 'Pierre'),
							array('titre' => 'Mon deuxième article',
								  'text' => 'Mon super deuxième texte ! <script type="text\javascript">',
								  'pseudo' => 'Tom'),
							);
	return $listeArticles;
}