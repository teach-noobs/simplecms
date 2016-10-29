<form method="post">
	<div class="errors"></div>
	<h3>Заголовок страницы</h3>
	<input type="text" name="title" id="stitle" value="<?=$fields['title']?>">
	<br>
	<h3>Контент</h3>
	<textarea id="replace" rows="8" name="content"><?=$fields['content']?></textarea><br>
</form>
