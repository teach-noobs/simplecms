<ul class="sorting">
	<?foreach($menu as $one): ?>
		<li id_page="<?=$one['id_page']?>"><?=$one['title']?></li> 
	<?endforeach;?>
</ul>
<form class="form_sorting" method="post">
	<input type="hidden" name="id_menu" value="<?=$id_menu?>">
	<input type="hidden" name="pages" value="">
	<input type="button" name="go" value="Изменить">
</form>