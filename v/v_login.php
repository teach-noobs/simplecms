<?/*
Шаблон авторизации пользователя
===============================
$login - логин пользователя

*/?>
<h1>Авторизация</h1>
<form method="post">
	Логин:
	<br/>
	<input name="login" type="text" value=""/>
	<br/>
	Пароль:
	<br/> 
	<input name="password" type="password" value=""/>
	<br/>
	<input type="checkbox" name="remember" /> запомнить меня
	<br/>	
	<input type="submit" value="Войти"/>
	<br/>
	<br/>	
	<a href="/">Главная страница</a>
</form>
