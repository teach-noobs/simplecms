<?php
class M_Images extends M_Model
{	
	private static $instance;	// экземпляр класса

	public static function Instance()
	{
		if (self::$instance == null)
			self::$instance = new self();
			
		return self::$instance;
	}

	public function __construct(){
		parent::__construct('images', 'id_image');
	}
	
	public function upload_base64($name, $value)
	{
		if(!$this->check_type($name))
			return false;
		
		$getMime = explode('.', $name);
		$mime = strtolower(end($getMime));
		$filename = mt_rand(0, 10000000) . '.' . $mime;

		while(file_exists(IMG_DIR . $filename))
			$filename = mt_rand(0, 10000000) . '.' . $mime;
		
		$id = $this->db->Insert('images', array('path' => $filename));
		$this->move_upload_base64($value, $filename);
		return $id;
	}
	
	//
	// Редактирование изображения
	//
	public function edit($id_image, $fields)
	{
		$id_image = (int)$id_image;

		$where = "id_image = '$id_image'";
		$this->db->Update('images', $fields, $where);

		return true;
	}
	
	private function check_type($name)
	{
		// Получаем расширение файла
		$getMime = explode('.', $name);
		$mime = strtolower(end($getMime));
		$types = array('jpg', 'png', 'gif', 'bmp', 'jpeg');
		return in_array($mime, $types);
	}

	public function delete($id_image)
	{
		$id_image = (int)$id_image;
		$one = $this->db->Select("SELECT * FROM images WHERE id_image='$id_image'");
		parent::delete($id_image);
		$filename = $one[0]['path'];
		
		if(file_exists(IMG_DIR . $filename))
			unlink(IMG_DIR . $filename);
			
		if(file_exists(IMG_SMALL_DIR . $filename))
			unlink(IMG_SMALL_DIR . $filename);
			
		return true;
	}
		
	private function move_upload_base64($file, $name) 
	{ 
		// Выделим данные
		$data = explode(',', $file);
		
		// Декодируем данные, закодированные алгоритмом MIME base64
		$encodedData = str_replace(' ','+',$data[1]);
		$decodedData = base64_decode($encodedData);

		// Создаем изображение на сервере
		if(file_put_contents(IMG_DIR . $name, $decodedData)){
			$this->resize(IMG_DIR . $name, IMG_SMALL_DIR . $name, IMG_SMALL_WIDTH);
			return true;
		}
		
		return false;
	}
	
	private function resize($src, $dest, $width, $height = null, $rgb = 0xFFFFFF, $quality = 100)
    {
      if (!file_exists($src)) return false;

      $size = getimagesize($src);

      if ($size === false) return false;

      // Определяем исходный формат по MIME-информации, предоставленной
      // функцией getimagesize, и выбираем соответствующую формату
      // imagecreatefrom-функцию.
      $format = strtolower(substr($size['mime'], strpos($size['mime'], '/')+1));
      $icfunc = "imagecreatefrom" . $format;
      if (!function_exists($icfunc)) return false;
		
      $x_ratio = $width / $size[0];
	  
	  if($height === null)
			$height = $size[1] * $x_ratio;
	  
      $y_ratio = $height / $size[1];

      $ratio       = min($x_ratio, $y_ratio);
      $use_x_ratio = ($x_ratio == $ratio);

      $new_width   = $use_x_ratio  ? $width  : floor($size[0] * $ratio);
      $new_height  = !$use_x_ratio ? $height : floor($size[1] * $ratio);
      $new_left    = $use_x_ratio  ? 0 : floor(($width - $new_width) / 2);
      $new_top     = !$use_x_ratio ? 0 : floor(($height - $new_height) / 2);

      $isrc = $icfunc($src);
      $idest = imagecreatetruecolor($width, $height);

      imagefill($idest, 0, 0, $rgb);
      imagecopyresampled($idest, $isrc, $new_left, $new_top, 0, 0,
        $new_width, $new_height, $size[0], $size[1]);

      imagejpeg($idest, $dest, $quality);

      imagedestroy($isrc);
      imagedestroy($idest);

      return true;
    }
	
	public function simple_upload($file)
	{
		if(!$this->check_type($file['name'])){
			$this->errors[] = 'INCORRECT_FILE_TYPE';
			return false;
		}
		
		$name = M_Helpers::unique_name(IMG_DIR, $file['name']);
		$id = $this->add(array('path' => $name));
		
		if($id && copy($file['tmp_name'], IMG_DIR . $name))
			$this->resize(IMG_DIR . $name, IMG_SMALL_DIR . $name, IMG_SMALL_WIDTH);
			
		return $id;
	}
}


