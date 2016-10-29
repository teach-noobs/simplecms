<?php
//
// Universal Search Engine
//

class M_Search
{
	private static $instance;	// экземпляр класса
	protected $search_map;
	protected $db;
	protected $errors = array();
	
	public static function Instance()
	{
		if (self::$instance == null)
			self::$instance = new self();
			
		return self::$instance;
	}
	
	protected function __construct()
	{
		$this->db = M_MSQL::Instance();
		$this->search_map = include_once(SEARCH_PATH);
	}
	
	public function find($string)
	{
		if($string == ''){
			$this->errors[] = 'EMPTY_SEARCH_WORD';
			return false;
		}
		
		$results = array();		
		$string = preg_replace('/[|%_\']+/', '', $string);
		$string = htmlspecialchars($string);
		
		foreach($this->search_map as $key => $table){
			if(count($table['fields'] > 0))
			{
				$where = $this->create_condition($table['fields'], $string);
				$dop_where = ($table['where'] != '') ? " AND {$table['where']}" : '';
				$results[$key] = $this->db->Select("SELECT * FROM $key WHERE 
													($where) $dop_where");
			}
		}
		
		return $results;
	}
	
	public function get_template($table){
		return $this->search_map[$table]['template'];
	}
	
	public function getErrors(){
		return $this->errors;
	}
	
	private function create_condition($fields, $string){
		$sets = array();
		
		foreach($fields as $field)
			$sets[] = " $field LIKE '%$string%'";
		
		return implode(' OR ', $sets);
	}
	
}