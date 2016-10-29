<h2>Редактирование новости</h2>

<? foreach($errors as $error): ?>
	<p class="error"><?=$error?></p>
<? endforeach; ?>

<div id="usersettings">
	
	<form method="post" enctype="multipart/form-data">
		<div class="control-group">
			<label class="control-label" for="dt">Дата</label>
			<div class="controls">
				<div class="input-prepend">
					<input type="text" name="dt" id="dt" class="datepicker" def="<?=$fields['dt']?>">
				</div>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="title">Заголовок</label>
			<div class="controls">
				<div class="input-prepend">
					<input type="text" name="title" id="title" value="<?=$fields['title']?>">
				</div>
			</div>
		</div>
		<input type="hidden" name="id_image" value="<?=$fields['id_image']?>">
		<div class="control-group">
			<label class="control-label">Текущее изображение</label>
			<div class="controls">
				<img src="<?=IMG_SMALL_DIR . $image['path']?>" class="art_img">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="file">Нове изображение </label>
			<div class="controls">
				<div class="input-prepend">
					<input type="file" name="file" id="file">
				</div>
				<span class="imp">(если Вы не хотите менять изображение, оставьте данное поле пустым)</span>
			</div>
		</div>
		<textarea id="replace" rows="8" name="content"><?=$fields['content']?></textarea><br>
		<!--<input type="checkbox" name="is_show" <? if($fields['is_show']) echo 'checked'; ?> > Опубликована-->
        <label class="radio">
          <input type="radio" name="is_show" value="1" <?if($fields['is_show']=='1') echo 'checked';?>>
          Отображать на сайте
        </label>
        <label class="radio">
          <input type="radio" name="is_show" value="0" <?if($fields['is_show']=='0') echo 'checked';?>>
          Не отображать на сайте
        </label>
        <label class="radio">
          <input type="radio" name="is_show" value="2" <?if($fields['is_show'] == '2') echo 'checked';?>>
          Отправить в корзину
        </label> 
		<br>
		<br>
		<input type="submit" name="save" value="Сохранить" class="btn btn-success">
		<a class="btn btn-danger" href="/articles/all"> Закрыть без сохранения</a> 
	</form>
</div>