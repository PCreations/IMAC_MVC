<h1>Liste des articles</h1>
<?php
foreach ($listeArticles as $article) {
	echo "<h2>{$article['titre']}</h2>";
	echo "<p>{$article['text']}</p>";
}
?>