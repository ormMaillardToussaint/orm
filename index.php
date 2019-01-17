<?php
require_once("./src/utils/ClassLoader.php");
$loader = new ClassLoader('src');
$loader->register();
use \query\Query as Query;
use \models\Model as Model;
use \models\Article as Article;
use \models\Categorie as Categorie;

$article = Article::find(64);
echo "<span>find(64)</span><br/>";
var_dump($article);
echo "<br/><br/><br/>";

$article2 = Article::find(64, ["id", "nom"]);
echo "<span>find(64, ['id', 'nom'])</span><br/>";
var_dump($article2);
echo "<br/><br/><br/>";

$article3 = Article::find(["tarif", "<", 100], ["id", "nom"]);
echo "<span>find(['tarif', '<', 100], ['id', 'nom'])</span><br/>";
var_dump($article3);
echo "<br/><br/><br/>";

$article4 = Article::first(64);
echo "<span>first(64)</span><br/>";
var_dump($article4);
echo "<br/><br/><br/>";

$article4 = Article::first(64);
echo "<span>first(64)</span><br/>";
var_dump($article4);
echo "<br/><br/><br/>";

$articles = Article::where("tarif", ">", 100)->get();
echo "<span>where('tarif', '>', 100)->get()</span><br/>";
var_dump($articles);
echo "<br/><br/><br/>";

$articles2 = Article::select(["id", "tarif"])->get();
echo "<span>select(['id', 'tarif'])->get()</span><br/>";
var_dump($articles2);
echo "<br/><br/><br/>";

echo "<span>insert d'un article</span><br/>";
$article5 = new Article();
var_dump($article5);
$article5->nom = "vélo";
$article5->descr = "vélo de course";
$article5->tarif = "150";
$article5->id_categ = 1;
echo "<br/><span>ajout des valeurs des attributs, il faut décommenter la ligne 44 dans le code pour exécuter l'insert</span><br/>";
var_dump($article5);
//$article5->insert();
echo "<br/><br/><br/>";

$articles = Article::all();
echo "<span>all sur Article</span><br/>";
var_dump($articles);
echo "<br/><br/><br/>";

$categorie = $article4->categorie();
var_dump($article4);
echo "<br/><span>categorie() sur un article fait un belongs_to</span><br/>";
var_dump($categorie);
echo "<br/><br/><br/>";

$articles3 = $categorie->articles();
var_dump($categorie);
echo "<br/><span>articles() sur une catégorie fait un has_many</span><br/>";
var_dump($articles3);
?>

<style type="text/css">
	span{
		font-size: 24px;
	}
</style>