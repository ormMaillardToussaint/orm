<?php
namespace models;
class Categorie extends Model{
	protected static $table = "categorie";
	protected static $primary = "id";

	public function articles(){
		return $this->has_many("article", "id_categ");
	}
}
?>