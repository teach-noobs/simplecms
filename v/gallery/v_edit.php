<div class="control-group">
	<h2>Редактирование данных изображения: 
	<a href="/gallery/images/<?=$gallery['id_gallery']?>"><?=$gallery['title']?></a> -> <?=$fields['path']?></h2>
	<a href="<?=IMG_DIR.$fields['path']?>" target="_blanc" data-lightbox="<? $a = explode('.', $fields['path']); echo "$a[0]"; ?>">
	<img class="img-polaroid" src="<?=IMG_SMALL_DIR.$fields['path']?>"></a>
</div><br>
<div id="usersettings">
	<form method="post">
		<div class="control-group">
			<label class="control-label" for="stitle">Заголовок изображения</label>
			<div class="controls">
				<div class="input-prepend">
					<input type="text" name="title_image" id="stitle" value="<?=$fields['title_image']?>">
				</div>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="sk">Альтернативный текст</label>
			<div class="controls">
				<div class="input-prepend">
					<input type="text" name="alt" id="sk" value="<?=$fields['alt']?>">
				</div>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="hrf">Ссылка для перехода</label>
			<div class="controls">
				<div class="input-prepend">
					<input type="text" name="href" id="hrf" value="<?=$fields['href']?>">
				</div>
			</div>
		</div>
		<br><p><a href="/gallery/images/<?=$gallery['id_gallery']?>">Вернуться в галерею</a></p><br>
		<input type="submit" value="Сохранить" class="btn btn-primary btn">
	</form>
</div>