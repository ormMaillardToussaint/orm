<?php
namespace query;
use \database\ConnexionFactory;
class query
{
	private $table;
	private $colonne = "*";
	private $where;
	private $args = array();
	private $pdo;

	public static function table($table)
	{
		$a = new query();
		$a->table = $table;
		$conf = parse_ini_file('src/conf/conf.ini');
		$a->pdo = ConnexionFactory::makeConnection($conf);
		$a->pdo->getConnection();
		return $a;
	}

	public function get()
	{
		$sql = "select ".$this->colonne." from ".$this->table." ".$this->where;
		$req = $this->pdo->conn->prepare($sql);
		$values = array();
		if($this->where != ""){
			if(!empty($this->args)){
				for($i = 1; $i <= count($this->args); $i++){
					$values["value".$i] = $this->args[$i-1]["value"];
				}
			}			
		}
		if($req->execute($values)){
			$return = array();
			foreach ($req->fetchAll() as $element) {
				$class = "\models\\".$this->table;
				$model = new $class;
				foreach ($element as $key => $value){				
					if(gettype($key) != "integer"){
						$model->$key = $value;
					}
				}
				array_push($return, $model);
			}
			return $return;
		}
		return false;		
	}

	public function select($colonnes){
		if(!empty($colonnes)){
			foreach ($colonnes as $c) {
				if($this->colonne == "" || $this->colonne == "*"){
					$this->colonne = $c;
				}
				else{
					$this->colonne .= ", ".$c;
				}
			}
		}
		return $this;
	}

	public function where($colonne, $operateur, $value){
		array_push($this->args, array("colonne" => $colonne, "operateur" => $operateur, "value" => $value)) ;
		if($this->where == ""){
			$this->where = "where ";
			$this->where .= $colonne." ".$operateur." :value1";
		}
		else{
			$n = intval(substr($this->where, strlen($this->where) - 1, 1)) + 1;
			$this->where .= " and ".$colonne." ".$operateur." :value".$n;
		}
		return $this;
	}

	public function delete($primary, $value){
		$sql = "delete from ".$this->table." where ".$primary." = ".$value;
		$req = $this->pdo->conn->exec($sql);
	}

	public function insert($data){
		$sql = "insert into ".$this->table." (";
		foreach ($data as $key => $value) {
			if(substr($sql, strlen($sql) - 1, 1) == "("){
				$sql .= $key;
			}
			else{
				$sql .= ", ".$key;
			}
		}
		$sql .= ") values (";
		for($i = 0;$i < count($data); $i++){
			if(substr($sql, strlen($sql) - 1, 1) == "("){
				$sql .= ":value1";
			}
			else{
				$sql .= ", :value".($i + 1);
			}
		}
		$sql .= ")";
		$values = array();
		$i = 1;
		foreach($data as $key => $value){
			$values["value".$i] = $value;
			$i++;
		}
		$req = $this->pdo->conn->prepare($sql);
		if($req->execute($values)){
			return $this->pdo->conn->lastInsertId();
		}
		return false;
	}
}
?>