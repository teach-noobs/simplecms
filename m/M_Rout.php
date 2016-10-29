<?php

class M_Rout
{	
	private $controller;
	private $action;
	private $params;
	
	public function __construct($url)
	{
		$info = explode('/', $url);		
		$this->params = array();

		foreach ($info as $v)
		{
			if ($v != '')
				$this->params[] = $v;
		}

		if (empty($this->params))
			$this->params[0] = null;

		$this->action = 'action_';
		$this->action .= (isset($this->params[1])) ? $this->params[1] : 'index';

		switch ($this->params[0])
		{
			case 'widget':
				$this->controller = 'C_Widget';
				break;
			case 'page':
				$this->controller = 'C_Page';
				break;
			case 'users':
				$this->controller = 'C_Users';
				break;
			case 'gallery':
				$this->controller = 'C_Gallery';
				break;
			case 'pages':
				$this->controller = 'C_Pages';
				break;
			case 'articles':
				$this->controller = 'C_Articles';
				break;
			case 'texts':
				$this->controller = 'C_Texts';
				break;
			case 'news':
				$this->controller = 'C_News';
				break;
			case 'docs':
				$this->controller = 'C_Docs';
				break;
			case 'menu':
				$this->controller = 'C_Menu';
				break;
			case 'auth':		
				$this->controller = 'C_Auth';
				break;
			case 'ajax':		
				$this->controller = 'C_Ajax';
				break;
			case 'templates':		
				$this->controller = 'C_Templates';
				break;
			case 'login':
				$this->controller = 'C_Auth';
				$this->action = 'action_login';
				break;
			case 'search':
				$this->controller = 'C_Page';
				$this->action = 'action_search';
				break;
			case 'frontedit':
				$this->controller = 'C_Ajax_Frontedit';
				break;
            case 'trash':
                $this->controller = 'C_Trash';
                break;                
			case null:
				$this->controller = 'C_Page';
				$this->action = 'action_index';
				break;
			default:
				$this->controller = 'C_Page';
				$this->action = 'action_index';
		}
	}
	
	public function Request()
	{
		$c = new $this->controller();
		$c->Go($this->action, $this->params);
	}
}
