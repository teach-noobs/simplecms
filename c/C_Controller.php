<?php//// ������� ����� �����������.//abstract class C_Controller{	// ������ � ����������� - ������ $_GET	protected $params;	// ��������� �������� �������	protected abstract function render();		// ������� �������������� �� ��������� ������	protected abstract function before();		public function Go($action, $params)	{		$this->params = $params;		$this->before();		$this->$action();		$this->render();	}		//	// ������ ���������� ������� GET?	//	protected function IsGet()	{		return $_SERVER['REQUEST_METHOD'] == 'GET';	}	//	// ������ ���������� ������� POST?	//	protected function IsPost()	{		return $_SERVER['REQUEST_METHOD'] == 'POST';	}	//	// ��������� HTML ������� � ������.	//	protected function Template($fileName, $vars = array())	{		// ��������� ���������� ��� �������.		foreach ($vars as $k => $v)		{			$$k = $v;		}		// ��������� HTML � ������.		ob_start();		include "$fileName";		return ob_get_clean();		}			// ���� ������� �����, �������� ��� - ��������� ������	public function __call($name, $params){        $this->p404();	}		public function p404(){       $c = new C_Page();	   $c->Go('action_404', array());	   die();	}		public function request($url)	{		ob_start();				if(strpos($url, 'http://') === 0 || strpos($url, 'https://'))			echo file_get_contents($url);		else		{			$rout = new M_Rout($url);			$rout->Request();		}				return ob_get_clean();	}		// 	protected function redirect($url){			if($url[0] == '/')			$url = BASE_URL . substr($url, 1);		header("location: $url");		exit();	}		protected function replace_widgets($str)	{		return preg_replace_callback(			WIDGETS_REPLACE_PATTERN,			create_function('$matches', 'return C_Controller::request($matches[2]);'),			$str		);	}}