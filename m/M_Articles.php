<?php
class M_Articles extends M_Model
{	
	private static $instance;	// ��������� ������
	
	public static function Instance()
	{
		if (self::$instance == null)
			self::$instance = new self();
			
		return self::$instance;
	}

	public function __construct(){
		parent::__construct('articles', 'id_article');
	}
	
	public function get($id_article, $is_show = false){
		$article = parent::get($id_article);
		
		if($is_show && $article['is_show'] != 1)
			return array();
		
		$image = M_Images::Instance()->get($article['id_image']);
		
		if(is_array($article) && is_array($image))
			$article = array_merge($article, $image);
		
		return $article;
	}
	
	public function add($fields){
		$mImages = M_Images::Instance();
		$id_image = $mImages->simple_upload($fields['file']);
		
		if(!$id_image){
			$this->errors = $mImages->errors();
			return false;
		}
		
		$fields['id_image'] = $id_image;
		$res = parent::add($fields);
		
		if(!$res)
			$mImages->delete($id_image);
			
		return $res;
	}
	
	public function edit($pk, $fields){
			$one = $this->get($pk);
			
		if($fields['file']['name'] != ''){
			$mImages = M_Images::Instance();
			$id_image = $mImages->simple_upload($fields['file']);
		
			if(!$id_image){
				$this->errors = $mImages->errors();
				return false;
			}

			$fields['id_image'] = $id_image;	
		}
		else
			unset($fields['file']);
		
		$res = parent::edit($pk, $fields);
		$delete_id = ($res) ? (($id_image) ? $one['id_image'] : $id_image) : $id_image;
		
		if($delete_id)
			M_Images::Instance()->delete($delete_id);
			
		return $res;
	}
	
	public function delete($pk){
		$one = $this->get($pk);
		M_Images::Instance()->delete($one['id_image']);
		return parent::delete($pk);
	}

    public function latest($limit=5, $id_article)
    {
        return $this->db->Select("SELECT * FROM {$this->table}
                                      LEFT JOIN images using (`id_image`)
                                      WHERE `is_show` = '1'
                                      AND `id_article` != $id_article
                                      ORDER BY dt DESC LIMIT $limit");
    }
    
    public function intro($str, $symbols, $word_whole = false){
	 	$str = strip_tags($str);
	  
	  	if(strlen($str) > $symbols){
	   		$str = substr($str, 0, $symbols);
	   
		   	if($word_whole){
			    $temp = explode(' ', $str);
			    unset($temp[count($temp) - 1]);
			    $str = implode(' ', $temp);
		   	}
	   
	   		$str .= '...';
	  	}
	  
	  	return $str;
	}
}


