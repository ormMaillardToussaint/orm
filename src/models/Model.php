<?php
namespace models;
use query\Query;
abstract class Model{
	protected static $table;
	protected static $primary;
	protected $_v = array();
	protected static $query;

	public function __construct(array $t = null){
		if($t != null){
			$this->_v = $t;
		}
	}

	public function __set($name,$value)
	{
		$this->_v[$name] = $value;
	}

	public function __get($name)
	{ 	
		if(array_key_exists($name, $this->_v)){
			return $this->_v[$name];
		}
		else{
			throw new \Exception('Propiété inexistante');
		}	
	}

	public function insert(){
		static::$query = query::table(static::$table);
		$id = static::$query->insert($this->_v);
		$this->_v[static::$primary] = (int) $id;
		return $id;
	}

	public function delete(){
		static::$query = query::table(static::$table);
		static::$query->delete(static::$primary, $this->_v[static::$primary]);
	}

	public static function where($colonne, $operateur, $value){
		static::$query = query::table(static::$table);
		static::$query->where($colonne, $operateur, $value);
		return static::$query;
	}

	public static function select($colonnes){
		static::$query = query::table(static::$table);
		static::$query->select($colonnes);
		return static::$query;
	}

	public static function all(){
		static::$query = query::table(static::$table);
		$all = static::$query->get();
		return $all;
	}

	public static function find($id, $columns = array()){
		static::$query = query::table(static::$table);
		static::$query->select($columns);
		if(is_array($id)){
			if(is_array($id[0])){
				static::$query->select($columns);
				foreach ($id as $parametre){
					static::$query->where($parametre[0], $parametre[1], $parametre[2]);
				}
			}
			else{
				static::$query->where($id[0], $id[1], $id[2]);
			}			
		}
		else{
			static::$query->where(static::$primary, "=", $id);
		}
		return static::$query->get();
	}

	public static function first($id, $columns = array()){
		return static::find($id, $columns)[0];
	}

	public function belongs_to($model, $key){
		static::$query = query::table($model);
		$class = "\models\\".$model;
		$m = new $class;
		return static::$query->where($m::$primary, "=", $this->_v[$key])->get()[0];
	}

	public function has_many($model, $key){
		static::$query = query::table($model);
		return static::$query->where($key, "=", $this->_v[$this::$primary])->get();
	}
}
?>