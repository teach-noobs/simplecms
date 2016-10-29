<?php

class M_Model
{
	protected $table;		// имя талицы
	protected $pk;			// первичный ключ
	protected $db;			// модуль для работы с бд
	protected $errors;		// список ошибок
	private $valid;			// модуль валидации

	
	public function __construct($table, $pk)
	{
		$this->table = $table;
		$this->pk = $pk;
		$this->errors = array();
		$this->valid = null;
		$this->db = M_MSQL::Instance();
	}
	
	public function all()
	{
		return $this->db->Select("SELECT * FROM {$this->table}");
	}

	public function get($id)
	{
		$id = (int)$id;
		$res = $this->db->Select("SELECT * FROM {$this->table} WHERE {$this->pk} = '$id'");
		return $res[0];
	}
	
	public function add($fields)
	{
		$this->errors = array();  // обнуляем список ошибок
		$valid = $this->load_validation(); // подгружаем модуль валидации
		
		$valid->execute($fields); 
		if($valid->good())
			return $this->db->Insert($this->table, $valid->getObj());
		
		$this->errors = $valid->errors();
		return false;
	}
	
	public function edit($pk, $fields)
	{
		$this->errors = array();  		   // обнуляем список ошибок
		$valid = $this->load_validation(); // подгружаем модуль валидации
		
		$valid->execute($fields, $pk); 
		if($valid->good()){
			$this->db->Update($this->table, $valid->getObj(), "{$this->pk} = '$pk'");
			return true;
		}
		
		$this->errors = $valid->errors();
		return false;
	}
	
	public function delete($id)
	{
		$id = (int)$id;
		$this->db->Delete($this->table, "{$this->pk} = '$id'");
		return true;
	}
	
	public function remove($id)
	{
		return $this->edit($id, array('is_show'=> '2'));
	}

	public function restore($id)
	{
		return $this->edit($id, array('is_show'=> '0'));
	}

	public function errors()
	{
		return $this->errors;
	}
	
	private function load_validation()
	{
		if($this->valid == null)
			$this->valid = new M_Validation($this->table);
			
		return $this->valid;
	}

	public function get_table()
	{
		return $this->table;
	}

	public function get_pk()
	{
		return $this->pk;
	}
}