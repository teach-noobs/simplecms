<div id="usersettings">
	<h2>Галерея: <?=$gallery['title']?></h2>
	<a href="/gallery/upload/<?=$gallery['id_gallery']?>">Загрузить изображения</a><br><br>
	<div>
		<input type="button" id="btn_save" value="Сохранить сортировку" class="btn btn-danger">
		<span id="msg_save">Сохранено</span>
	</div>
	<? if(count($images) > 0):?>
		<ul id="gallery_sortable" class="noicons noshifts">
		<? foreach($images as $img):?>
			<li class="delimg" id_image="<?=$img['id_image']?>">
				<form method="post">
					<input type="submit" class="delete" value="">
					<input type="hidden" name="id_gallery" value="<?=$img['id_gallery']?>">
					<input type="hidden" name="id_image" class="delete" value="<?=$img['id_image']?>">
				</form>
				<a href="gallery/edit/<?=$img['id_image']?>/<?=$gallery['id_gallery']?>">Редактировать</a>
				<img class="im" src="<?=IMG_SMALL_DIR . $img['path']?>">
				
			</li>
		<? endforeach ?>
		</ul>
	<? else: ?>
		<p>В галерее нет изображений</p>
	<? endif; ?>
</div>
<div class="clear"></div><br>
<p>Для изменения последовательности показа переместите изображения.</p><br>
<a href="/gallery/ "> Вернуться к списку галерей</a>