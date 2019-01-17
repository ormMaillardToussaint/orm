<?php
namespace models;
class Article extends Model{
	protected static $table = "article";
	protected static $primary = "id";

	public function categorie(){
		return $this->belongs_to("categorie", "id_categ");
	}
}
?>