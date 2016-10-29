<h2>Создание новой новости</h2>

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
		<div class="control-group">
			<label class="control-label" for="file">Изображение</label>
			<div class="controls">
				<div class="input-prepend">
					<input type="file" name="file" id="file">
				</div>
			</div>
		</div>
		<textarea id="replace" rows="8" name="content"><?=$fields['content']?></textarea><br>
		<!--<input type="checkbox" name="is_show" <?if(isset($fields['is_show'])) echo 'checked';?>>-->
        <label class="radio">
          <input type="radio" name="is_show" value="1" <?if(isset($fields['is_show'])) echo 'checked';?>>
          Отображать на сайте
        </label>
        <label class="radio">
          <input type="radio" name="is_show" value="0" <?if(!isset($fields['is_show'])) echo 'checked';?>>
          Не отображать на сайте
        </label>
        <label class="radio">
          <input type="radio" name="is_show" value="2" <?if($fields['is_show'] == '2') echo 'checked';?>>
          Отправить в корзину
        </label> 
		<br><br>
		<input type="submit" value="Создать" class="btn btn-success">
		<a class="btn btn-danger" href="/articles/all"> Закрыть без сохранения</a>
	</form>
</div>