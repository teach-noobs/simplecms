<?phpclass C_Ajax extends C_Controller{	//	// Конструктор.	//	public function __construct(){	}		public function before(){	}		public function render(){	}		public function action_ckupload(){			if(M_Users::Instance()->Get() == null)			die();			$callback = 3;		$file_name = $_FILES['upload']['name'];				$getMime = explode('.', $file_name);		$mime = end($getMime);				$types = array('jpg', 'png', 'gif', 'bmp', 'jpeg');		if(!in_array($mime, $types))		{			$error = "Go Home";			$http_path = '';		}		else		{			$file_name = substr_replace(sha1(microtime(true)), '', 12).'.'.$mime;											$file_name_tmp = $_FILES['upload']['tmp_name'];			$file_new_name = CKUPLOAD_DIR;			$full_path = $file_new_name.$file_name;						if(copy($file_name_tmp, $full_path)){				$http_path = "/".$full_path;				$error = '';			}			else			{				$error = "Произошла ошибка, попробуйте еще раз";				$http_path = '';			}		}		echo "<script>window.parent.CKEDITOR.tools.callFunction($callback, \"".$http_path."\",\"".$error."\");</script>";	}		public function action_image(){			if(M_Users::Instance()->Get() == null)			die();			if($id_image = M_Images::Instance()->upload_base64($_POST['name'], $_POST['value']))		{			M_Gallery::Instance()->add_image($_POST['id_gallery'], $id_image);			die($_POST['name'] . ':загружен успешно');		}				die($_POST['name'] . ':ошибка загрузки');		}		public function action_uploadDoc(){		if(!M_Session::has('hash') || !M_Session::has('name') || !M_Session::has('uploaddir')){			header("HTTP/1.0 500 Internal Server Error");			print "Wrong session hash.";			die();		}				$uploaddir = M_Session::read('uploaddir');		$name = M_Session::read('name');		if (preg_match("/^[0123456789abcdef]{32}$/i", M_Session::read('hash'))) {			if ($_SERVER["REQUEST_METHOD"] == "GET") {				if ($this->params[2] == "abort") {					if (is_file($uploaddir."/".$name.".html5upload")) unlink($uploaddir."/".$name.".html5upload");					print "ok abort";					M_Session::kick(array('name', 'hash', 'uploaddir'));					return;				}				if ($this->params[2] == "done") {					if (is_file($uploaddir."/".$name.".original")) 						unlink($uploaddir."/".$name.".original");					rename($uploaddir."/".$name.".html5upload", $uploaddir."/".$name);							M_Session::push('done', $name);					M_Session::kick(array('name', 'hash', 'uploaddir'));				}			}			elseif ($_SERVER["REQUEST_METHOD"]=="POST"){				$filename = $uploaddir . "/" . $name .  ".html5upload";								if (intval($_SERVER["HTTP_PORTION_FROM"]) == 0) 					$fout = fopen($filename,"wb");				else					$fout = fopen($filename,"ab");				if (!$fout) {					header("HTTP/1.0 500 Internal Server Error");					print "Can't open file for writing.";					return;				}				$fin = fopen("php://input", "rb");				if ($fin) {					while (!feof($fin)) {						$data=fread($fin, 1024*1024);						fwrite($fout,$data);						}					fclose($fin);					}				fclose($fout);				}			header("HTTP/1.0 200 OK");			print "ok\n";			}		else {			header("HTTP/1.0 500 Internal Server Error");			print "Wrong session hash.";		}	}		public function action_galsort(){			if(M_Users::Instance()->Get() == null)			die();			echo (int)M_Gallery::Instance()->sorting($_POST['id_gallery'], $_POST['images']);	}		public function action_getgallery(){  		foreach (M_Gallery::Instance()->all() as $key => $val){   		 			$data[$key]['id_gallery'] = $val['id_gallery'];			$data[$key]['title'] = $val['title'];			}					echo json_encode($data);                	}	public function action_getdocuments(){  		foreach (M_Docs::Instance()->all_shown() as $key => $val){   		 			$data[$key]['id_document'] = $val['id_doc'];			$data[$key]['title'] = $val['title'];			$data[$key]['type'] = $val['type'];			}					echo json_encode($data);                	}}