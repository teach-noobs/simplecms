<?phpclass C_Widget extends C_Controller{	private $content;		//	// Конструктор.	//	public function __construct(){		$this->content = '';	}		public function before(){	}		public function render(){		echo $this->content;	}		public function action_gallery(){		$id_gallery = isset($this->params[2]) ? (int)$this->params[2] : 1;		$this->content = $this->Template('v/widgets/v_gallery.php', 						array('images' => M_Gallery::Instance()->get_images($id_gallery)));	}	public function action_slider(){		$id_gallery = isset($this->params[2]) ? (int)$this->params[2] : 1;		$this->content = $this->Template('v/widgets/v_slider.php', 						array('images' => M_Gallery::Instance()->get_images($id_gallery)));	}	public function action_documents(){		$id_doc = isset($this->params[2]) ? (int)$this->params[2] : 1;		$this->content = $this->Template('v/widgets/v_docs.php', 						array('doc' => M_Docs::Instance()->get($id_doc)));	}    public function action_news(){               $news = M_Articles::Instance()->latest(2);        $this->content = $this->Template('v/widgets/v_news.php',                         array('news' => $news));    }        public function action_latest_news(){                $id_article = $this->params[2];        if($id_article == NULL) $id_article = 0;        $news = M_Articles::Instance()->latest(5 , $id_article);        foreach($news as $key=>$new){            $news[$key]['intro'] = M_Articles::Instance()->intro($new['content'], 250, true);        }        $this->content = $this->Template('v/widgets/v_latest_news.php',                         array('news' => $news));    }}