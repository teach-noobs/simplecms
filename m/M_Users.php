<?php

//
// Менеджер пользователей
//
class M_Users extends M_Model
{	
	private static $instance;	// экземпляр класса
	private $msql;				// драйвер БД
	private $sid;				// идентификатор текущей сессии
	private $uid;				// идентификатор текущего пользователя
	private $onlineMap;			// карта пользователей online
	private $privs_cahce;		// кэш привиллегий пользователя, чтобы БД не мучать при выхове Can
	
	//
	// Получение экземпляра класса
	// результат	- экземпляр класса MSQL
	//
	public static function Instance()
	{
		if (self::$instance == null)
			self::$instance = new M_Users();
			
		return self::$instance;
	}

	//
	// Конструктор
	//
	public function __construct()
	{
		parent::__construct('users', 'id_user');
		$this->sid = null;
		$this->uid = null;
		$this->onlineMap = null;
		$this->privs_cahce = array();
	}
	
	//
	// Получить всех пользователей с ролями и привилегиями
	//
	public function all()
	{
		return $this->db->Select("SELECT users.id_user, users.login, users.name, 
								  roles.description, privs.description as description_priv
								  FROM users 
								  LEFT JOIN roles using(id_role) 
								  LEFT JOIN privs2roles using(id_role) 
								  LEFT JOIN privs using(id_priv)");
	}
	
	public function add($fields)
	{
		$fields['password'] = md5($fields['password']);
		return parent::add($fields);	
	}
	
	//
	// Редактирование данных пользователя
	//
	public function edit($id_user, $fields)
	{
		if(trim($fields['password']) == "")
			unset($fields['password']);
		else
			$fields['password'] = md5($fields['password']);
		
		$id_user = (int)$id_user;
		return parent::edit($id_user, $fields);
	}
	
	//
	// Удаление пользователя
	//
	public function delete($id_user)
	{
		$id_user = (int)$id_user;
		return $this->db->Delete('users', "id_user='$id_user'");
	}
	
	//
	// Очистка неиспользуемых сессий
	// 
	public function ClearSessions()
	{
		$min = date('Y-m-d H:i:s', time() - 60 * 20); 			
		$t = "time_last < '%s'";
		$where = sprintf($t, $min);
		$this->db->Delete('sessions', $where);
	}

	//
	// Авторизация
	// $login 		- логин
	// $password 	- пароль
	// $remember 	- нужно ли запомнить в куках
	// результат	- true или false
	//
	public function Login($login, $password, $remember = true)
	{
		// вытаскиваем пользователя из БД 
		$user = $this->GetByLogin($login);

		if ($user == null)
			return false;
		
		$id_user = $user['id_user'];
				
		// проверяем пароль
		if ($user['password'] != md5($password))
			return false;
				
		// запоминаем имя и md5(пароль)
		if ($remember)
		{
			$expire = time() + 3600 * 24 * 100;
			setcookie('login', $login, $expire);
			setcookie('password', md5($password), $expire);
		}		
				
		// открываем сессию и запоминаем SID
		$this->sid = $this->OpenSession($id_user);
		
		return true;
	}
	
	//
	// Выход
	//
	public function Logout()
	{
		setcookie('login', '', time() - 1);
		setcookie('password', '', time() - 1);
		unset($_COOKIE['login']);
		unset($_COOKIE['password']);
		unset($_SESSION['sid']);		
		$this->sid = null;
		$this->uid = null;
	}
						
	//
	// Получение пользователя
	// $id_user		- если не указан, брать текущего
	// результат	- объект пользователя
	//
	public function Get($id_user = null)
	{	
		// Если id_user не указан, берем его по текущей сессии.
		if ($id_user == null)
			$id_user = $this->GetUid();
			
		if ($id_user == null)
			return null;
			
		// А теперь просто возвращаем пользователя по id_user.
		$t = "SELECT * FROM users WHERE id_user = '%d'";
		$query = sprintf($t, $id_user);
		$result = $this->db->Select($query);
		return $result[0];		
	}
	
	//
	// Получает пользователя по логину
	//
	public function GetByLogin($login)
	{	
		$t = "SELECT * FROM users WHERE login = '%s'";
		$query = sprintf($t, mysql_real_escape_string($login));
		$result = $this->db->Select($query);
		return $result[0];
	}
			
	//
	// Проверка наличия привилегии
	// $priv 		- имя привилегии
	// $id_user		- если не указан, значит, для текущего
	// результат	- true или false
	//
	public function Can($priv, $id_user = null)
	{		
		if ($id_user == null)
		    $id_user = $this->GetUid();
		    
		if ($id_user == null)
		    return false;
		
		if(!isset($this->privs_cahce[$priv][$id_user]))
		{		
			$t = "SELECT count(*) as cnt FROM privs2roles p2r
				  LEFT JOIN users u ON u.id_role = p2r.id_role
				  LEFT JOIN privs p ON p.id_priv = p2r.id_priv 
				  WHERE u.id_user = '%d' AND (p.name = '%s' OR p.name = 'ALL')";
		
			$query  = sprintf($t, $id_user, $priv);
			$result = $this->db->Select($query);
			$this->privs_cahce[$priv][$id_user] = ($result[0]['cnt'] > 0);
		}
		
		return $this->privs_cahce[$priv][$id_user];
	}

	//
	// Проверка активности пользователя
	// $id_user		- идентификатор
	// результат	- true если online
	//
	public function IsOnline($id_user)
	{		
		if ($this->onlineMap == null)
		{	    
		    $t = "SELECT DISTINCT id_user FROM sessions";		
		    $query  = sprintf($t, $id_user);
		    $result = $this->db->Select($query);
		    
		    foreach ($result as $item)
		    	$this->onlineMap[$item['id_user']] = true;		    
		}
		
		return ($this->onlineMap[$id_user] != null);
	}
	
	public function GetPrivs()
	{	
		$user = $this->Get();
		
		if($user == null)
			return array();
		
		$t = "SELECT privs.name as name FROM privs2roles LEFT JOIN privs using(id_priv) 
			 WHERE id_role = '%s'";
		$query = sprintf($t, mysql_real_escape_string($user['id_role']));
		$result = $this->db->Select($query);
		
		$privs = array();
		
		foreach($result as $one)
			$privs[] = $one['name'];
			
		return $privs;
	}
	
	public function getRoles()
	{	
		return $this->db->Select("SELECT * FROM roles");
	}
	
	//
	// Получение id текущего пользователя
	// результат	- UID
	//
	public function GetUid()
	{	
		// Проверка кеша.
		if ($this->uid != null)
			return $this->uid;	

		// Берем по текущей сессии.
		$sid = $this->GetSid();
				
		if ($sid == null)
			return null;
			
		$t = "SELECT id_user FROM sessions WHERE sid = '%s'";
		$query = sprintf($t, mysql_real_escape_string($sid));
		$result = $this->db->Select($query);
				
		// Если сессию не нашли - значит пользователь не авторизован.
		if (count($result) == 0)
			return null;
			
		// Если нашли - запоминм ее.
		$this->uid = $result[0]['id_user'];
		return $this->uid;
	}

	//
	// Функция возвращает идентификатор текущей сессии
	// результат	- SID
	//
	private function GetSid()
	{
		// Проверка кеша.
		if ($this->sid != null)
			return $this->sid;
	
		// Ищем SID в сессии.
		if (isset($_SESSION['sid']))
			$sid = $_SESSION['sid'];
		else $sid = null;
								
		// Если нашли, попробуем обновить time_last в базе. 
		// Заодно и проверим, есть ли сессия там.
		if ($sid != null)
		{
			$session = array();
			$session['time_last'] = date('Y-m-d H:i:s'); 			
			$t = "sid = '%s'";
			$where = sprintf($t, mysql_real_escape_string($sid));
			$affected_rows = $this->db->Update('sessions', $session, $where);

			if ($affected_rows == 0)
			{
				$t = "SELECT count(*) FROM sessions WHERE sid = '%s'";		
				$query = sprintf($t, mysql_real_escape_string($sid));
				$result = $this->db->Select($query);
				
				if ($result[0]['count(*)'] == 0)
					$sid = null;			
			}			
		}		
		
		// Нет сессии? Ищем логин и md5(пароль) в куках.
		// Т.е. пробуем переподключиться.
		if ($sid == null && isset($_COOKIE['login']))
		{
			$user = $this->GetByLogin($_COOKIE['login']);
			
			if ($user != null && $user['password'] == $_COOKIE['password'])
				$sid = $this->OpenSession($user['id_user']);
		}
		
		// Запоминаем в кеш.
		if ($sid != null)
			$this->sid = $sid;
		
		// Возвращаем, наконец, SID.
		return $sid;		
	}
	
	//
	// Открытие новой сессии
	// результат	- SID
	//
	private function OpenSession($id_user)
	{
		// генерируем SID
		$sid = $this->GenerateStr(10);
				
		// вставляем SID в БД
		$now = date('Y-m-d H:i:s'); 
		$session = array();
		$session['id_user'] = $id_user;
		$session['sid'] = $sid;
		$session['time_start'] = $now;
		$session['time_last'] = $now;				
		$this->db->Insert('sessions', $session); 
				
		// регистрируем сессию в PHP сессии
		$_SESSION['sid'] = $sid;				
				
		// возвращаем SID
		return $sid;	
	}

	//
	// Генерация случайной последовательности
	// $length 		- ее длина
	// результат	- случайная строка
	//
	private function GenerateStr($length = 10) 
	{
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
		$code = "";
		$clen = strlen($chars) - 1;  

		while (strlen($code) < $length) 
            $code .= $chars[mt_rand(0, $clen)];  

		return $code;
	}
}
