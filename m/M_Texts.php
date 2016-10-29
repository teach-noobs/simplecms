<?php
class M_Texts extends M_Model
{	
	private static $instance;	
	private $field;
	private static $cache;
	
	public static function Instance()
	{
		if (self::$instance == null)
			self::$instance = new self();
			
		return self::$instance;
	}

	public function __construct(){
		parent::__construct('texts', 'id_text');
		$this->field = 'alias';
		self::$cache = null;
	}
	
	public function getByA($alias)
	{
		if(self::$cache == null)
			$this->load_texts();
		
		return self::$cache[$alias];
	}
	
	private function load_texts()
	{
		$texts = $this->all();
		
		foreach($texts as $text)
			self::$cache[$text['alias']] = $text;
	}
}


