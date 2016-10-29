<?phpclass M_Gallery extends M_Model{	private static $instance;	// ��������� ������	public static function Instance()	{		if (self::$instance == null)			self::$instance = new self();					return self::$instance;	}		public function __construct(){		parent::__construct('gallery', 'id_gallery');	}		public function all()	{		return $this->db->Select("SELECT * FROM gallery");	}		public function get($id)	{		$id = (int)$id;		$res = $this->db->Select("SELECT * FROM gallery WHERE id_gallery = '$id'");		return $res[0];	}	public function get_images($id_gallery)	{	$id_gallery = (int)$id_gallery;		return $this->db->Select("SELECT * FROM gallery_images 								 LEFT JOIN images using(id_image)								 WHERE id_gallery = '$id_gallery'								 ORDER BY num_sort ASC");	}		// add �� ����� - ���� � ��������		public function add_image($id_gallery, $id_image)	{		return $this->db->Insert('gallery_images', array('id_gallery' => (int)$id_gallery,						'id_image' => (int)$id_image));	}		public function delete_image($id_gallery, $id_image)	{		$id_gallery = (int)$id_gallery;		$id_image = (int)$id_image;		$this->db->Delete('gallery_images', "id_gallery='$id_gallery' 						   AND id_image='$id_image'");		return M_Images::Instance()->delete($id_image);	}	public function delete_gallery($id_gallery)	{		$id_gallery = (int)$id_gallery;		// ������� �����		foreach($this->get_images($id_gallery) as $image) {			$this->delete_image($id_gallery, $image['id_image']);		}		// ������ ����		$this->db->Delete('gallery_images', "id_gallery='$id_gallery'");		parent::delete($id_gallery);	}		public function edit($id_page, $fields)	{		$pages = explode(',', $fields['pages']);		unset($fields['pages']);			if(in_array('', $fields))			return false;			$id_page = (int)$id_page;			$fields['full_cache_url'] = $this->make_full_url($fields['id_parent'], $fields['url']); 		$fields['is_show'] = !isset($fields['is_show']) ? 0 : 1;		$where = "id_page = '$id_page'";		$this->db->Update('pages', $fields, $where);		$this->change_url($id_page);						$obj = array();				for($i = 0; $i < count($pages); $i++)		{			$id_page = (int)$pages[$i];			$where = "id_page='$id_page'";			$obj['children_sort'] = $i;			$this->db->Update('pages', $obj, $where);		}				return true;	}	public function sorting($id_gallery, $images)	{		$id_gallery = (int)$id_gallery;		$obj = array();				for($i = 0; $i < count($images); $i++)		{			$id_image = (int)$images[$i];			$where = "id_gallery='$id_gallery' AND id_image='$id_image'";			$obj['num_sort'] = $i;			$this->db->Update('gallery_images', $obj, $where);		}				return true;	}}