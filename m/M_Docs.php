<?php
class M_Docs extends M_Model
{	
	private static $instance;	// экземпляр класса
	
	public static function Instance()
	{
		if (self::$instance == null)
			self::$instance = new self();
			
		return self::$instance;
	}

	public function __construct(){
		parent::__construct('docs', 'id_doc');
	}
	
	public function all_shown()
	{
		return $this->db->Select("SELECT * FROM {$this->table} WHERE `is_show`");
	}

	public function add($fields){
		$fields['is_show'] = !isset($fields['is_show']) ? 0 : 1;
		return parent::add($fields);
	}
	
	public function edit($pk, $fields){
		$fields['is_show'] = !isset($fields['is_show']) ? 0 : 1;
		return parent::edit($pk, $fields);
	}
	
	public function delete($pk)
	{
		$one = $this->get($pk);
		
		if(empty($one))
			return false;
			
		$res = parent::delete($pk);
			
		if(file_exists(DOCS_DIR . $one['path']))
			unlink(DOCS_DIR . $one['path']);
			
		return $res;
	}
	
	public function check_type($name)
	{
		return preg_match(DOCS_TYPES , $name) ? 1 : -1;
	}
}


